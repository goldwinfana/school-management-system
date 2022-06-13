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
//Transport

if (isset($_POST['getBus'])) {
    $id = $_POST['getBus'];

    $sql = $init->prepare("SELECT * FROM transport WHERE transport_id=:id");
    $sql->execute(['id' => $id]);
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

if(isset($_POST['edit-parent'])) {
    $name = $_POST['edit-p-name'];
    $surname = $_POST['edit-p-surname'];
    $email = $_POST['edit-p-email'];
    $mobile = $_POST['edit-p-mobile'];

    $sql = $init->prepare("SELECT * FROM parent WHERE parent_id=:parent_id ");
    $sql->execute(['parent_id' => $_SESSION['id']]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Parent does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE parent SET name=:name, email=:email,surname=:surname,mobile=:mobile WHERE parent_id=:parent_id");
            $sql->execute(['name'=>$name,'surname'=>$surname,'email'=>$email,'mobile'=>$mobile,'parent_id'=>$_SESSION['id']]);
            $_SESSION['success'] = 'Parent updated successfully';
            $_SESSION['name'] = $name;
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
}

if(isset($_POST['delete-student'])) {
    $studentNo = $_POST['delete-student'];

    try {
        $sql = $init->prepare("DELETE FROM student WHERE studentNo=:studentNo");
        $sql->execute(['studentNo' => $studentNo]);

        $_SESSION['success'] = 'Student deleted successfully';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: ' . $return);
}

///parent
    if (isset($_POST['getParent'])) {
        $getParent = $_POST['getParent'];

        $sql = $init->prepare("SELECT * FROM parent WHERE parent_id=:parent_id");
        $sql->execute(['parent_id' => $getParent]);
        $results = $sql->fetch();

        echo json_encode($results);
    }






$pdo->close();

?>
