<?php include './../layouts/session.php'; include './../layouts/alerts.php';$page='home'?>


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
                <h2 class="h5 no-margin-bottom">Admin Dashboard</h2>
            </div>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">

                                <div class=" row ">
                                    <div class="form-group">
                                        <label for="type" class="col-sm-5 control-label">Report Type</label>

                                        <div class="col-sm-9">
                                            <select name="type" id="type" class="form-control" onchange="window.location.href='?report_type='+this.value" required>
                                                <option selected disabled>Select report type</option>
                                                <option value="marks">Marks</option>
                                                <option value="books">Books</option>
                                                <option value="bus">Bus</option>
                                                <option value="parents">Parents</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-group" hidden>
                                        Search Keys:
                                        <input type="text" id="search" name="search" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" />
                                        <br/>
                                    </div>
                                </div>
                            </div>

                            <div >
                            <?php
                            $init=$pdo->open();
                            if(isset($_GET['report_type'])) {
                                if ($_GET['report_type'] == 'marks') {?>
                                    <div class="col-md-12" style="display: flex">
                                        <select name="type" id="type" class="form-control" onchange="window.location.href='?report_type=marks&grade='+this.value" value="<?php if(isset($_GET['grade'])){echo $_GET['grade'];} ?>" required>
                                            <option selected disabled>Select grade</option>
                                            <?php
                                            $stmt = $init->prepare("SELECT * from grade");
                                            $stmt->execute();

                                            if($stmt->rowCount() > 0) {
                                                foreach ($stmt as $row) {
                                                    echo '<option value="'.$row['grade_code'].'" >'.$row['grade_code'].'</option>';
                                                }

                                            }
                                            ?>
                                        </select>

                                        <?php if (isset($_GET['grade'])) {?>
                                        <select style="margin-left: 10px" class="form-control" onchange="setSubject(this.value)" value="<?php if(isset($_GET['subject'])){echo $_GET['subject'];} ?>"  required>
                                            <option selected disabled>Select subject</option>
                                            <?php
                                            $stmt = $init->prepare("SELECT * from grade");
                                            $stmt->execute();

                                            if($stmt->rowCount() > 0) {
                                                foreach (explode(',',$stmt->fetch()['subjects']) as $row) {
                                                    echo '<option value="'.str_replace(array('"', "'"), '',$row).'" >'.str_replace(array('"', "'"), '',$row).'</option>';
                                                }

                                            }
                                            ?>
                                        </select>
                                        <?php }
                                         if (isset($_GET['subject'])) {?>
                                        <select style="margin-left: 10px" class="form-control" onchange="setTest(this.value)" value="<?php if(isset($_GET['test_name'])){echo $_GET['test_name'];} ?>"  required>
                                            <option selected disabled>Select test</option>
                                            <?php
                                            $stmt = $init->prepare("SELECT * from exam");
                                            $stmt->execute();
                                            if($stmt->rowCount() > 0) {
                                                foreach ($stmt as $row) {
                                                    echo '<option value="'.$row['test_name'].'" >'.$row['test_name'].'</option>';
                                                }

                                            }
                                            ?>
                                        </select>
                                         <?php }?>
                                      </div><br>

                                    <?php
                                    if(isset($_GET['report_type']) && isset($_GET['grade']) && isset($_GET['subject']) && isset($_GET['test_name'])) {
                                        echo '
                                        <table id="marks_datatable" class="table table-bordered" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Student Names</th>
                                                <th>Grade</th>
                                                <th>Test Name</th>
                                                <th>Score</th>
                                                <th>Pass/Fail</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            ';

                                        $sql = $init->prepare("SELECT *,SUM(score) AS totScore,COUNT(mark.student_id ) AS scores FROM mark,exam,student WHERE mark.exam_id=exam.exam_id 
                                                           AND mark.student_id=student.student_id AND exam.grade='$_GET[grade]' AND test_name='$_GET[test_name]' GROUP BY mark.exam_id,mark.student_id");
                                        $sql->execute();

                                        if ($sql->rowCount() > 0) {
                                            foreach ($sql as $data) {
                                                echo '
                                                <tr>
                                                    <td>' . $data["name"] . ' ' . $data["surname"] . '</td>
                                                    <td>' . $data["grade"] . '</td>
                                                    <td>' . $data["test_name"] . '</td>
                                                    <td>' . ($data["totScore"] / $data["scores"]) * 100 . '%</td>
                                                    <td>' . (($data["totScore"] / $data["scores"]) * 100 > 50 ? '<i class="text-success">Pass</i>' : '<i class="text-danger">Fail</i>') . '</td>
                                                </tr>
                                                ';
                                            }
                                        }
                                    }
                                }else if($_GET['report_type'] == 'books'){?>
                                    <div class="col-lg-12">
                                        <label>Filters</label><br>
                                        <label>From</label>
                                        <input type="date" class="col-md-4 rFrom" value="<?php if(isset($_GET['from'])){echo $_GET['from'];} ?>"><br>

                                        <label>To</label>
                                        <input type="date" class="col-md-4 rTo" value="<?php if(isset($_GET['to'])){echo $_GET['to'];} ?>"><br>

                                        <button class="btn btn-success" onclick="generateReport()">Generate Report</button>
                                    </div><br>

                                    <?php
                                    if(isset($_GET['report_type']) && isset($_GET['from']) && isset($_GET['to'])) {
                                        echo '
                                        <table id="marks_datatable" class="table table-bordered" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Student Names</th>
                                                <th>Book Name</th>
                                                <th>Borrow Date</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            ';

                                        $sql = $init->prepare("SELECT *,booking.status AS stat FROM booking,book,student WHERE student.student_id=booking.student_id 
                                                                AND booking.book_id=book.book_id AND borrow_date BETWEEN '$_GET[from]' AND '$_GET[to]'");
                                        $sql->execute();

                                        if ($sql->rowCount() > 0) {
                                            foreach ($sql as $data) {
                                                $status = '<i class="text-white">Borrowed</i>';
                                                if ($data["stat"] == 1) {
                                                    $status = '<i class="text-warning">Waiting For Confirmation</i>';
                                                } else if ($data["stat"] == 2) {
                                                    $status = '<i class="text-danger">Rejected</i>';
                                                } else if ($data["stat"] == 3) {
                                                    $status = '<i class="text-success">Returned</i>';
                                                }
                                                echo '
                                                <tr>
                                                    <td>' . $data["name"] . ' ' . $data["surname"] . '</td>
                                                    <td>' . $data["book_name"] . '</td>
                                                    <td>' . $data["borrow_date"] . '</td>
                                                    <td>' . $status . '</td>
                                                </tr>
                                                ';
                                            }
                                        }
                                    }

                                }else if($_GET['report_type'] == 'bus'){?>

                                    <select hidden name="type" id="type" class="form-control" onchange="window.location.href='?report_type='+this.value" required>
                                        <option selected disabled>Order By No Of Students</option>
                                        <option value="high">Highest to Lowest</option>
                                        <option value="low">Lowest To Highest</option>
                                    </select><br>
                                    <table id="marks_datatable" class="table table-bordered" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>No#</th>
                                            <th>Bus Name</th>
                                            <th>Driver Details</th>
                                            <th>ID Number</th>
                                            <th>Mobile</th>
                                            <th>Number Of Students</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $init = $pdo->open();
                                        $sql = $init->prepare("SELECT *,COUNT(transport) AS trans FROM transport LEFT JOIN student ON transport_id=transport 
                                                                GROUP BY transport  ASC");
                                        $sql->execute();

                                        if($sql->rowCount() > 0){
                                            foreach ($sql as $data){
                                                echo '
                                                     <tr>
                                                        <td>'.$data["transport_id"].'</td>
                                                        <td>'.$data["bus"].'</td>
                                                        <td>'.$data["name"].' '.$data["surname"].'</td>
                                                        <td>'.$data["id_number"].'</td>
                                                        <td>'.$data["mobile"].'</td>
                                                        <td>'.$data["trans"].'</td>
                                                     </tr>
                                                ';
                                            }

                                        }
                                        $pdo->close();
                                        ?>


                                        </tbody>
                                    </table>




                                <?php }else if($_GET['report_type'] == 'parents'){?>

                                <select hidden name="type" id="type" class="form-control" onchange="window.location.href='?report_type='+this.value" required>
                                    <option selected disabled>Order By No Of Students</option>
                                    <option value="high">Highest to Lowest</option>
                                    <option value="low">Lowest To Highest</option>
                                </select><br>
                                <table id="marks_datatable" class="table table-bordered" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>No#</th>
                                        <th>Parent Name</th>
                                        <th>ID Number</th>
                                        <th>Number Of Children</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $init = $pdo->open();
                                    $sql = $init->prepare("SELECT *,COUNT(parent_id_number) AS parents,parent.name AS pName,parent.surname AS pSurname,parent.id_number AS pId 
                                                           FROM parent,student WHERE parent.id_number=parent_id_number GROUP BY parent_id_number");
                                    $sql->execute();

                                    if($sql->rowCount() > 0) {
                                        foreach ($sql as $key=> $data) {
                                            echo '
                                                     <tr>
                                                        <td>' . $key . '</td>
                                                        <td>' . $data["pName"] . ' ' . $data["pSurname"] . '</td>
                                                        <td>' . $data["pId"] . '</td>
                                                        <td>' . $data["parents"] . '</td>
                                                     </tr>
                                                ';
                                        }
                                    }

                                    }
                                    $pdo->close();
                                    ?>


                                    </tbody>
                                </table>



                                <?php }
                            ?>
                            </div>


                    </div>
                </div>
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
<script>

    function setSubject(grade){
       window.location.href=window.location.search+'&subject='+grade;
    }
    function setTest(test){
        window.location.href=window.location.search+'&test_name='+test;
    }

    function generateReport(){
        if($('.rFrom').val()==''){
            $('.rFrom').focus();
            return;
        }else if($('.rTo').val()==''){
            $('.rTo').focus();
            return;
        }else{
            window.location.href='?report_type=books&from='+$('.rFrom').val()+'&to='+$('.rTo').val();
        }

    }


</script>


