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

if(isset($_POST['cancelBooking'])){
    $id = $_SESSION['id'];
    $bookID = $_POST['cancelBooking'];

    try{

        $sql = $init->prepare("UPDATE session SET status='cancelled' WHERE customerID=:customerID AND id=:id");
        $sql->execute(['customerID' => $id,'id'=>$bookID]);

        $_SESSION['success'] = 'Booking cancelled successfully';

    }
    catch(PDOException $e){
        echo json_encode($e->getMessage());
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


$pdo->close();

?>
