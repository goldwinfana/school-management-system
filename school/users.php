<?php include './../layouts/session.php'; ?>
<?php

if(isset($_SESSION["islogged"])){
    $_SESSION['user']=='student'? header('location: ./../student/dashboard.php'):'';
}else{
    header('location: ./../login.php');
}

?>

<?php

if(isset($_SESSION['success'])){
    echo '
                            <div class="alert btn-success message-alert"> '
        .$_SESSION['success'].'
                            </div>';
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])){
    echo '
                            <div class="alert btn-danger message-alert"> '
        .$_SESSION['error'].'
                            </div>';
    unset($_SESSION['error']);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include './../layouts/header.php'; ?>
<body style="display: flex">
<div style="width:100%;display:flex;background: #2d3035;">
    <?php include './../layouts/navbar.php'; ?>

    <!--    {{--BODY --}}-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Admin Dashboard</h2>
            </div>
        </div>

        <div style="margin:15px">
            <button class="btn btn-primary add-user">Add User</button>
        </div>

        <div style="margin:15px">
            <select class="form-control" style="width: auto" name="select-user">
                <option value="" selected disabled>Select user to display</option>
                <option>Admins</option>
                <option>Students</option>
            </select>
        </div>

        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="ticket_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th class="students">Student Number</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Gender</th>
                            <th>ID Number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="students">

                        <?php

                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT * FROM student");
                        $sql->execute();

                        if($sql->rowCount() > 0){
                            foreach ($sql as $data){

                                echo '
                                     <tr>
                                        <td>'.$data["studentNo"].'</td>
                                        <td>'.$data["name"].'</td>
                                        <td>'.$data["email"].'</td>
                                        <td>'.$data["gender"].'</td>
                                        <td>'.$data["id_number"].'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["studentNo"].'" class="contributions bg-info text-white action_spans" title="View"><i class="fa fa-eye"></i></a>
                                                <a id="'.$data["studentNo"].'" class="contributions bg-warning text-white action_spans edit-student" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="'.$data["studentNo"].'" class="contributions bg-danger text-white action_spans delete-student" title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                     </tr>
                                ';
                            }

                        }
                        $pdo->close();
                        ?>

                        </tbody>


                        <tbody class="admins">

                        <?php

                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT * FROM admin");
                        $sql->execute();

                        if($sql->rowCount() > 0){
                            foreach ($sql as $data){

                                echo '
                                     <tr>
                                        <td>'.$data["name"].'</td>
                                        <td>'.$data["email"].'</td>
                                        <td>'.$data["gender"].'</td>
                                        <td>'.$data["id_number"].'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["id"].'" class="contributions bg-info text-white action_spans" title="View"><i class="fa fa-eye"></i></a>
                                                <a id="'.$data["id"].'" class="contributions bg-warning text-white action_spans edit-admin" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="'.$data["id"].'" class="contributions bg-danger text-white action_spans delete-admin" title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                     </tr>
                                ';
                            }

                        }
                        $pdo->close();
                        ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </section>

        <!--        {{--        ENd Table--}}-->
    </div>
    <!--    {{--END BODY--}}-->
</div>

<?php include('./../layouts/footer.php') ?>
</body>
</html>



