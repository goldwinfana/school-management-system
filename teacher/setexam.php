<?php include './../layouts/session.php';include './../layouts/alerts.php'; $page='setexam';?>


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

        <form id="create-test" hidden>
            <input name="create-grade">
            <input name="create-subject">
            <input name="create-test">
            <input name="create-date">
            <input name="create-duration">
        </form>

        <form id="submitQuestions" action="sql.php" method="post">
        <div style="display: flex">
            <div class="select-grade" style="margin:15px;">
                <select class="form-control" style="width: auto" class="choose-grade" name="choose-grade" required>
                    <option value="" selected disabled>Select grade from list</option>

                    <?php
                    $init = $pdo->open();
                    $sql = $init->prepare("SELECT * FROM teacher WHERE teacher_id='$_SESSION[id]'");
                    $sql->execute();

                    if ($sql->rowCount() > 0) {
                        foreach ($sql as $data) {
                            echo '<option value="'.$data['grade_code'].'">Grade '.$data['grade_code'].'</option>';
                        }
                    }
                    ?>

                </select>

            </div>

            <div class="select-sub" style="margin:15px;">
                <select class="form-control" id="choose-sub" name="choose-sub" required>
                    <option value="" selected disabled>Select subject from list</option>

                    <?php
                    $sql = $init->prepare("SELECT * FROM teacher WHERE teacher_id='$_SESSION[id]'");
                    $sql->execute();

                    if ($sql->rowCount() > 0) {
                        foreach (json_decode($sql->fetch()['subjects']) as $data) {
                            echo '<option value="'.$data.'">'.$data.'</option>';
                        }
                    }
                    $pdo->close();
                    ?>

                </select>
            </div>
            <div class="test_name" style="margin:15px;">
                <input name="test_name" placeholder="Enter Test Name..." class="form-control" minlength="5" maxlength="15" required>
            </div>

            <div class="test_date" style="margin:15px;">
                    <input class="form-control" type="date" name="test_date" required>
            </div>

            <div class="test_duration" style="margin:15px;">
                <input class="form-control" type="number" placeholder="Enter test duration here..." name="test_duration" onkeyup="enableConBtn(this.value)" required>
            </div>

            <div class="confirmD" style="margin:15px;">
                <button class="btn btn-secondary confirm-details" onclick="event.preventDefault();createTest();$('.confirm-details').attr('disabled',false)" disabled>Confirm and Proceed</button>
            </div>
<!--            <div style="margin:15px;">-->
<!--                <button class="btn btn-secondary undo-" onclick="event.preventDefault();$('.confirm-details').attr('disabled',false)" disabled>Change Test</button>-->
<!--            </div>-->

        </div>


        <div class="set_qs" style="display: none">
            <div class="block">
                <h4>Question <i class="q_num"></i> <input class="q_number" name="q_number" type="number" placeholder="number..." required></h4>
                <div class="block">
                    <label>Question</label>
                    <textarea name="question" rows="4" placeholder="Type your question here..." style="width: 100%;border-radius: 5px" required></textarea>

                    <label>Answer</label>
                    <select class="form-control q_type" name="q_type" style="margin:15px;" required>
                        <option value="" selected disabled>Select type of answer</option>
                        <option value="tbox">Text Box</option>
                        <option value="tf">True/False</option>
                        <option value="options">Choose The Correct Answer</option>
                    </select>
                    <div class="q2_type block">

                    </div>

                    <button class="btn btn-success save-question" onclick="event.preventDefault();submitQuestions();"><i class="fa fa-save"></i> Save</button>
                    <button class="btn btn-secondary" onclick="event.preventDefault();$('.q2_type').html('');$('.set_qs').find('input,textarea,select').each(function () {$(this).val('');});"><i class="fa fa-eraser"></i> Reset</button>
                </div>

            </div>

        </div>
        </form>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row ms-row">



                </div>
            </div>
        </section>

<!--        {{--        ENd Table--}}-->
    </div>
<!--    {{--END BODY--}}-->
</div>
<input value="<?php echo $_SESSION['id']?>" id="teacher_id"  hidden>
<?php include('./../layouts/footer.php') ?>
</body>
</html>



