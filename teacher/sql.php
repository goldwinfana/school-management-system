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

if(isset($_POST['edit-teacher'])) {
    $id = $_SESSION['id'];
    $name = $_POST['edit-name'];
    $surname = $_POST['edit-surname'];
    $email = $_POST['edit-email'];

    $sql = $init->prepare("SELECT * FROM teacher WHERE teacher_id=:id ");
    $sql->execute(['id' => $id]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Teacher does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE teacher SET name=:name,surname=:surname, email=:email
                                         WHERE teacher_id=:id");
            $sql->execute(['name'=>$name,'surname'=>$surname,'email'=>$email,'id'=>$id]);
            $_SESSION['success'] = 'Profile updated successfully';
            $_SESSION['name'] = $name.' '.$surname;
            $_SESSION['surname'] = $surname;
            $_SESSION['email'] = $email;
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
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

if(isset($_POST['broad_message'])) {
    $message= $_POST['broad_message'];

    try{

        $sql = $init->prepare("SELECT * FROM student");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            foreach ($sql as $user){
                $sql = $init->prepare("INSERT INTO message(sender_id,sender_type,user_id,user_type,message) 
                    VALUES (:sender_id,:sender_type,:user_id,:user_type,:message)");
                $sql->execute(['sender_id'=>$_SESSION['id'],'sender_type'=>$_SESSION['user'], 'user_id'=>$user['student_id'],'user_type'=>'student','message'=>$message]);

            }
        }

        $_SESSION['success'] = 'Message sent successfully';
    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }

    header('Location: '.$return);
}


if(isset($_POST['message'])) {
    $message= $_POST['message'];
    $user_type = $_POST['user_type'];
    $user_id = $_POST['user_id'];

    try{
        if($user_type=='student'){
            $sql = $init->prepare("SELECT * FROM student WHERE student_id=:user_id ");
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
        $s= $init->prepare("SELECT * FROM exam WHERE grade=:grade AND subject=:subject AND test_name LIKE '%$test%' ");
        $s->execute(['grade' => $grade,'subject'=>$sub]);
        $res=$s->fetch();
        if($s->rowCount() > 0){

            $sql = $init->prepare("SELECT COUNT(question_id) AS ques FROM question WHERE exam_id=:exam_id");
            $sql->execute(['exam_id'=> $res['exam_id']]);
            $count = $sql->fetch()['ques'];
            echo json_encode(['message'=>'exists','count'=>$count+1,'teacher'=>$res['teacher_id']]);

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

if(isset($_POST['change_mark'])) {

    $sql = $init->prepare("SELECT * FROM mark WHERE mark_id='$_POST[mark_id]' ");
    $sql->execute();

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Question does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE mark SET score='$_POST[change_mark]' 
                                         WHERE mark_id='$_POST[mark_id]'");
            $sql->execute();
            $_SESSION['success'] = 'Mark updated successfully';
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
}

if (isset($_POST['getTeacher'])) {
    $id = $_POST['getTeacher'];

    $sql = $init->prepare("SELECT * FROM teacher WHERE teacher_id=:id");
    $sql->execute(['id' => $id]);
    $results = $sql->fetch();

    echo json_encode($results);
}

$pdo->close();

?>
