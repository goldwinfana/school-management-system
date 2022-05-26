<?php include './../layouts/session.php'; include './../layouts/alerts.php'; $page='home';?>

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
                <h2 class="h5 no-margin-bottom">Parent Dashboard</h2>
            </div>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">
                    <h3>Children List</h3>
                    <table id="parent_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>No#</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Mobile</th>
                            <th>E-mail</th>
                            <th>ID Number</th>
                            <th>Grade</th>
                            <th>Transport</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                            $init = $pdo->open();
                            $sql = $init->prepare("SELECT * FROM student WHERE parent_id_number='$_SESSION[id_number]'");
                            $sql->execute();

                            if($sql->rowCount() > 0){
                            foreach ($sql as $key=> $data){
                                $grade= $data["grade"]==null?'Not yet chosen':$data["grade"];
                                $transport= $data["transport"]==null?'Not yet chosen':"<a id='$data[transport]' class='btn btn-secondary text-white view-busx'>View Bus Details</a>";
                            echo '
                            <tr>
                                <td>'.$key.'</td>
                                <td>'.$data["name"].'</td>
                                <td>'.$data["surname"].'</td>
                                <td>'.$data["mobile"].'</td>
                                <td>'.$data["email"].'</td>
                                <td>'.$data["id_number"].'</td>
                                <td>'.$grade.'</td>
                                <td>'.$transport.'</td>
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
<!--ends hereererererereeeeeeeeeeeeeeeeeeeeee-->
<!--<div class="body-content">-->
<!--<div class="page-header">-->
<!--    --><?php
//    if(isset($_SESSION['error'])){
//        echo "
//                        <div class='alert alert-warning beautiful' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//                            <span aria-hidden='true'>&times;</span>
//                            </button>
//                           ".$_SESSION['error']."</div>
//                        ";
//        unset($_SESSION['error']);
//    }
//
//    if(isset($_SESSION['success'])){
//        echo "
//                        <div class='alert btn-success beautiful' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//                            <span aria-hidden='true'>&times;</span>
//                            </button>
//                           ".$_SESSION['success']."</div>
//                        ";
//        unset($_SESSION['success']);
//    }
//
//
//    ?>
<!--    <h1>Farmer Dashboard</h1>-->
<!--    <button class="btn btn-warning addnew">Add Tracker</button>-->
<!--</div>-->
<!---->
<!---->
<!--    <h4 class="row" style="padding: 10px" align="center">-->
<!--        <div id="svgcanvas">-->
<?php
//        $conn = $pdo->open();
//
//        try {
//            $stmt = $conn->prepare("SELECT * FROM livestock WHERE farmer_id=:id");
//            $stmt->execute(['id'=>$_SESSION['admin']]);
//        }
//        catch (Exception $e){
//            print_r($e->getMessage());
//        }
//
//
//
//        if($stmt->rowCount() > 0) {
//            $count=0;
//            foreach ($stmt as $key=> $row) {
//
//                echo '
//
//                <button class="front-btn '.$count.'" style="margin: 5px"><div class="frontside '.$row["animal_type"].'  ">
//                            <div class="card">
//                                <div class="card-body">
//                                    <p id="'.$row["serial_no"].'" class="anim_view"><img src="../assets/img/info_animals/'.$row["image"].'"></p>
//                                    <h4 class="card-title">'.$row["animal_type"].' ';
//                                        if($row["status"] =="online")
//                                        {
//                                            echo'<i class="fa fa-circle text-success"></i>';
//                                        }else
//                                        {
//                                            echo '<i class="fa fa-circle text-danger" ></i>';
//                                        }
//
//
//                                    echo'</h4>
//                                    <p class="card-text">Ser No: '.$row["serial_no"].' </p>
//                                    <p>';
//
//                                         if($row["status"] =="online")
//                                        {
//                                            echo'<a id="'.$row["serial_no"].'"  class="btn btn-warning btn-sm anim_trace"><i class="fa fa-location-arrow"></i></a> ';
//                                        }
//                                         echo'
//
//                                         <a id="'.$row["serial_no"].'"  class="btn btn-danger btn-sm anim_delete"><i class="fa fa-trash"></i></a>
//                                     </p>
//                                </div>
//                            </div>
//                        </div></button>
//                         ';
//                $count++;
//            }
//
//            $pdo->close();
//            echo '   </table>';
//        }else{
//            echo '<h3>No Records Found ...</h3>' ;
//        }
//        ?>
<!--        </div>-->
<!---->
<!---->
<!--    <div class="pagination">-->
<!--        <a id="first" href="#">&laquo;</a>-->
<!--        <a id="one" href="#" class="active">1</a>-->
<!--        <a id="two" href="#">2</a>-->
<!--        <a id="three" href="#">3</a>-->
<!--        <a id="four" href="#">4</a>-->
<!--        <a  id="five" href="#">5</a>-->
<!--        <a id="six" href="#">6</a>-->
<!--        <a id="last" href="#">&raquo;</a>-->
<!--    </div>-->
<!--</div>-->
<?php include('./../layouts/footer.php') ?>
</body>
</html>



