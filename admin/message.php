<?php include './../layouts/session.php'; include './../layouts/alerts.php';$page='message'?>

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
                <h2 class="h5 no-margin-bottom">Admin Messages</h2>
            </div>
        </div>

        <div style="margin:15px">
            View All messages sent and received here.
        </div>


        <section class="" style="padding: 20px">
            <div class="container-fluid" style="height: 600px;overflow: scroll;">
                <div class="row" style="margin-left: 15px">

                    <div class="ms-container ms-darker ms-gray-bg">
                        <button class="broadcast-btn text-black">Send Broadcast Message <i class="fa fa-microphone"></i></button>
                    </div>



                    <?php
                    if(isset($_GET['user_type'])){

                        $user_id='';
                        $init = $pdo->open();
                        if($_GET['user_type']=='teacher'){
                            $sql = $init->prepare("SELECT * FROM message,teacher 
                                                WHERE (user_id=teacher_id AND user_type='teacher' AND sender_type='admin' AND user_id=:id AND sender_id=:user_id) 
                                                OR (sender_id=teacher_id AND sender_type='teacher' AND user_type='admin' AND user_id=:user_id AND sender_id=:id)");

                        }else if($_GET['user_type']=='student'){
                            $sql = $init->prepare("SELECT * FROM message,student 
                                                WHERE (user_id=student_id AND user_type='student' AND sender_type='admin' AND user_id=:id AND sender_id=:user_id) 
                                                OR (sender_id=student_id AND sender_type='student' AND user_type='admin' AND user_id=:user_id AND sender_id=:id)");
                        }

                        $sql->execute(['id'=>$_GET['user_id'],'user_id'=>$_SESSION['id']]);

                        if($sql->rowCount() > 0){
                            foreach ($sql as $data) {
                                if($data['sender_type']==$_SESSION['user'] &&$data['sender_id']==$_SESSION['id']){

                                    echo '
                                    <div class="sender-msg">
                                        <div class="ms-container ms-darker ms-green-bg">
                                        <h4><b><i>You</i></b></h4>
                                            <p>'.$data['message'].'</p>
                                            <span class="ms-time-right">'.$data['date'].'</span>
                                        </div>
                                    </div>
                                ';
                                }else{
                                    echo '
                                    <div class="receiver-msg">
                                        <div class="ms-container ms-darker ms-gray-bg">
                                        <h4><b><i>'.$data['name'].'</i></b></h4>
                                            <p>'.$data['message'].'</p>
                                            <span class="ms-time-left">'.$data['date'].'</span>
                                        </div>
                                    </div>
                                ';
                                }

                            }

                        }else {
                            echo '
                                   <div class="ms-container ms-darker ms-gray-bg">
                                        <p>No messages found!</p>
                                    </div>
                            ';
                        }

                        echo '
                                <form class="" style="width: 100%" method="post" action="sql.php">
                                    <input name="user_type" value="'.$_GET['user_type'].'" hidden>
                                    <input name="user_id" value="'.$_GET['user_id'].'" hidden>
                                    <textarea name="message" placeholder="Type your message here..." class="form-control bg-white" rows="3" style="border-radius: 5px" required></textarea>
                                    <button class="btn btn-success"><i class="fa fa-send"></i> Send</button>
                                </form>
                            ';
                    }else{
                        echo '
                           <table id="admin_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>User Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                ';

                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT name,surname,teacher_id,email FROM teacher UNION SELECT name,surname,student_id,email FROM student");
                        $sql->execute();

                        if ($sql->rowCount() > 0) {
                            foreach ($sql as $data) {

                                $role='teacher';
                                $sql3 = $init->prepare("SELECT * FROM student WHERE email=:email");
                                $sql3->execute(['email'=>$data["email"]]);
                                if($sql3->rowCount() > 0){
                                    $role='student';
                                }


                                echo '
                                     <tr>
                                        <td>' . $data["name"] . '</td>
                                        <td>' . $data["surname"] . '</td>
                                        <td>' . ucfirst($role). '</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a href="?user_type='.$role.'&user_id='.$data["teacher_id"].'" class="contributions bg-info text-white action_spans view-admin-profile" title="Open Chat"><i class="fa fa-level-up"></i> Open Chat</a>
                                            </div>
                                        </td>
                                     </tr>
                                ';

                            }
                            $pdo->close();
                        }
                        echo '
                    
                                     </tbody>
                    </table>';
                    }
                    ?>

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



