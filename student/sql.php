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


if(isset($_POST['reg-grade'])) {
    $grade = $_POST['reg-grade'];

    try{
        $sql = $init->prepare("UPDATE student SET grade=:grade WHERE student_id=:id");
        $sql->execute(['grade'=>$grade,'id'=>$_SESSION['id']]);
        $_SESSION['success'] = 'Grade registered successfully';
    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }

    header('Location: '.$return);
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
    $studNo = $_SESSION['id'];
    $name = $_POST['edit-st-name'];
    $surname = $_POST['edit-st-surname'];
    $email = $_POST['edit-st-email'];
    $id_number = $_POST['edit-st-idNo'];
    $password= $_POST['edit-password'];

    $sql = $init->prepare("SELECT * FROM student WHERE student_id=:studentNo ");
    $sql->execute(['studentNo' => $studNo]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Student does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE student SET name=:name,surname=:surname, email=:email, id_number=:id_number,password=:password
                                         WHERE student_id=:studentNo");
            $sql->execute(['name'=>$name,'surname'=>$surname,'email'=>$email,'id_number'=>$id_number, 'password'=>$password,'studentNo'=>$studNo]);
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

if(isset($_POST['borrow_book'])){
    try{
        $sql = $init->prepare("INSERT INTO booking(student_id,book_id,status) VALUES (:student_id,:book_id,0)");
        $sql->execute(['student_id' => $_SESSION['id'],'book_id'=>$_POST['borrow_book']]);

        $_SESSION['success'] = 'Book borrowed successfully';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}

if(isset($_POST['return_book'])){
    try{
        $sql = $init->prepare("UPDATE booking SET status=1 WHERE booking_id='$_POST[return_book]'");
        $sql->execute();

        $_SESSION['success'] = 'Book returned successfully';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}

if(isset($_POST['upload-file'])){

    $description = $_POST['description'];
    $image = md5(microtime()).basename( $_FILES['file_name']['name']);

    try{
        $sql = $init->prepare("INSERT INTO upload (user_id,description,file_name) VALUES (:user_id, :description,:file_name)");
        $sql->execute(['user_id'=>$_SESSION["id_number"],'description'=>$description,'file_name'=>$image]);

        if(!empty($_FILES['file_name']))
        {
            $path = "uploads/".$image;

            if(move_uploaded_file($_FILES['file_name']['tmp_name'], $path)) {
                echo "The file ".  basename( $_FILES['file_name']['name']).
                    " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }
        }
        $_SESSION['success']='File uploaded successfully...';
    }catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}

if(isset($_POST['testAnswers'])){
    parse_str($_POST['testAnswers'],$data);
    $question= $data['question'];
    $exam= $data['exam_id'];

    try{
        $mark= $init->prepare("SELECT * FROM mark WHERE question=:question 
                                     AND exam_id=:exam AND student_id=:id");
        $mark->execute(['question' => $data['question'],'exam'=>$data['exam_id'],'id'=>$_SESSION['id']]);

        if($mark->rowCount() > 0){
            $score=0;
            $answer=$mark->fetch()['answer'];
            if(isset($data['answer'])){
                if($data['answer'] !=''){
                    $answer=$data['answer'];
                }
            }

            $question= $init->prepare("SELECT * FROM question WHERE question_id=:question 
                                     AND exam_id=:exam");
            $question->execute(['question' => $data['question'],'exam'=>$data['exam_id']]);
            if($answer==$question->fetch()['answer']){
                $score=1;
            }

            $sql = $init->prepare("UPDATE mark SET answer=:answer,score=:score WHERE exam_id=:exam_id 
                                   AND question=:question AND student_id=:student_id ");
            $sql->execute(['exam_id'=>$data['exam_id'],'student_id'=>$_SESSION['id'],'question'=>$data['question'],
                            'answer'=>$answer,'score'=>$score]);

            echo json_encode(['message'=>'Answer successfully updated','success'=>1]);

        }else {
            $question = $init->prepare("SELECT * FROM question WHERE question_id=:question 
                                     AND exam_id=:exam");
            $question->execute(['question' => $data['question'], 'exam' => $data['exam_id']]);
            if ($question->rowCount() > 0) {
                $score = 0;
                $answer = '';
                if (isset($_POST['answer'])) {
                    if($data['answer'] !=''){
                        $answer=$data['answer'];
                    }
                    if ($data['answer'] == $question->fetch()['answer']) {
                        $score = 1;
                    }
                }
                $sql2 = $init->prepare("INSERT INTO mark (exam_id,student_id,question,answer,score)
                                        VALUES (:exam_id,:student_id,:question,:answer,:score)");
                $sql2->execute(['exam_id' => $data['exam_id'], 'student_id' => $_SESSION['id'], 'question' => $data['question'],
                    'answer' => $answer, 'score' => $score]);

                echo json_encode(['message' => 'Answer successfully submitted', 'success' => 1]);

            }
        }
    }catch (Exception $exception){
        echo $exception->getMessage();
    }


}


$pdo->close();

?>
