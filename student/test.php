<?php include './../layouts/session.php'; include './../layouts/alerts.php'; $page='test';?>


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
                <h2 class="h5 no-margin-bottom">Tests</h2>
            </div>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">


                    <?php

                    $init = $pdo->open();

                    if(!isset($_GET['test_id'])){
                        echo '
                        <h4>List of all assessment for your grade.</h4>

                    <table id="users_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>No#</th>
                            <th>Test Name</th>
                            <th>Subject</th>
                            <th>Teachers Name</th>
                            <th>Date</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';

                        $sql = $init->prepare("SELECT *,exam.status AS stat, teacher.name AS tname,teacher.surname AS tsurname FROM exam,student,teacher 
                                           WHERE student_id='$_SESSION[id]' AND exam.grade=student.grade
                                           AND exam.teacher_id=teacher.teacher_id");
                        $sql->execute();

                        if($sql->rowCount() > 0){
                            foreach ($sql as $key => $data) {
                                echo '
                                     <tr>
                                        <td>' . $key . '</td>
                                        <td>' . $data["test_name"] . '</td>
                                        <td>' . $data["subject"] . '</td>
                                        <td>' . $data["tname"].' '.$data["tsurname"]. '</td>
                                        <td>' . $data["exam_date"] . '</td>
                                        <td>' . $data["duration"] . '</td>
                                        <td>' . ($data["stat"]==null?'<i class="text-danger">inactive</i>':'<i class="text-success">active</i>'). '</td>
                                        <td>
                                            <div class="d-flex" >
                                            <a href="?test_id='. $data["exam_id"].'"  class="btn btn-warning" title="View">View Test</a>
                                        </td>
                                     </tr>
                                ';
                            }

                        }
                        echo '</tbody>
                    </table>';

                    }else{
                        $sql = $init->prepare("SELECT * FROM exam WHERE exam.exam_id='$_GET[test_id]'");
                        $sql->execute();
                        $sum = $sql->fetch();
                        if($sql->rowCount() > 0){
                            if(!isset($_GET['start_test'])){
                                $count = $init->prepare("SELECT *,COUNT(question_id ) AS ques FROM exam,question 
                                                WHERE exam.exam_id=question.exam_id AND exam.exam_id='$_GET[test_id]' GROUP BY question.exam_id");
                                $count->execute();
                                $countRows =0;
                                if($count->rowCount() > 0){
                                    $countRows=$count->fetch()["ques"];
                                }

                                $mark= $init->prepare("SELECT COUNT(*) AS total,SUM(score) AS score FROM mark WHERE exam_id=:exam AND student_id=:id");
                                $mark->execute(['exam'=>$_GET['test_id'],'id'=>$_SESSION['id']]);
                                $output = $mark->fetch();

                                echo '
                                <div style="margin:15px;">
                                  <h3>Subject: '.$sum["subject"].'</h3>
                                  <h3>Test Name: '.$sum["test_name"].'</h3>
                                  <h3>Date: '.$sum["exam_date"].'</h3>
                                  <h3>Duration: '.$sum["duration"].' Hours(s)</h3>
                                  <h3>Number Questions: '.$countRows.'</h3>';


                                  if($output["total"] > 0){
                                      echo '
                                            <h3>Score: '.(($output["score"]/$countRows)*100).'% ('.$output["score"].'/'.$countRows.')</h3>
                                             <a href="?" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> View All Tests</a>';
                                  }else{
                                      echo '<h3>Status: '. ($sum['status']==null?'<i class="text-danger">inactive</i>':'<i class="text-success">active</i>').'</h3>';
                                        if($sum['status']!=null){
                                          echo '<a href="?test_id='. $_GET["test_id"].'&start_test=true" class="btn btn-warning">
                                         <i class="fa fa-hourglass-start"></i> Start Test</a>';
                                        }else{
                                            echo ' <a href="?" class="btn btn-warning" ><i class="fa fa-arrow-left"></i> View All Tests</a>';
                                        }

                                  }
                                  echo '</div>';

                            }else{
                                $sql2 = $init->prepare("SELECT * FROM question WHERE exam_id='$_GET[test_id]'");
                                $sql2->execute();
                                if($sql2->rowCount() > 0){

                                    foreach ($sql2 as $key => $data) {
                                        echo '<h4 class="form-control">Question ' . $data["question_id"] . '</h4>';

                                        echo '<div style="width: 100%"><strong> ' . $data["question"] . '?</strong></div><br>';

                                        if($data["q_type"]=='tf'){
                                            echo '<div style="display: block">
                                                    <form id="submitAnswer_'.$data["question_id"].'" method="post" action="sql.php">
                                                        <input name="question" value="'.$data["question_id"].'" hidden>
                                                        <input name="exam_id" value="'.$data["exam_id"].'" hidden>
                                                        <br><i>Choose the correct answer below: </i><br>
                                                        <input name="answer" type="radio" value="true"> <label>True</label> <br/>
                                                        <input name="answer" type="radio" value="false"> <label>False</label> 
                                                        <div style="display: block;width: 100%">'?>
                                                           <button class="btn btn-warning answerBtn" onclick="event.preventDefault();getAnswer(<?php echo $data["question_id"] ?>)"><i class="fa fa-save"></i> Save Answer</button>
                                                        <?php echo'</div>
                                                    </form>
                                                  </div>
                                            ';
                                        }else  if($data["q_type"]=='tbox'){
                                            echo '<div style="display: block;width: 100%">
                                                    <form id="submitAnswer_'.$data["question_id"].'">
                                                        <input name="question" value="'.$data["question_id"].'" hidden>
                                                        <input name="exam_id" value="'.$data["exam_id"].'" hidden>
                                                        <br><i>Type in your answer below: </i><br>
                                                        <textarea name="answer" rows="4" placeholder="Type your answer here..." style="width: 100%;border-radius: 5px" required></textarea> 
                                                        <div style="display: block;width: 100%">'?>
                                                           <button class="btn btn-warning answerBtn" onclick="event.preventDefault();getAnswer(<?php echo $data["question_id"] ?>)"><i class="fa fa-save"></i> Save Answer</button>
                                                        <?php echo'</div>
                                                    </form>
                                                  </div>
                                            ';
                                        }else{
                                            echo '<div style="display: block">
                                                    <form id="submitAnswer_'.$data["question_id"].'">
                                                        <input name="question" value="'.$data["question_id"].'" hidden>
                                                        <input name="exam_id" value="'.$data["exam_id"].'" hidden>
                                                        <br><i>Choose the correct answer from the options below: </i><br>';

                                                        foreach (json_decode($data["options"]) as $options){
                                                            echo '<input name="answer" type="radio" value="'.$options.'" required> <label>'.$options.'</label> <br/>';
                                                        }
                                                echo'  <div style="display: block;width: 100%">'?>
                                                           <button class="btn btn-warning answerBtn" onclick="event.preventDefault();getAnswer(<?php echo $data["question_id"] ?>)"><i class="fa fa-save"></i> Save Answer</button>
                                                        <?php echo'</div>
                                                    </form>
                                                 </div>';
                                        }
                                        echo '<div style="margin-top: 2%;width: 100%;visibility: hidden">-</div>';


                                    }
//                                    Save
                                    ?>
                                      <button class="btn btn-success" onclick="$('#saveAnswers').modal('show');"><i class="fa fa-save"></i> Save & Submit Test</button>

                                <?php }else{
                                    echo '<h3>QUESTIONS NOT FOUND!!!</h3>';
                                }
                            }
                        }else{
                            echo '<h3>TEST NOT FOUND!!!</h3>';
                        }


                    }

                    $pdo->close();
                    ?>

                </div>
            </div>
        </section>

    </div>

</div>


<?php include('./../layouts/footer.php'); ?>
</body>
</html>



