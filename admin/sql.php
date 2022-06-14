<?php
include './../layouts/session.php';
$init = $pdo->open();
$return = $_SERVER['HTTP_REFERER'];

if(isset($_POST['add-user'])){

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];

    $accType = $_POST['accountType'];
    if($accType !='admin'){
        $mobile= $_POST['mobile'];
        $idNumber = $_POST['idNumber'];
    }

    $password = $_POST['password'];


    $sql = $init->prepare("SELECT * FROM student WHERE email = :email");
    $sql->execute(['email'=>$email]);
    $row = $sql->fetch();

    if($sql->rowCount() >0){
        $_SESSION['error']= 'Email already exists.';
        header('location: '.$return);
        exit(0);
    }

    $sql = $init->prepare("SELECT * FROM teacher WHERE email = :email");
    $sql->execute(['email'=>$email]);
    $row = $sql->fetch();

    if($sql->rowCount() >0){
        $_SESSION['error']= 'Email already exists.';
        header('location: '.$return);
        exit(0);
    }

    $sql = $init->prepare("SELECT * FROM parent WHERE email = :email");
    $sql->execute(['email'=>$email]);
    $row = $sql->fetch();

    if($sql->rowCount() >0){
        $_SESSION['error']= 'Email already exists.';
        header('location: '.$return);
        exit(0);
    }

    $sql = $init->prepare("SELECT * FROM admin WHERE email = :email");
    $sql->execute(['email'=>$email]);
    $row = $sql->fetch();

    if($sql->rowCount() >0){
        $_SESSION['error']= 'Email already exists.';
        header('location: '.$return);
        exit(0);
    }


    if($accType =='student'){
        try {

            $stmt = $init->prepare("INSERT INTO student (name,surname, email,id_number,parent_id_number,mobile, password,status) 
            VALUES (:name,:surname,:email,:idNo,:p_id,:mobile,:password,:status)");
            $stmt->execute(['name' => $name,'surname' => $surname, 'email' => $email,'idNo' => $idNumber,'p_id' => $_POST['PidNumber'],
                'mobile' => $mobile,'password' => $password,'status'=>0]);

            $_SESSION['success'] = 'Account successfully created';
            header('location: '.$return);

        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('location: '.$return);
        }
    }else if($accType =='teacher'){
        try {

            $stmt = $init->prepare("INSERT INTO teacher (name,surname, email,id_number,mobile, password,status) 
            VALUES (:name,:surname,:email,:idNo,:mobile,:password,:status)");
            $stmt->execute(['name' => $name,'surname' => $surname, 'email' => $email,'idNo' => $idNumber,
                'mobile' => $mobile,'password' => $password,'status'=>0]);

            $_SESSION['success'] = 'Account successfully created';
            header('location: '.$return);

        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('location: '.$return);
        }
    }else if($accType =='parent'){
        try {

            $stmt = $init->prepare("INSERT INTO parent (name,surname, email,id_number,mobile, password,status) 
            VALUES (:name,:surname,:email,:idNo,:mobile,:password,:status)");
            $stmt->execute(['name' => $name,'surname' => $surname, 'email' => $email,'idNo' => $idNumber,
                'mobile' => $mobile,'password' => $password,'status'=>0]);

            $_SESSION['success'] = 'Account successfully created';
            header('location: '.$return);

        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('location: '.$return);
        }
    }else{
        try {

            $stmt = $init->prepare("INSERT INTO admin (name,surname, email, password,created_by) 
            VALUES (:name,:surname,:email,:password,:created_by)");
            $stmt->execute(['name' => $name,'surname' => $surname, 'email' => $email
                ,'password' => $password,'created_by'=>$_SESSION['id']]);

            $_SESSION['success'] = 'Account successfully created';
            header('location: '.$return);

        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('location: '.$return);
        }
    }


}


if (isset($_POST['checkParentID'])) {

    $sql = $init->prepare("SELECT * FROM student WHERE parent_id_number=:parentID");
    $sql->execute(['parentID'=>$_POST['checkParentID']]);
    $results = $sql->fetchAll();

    echo json_encode($results);
}

if (isset($_POST['checkID'])) {

    $sql = $init->prepare("SELECT * FROM student WHERE id_number=:checkID");
    $sql->execute(['checkID'=>$_POST['checkID']]);
    $results = $sql->fetchAll();
    $res=[];
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $init->prepare("SELECT * FROM teacher WHERE id_number=:checkID ");
    $sql->execute(['checkID'=>$_POST['checkID']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    echo json_encode($results);
}

if (isset($_POST['checkEmail'])) {

    $sql = $init->prepare("SELECT * FROM student WHERE email=:email");
    $sql->execute(['email'=>$_POST['checkEmail']]);
    $results = $sql->fetchAll();
    $res=[];
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $init->prepare("SELECT * FROM teacher WHERE email=:email ");
    $sql->execute(['email'=>$_POST['checkEmail']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $init->prepare("SELECT * FROM parent WHERE email=:email ");
    $sql->execute(['email'=>$_POST['checkEmail']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }
    $sql = $init->prepare("SELECT * FROM admin WHERE email=:email ");
    $sql->execute(['email'=>$_POST['checkEmail']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    echo json_encode($res);
}

if (isset($_POST['checkValues'])) {
    $sql = $init->prepare("SELECT * FROM student WHERE mobile=:mobile");
    $sql->execute(['mobile'=>$_POST['checkValues']]);
    $results = $sql->fetchAll();
    $res=[];
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $init->prepare("SELECT * FROM teacher WHERE mobile=:mobile");
    $sql->execute(['email'=>$_POST['checkValues']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    $sql = $init->prepare("SELECT * FROM parent WHERE mobile=:mobile");
    $sql->execute(['email'=>$_POST['checkValues']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }
    $sql = $init->prepare("SELECT * FROM admin WHERE mobile=:mobile ");
    $sql->execute(['mobile'=>$_POST['checkValues']]);
    $results = $sql->fetchAll();
    if($sql->rowCount() >  0){
        $res= $results;
    }

    echo json_encode($res);
}


if(isset($_POST['acc_approval'])){
    $email = $_POST['acc_approval'];

    try{
        if(isset($_POST['acc_parent'])){
            $stmt = $init->prepare("UPDATE parent SET status=1,approved_by=:id WHERE email=:email");
            $stmt->execute(['email'=>$email,'id'=>$_SESSION['id']]);
        }

        if(isset($_POST['acc_student'])){
            $stmt = $init->prepare("UPDATE student SET status=1,approved_by=:id WHERE email=:email");
            $stmt->execute(['email'=>$email,'id'=>$_SESSION['id']]);
        }

        if(isset($_POST['acc_teacher'])){
            $stmt = $init->prepare("UPDATE teacher SET status=1,approved_by=:id WHERE email=:email");
            $stmt->execute(['email'=>$email,'id'=>$_SESSION['id']]);
        }

        $_SESSION['success'] = 'Record approved successfully';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);

}

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



//student

if (isset($_POST['getStudent'])) {
    $studentNo = $_POST['getStudent'];

    $sql = $init->prepare("SELECT * FROM student WHERE student_id=:student_id");
    $sql->execute(['student_id' => $studentNo]);
    $results = $sql->fetch();

    echo json_encode($results);
}

if(isset($_POST['edit-st'])) {
    $studNo = $_POST['edit-st'];
    $name = $_POST['edit-st-name'];
    $surname = $_POST['edit-st-surname'];
    $email = $_POST['edit-st-email'];
    $id_number = $_POST['edit-st-idNo'];

    $sql = $init->prepare("SELECT * FROM student WHERE student_id=:student_id ");
    $sql->execute(['student_id' => $studNo]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Student does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE student SET name=:name,surname=:surname, email=:email, id_number=:id_number
                                         WHERE student_id=:student_id");
            $sql->execute(['name'=>$name,'email'=>$email,'id_number'=>$id_number, 'surname'=>$surname, 'student_id'=>$studNo]);
            $_SESSION['success'] = 'Student updated successfully';
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
}

if(isset($_POST['delete-student'])){
    $studentNo = $_POST['delete-student'];

    try{
        $sql = $init->prepare("DELETE FROM student WHERE id_number=:id_number");
        $sql->execute(['id_number'=>$studentNo]);

        $_SESSION['success'] = 'Student deleted successfully';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);

}

//Admins
if (isset($_POST['getAdmin'])) {
    $id = $_POST['getAdmin'];

    $sql = $init->prepare("SELECT * FROM admin WHERE admin_id=:id");
    $sql->execute(['id' => $id]);
    $results = $sql->fetch();

    echo json_encode($results);
}

if(isset($_POST['edit-admin'])) {
    $id = $_POST['edit-admin'];
    $name = $_POST['edit-admin-name'];
    $surname = $_POST['edit-admin-surname'];
    $email = $_POST['edit-admin-email'];

    $sql = $init->prepare("SELECT * FROM admin WHERE admin_id=:id ");
    $sql->execute(['id' => $id]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Admin does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE admin SET name=:name, email=:email, surname=:surname WHERE admin_id=:id");
            $sql->execute(['name'=>$name,'email'=>$email,'surname'=>$surname,'id'=>$id]);
            $_SESSION['success'] = 'Profile updated successfully';
            $id == $_SESSION['id']?$_SESSION['name'] = $name: '';
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
}


if(isset($_POST['delete-admin'])){
    $adminNo = $_POST['delete-admin'];


    try{
        $stmt = $init->prepare("SELECT * FROM admin WHERE admin_id=:id");
        $stmt->execute(['id'=>$adminNo]);
        $res = $stmt->fetch();
        echo $res['admin_id'];
        if($res['admin_id'] == $_SESSION['id']){
            $_SESSION['error'] = 'Not permitted to delete self account...';
        }else{
            $sql = $init->prepare("DELETE FROM admin WHERE admin_id=:id_number");
            $sql->execute(['id_number'=>$adminNo]);

            $_SESSION['success'] = 'Admin deleted successfully';
        }


    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);

}

if (isset($_POST['profile_admin'])) {
    $id = $_SESSION['admin'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM admin WHERE email=:email AND id <>:id");
    $stmt->execute(['email'=>$email, 'id'=>$id]);
    $row = $stmt->fetch();
    if($row['numrows'] > 0){
        $_SESSION['error'] = 'Email already exits';
    }
    else {

        $stmt = $conn->prepare("UPDATE admin SET email=:email, password=:password, firstName=:name,
                                         mobile=:mobile
                                         WHERE id=:id");
        $stmt->execute(['email' => $email, 'password' => $password, 'name' =>
            $name, 'mobile' => $mobile,'id'=>$id]);

        $_SESSION['success'] = 'Record updated successfully';
    }
    header('location: welcome.php');
}


if (isset($_POST['edit_admin'])) {
    $id = $_POST['edit_admin'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM admin WHERE email=:email AND id <>:id");
    $stmt->execute(['email'=>$email, 'id'=>$id]);
    $row = $stmt->fetch();
    if($row['numrows'] > 0){
        $_SESSION['error'] = 'Email already exits';
    }
    else {

        $stmt = $conn->prepare("UPDATE admin SET email=:email, password=:password, name=:name,
                                         mobile=:mobile
                                         WHERE id=:id");
        $stmt->execute(['email' => $email, 'password' => $password, 'name' =>
            $name, 'mobile' => $mobile,'id'=>$id]);

        $_SESSION['success'] = 'Record updated successfully';
    }
    header('location: welcome.php');
}



if (isset($_POST['search'])) {

    $_SESSION['search']=$_POST['search'];
    header('Location: welcome.php');
}

if(isset($_POST['addStudent'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM farmer,admin WHERE farmer.email=:email OR admin.email=:email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();
    if ($row['numrows'] > 0) {
        $_SESSION['error'] = 'Email already exits';
    } else {

        $stmt = $conn->prepare("INSERT INTO farmer (firstName, lastName,gender, mobile, address, email, password) 
						VALUES (:firstName, :lastName,:gender, :mobile, :address, :email,:password)");
        $stmt->execute(['firstName'=>$firstname, 'lastName'=>$lastname, 'gender'=>$gender,'mobile'=>$mobile, 'address'=>$address, 'email'=>$email, 'password'=>$password]);
        $userid = $conn->lastInsertId();
        $_SESSION['success'] = 'Book added successfully';

    }
    header('Location: '.$return);
}



if(isset($_POST['addAdmin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM farmer,admin WHERE farmer.email=:email OR admin.email=:email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();
    if ($row['numrows'] > 0) {
        $_SESSION['error'] = 'Email already exits';
    } else {

        $stmt = $conn->prepare("INSERT INTO admin (name, mobile, email, password) 
						VALUES (:name, :mobile, :email,:password)");
        $stmt->execute(['name'=>$name,'mobile'=>$mobile, 'email'=>$email, 'password'=>$password]);
        $userid = $conn->lastInsertId();
        $_SESSION['success'] = 'Admin added successfully';

    }
    header('Location: welcome.php');
}



if(isset($_POST['report'])){
    $report = $_POST['report'];

    try{
            $stmt = $conn->prepare("SELECT * FROM admin");
            $stmt->execute();
            $row = $stmt->fetchAll();

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    echo json_encode($row);

}





//Driver
if(isset($_POST['add-transport'])){

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $idNo = $_POST['DidNo'];
    $mobile= $_POST['Dmobile'];
    $bus= $_POST['bus'];
    $image = md5(microtime()).basename( $_FILES['picture']['name']);
    try {

        $stmt = $init->prepare("INSERT INTO transport (name,surname,id_number,mobile,bus,image) 
            VALUES (:name,:surname,:idNo,:mobile,:bus,:image)");
        $stmt->execute(['name' => $name,'surname' => $surname,'idNo' => $idNo,'mobile' => $mobile,'bus' => $bus,'image'=>$image]);

        if(!empty($_FILES['picture']))
        {
            $path = "uploads/bus/".$image;

            if(move_uploaded_file($_FILES['picture']['tmp_name'], $path)) {
                echo "The file ".  basename( $_FILES['picture']['name']).
                    " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }
        }
        $_SESSION['success'] = 'Driver successfully created';

    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();

    }

    header('location: '.$return);
}

if (isset($_POST['getBus'])) {
    $id = $_POST['getBus'];

    $sql = $init->prepare("SELECT * FROM transport WHERE transport_id=:id");
    $sql->execute(['id' => $id]);
    $results = $sql->fetch();

    echo json_encode($results);
}

if(isset($_POST['delete-bus'])){
    $transport = $_POST['delete-bus'];

    try{
        $sql = $init->prepare("DELETE FROM transport WHERE transport_id=:id");
        $sql->execute(['id'=>$transport]);

        $_SESSION['success'] = 'Transport deleted successfully';

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);

}

if(isset($_POST['broad_cast'])) {
    $message= $_POST['broad_message'];
    $user_type = $_POST['broad_cast'];

    try{
        if($user_type=='teacher'){
            $sql = $init->prepare("SELECT * FROM teacher");
            $sql->execute();
            if ($sql->rowCount() > 0) {
                foreach ($sql as $user){
                    $sql = $init->prepare("INSERT INTO message(sender_id,sender_type,user_id,user_type,message) 
						VALUES (:sender_id,:sender_type,:user_id,:user_type,:message)");
                    $sql->execute(['sender_id'=>$_SESSION['id'],'sender_type'=>$_SESSION['user'], 'user_id'=>$user['teacher_id'],'user_type'=>$user_type,'message'=>$message]);

                }
            }
        }elseif ($user_type=='student'){
            $sql = $init->prepare("SELECT * FROM student");
            $sql->execute();
            if ($sql->rowCount() > 0) {
                foreach ($sql as $user){
                    $sql = $init->prepare("INSERT INTO message(sender_id,sender_type,user_id,user_type,message) 
						VALUES (:sender_id,:sender_type,:user_id,:user_type,:message)");
                    $sql->execute(['sender_id'=>$_SESSION['id'],'sender_type'=>$_SESSION['user'], 'user_id'=>$user['student_id'],'user_type'=>$user_type,'message'=>$message]);

                }
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
        if($user_type=='teacher'){
            $sql = $init->prepare("SELECT * FROM teacher WHERE teacher_id=:user_id ");
        }elseif ($user_type=='student'){
            $sql = $init->prepare("SELECT * FROM student WHERE student_id=:user_id ");
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
//Library
if(isset($_POST['accept_return'])){
    try{
        $date = date('Y-m-d H:i');
        $sql = $init->prepare("UPDATE booking SET status=3,return_date='$date' WHERE booking_id='$_POST[accept_return]'");
        $sql->execute();

        $_SESSION['success'] = 'Book returned successfully';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}

if(isset($_POST['decline_return'])){
    try{
        $sql = $init->prepare("UPDATE booking SET status=0 WHERE booking_id='$_POST[decline_return]'");
        $sql->execute();

        $_SESSION['success'] = 'Book has not been returned yet';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}


if(isset($_POST['add_book'])){
    try{
        $sql = $init->prepare("SELECT * FROM book WHERE book_name='$_POST[add_book]' ");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $_SESSION['error'] = 'Book already exits';
        } else {

            $sql = $init->prepare("INSERT INTO book(book_name) VALUES ('$_POST[add_book]')");
            $sql->execute();
            $_SESSION['success'] = 'Book added successfully';
        }
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}

if(isset($_POST['edit_book'])){
    try{
        $sql = $init->prepare("UPDATE book SET book_name='$_POST[edit_book]' WHERE book_id='$_POST[edit_book_id]'");
        $sql->execute();

        $_SESSION['success'] = 'Book updated successfully';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}

if(isset($_POST['delete_book_id'])){
    try{
        $sql = $init->prepare("DELETE FROM book WHERE book_id='$_POST[delete_book_id]'");
        $sql->execute();

        $sql = $init->prepare("DELETE FROM booking WHERE book_id='$_POST[delete_book_id]'");
        $sql->execute();

        $_SESSION['success'] = 'Book deleted successfully';

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);

}

$pdo->close();

?>
