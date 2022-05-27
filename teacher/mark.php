<?php include './../layouts/session.php';include './../layouts/alerts.php'; $page='mark';?>


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
                <h2 class="h5 no-margin-bottom">Student Marks</h2>
            </div>
        </div>

        <div style="margin:15px;">
            <script>
                function getMarks(id){
                    var queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    let test_id = urlParams.get('exam_id');
                    window.location.href='?exam_id='+test_id+'&student_id='+id;
                }

            </script>

            <select class="form-control" onchange="getMarks(this.value)">
                <option value="" selected disabled>Select student from list</option>

                <?php
                $init = $pdo->open();
                $sql = $init->prepare("SELECT * FROM student,mark WHERE student.student_id=mark.student_id GROUP BY student.student_id");
                $sql->execute();

                if ($sql->rowCount() > 0) {
                    foreach ($sql as $data) {
                        echo '<option value="'.$data['student_id'].'">'.$data['name'].' '.$data['surname'].'</option>';
                    }
                }
                ?>

            </select>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">
                    <?php

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
                        $hide = (isset($_GET['student_id'])?'':'hidden');

                            echo '
                    <table id="users_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Question #No</th>
                            <th>Question</th>
                            <th>Options</th>
                            <th>Type</th>
                            <th>Answer</th>
                            <th>Score</th>
                            <th><span '.$hide.'>Student Answer</span></th>
                            <th><span '.$hide.'>Student Score</span></th>

                        </tr>
                        </thead>
                        <tbody>
                        ';

                            $sql = $init->prepare("SELECT * FROM question,exam WHERE exam.exam_id=:exam_id AND exam.exam_id=question.exam_id");
                            $sql->execute(['exam_id'=>$_GET['exam_id']]);

                            if ($sql->rowCount() > 0) {
                                $total=0;
                                $studTotal=0;
                                foreach ($sql as $data) {
                                    $total++;

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
                                            <td>1</td>';
                                            if(isset($_GET['student_id'])){
                                                $mark= $init->prepare("SELECT * FROM mark WHERE exam_id='$_GET[exam_id]' AND student_id='$_GET[student_id]' AND question='$data[question_id]'");
                                                $mark->execute();
                                                $marks = $mark->fetch();
                                                $studTotal+=$marks['score'];
                                                echo '<td>'.$marks['answer'].'</td>
                                                      <td>'.$marks['score'].'</td>';
                                            }

                                        echo'</tr>
                                        ';
                                }
                                echo'
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>'.$total.'/'.$total.'(100%)</td>
                                    <td '.$hide.'><span '.$hide.'></span></td>
                                    <td '.$hide.'><span '.$hide.'>'.$studTotal.'/'.$total.'('.(($studTotal/$total)*100).'%)</span></td>
                                    </tr>
                                ';
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



