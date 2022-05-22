<?php include './../layouts/session.php';  include './../layouts/alerts.php'; $page='home';?>


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
                <h2 class="h5 no-margin-bottom">Student Dashboard</h2>
            </div>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="ticket_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <th>Available Schedule</th>
                        </thead>
                        <tbody>

<!--                        --><?php
//                        $init = $pdo->open();
//                        $sql = $init->prepare("SELECT *,book.id AS bookID FROM book,category where book.categoryID=category.id");
//                        $sql->execute();
//
//                        if($sql->rowCount() > 0){
//                            foreach ($sql as $data){
//
//                                echo '
//
//
//                        <tr>
//                            <td>
//                                <div class="public-user-block block">
//                                    <div class="align-items-center">
//                                        <div class="d-flex float-right sec_actions" >
//
//
//                                        </div>
//
//                                        <div class="d-block align-items-center">
//                                            <strong class="d-block">
//                                                <a id="'.$data["bookID"].'" class="post-title" style="color: cadetblue;" href="#pNo={{$post->postID}}">'.$data["bookName"].' <small class="text-white-50 font-weight-lighter">('.$data["author"].')</small></a>
//                                                <span class="contributions status_show {{$post->status}}">Shelve Number '.$data["shelveNumber"].'</span>
//                                                <a href="#applicants" style="text-decoration: none;color: currentColor;" title="click to view applications" class="contributions status_show"> R'.$data["price"].'</a>
//                                            </strong>
//                                            <span class="d-block padding-top-sm padding-bottom-sm">'.$data["categoryName"].'</span>
//                                            <div class="contributions text-danger">Available</div>
//                                        </div>
//
//                                    </div>
//                                </div>
//
//                            </td>
//                        </tr>
//
//
//                                ';
//                            }
//
//                        }
//                        $pdo->close();
//                        ?>
<!---->
<!--                        <tr>-->
<!--                            <td>-->
<!--                                <div class="public-user-block block">-->
<!--                                    <div class="align-items-center">-->
<!--                                        <div class="d-flex float-right sec_actions" >-->
<!---->
<!--                                            <a id="{{$post->postID}}" class="contributions bg-warning text-white action_spans edit-post" title="Edit"><i class="fa fa-edit"></i></a>-->
<!--                                            <a id="{{$post->postID}}" class="contributions bg-danger text-white action_spans delete-post" title="Delete"><i class="fa fa-trash"></i></a>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="d-block align-items-center">-->
<!--                                            <strong class="d-block">-->
<!--                                                <a id="{{$post->postID}}" class="post-title" style="color: cadetblue;" href="#pNo={{$post->postID}}">{{$post->title}} <small class="text-white-50 font-weight-lighter">({{$post->postID}})</small></a>-->
<!--                                                <span class="contributions status_show {{$post->status}}">{{$post->status}}</span>-->
<!--                                                <a href="#applicants" style="text-decoration: none;color: currentColor;" title="click to view applications" class="contributions status_show">{{__('0')}} applicants</a>-->
<!--                                            </strong>-->
<!--                                            <span class="d-block padding-top-sm padding-bottom-sm">{{$post->description}}</span>-->
<!--                                            <div class="contributions text-danger">Closing Date: {{$post->closeDate}}</div>-->
<!--                                        </div>-->
<!---->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </td>-->
<!--                        </tr>-->


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



