<?php include './../layouts/session.php';include './../layouts/alerts.php'; $page='exam';?>


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
                <h2 class="h5 no-margin-bottom">Teacher Exams</h2>
            </div>
        </div>

        <div style="margin:15px">
            <button class="btn btn-primary set-exam" onclick="window.location.href='setexam.php'">Set Exam Paper</button>
        </div>

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $init = $pdo->open();
                    if(!isset($_GET['exam_id'])){
                    echo '
                    <table id="admin_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Subject</th>
                            <th>Test Name</th>
                            <th>Questions</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';

                        $sql = $init->prepare("SELECT *,COUNT(question_id ) AS ques FROM exam,question 
                                                WHERE exam.exam_id=question.exam_id GROUP BY question.exam_id");
                        $sql->execute();

                        if ($sql->rowCount() > 0) {
                        foreach ($sql as $data) {
                            $status= $data["status"]!=null?'<i class="text-success">'.$data["status"].'</i>' ." <a id='$data[exam_id]' for='$data[test_name]' class='btn btn-danger deactivate_test'>Deactivate Test</a>":"<a id='$data[exam_id]' for='$data[test_name]' class='btn btn-warning activate_test'>Activate Test</a>";
                            echo '
                        <tr>
                            <td>' . $data["grade"] . '</td>
                            <td>' . $data["subject"] . '</td>
                            <td>' . $data["test_name"] . '</td>
                            <td>' . $data["ques"] . '</td>
                            <td>' . $status . '</td>
                            <td>
                                <div class="d-flex" >
                                    <a href="?exam_id=' . $data["exam_id"].'&grade='.$data["grade"].'&subject='.$data["subject"].'" class="contributions bg-info text-white action_spans" title="View Questions"><i class="fa fa-level-up"></i> View Questions</a>
                                </div>
                            </td>
                        </tr>
                        ';
                        }

                      }
                    }else{

                            echo '
                    <table id="users_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Question #No</th>
                            <th>Question</th>
                            <th>Options</th>
                            <th>Type</th>
                            <th>Answer</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';

                            $sql = $init->prepare("SELECT * FROM question,exam WHERE exam.exam_id=:exam_id AND exam.exam_id=question.exam_id");
                            $sql->execute(['exam_id'=>$_GET['exam_id']]);

                            if ($sql->rowCount() > 0) {
                                foreach ($sql as $data) {

                                    echo '
                                        <tr>
                                            <td>' . $data["question_id"] . '</td>
                                            <td>' . $data["question"] . '</td>
                                            <td>';
                                              if($data["options"] !=null){
                                                  foreach (json_decode($data["options"]) as $ops){
                                                      if($ops==$data["answer"]){
                                                          echo '<input type="radio" value="'.$ops.'"> <lable>'.$ops.'</lable> <i class="text-success fa fa-check-circle"></i><br>';
                                                      }else{
                                                          echo '<input type="radio" value="'.$ops.'"> <lable>'.$ops.'</lable><br>';
                                                      }

                                                    }
                                              }else{
                                                  echo "Any accepted answer";
                                              }
                                              echo

                                        '</td>
                                            <td>' . $data["q_type"] . '</td>
                                            <td>'.$data["answer"].'</td>
                                        </tr>
                                        ';
                                }
                            }


                        $pdo->close();
                    }
                    echo '

                        </tbody>
                    </table>';
                    ?>

                </div>
            </div>
        </section>

<!--        {{--        ENd Table--}}-->
    </div>
<!--    {{--END BODY--}}-->
</div>

<?php include('./../layouts/footer.php');include 'modal.php'; ?>
</body>
</html>



