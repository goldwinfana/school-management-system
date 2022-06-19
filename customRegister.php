<?php

include 'layouts/session.php';
$conn = $pdo->open();
$return = $_SERVER['HTTP_REFERER'];

if(isset($_POST['register'])){

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $mobile= $_POST['mobile'];
        $idNumber = $_POST['idNumber'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $accType = $_POST['accountType'];

        $sql = $conn->prepare("SELECT * FROM student WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $row = $sql->fetch();

        if($sql->rowCount() >0){
            $_SESSION['error']= 'Email already exists.';
            header('location: '.$return);
            exit(0);
        }

        $sql = $conn->prepare("SELECT * FROM teacher WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $row = $sql->fetch();

        if($sql->rowCount() >0){
            $_SESSION['error']= 'Email already exists.';
            header('location: '.$return);
            exit(0);
        }

        $sql = $conn->prepare("SELECT * FROM parent WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $row = $sql->fetch();

        if($sql->rowCount() >0){
            $_SESSION['error']= 'Email already exists.';
            header('location: '.$return);
            exit(0);
        }

        $sql = $conn->prepare("SELECT * FROM admin WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $row = $sql->fetch();

        if($sql->rowCount() >0){
            $_SESSION['error']= 'Email already exists.';
            header('location: '.$return);
            exit(0);
        }


        if($accType =='student'){
            try {

                $description = 'Registration proof of payment';
                $image = md5(microtime()).basename( $_FILES['file_name']['name']);

                $stmt = $conn->prepare("INSERT INTO student (name,surname, email,id_number,parent_id_number,mobile,address, password,status) 
            VALUES (:name,:surname,:email,:idNo,:p_id,:mobile,:address,:password,:status)");
                $stmt->execute(['name' => $name,'surname' => $surname, 'email' => $email,'idNo' => $idNumber,'p_id' => $_POST['PidNumber'],
                    'mobile' => $mobile,'address'=>$address,'password' => $password,'status'=>0]);

                $sql = $conn->prepare("INSERT INTO upload (user_id,description,file_name) VALUES (:user_id, :description,:file_name)");
                $sql->execute(['user_id'=>$idNumber,'description'=>$description,'file_name'=>$image]);

                if(!empty($_FILES['file_name']))
                {
                    $path = "student/uploads/".$image;

                    if(move_uploaded_file($_FILES['file_name']['tmp_name'], $path)) {
                        echo "The file ".  basename( $_FILES['file_name']['name']).
                            " has been uploaded";
                    } else{
                        echo "There was an error uploading the file, please try again!";
                    }
                }

                $_SESSION['success'] = 'Account successfully created. Proceed to Login';
                header('location: login.php');

            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
                header('location: '.$return);
            }
        }else if($accType =='teacher'){
            try {

                $stmt = $conn->prepare("INSERT INTO teacher (name,surname, email,id_number,mobile,address, password,status) 
            VALUES (:name,:surname,:email,:idNo,:mobile,:address,:password,:status)");
                $stmt->execute(['name' => $name,'surname' => $surname, 'email' => $email,'idNo' => $idNumber,
                    'mobile' => $mobile,'address'=>$address,'password' => $password,'status'=>0]);

                $_SESSION['success'] = 'Account successfully created. Proceed to Login';
                header('location: login.php');

            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
                header('location: '.$return);
            }
        }else if($accType =='parent'){
            try {

                $stmt = $conn->prepare("INSERT INTO parent (name,surname, email,id_number,mobile,address, password,status) 
            VALUES (:name,:surname,:email,:idNo,:mobile,:address,:password,:status)");
                $stmt->execute(['name' => $name,'surname' => $surname, 'email' => $email,'idNo' => $idNumber,
                    'mobile' => $mobile,'address'=>$address,'password' => $password,'status'=>0]);

                $_SESSION['success'] = 'Account successfully created. Proceed to Login';
                header('location: login.php');

            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
                header('location: '.$return);
            }
        }


}

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    try{

        $sql = $conn->prepare("SELECT * FROM admin WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($sql->rowCount() >  0){
            if($password == $results['password']){
                $_SESSION['user'] = 'admin';
                $_SESSION['name'] = $results['name'];
                $_SESSION['id'] = $results['admin_id'];
                $_SESSION["islogged"] = true;
                $_SESSION["email"] = $results['email'];
                header('location: admin/dashboard.php');

            }
            else{
                $_SESSION['error'] = 'Incorrect Password...';
                header('location: '.$return);
            }
        }


        $sql = $conn->prepare("SELECT * FROM student WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($sql->rowCount() >  0){
            if($password == $results['password']){
                if($results['status'] > 0){
                    $_SESSION['user'] = 'student';
                    $_SESSION['name'] = $results['name'].' '.$results['surname'];
                    $_SESSION['id'] = $results['student_id'];
                    $_SESSION['id_number'] = $results['id_number'];
                    $_SESSION["islogged"] = true;
                    $_SESSION["email"] = $results['email'];

                    $sqlD = $conn->prepare("SELECT * FROM attendance WHERE student_id ='$results[student_id]'");
                    $sqlD->execute();
                    $res= $sqlD->fetch();

                    if($sqlD->rowCount() >  0) {
                        if (date('Y-m-d', strtotime($res['date'])) != date('Y-m-d')) {
                            $stmt = $conn->prepare("INSERT INTO attendance (student_id,date) VALUES (:id,:date)");
                            $stmt->execute(['id' => $results['student_id'], 'date' => date('Y-m-d H:i')]);
                        }
                    }else{
                        $stmt = $conn->prepare("INSERT INTO attendance (student_id,date) VALUES (:id,:date)");
                        $stmt->execute(['id' => $results['student_id'], 'date' => date('Y-m-d H:i')]);
                    }

                    header('location: student/dashboard.php');

                }else{
                    $_SESSION['error'] = 'Account Not Yet Active...';
                    header('location: '.$return);
                }

            }
            else{
                $_SESSION['error'] = 'Incorrect Password...';
                header('location: '.$return);
            }
        }

        $sql = $conn->prepare("SELECT * FROM teacher WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($sql->rowCount() >  0){
            if($password == $results['password']){
                if($results['status'] > 0){
                    $_SESSION['user'] = 'teacher';
                    $_SESSION['name'] = $results['name'].' '.$results['surname'];
                    $_SESSION['id'] = $results['teacher_id'];
                    $_SESSION['id_number'] = $results['id_number'];
                    $_SESSION["islogged"] = true;
                    $_SESSION["email"] = $results['email'];
                    header('location: teacher/dashboard.php');
                }else{
                    $_SESSION['error'] = 'Account Not Yet Active...';
                    header('location: '.$return);
                }

            }
            else{
                $_SESSION['error'] = 'Incorrect Password...';
                header('location: '.$return);
            }
        }

        $sql = $conn->prepare("SELECT * FROM parent WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($sql->rowCount() >  0){
            if($password == $results['password']){
                if($results['status'] > 0){
                    $_SESSION['user'] = 'parent';
                    $_SESSION['name'] = $results['name'].' '.$results['surname'];
                    $_SESSION['id'] = $results['parent_id'];
                    $_SESSION['id_number'] = $results['id_number'];
                    $_SESSION["islogged"] = true;
                    $_SESSION["email"] = $results['email'];
                    header('location: parent/dashboard.php');
                }else{
                    $_SESSION['error'] = 'Account Not Yet Active...';
                    header('location: '.$return);
                }

            }
            else{
                $_SESSION['error'] = 'Incorrect Password...';
                header('location: '.$return);
            }
        }

        $_SESSION['error'] = 'Account Does Not Exists...';
        header('location: '.$return);

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }


}



if (isset($_POST['checkParentID'])) {

    $sql = $conn->prepare("SELECT * FROM student WHERE parent_id_number=:parentID");
    $sql->execute(['parentID'=>$_POST['checkParentID']]);
    $results = $sql->fetchAll();

    echo json_encode($results);
}

if (isset($_POST['checkID'])) {

    $sql = $conn->prepare("SELECT * FROM student WHERE id_number=:checkID");
    $sql->execute(['checkID'=>$_POST['checkID']]);
    $results = $sql->fetchAll();
    $res=[];
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $conn->prepare("SELECT * FROM teacher WHERE id_number=:checkID ");
    $sql->execute(['checkID'=>$_POST['checkID']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $conn->prepare("SELECT * FROM parent WHERE id_number=:checkID ");
    $sql->execute(['checkID'=>$_POST['checkID']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    echo json_encode($res);
}

if (isset($_POST['checkEmail'])) {

    $sql = $conn->prepare("SELECT * FROM student WHERE email=:email");
    $sql->execute(['email'=>$_POST['checkEmail']]);
    $results = $sql->fetch();
    $res=[];
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $conn->prepare("SELECT * FROM teacher WHERE email=:email ");
    $sql->execute(['email'=>$_POST['checkEmail']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $conn->prepare("SELECT * FROM parent WHERE email=:email ");
    $sql->execute(['email'=>$_POST['checkEmail']]);
    $results = $sql->fetch();
    if($sql->rowCount() >  0){
        $res= $results;
    }
    $sql = $conn->prepare("SELECT * FROM admin WHERE email=:email ");
    $sql->execute(['email'=>$_POST['checkEmail']]);
    $results = $sql->fetch();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    echo json_encode($res);
    exit(0);
}

if (isset($_POST['checkValues'])) {
    $sql = $conn->prepare("SELECT * FROM student WHERE mobile=:mobile");
    $sql->execute(['mobile'=>$_POST['checkValues']]);
    $results = $sql->fetchAll();
    $res=[];
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $conn->prepare("SELECT * FROM teacher WHERE mobile=:mobile");
    $sql->execute(['email'=>$_POST['checkValues']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $conn->prepare("SELECT * FROM parent WHERE mobile=:mobile");
    $sql->execute(['email'=>$_POST['checkValues']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }
    $sql = $conn->prepare("SELECT * FROM admin WHERE mobile=:mobile ");
    $sql->execute(['mobile'=>$_POST['checkValues']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    echo json_encode($res);
}

if(isset($_POST['reset'])){
    try{

        $sql = $conn->prepare("SELECT * FROM student WHERE id_number=:checkID");
        $sql->execute(['checkID'=>$_POST['idNumber']]);
        if($sql->rowCount() >  0){
            $sql = $conn->prepare("UPDATE student SET password='$_POST[password]' WHERE id_number='$_POST[idNumber]'");
            $sql->execute();
        }

        $sql = $conn->prepare("SELECT * FROM teacher WHERE id_number=:checkID ");
        $sql->execute(['checkID'=>$_POST['idNumber']]);
        if($sql->rowCount() >  0){
            $sql = $conn->prepare("UPDATE teacher SET password='$_POST[password]' WHERE id_number='$_POST[idNumber]'");
            $sql->execute();
        }

        $sql = $conn->prepare("SELECT * FROM parent WHERE id_number=:checkID ");
        $sql->execute(['checkID'=>$_POST['idNumber']]);
        if($sql->rowCount() >  0){
            $sql = $conn->prepare("UPDATE book SET password='$_POST[password]' WHERE id_number='$_POST[idNumber]'");
            $sql->execute();
        }

        $_SESSION['success'] = 'Password updated successfully';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: login.php');
}


$pdo->close();

?>