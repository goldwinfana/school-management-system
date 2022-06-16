<?php include './../layouts/session.php'; include './../layouts/alerts.php'; $page='transport';
if($_SERVER['REQUEST_URI']!='/school-management-system/document.php'){
    $init = $pdo->open();
    $sql = $init->prepare("SELECT * FROM student WHERE student_id='$_SESSION[id]'");
    $sql->execute();
    if($sql->fetch()['grade'] ==NULL){
        ?>
        <script>window.location.href='./document.php';</script>
        <?php
    }
    $pdo->close();
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
                <h2 class="h5 no-margin-bottom">Transportation</h2>
            </div>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <?php
                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT * FROM student,transport WHERE student_id=:id 
                                                AND transport=transport_id AND transport IS NOT NULL");
                        $sql->execute(['id'=>$_SESSION['id']]);
                        $results = $sql->fetch();
                        if($sql->rowCount() > 0){?>

                    <div class="flex" style="display: flex;width: 100%">
                        <div class="card bus-pic" style="width: 40%;padding: 20px">
                            <p>Bus Image</p>
                            <img src="<?php echo ($results["image"]!=null)? './../admin/uploads/bus/'.$results["image"] : './../assets/img/profile.png'; ?>" style="height: 90%">
                        </div>
                        <div class="card driver-details" style="width: 50%;padding: 20px">
                            <?php
                                echo '
                                        <p>Bus Name: '.$results["bus"].'</p>
                                        <p>Driver Name: '.$results["name"].'</p>
                                        <p>Driver Surname: '.$results["surname"].'</p>
                                        <p>Driver Contact: '.$results["mobile"].'</p>
                                        <p><strong>NB: If you wish to change your transportation, simple send message to admin by clicking <a href="message.php?user_type=admin&user_id=1">here</a>.</strong></p>
                                ';

                            }else{?>
                        </div>
                    </div>



                    <table id="transport_table" class="table table-bordered" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>No#</th>
                        <th>Bus Name</th>
                        <th>Driver Details</th>
                        <th>ID Number</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                       <?php


                            $sql2 = $init->prepare("SELECT * FROM transport");
                            $sql2->execute();

                            if($sql2->rowCount() > 0){
                                foreach ($sql2 as $data){
                                    echo '
                                     <tr>
                                        <td>'.$data["transport_id"].'</td>
                                        <td>'.$data["bus"].'</td>
                                        <td>'.$data["name"].' '.$data["surname"].'</td>
                                        <td>'.$data["id_number"].'</td>
                                        <td>'.$data["mobile"].'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["transport_id"].'" class="contributions bg-info text-white action_spans view-admin-profile" title="View" hidden><i class="fa fa-eye">View </i></a>
                                                <a id="'.$data["transport_id"].'" href="javascript:void(0)" for="'.$data["bus"].'" class="contributions bg-warning text-white action_spans register-transport" title="Register Bus"><i class="fa fa-first-order"></i> Select</a>
                                            </div>
                                        </td>
                                     </tr>
                                ';
                                }

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



