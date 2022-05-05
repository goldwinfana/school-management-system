<?php
//include 'includes/session.php';


function best_three( $no1, $no2, $no3, $no4, $no5 ) {
    //Insert your code here
    $array=array();
    $arrayNew=array();
    array_push($array,$no1);
    array_push($array,$no2);
    array_push($array,$no3);
    array_push($array,$no4);
    array_push($array,$no5);
    sort($array);
    for($i =0;$i<= 3;$i++){
        array_push($arrayNew,$array[$i]);
    }


}

best_three( 20, 50, 30, 25, 12 );

//
//
//$conn = $pdo->open();
//
//if(isset($_POST['login'])){
//
//    $email = $_POST['email'];
//    $password = $_POST['password'];
//
//    try{
//
//        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows1 FROM admin WHERE email = :email");
//        $stmt->execute(['email'=>$email]);
//        $row = $stmt->fetch();
//
//        if($row['numrows1'] > 0){
//            if($password == $row['password']){
//                $_SESSION['user'] = 'admin';
//                $_SESSION['name'] = $row['name'];
//                $_SESSION['admin'] = $row['id'];
//                $_SESSION["loggedin"] = true;
//                $_SESSION["email"] = $row['email'];
//            }
//            else{
//                $_SESSION['error'] = 'Incorrect Password';
//                header('location: login.php');
//            }
//        }
//
//        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows1 FROM farmer WHERE email = :email");
//        $stmt->execute(['email'=>$email]);
//        $row = $stmt->fetch();
//
//        if($row['numrows1'] > 0){
//            if($password == $row['password']){
//                $_SESSION['user'] = 'farmer';
//                $_SESSION['admin'] = $row['id'];
//                $_SESSION["loggedin"] = true;
//                $_SESSION["email"] = $row['email'];
//                $_SESSION['name'] = $row['firstName'];
//                $_SESSION['surname'] = $row['lastName'];
//
//                header('location: farmer/welcome.php');
//            }
//            else{
//                $_SESSION['error'] = 'Incorrect Password';
//                header('location: login.php');
//            }
//        }
//        else{
//             $_SESSION['error'] = 'Username Does Not Exist';
//             header('location: login.php');
//        }
//
//
//
//    }
//    catch(PDOException $e){
//        echo "There is some problem in connection: " . $e->getMessage();
//    }
//
//
//}
//
//
//
//if(isset($_POST['message'])){
//
////    $to_email = 'tut@gmail.com';
////    $subject = 'Truber Query Message';
////    $body ='Name: '.$_POST['name'].'<br> Message: '. $_POST['message'];
////    $header = 'From: '.$_POST['email']. "\r\n" .
////        'MIME-Version: 1.0' . "\r\n" .
////        'Content-type: text/html; charset=utf-8';
////
////    if(mail($to_email,$subject,$body,$header)){
////        $_SESSION['success'] = 'Message Successfully Submitted, We Will Respond To Your Query ASAP ...';
////    }else{
////        $_SESSION['error'] = 'Failed To Send Query ...';
////    }
//
//    $to_email = $_POST['email'];
//    $subject = 'FMS Query Message';
//
//    $body = "
//                <a href='https://fmstut.000webhostapp.com/' style='color: #fed136;font-family: Kaushan Script,Helvetica Neue,Helvetica,Arial,cursive;'>FMS</a><br/>
//                <h3>Hi ".$_POST['name'].".</h3>
//                <h3>Your query was received and will be attended by one of our agency ASAP...</h3>
//                <br/>
//
//             ";
//
//    $header = 'From: fmstut@gmail.com'. "\r\n" .
//        'MIME-Version: 1.0' . "\r\n" .
//        'Content-type: text/html; charset=utf-8';
//
//
//    if(mail($to_email,$subject,$body,$header)){
//        $_SESSION['success'] = 'Message Successfully Submitted, We Will Respond To Your Query ASAP ...';
//    }else{
//        $_SESSION['error'] = 'Failed To Send Query ...';
//    }
//
//    header('location: '.$_SERVER['HTTP_REFERER']);
//    exit(0);
//
//}
//
//if(isset($_POST['tracker_id'])){
//    $serial = $_POST['tracker_id'];
//    $lat= $_POST['lat'];
//    $lng= $_POST['lng'];
//    $stmt = $conn->prepare("SELECT *,COUNT(*) AS numrows FROM livestock WHERE serial_no=:serial");
//    $stmt->execute(['serial'=>$serial]);
//    $row = $stmt->fetch();
//
//    if($row['numrows'] > 0){
//        if($row['status'] =='online'){
//            $_SESSION['success'] = 'Tracker Already Activated ...';
//        }else{
//            $stmt = $conn->prepare("UPDATE livestock SET status='online',latitude=:lat,longitude=:lng WHERE serial_no=:id");
//            $stmt->execute(['lat'=>$lat,'lng'=>$lng,'id'=>$serial]);
//
//            $_SESSION['success'] = 'Tracker Successfully Activated ...';
//            $_SESSION['tracker_token'] =$serial;
//
//        }
//    }else{
//        $_SESSION['error'] = 'Tracker Does Not Exist...';
//    }
//
//    header('location: '.$_SERVER['HTTP_REFERER']);
//    exit(0);
//}
//
//if(isset($_POST['checkValues'])){
//    $stmt = $conn->prepare("SELECT *,COUNT(*) AS numrows FROM farmer WHERE mobile=:email OR email=:email");
//    $stmt->execute(['email'=>$_POST['checkValues']]);
//    $row = $stmt->fetch();
//
//    $stmtA = $conn->prepare("SELECT *,COUNT(*) AS numrows FROM admin WHERE mobile=:email OR email=:email");
//    $stmtA->execute(['email'=>$_POST['checkValues']]);
//    $rowA = $stmtA->fetch();
//
//    if($row['numrows'] >0){
//        echo json_encode($row);
//    }
//    else if($rowA['numrows'] >0){
//        echo json_encode($rowA);
//    }else{
//        echo json_encode(null);
//    }
//
//
//}
//
//if(isset($_POST['checkFarmName'])){
//    $stmt = $conn->prepare("SELECT * FROM farm WHERE name=:name");
//    $stmt->execute(['name'=>$_POST['checkFarmName']]);
//    $row = $stmt->fetch();
//
//    echo json_encode($row);
//
//
//
//}
//
//
//if(isset($_POST['update_now'])){
//    $serial = $_POST['update_now'];
//    $lat= $_POST['lat'];
//    $lng= $_POST['lng'];
//    $stmt = $conn->prepare("UPDATE livestock SET latitude=:lat,longitude=:lng WHERE serial_no=:id");
//    $stmt->execute(['lat'=>$lat,'lng'=>$lng,'id'=>$serial]);
//
//    return 'updated';
//}
//
//if(isset($_POST['tracker_off'])){
//    $serial = $_POST['tracker_off'];
//    $stmt = $conn->prepare("UPDATE livestock SET status='offline' WHERE serial_no=:id");
//    $stmt->execute(['id'=>$serial]);
//
//    unset($_SESSION['tracker_token']);
//
//    header('location: '.$_SERVER['HTTP_REFERER']);
//    exit(0);
//
//}
//
//$pdo->close();

//header('location: login.php');

?>
