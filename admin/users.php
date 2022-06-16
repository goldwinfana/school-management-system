<?php include './../layouts/session.php'; include './../layouts/alerts.php'; $page='users';?>

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
            <select class="form-control" style="width: auto" name="select-user" onchange="window.location.href='?user='+this.value">
                <option value="" selected disabled>Select user to display</option>
                <option>admin</option>
                <option>teacher</option>
                <option>student</option>
                <option>parent</option>
            </select>
        </div>

        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <?php

                    if(isset($_GET['user'])){
                        if($_GET['user']=='student'){
                            echo '
                                <table id="users_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>E-mail</th>
                                    <th>Mobile</th>
                                    <th>ID Number</th>
                                    <th>Documents</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                ';

                                $init = $pdo->open();
                                $sql = $init->prepare("SELECT * FROM student,status WHERE student.status=status.status_id");
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    foreach ($sql as $data){
                                        $img = $init->prepare("SELECT * FROM upload WHERE user_id=:id");
                                        $img->execute(['id'=>$data["id_number"]]);
                                        $filename='';
                                        if($img->rowCount() > 0){
                                            $filename = "../student/uploads/".$img->fetch()["file_name"];
                                        }

                                        $stBtn='';
                                        if($data["status"]==0){
                                            $stBtn= '<a href="javascript:void(0)" id="'.$data["email"].'" class="bg-success text-white action_spans approve_student" title="Approve"><i class="fa fa-check-circle-o">Approve Account</i></a>';
                                        }

                                        echo '
                                     <tr>
                                        <td>'.$data["student_id"].'</td>
                                        <td>'.$data["name"].'</td>
                                        <td>'.$data["surname"].'</td>
                                        <td>'.$data["email"].'</td>
                                        <td>'.$data["mobile"].'</td>
                                        <td>'.$data["id_number"].'</td>
                                         <td>
                                            <div class="d-flex" >'?>
                                        <button onclick='window.location.href="document.php?stud=<?php echo $data["student_id"]?>";' class="btn btn-warning" title="View"><i class="fa fa-file-pdf-o"></i> View Documents</button>
                                        <?php echo '</div>
                                        </td>
                                        <td>'.$data["status_name"].$stBtn.'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["student_id"].'" class="contributions bg-info text-white action_spans view-student" title="View"><i class="fa fa-eye"></i></a>
                                                <a id="'.$data["student_id"].'" class="contributions bg-warning text-white action_spans edit-student" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="'.$data["id_number"].'" class="contributions bg-danger text-white action_spans delete-student" title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                     </tr>
                                ';
                                    }

                                }
                                $pdo->close();
                            }else if($_GET['user']=='admin'){
                               echo '
                                <table id="admin_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>E-mail</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                ';

                                $init = $pdo->open();
                                $sql = $init->prepare("SELECT * FROM admin");
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    foreach ($sql as $data){
                                        $delAdmin='';
                                        if($data["admin_id"]!=$_SESSION['id']){
                                            $delAdmin = '<a id="'.$data["admin_id"].'" class="contributions bg-danger text-white action_spans delete-admin" title="Delete"><i class="fa fa-trash"></i></a>';
                                        }

                                        echo '
                                     <tr>
                                        <td>'.$data["name"].'</td>
                                        <td>'.$data["surname"].'</td>
                                        <td>'.$data["email"].'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["admin_id"].'" class="contributions bg-info text-white action_spans view-admin-profile" title="View"><i class="fa fa-eye"></i></a>
                                                <a id="'.$data["admin_id"].'" class="contributions bg-warning text-white action_spans edit-admin" title="Edit"><i class="fa fa-edit"></i></a>
                                                '.$delAdmin.'
                                            </div>
                                        </td>
                                     </tr>
                                ';
                                    }

                                }
                                $pdo->close();
                            }else if($_GET['user']=='teacher'){
                            echo '
                                <table id="teacher_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>E-mail</th>
                                    <th>ID Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="">
                                ';

                            $init = $pdo->open();
                            $sql = $init->prepare("SELECT * FROM teacher,status WHERE teacher.status=status.status_id");
                            $sql->execute();

                            if($sql->rowCount() > 0){
                                foreach ($sql as $data){
                                    $stBtn='';
                                    if($data["status"]==0){
                                        $stBtn= '<a href="javascript:void(0)" id="'.$data["email"].'" class="bg-success text-white action_spans approve_teacher" title="Approve"><i class="fa fa-check-circle-o">Approve Account</i></a>';
                                    }
                                    echo '
                                     <tr>
                                        <td>'.$data["teacher_id"].'</td>
                                        <td>'.$data["name"].'</td>
                                        <td>'.$data["surname"].'</td>
                                        <td>'.$data["email"].'</td>
                                        <td>'.$data["id_number"].'</td>
                                        <td>'.$data["status_name"].$stBtn.'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["teacher_id"].'" class="contributions bg-info text-white action_spans view-admin-profile" title="View"><i class="fa fa-eye"></i></a>
                                                <a id="'.$data["teacher_id"].'" class="contributions bg-warning text-white action_spans edit-admin" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="'.$data["teacher_id"].'" class="contributions bg-danger text-white action_spans delete-admin" title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                     </tr>
                                ';
                                }

                            }
                            $pdo->close();
                        }else if($_GET['user']=='parent'){
                            echo '
                                <table id="parent_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>E-mail</th>
                                    <th>ID Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                ';

                            $init = $pdo->open();
                            $sql = $init->prepare("SELECT * FROM parent,status WHERE parent.status=status.status_id");
                            $sql->execute();

                            if($sql->rowCount() > 0){
                                foreach ($sql as $data){
                                    $stBtn='';
                                    if($data["status"]==0){
                                        $stBtn= '<a id="'.$data["email"].'" href="javascript:void(0)" class="bg-success text-white action_spans approve_parent" title="Approve"><i class="fa fa-check-circle-o">Approve Account</i></a>';
                                    }
                                    echo '
                                     <tr>
                                        <td>'.$data["parent_id"].'</td>
                                        <td>'.$data["name"].'</td>
                                        <td>'.$data["surname"].'</td>
                                        <td>'.$data["email"].'</td>
                                        <td>'.$data["id_number"].'</td>
                                        <td>'.$data["status_name"].$stBtn.'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["parent_id"].'" class="contributions bg-info text-white action_spans view-admin-profile" title="View"><i class="fa fa-eye"></i></a>
                                                <a id="'.$data["parent_id"].'" class="contributions bg-warning text-white action_spans edit-admin" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="'.$data["parent_id"].'" class="contributions bg-danger text-white action_spans delete-admin" title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                     </tr>
                                ';
                                }

                            }
                            $pdo->close();
                         }
                        }



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



