<?php
include './../layouts/session.php';
$init = $pdo->open();
$return = $_SERVER['HTTP_REFERER'];

if(isset($_POST['user'])) {
    $name = $_POST['add-name'];
    $email = $_POST['add-email'];
    $idNo = $_POST['add-idNo'];
    $gender = $_POST['add-gender'];
    $password = $_POST['password'];
    $studentNo=date('Y').substr($idNo,2,4).substr(rand(),0,2);
    if($_POST['user'] =='Admin'){
        $sql = $init->prepare("SELECT * FROM admin WHERE email=:email ");
        $sql->execute(['email' => $email]);

        if ($sql->rowCount() > 0) {
            $_SESSION['error'] = 'Email already exits';
        } else {

            $sql = $init->prepare("INSERT INTO admin(name, email,id_number,gender, password) 
						VALUES (:name,:email,:id_number,:gender, :password)");
            $sql->execute(['name'=>$name, 'email'=>$email,'id_number'=>$idNo,'gender'=>$gender, 'password'=>$password]);
            $_SESSION['success'] = 'Admin added successfully';
        }
        header('Location: '.$return);
    }else{
        $sql = $init->prepare("SELECT * FROM student WHERE email=:email ");
        $sql->execute(['email' => $email]);

        if ($sql->rowCount() > 0) {
            $_SESSION['error'] = 'Email already exits';
        } else {

            $sql = $init->prepare("INSERT INTO student(studentNo,name, email,id_number,gender, password) 
						VALUES (:studentNo,:name,:email,:id_number,:gender, :password)");
            $sql->execute(['studentNo'=>$studentNo,'name'=>$name, 'email'=>$email,'id_number'=>$idNo,'gender'=>$gender, 'password'=>$password]);
            $_SESSION['success'] = 'Student added successfully';
        }
        header('Location: '.$return);
    }
}

if(isset($_POST['add-category'])) {
    $category = $_POST['category'];

    $sql = $init->prepare("SELECT * FROM category WHERE categoryName=:categoryName ");
    $sql->execute(['categoryName' => $category]);

    if ($sql->rowCount() > 0) {
        $_SESSION['error'] = 'Category already exits';
    } else {

        $sql = $init->prepare("INSERT INTO category(categoryName) VALUES (:categoryName)");
        $sql->execute(['categoryName'=>$category]);
        $_SESSION['success'] = 'Category added successfully';
    }
    header('Location: '.$return);
}

if(isset($_POST['message'])) {
    $message= $_POST['message'];
    $user_type = $_POST['user_type'];
    $user_id = $_POST['user_id'];

    try{
        if($user_type=='teacher'){
            $sql = $init->prepare("SELECT * FROM teacher WHERE teacher_id=:user_id ");
        }elseif ($user_type=='admin'){
            $sql = $init->prepare("SELECT * FROM admin WHERE admin_id=:user_id ");
        }else{
            $_SESSION['error'] = 'Something went wrong';
        }
        $sql->execute(['user_id'=>$user_id]);

        if ($sql->rowCount() < 1) {
            $_SESSION['error'] = 'User does not exits';
        } else {

            $sql = $init->prepare("INSERT INTO messages(sender_id,sender_type,user_id,user_type,message) 
						VALUES (:sender_id,:sender_type,:user_id,:user_type,:message)");
            $sql->execute(['sender_id'=>$_SESSION['id'],'sender_type'=>$_SESSION['user'], 'user_id'=>$user_id,'user_type'=>$user_type,'message'=>$message]);
            $_SESSION['success'] = 'Message sent successfully';
        }
    }catch (Exception $e){
        $_SESSION['error'] = $e;
    }

    header('Location: '.$return);
}

if(isset($_POST['reg-bus'])) {
    $transport_id = $_POST['reg-bus'];

    $sql = $init->prepare("SELECT * FROM transport WHERE transport_id=:transport_id ");
    $sql->execute(['transport_id' => $transport_id]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Transport does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE student SET transport=:transport
                                         WHERE student_id=:id");
            $sql->execute(['transport'=>$transport_id,'id'=>$_SESSION['id']]);
            $_SESSION['success'] = 'Transport registered successfully';
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
}
//Admin

if (isset($_POST['getAdmin'])) {
    $getAdmin = $_POST['getAdmin'];

    $sql = $init->prepare("SELECT * FROM admin WHERE admin_id=:admin_id");
    $sql->execute(['admin_id' => $getAdmin]);
    $results = $sql->fetch();

    echo json_encode($results);
}

///Student
if (isset($_POST['getStudent'])) {
    $studentNo = $_POST['getStudent'];

    $sql = $init->prepare("SELECT * FROM student WHERE student_id=:studentNo");
    $sql->execute(['studentNo' => $studentNo]);
    $results = $sql->fetch();

    echo json_encode($results);
}

if(isset($_POST['edit-student'])) {
    $studNo = $_SESSION['edit-student'];
    $name = $_POST['edit-st-name'];
    $email = $_POST['edit-st-email'];
    $id_number = $_POST['edit-st-idNo'];
    $password= $_POST['edit-password'];

    $sql = $init->prepare("SELECT * FROM student WHERE student_id=:studentNo ");
    $sql->execute(['studentNo' => $studNo]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Student does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE student SET name=:name, email=:email, id_number=:id_number,password=:password
                                         WHERE student_id=:studentNo");
            $sql->execute(['name'=>$name,'email'=>$email,'id_number'=>$id_number, 'password'=>$password,'studentNo'=>$studNo]);
            $_SESSION['success'] = 'Student updated successfully';
            $_SESSION['name'] = $name;
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
}

if(isset($_POST['delete-student'])){
    $studentNo = $_POST['delete-student'];

    try{
        $sql = $init->prepare("DELETE FROM student WHERE studentNo=:studentNo");
        $sql->execute(['studentNo'=>$studentNo]);

        $_SESSION['success'] = 'Student deleted successfully';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);

}

if(isset($_POST['endBooking'])){
    $studentNo = $_SESSION['studentNo'];

    try{

        $sql = $init->prepare("SELECT * FROM session WHERE studNumber=:studentNo");
        $sql->execute(['studentNo' => $studentNo]);
        $results = $sql->fetch();

        $sql = $init->prepare("UPDATE desk SET status=:status WHERE tblNumber=:tblNumber");
        $sql->execute(['tblNumber' => $results['tblNumber'],'status'=>'available']);

        $sql = $init->prepare("DELETE FROM session WHERE studNumber=:studentNo");
        $sql->execute(['studentNo'=>$studentNo]);

        if($_POST['end-book']){
            $_SESSION['success'] = 'Session ended successfully';
        }

    }
    catch(PDOException $e){
        echo json_encode($e->getMessage());
    }
    header('Location: '.$return);
}


//if(isset($_POST['book-session'])) {
//    $studNo = $_SESSION['studentNo'];
//    $tblNumber = $_POST['book-session'];
//    $startTime = date('H:i:sa');
//    $duration = $_POST['book-hours'];
//    $endTime = date('H:i:sa',strtotime('now +'.$duration.' hour'));
//
//    $sql = $init->prepare("SELECT * FROM desk where tblNumber=:tblNumber and status='available'");
//    $sql->execute(['tblNumber'=>$tblNumber]);
//
//    if ($sql->rowCount() < 0) {
//        $_SESSION['error'] = 'Table already booked';
//    } else {
//
//        try{
//            $sql = $init->prepare("INSERT INTO session (startTime, endTime,duration, studNumber, tblNumber)
//						VALUES (:startTime, :endTime,:duration, :studNumber,:tblNumber)");
//            $sql->execute(['startTime'=>$startTime,'endTime'=>$endTime,'duration'=>$duration,'studNumber'=>$studNo,'tblNumber'=>$tblNumber]);
//
//            $sql = $init->prepare("UPDATE desk SET status=:status WHERE tblNumber=:tblNumber");
//            $sql->execute(['tblNumber'=>$tblNumber,'status'=>'available']);
//
//            $_SESSION['success'] = 'Session booked successfully at '.$startTime;
//        }catch (Exception $e){
//            $_SESSION['error'] = $e->getMessage();
//        }
//
//    }
//    header('Location: '.$return);
//}



$pdo->close();

?>
