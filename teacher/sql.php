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

if (isset($_POST['getSaloon'])) {
    $service = $_POST['getSaloon'];

    $sql = $init->prepare("SELECT *,service.id AS serID FROM service,saloon 
                                    WHERE service.saloonID=saloon.id
                                    AND saloon.id=:id");
    $sql->execute(['id' => $service]);
    $results = $sql->fetchAll();

    echo json_encode($results);
}

if (isset($_POST['getService'])) {
    $service = $_POST['getService'];

    $sql = $init->prepare("SELECT *,service.id AS serID FROM service,category,saloon 
                                    WHERE service.id=:id AND categoryID=category.id 
                                    AND saloonID=saloon.id");
    $sql->execute(['id' => $service]);
    $results = $sql->fetch();

    echo json_encode($results);
}

if (isset($_POST['loadData'])) {
    $id= $_SESSION['id'];

    $sql = $init->prepare("SELECT * FROM session
                                    WHERE customerID=:id ");
    $sql->execute(['id' => $id]);
    $results = $sql->fetchAll();

    echo json_encode($results);
}

if (isset($_POST['getAllStuff'])) {
    $saloon = $_POST['getAllStuff'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    try{

//        $sql = $init->prepare("SELECT * FROM session WHERE startTime >= {$start} AND endTime < {$end}");
//        $sql->execute();
//        $ids = $sql->fetchAll();
//        $arr=array(0);
//        foreach ($ids as $id){
//            array_push($arr,$id['stuffID']);
//        }
//        $iD = implode(',',$arr);

        $sql = $init->prepare("SELECT * FROM stuff,saloon WHERE saloon.id=stuff.saloonID
                                        AND saloon.id=:id");
        $sql->execute(['id'=>$saloon]);
        $results = $sql->fetchAll();
    }
    catch(PDOException $e){
        $results = $e->getMessage();
    }

    echo json_encode($results);
}

if(isset($_POST['activate_test'])) {

    $sql = $init->prepare("SELECT * FROM exam WHERE exam_id=:id ");
    $sql->execute(['id' => $_POST['activate_test']]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Test does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE exam SET status='active'
                                         WHERE exam_id=:id");
            $sql->execute(['id' => $_POST['activate_test']]);
            $_SESSION['success'] = 'Test activated successfully';
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
}

if(isset($_POST['deactivate_test'])) {

    $sql = $init->prepare("SELECT * FROM exam WHERE exam_id=:id ");
    $sql->execute(['id' => $_POST['deactivate_test']]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Test does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE exam SET status=NULL 
                                         WHERE exam_id=:id");
            $sql->execute(['id' => $_POST['deactivate_test']]);
            $_SESSION['success'] = 'Test deactivated successfully';
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




if(isset($_POST['booking'])) {

    $user = $_SESSION['id'];
    $stuff = $_POST['stuff'];
    $saloon = $_POST['saloon'];
    $service = $_POST['service'];
    $startTime = $_POST['start'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $endTime = $_POST['end'];
    $duration = $_POST['duration'];
    $bookDate = date('Y M D H:i');

    try{
        $sql = $init->prepare("INSERT INTO session (startTime, endTime,duration, customerID,stuffID, saloonID,price,service,date,bookDate)
                    VALUES (:startTime, :endTime,:duration, :customerID,:stuffID, :saloonID,:price,:service,:date,:bookDate)");
        $sql->execute(['startTime'=>$startTime,'endTime'=>$endTime,'duration'=>$duration,'service'=>$service,'price'=>$price,
            'customerID'=>$user,'stuffID'=>$stuff,'saloonID'=>$saloon, 'date'=>$date,'bookDate'=>$bookDate]);

        $_SESSION['success'] = 'Booking confirmed successfully at '.$bookDate;
    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }

    header('Location: '.$return);
}

if(isset($_POST['report'])){

    $fugitive_num = $_POST['report'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $case_num = substr(rand(),0,6);
    $id = $_SESSION['id'];

    try{

        $sql = $conn->prepare("INSERT INTO alert(case_number,fugitive_id,user_id,lat,lng) 
                                        VALUES(:case_number,:fugitive_id,:user_id,:lat,:lng)");
        $sql->execute(['case_number'=>$case_num,'fugitive_id'=>$fugitive_num,'user_id'=>$id,'lat'=>$lat,'lng'=>$lng]);


        $sql = $conn->prepare("SELECT * FROM fugitive WHERE id=:id");
        $sql->execute(['id'=>$fugitive_num]);
        $results = $sql->fetch();


        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = 587; // TLS only
        $mail->SMTPSecure = 'tls'; // ssl is deprecated
        $mail->SMTPAuth = true;

        $mail->Username   = "crimealertsystem21@gmail.com";
        $mail->Password   = "1234@Abc";

        $mail->IsHTML(true);
        $mail->AddAddress("crimealertsystem21@gmail.com", "Admin");
        $mail->SetFrom("crimealertsystem21@gmail.com", "Police Crime App Support");

        $mail->Subject = 'New Alert';
        $mail->msgHTML( "
                <p>Hi Admin</p>
                <p>".$results['first_name'].' '.$results['last_name']." has been reported, please check alerts on the app for more info...</p>
                <p>Case Number: ".$case_num."</p><br>
                <a href='https://policealertapp.000webhostapp.com/admin/alerts.php' style='color: orange'>View Alerts</a>
             ");
        $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->send();

    }
    catch(PDOException $e){
        $case_num = $e->getMessage();
    }
    $_SESSION['case_number'] = $case_num;
}

if(isset($_POST['upload-images'])){

    $user = $_SESSION['id'];
    $image = basename( $_FILES['img']['name']);
    try{
        $sql = $init->prepare("INSERT INTO search (customerID,:image) VALUES (:customerID, :image)");
        $sql->execute(['customerID'=>$user,'image'=>$image]);

        if(!empty($_FILES['img']))
        {
            $path = "uploads/";
            $path = $path . basename( $_FILES['img']['name']);

            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
                echo "The file ".  basename( $_FILES['img']['name']).
                    " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }
        }
        $_SESSION['success']='Image uploaded successfully, you will get email from different saloon that offer the service requested..';
    }catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }


}



if(isset($_POST['message'])) {
    $message= $_POST['message'];
    $user_type = $_POST['user_type'];
    $user_id = $_POST['user_id'];

    try{
        if($user_type=='student'){
            $sql = $init->prepare("SELECT * FROM student WHERE teacher_id=:user_id ");
        }elseif ($user_type=='admin'){
            $sql = $init->prepare("SELECT * FROM admin WHERE admin_id=:user_id ");
        }else{
            $_SESSION['error'] = 'Something went wrong';
        }
        $sql->execute(['user_id'=>$user_id]);

        if ($sql->rowCount() < 1) {
            $_SESSION['error'] = 'User does not exits';
        } else {

            $sql = $init->prepare("INSERT INTO message(sender_id,sender_type,user_id,user_type,message) 
						VALUES (:sender_id,:sender_type,:user_id,:user_type,:message)");
            $sql->execute(['sender_id'=>$_SESSION['id'],'sender_type'=>$_SESSION['user'], 'user_id'=>$user_id,'user_type'=>$user_type,'message'=>$message]);
            $_SESSION['success'] = 'Message sent successfully';
        }
    }catch (Exception $e){
        $_SESSION['error'] = $e;
    }

    header('Location: '.$return);
}


if (isset($_POST['getSubjects'])) {
    $sub= $_POST['getSubjects'];

    $sql = $init->prepare("SELECT * FROM grade WHERE grade_code=:grade ");
    $sql->execute(['grade' => $sub]);
    $results = $sql->fetch();

    echo json_encode($results);
}

if (isset($_POST['getMySubjects'])) {
    $sub= $_POST['getSubjects'];

    $sql = $init->prepare("SELECT * FROM grade WHERE teacher_id=:grade ");
    $sql->execute(['id' => $sub]);
    $results = $sql->fetch();

    echo json_encode($results);
}

if(isset($_POST['createTest'])){
    parse_str($_POST['createTest'],$data);
    $grade= $data['create-grade'];
    $sub= $data['create-subject'];
    $test= $data['create-test'];
    $date= $data['create-date'];
    $duration= $data['create-duration'];

    try{
        $count=0;
        $s= $init->prepare("SELECT * FROM exam WHERE grade=:grade AND subject=:subject AND test_name LIKE '%$test%' 
                            AND teacher_id=:id ");
        $s->execute(['grade' => $grade,'subject'=>$sub,'id'=>$_SESSION['id']]);
        if($s->rowCount() > 0){

            $sql = $init->prepare("SELECT COUNT(question_id) AS ques FROM question WHERE exam_id=:exam_id");
            $sql->execute(['exam_id'=> $s->fetch()['exam_id']]);
            $count = $sql->fetch()['ques'];
            echo json_encode(['message'=>'exists','count'=>$count+1]);
        }else{
            $sql2 = $init->prepare("INSERT INTO exam (grade,subject,test_name,teacher_id,exam_date,duration) 
                                    VALUES (:grade,:subject,:test_name,:teacher_id,:date,:duration)");
            $sql2->execute(['grade'=>$grade,'subject'=>$sub,'test_name'=>$test,'teacher_id'=>$_SESSION['id'],'date'=>$date,'duration'=>$duration]);

            echo json_encode(['message'=>'Exam created successfully','count'=>$count+1]);
        }

    }catch (Exception $exception){
        echo $exception->getMessage();
    }

}

if (isset($_POST['question_creation'])) {
    parse_str($_POST['question_creation'],$data);
    $grade= $data['choose-grade'];
    $sub= $data['choose-sub'];
    $test= $data['test_name'];
    $ques= $data['q_number'];
    $question = $data['question'];

    $q_type=$data['q_type'];
    if($q_type=='options'){
        $options = json_encode($data['option']);
        $answer = current($data['option']);
    }else if($q_type=='tbox'){
        $options='';
        $answer = $data['tbox'];
    }else{
        $options = json_encode(['true','false']);
        $answer = $data['tf_option'];
    }

    $exam='';
    try{
        $sql = $init->prepare("SELECT * FROM exam WHERE grade=:grade AND subject=:subject AND test_name LIKE '%$test%' AND teacher_id=:id");
        $sql->execute(['grade' => $grade,'subject'=>$sub,'id'=>$_SESSION['id']]);
        $data = $sql->fetch();
        if($sql->rowCount() > 0){
            $s= $init->prepare("SELECT * FROM exam WHERE grade=:grade AND subject=:subject AND test_name LIKE '%$test%' AND teacher_id=:id");
            $s->execute(['grade' => $grade,'subject'=>$sub,'id'=>$_SESSION['id']]);
            $exam = $s->fetch();

            $sql3 = $init->prepare("SELECT * FROM question WHERE exam_id=:exam_id AND question_id=:question_id ");
            $sql3->execute(['exam_id'=>$data['exam_id'],'question_id'=>$ques]);
            $results = $sql3->fetch();


            if($sql3->rowCount() < 1){
                $sql4 = $init->prepare("INSERT INTO question (question_id,exam_id,question,q_type,options,answer) VALUES (:question_id,:exam_id,:question,:q_type,:options,:answer)");
                $sql4->execute(['question_id'=>$ques,'exam_id'=>$exam['exam_id'],'question'=>$question,'q_type'=>$q_type,'options'=>$options,'answer'=>$answer]);

                echo json_encode(['message'=>"Question ".$ques." created successfully",'success'=>1]);
            }else{
                echo json_encode(['message'=>"Question ".$ques." already exits",'success'=>0]);
            }
        }

    }catch(PDOException $e){
        echo json_encode(['message'=>$e->getMessage(),'success'=>0]);
    }
}


if(isset($_POST['teacherGrade'])){
    $id = $_SESSION['id'];
    $grade = $_POST['teacherGrade'];
    $subjects = json_encode($_POST['sub']);

    try{

        $sql = $init->prepare("UPDATE teacher SET grade_code=:grade,subjects=:subjects WHERE teacher_id=:id");
        $sql->execute(['grade' => $grade,'id'=>$id,'subjects'=>$subjects]);

        $_SESSION['success'] = 'Grade and subjects registered successfully';

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}

$pdo->close();

?>
