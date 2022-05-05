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

if(isset($_POST['add-book'])) {
    $book = $_POST['book'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $shelve = $_POST['shelve'];
    $price= $_POST['price'];
    $quantity= $_POST['quantity'];

    $sql = $init->prepare("SELECT * FROM book WHERE bookName=:bookName ");
    $sql->execute(['bookName' => $book]);

    if ($sql->rowCount() > 0) {
        $_SESSION['error'] = 'Book already exits';
    } else {

        $sql = $init->prepare("INSERT INTO book(bookName, categoryID,quantity,author, shelveNumber, price) 
						VALUES (:bookName,:categoryID,:quantity,:author, :shelveNumber, :price)");
        $sql->execute(['bookName'=>$book, 'categoryID'=>$category,'quantity'=>$quantity,'author'=>$author, 'shelveNumber'=>$shelve, 'price'=>$price]);
        $_SESSION['success'] = 'Book added successfully';
    }
    header('Location: '.$return);
}

if(isset($_POST['edit-book'])) {
    $id = $_POST['edit-book'];
    $book = $_POST['book'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $shelve = $_POST['shelve'];
    $price= $_POST['price'];
    $quantity= $_POST['quantity'];

    $sql = $init->prepare("SELECT * FROM book WHERE bookName=:bookName ");
    $sql->execute(['bookName' => $book]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Book does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE book SET bookName=:bookName, categoryID=:categoryID, quantity=:quantity,
                                         author=:author,shelveNumber=:shelveNumber,price=:price
                                         WHERE id=:id");
            $sql->execute(['bookName'=>$book, 'categoryID'=>$category,'quantity'=>$quantity,'author'=>$author, 'shelveNumber'=>$shelve, 'price'=>$price,'id'=>$id]);
            $_SESSION['success'] = 'Book updated successfully';
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
    $studNo = $_SESSION['studentNo'];
    $name = $_POST['edit-name'];
    $email = $_POST['edit-email'];
    $id_number = $_POST['edit-idNo'];
    $gender = $_POST['edit-gender'];
    $password= $_POST['edit-password'];

    $sql = $init->prepare("SELECT * FROM student WHERE studentNo=:studentNo ");
    $sql->execute(['studentNo' => $_POST['studentNo']]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Student does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE student SET name=:name, email=:email, id_number=:id_number,
                                         gender=:gender,password=:password
                                         WHERE studentNo=:studentNo");
            $sql->execute(['name'=>$name,'email'=>$email,'id_number'=>$id_number, 'gender'=>$gender, 'password'=>$password,'studentNo'=>$studNo]);
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
