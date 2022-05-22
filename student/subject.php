<?php include './../layouts/session.php'; include './../layouts/alerts.php'; $page='subject';?>


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

                    <?php
                    $init = $pdo->open();
                    $sql = $init->prepare("SELECT * FROM student WHERE student_id='$_SESSION[id]'");
                    $sql->execute();
                    if(!isset($sql->fetch()['grade'])){
                        echo '
                                <h4>Choose your grade from the table below in order to enroll.</h4>

                                <table id="users_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Grade</th>
                                    <th>Subjects</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                ';

                        $sql = $init->prepare("SELECT * FROM grade");
                        $sql->execute();

                        if($sql->rowCount() > 0) {
                            foreach ($sql as $key => $data) {

                                echo '
                                     <tr>
                                        <td>' . $key . '</td>
                                        <td>Grade ' . $data["grade_code"] . '</td><td><ul>';
                                foreach (explode(',', str_replace("'", "", $data["subjects"])) as $subs) {
                                    echo '<li>' . $subs . '</li>';
                                }
                                echo '</ul></td>
                                        <td>
                                            <div class="d-flex" >
                                                <a href="#register" id="' . $data["grade_code"] . '" class="contributions bg-info text-white action_spans register_grade" title="View">Register</a>
                                            
                                            </div>
                                        </td>
                                     </tr>
                                ';
                            }
                        }

                    }else{
                        echo '
                                <p>Full grade and subjects details below. </p><br>
                                <p><strong> NB: If you wish to change your grade, simple send message to admin by clicking <a href="message.php?user_type=admin&user_id=1">here</a>.</strong></p>

                                <table id="users_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>Academic Year</th>
                                    <th>Grade</th>
                                    <th>Subjects</th>
                                </tr>
                                </thead>
                                <tbody>
                                ';

                        $sql = $init->prepare("SELECT * FROM grade,student WHERE grade=grade_code AND student_id='$_SESSION[id]'");
                        $sql->execute();

                        if($sql->rowCount() > 0) {
                            foreach ($sql as $key => $data) {

                                echo '
                                     <tr>
                                        <td>' . date('Y') . '</td>
                                        <td>Grade ' . $data["grade_code"] . '</td><td><ul>';
                                foreach (explode(',', str_replace("'", "", $data["subjects"])) as $subs) {
                                    echo '<li>' . $subs . '</li>';
                                }
                                echo '</ul></td>
                                     </tr>
                                ';
                            }
                        }
                    }

                    $pdo->close();
                    ?>
                </div>
            </div>
        </section>

    </div>

</div>


<?php include('./../layouts/footer.php') ?>
</body>
</html>



