<?php include './../layouts/session.php'; include './../layouts/alerts.php'; $page='message'; ?>


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
                <h2 class="h5 no-margin-bottom">Student Messages</h2>
            </div>
        </div>

        <div style="margin:15px">
            View All messages sent and received here.
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid" style="height: 600px;overflow-y: scroll">
                <div class="row" style="margin-left: 15px">

<!--                    <div class="ms-container ms-darker ms-gray-bg">-->
<!--                        <img src="../assets/img/profile.png" alt="Avatar" class="left" style="width:10%;">-->
<!--                        <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>-->
<!--                        <span class="ms-time-left">11:05</span>-->
<!--                    </div>-->



                    <?php
                    if(isset($_GET['user_type'])){

                        $user_id='';
                        $init = $pdo->open();
                        if($_GET['user_type']=='admin'){
                            $sql = $init->prepare("SELECT * FROM message,admin 
                                                WHERE (user_id=admin_id AND user_type='admin' AND user_id=:id AND sender_id=:user_id) 
                                                OR (sender_id=admin_id AND sender_type='admin' AND user_id=:user_id AND sender_id=:id)");

                        }else{
                            $sql = $init->prepare("SELECT * FROM message,teacher 
                                                WHERE (user_id=teacher_id AND user_type='teacher' AND user_id=:id AND sender_id=:user_id) 
                                                OR (sender_id=teacher_id AND sender_type='teacher' AND user_id=:user_id AND sender_id=:id)");
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
                        $sql = $init->prepare("SELECT name,surname,admin_id,email FROM admin UNION SELECT name,surname,teacher_id,email FROM teacher");
                        $sql->execute();

                        if ($sql->rowCount() > 0) {
                            foreach ($sql as $data) {

                                echo '
                                     <tr>
                                        <td>' . $data["name"] . '</td>
                                        <td>' . $data["surname"] . '</td>
                                        <td>' . (($data["email"]=='admin@gmail.com')?'Admin': 'Teacher'). '</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a href="?user_type='.(($data["email"]=='admin@gmail.com')?'admin': 'teacher').'&user_id='.$data["admin_id"].'" class="contributions bg-info text-white action_spans view-admin-profile" title="Open Chat"><i class="fa fa-level-up"></i> Open Chat</a>
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



