<?php include './../layouts/session.php'; include './../layouts/alerts.php';$page='attendance'?>

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
                <h2 class="h5 no-margin-bottom">Attendance</h2>
            </div>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                   <table id="users_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>E-mail</th>
                                    <th>Mobile</th>
                                    <th>ID Number</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $init = $pdo->open();
                                $sql = $init->prepare("SELECT * FROM student,attendance WHERE student.student_id=attendance.student_id");
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    foreach ($sql as $key=> $data){
                                        echo '
                                     <tr>
                                        <td>'.$key.'</td>
                                        <td>'.$data["name"].'</td>
                                        <td>'.$data["surname"].'</td>
                                        <td>'.$data["email"].'</td>
                                        <td>'.$data["mobile"].'</td>
                                        <td>'.$data["id_number"].'</td>
                                        <td>'.$data["date"].'</td>
                                     </tr>
                                ';
                                    }


                            $pdo->close();

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



