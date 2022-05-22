<?php include './../layouts/session.php'; include './../layouts/alerts.php';include 'modal.php';
$page='home';
?>

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
                <h2 class="h5 no-margin-bottom">Teacher Dashboard</h2>
            </div>
        </div>


        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row" style="display: block">
                    <?php
                    $init = $pdo->open();
                    $sql = $init->prepare("SELECT * FROM teacher WHERE teacher_id=:id");
                    $sql->execute(['id'=>$_SESSION['id']]);

                    if ($sql->fetch()['grade_code']==NULL) {
                        echo '<h3>You do not have grade as yet, please register below</h3><br>';
                        ?>

                        <div class="select-grade" style="margin:15px;">
                            <select class="form-control" style="width: auto" class="choose-grade" name="choose-grade" onchange="getSubject(this.value)" required>
                                <option value="" selected disabled>Select grade from list</option>

                                <?php
                                $init = $pdo->open();
                                $sql = $init->prepare("SELECT * FROM grade");
                                $sql->execute();

                                if ($sql->rowCount() > 0) {
                                    foreach ($sql as $data) {
                                        echo '<option value="'.$data['grade_code'].'">Grade '.$data['grade_code'].'</option>';
                                    }
                                }
                                $pdo->close();
                                ?>

                            </select>

                        </div>

                        <div class="select-sub" style="margin:15px;">
                            <form class="formSubjects" action="sql.php" method="post">
                                <input name="grade" hidden>

                            </form>
                        </div>

                    <?php }else{

                        echo '
                        <table id="admin_table" class="table table-bordered" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>Grade</th>
                                <th>Subjects</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            ';

                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT * FROM teacher");
                        $sql->execute();

                        if ($sql->rowCount() > 0) {
                            foreach ($sql as $data) {

                                echo '
                            <tr>
                                <td>' . $data["grade_code"] . '</td>
                                <td>';
                                    foreach (json_decode($data["subjects"]) as $subs){
                                       echo '<p>'.$subs.'</p>';
                                    }
                                    echo
                                '</td>
                                <td>
                                    <div class="d-flex" >
                                        <a href="exam.php" class="contributions bg-info text-white action_spans" title="View Questions"><i class="fa fa-level-up"></i> View Exams</a>
                                    </div>
                                </td>
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

<!--        {{--        ENd Table--}}-->
    </div>
<!--    {{--END BODY--}}-->
</div>

<?php include('./../layouts/footer.php') ?>
<script type="text/javascript">
    $(document).ready(function () {

        $('.regBtn').on('click',function () {

                console.log('ce');



            // $('#regBtn').modal('show');
        });

    });

    function regBtn() {
        var count = 0;
        var grade = $('select[name=choose-grade]').val();
        $('.conSubs').html('');
        $('.conSubs').append('<p>Are you sure you want to register thr following grade and subjects?</p>');
        $('.conSubs').append('<h4>Grade '+grade+'</h4><br><hr>');

        $('.lastSub').html('');
        $('.lastSub').append('<input name="teacherGrade" value="'+grade+'">');

        $('.formSubjects').find('input').each(function () {
            if($(this).is(':checked')){
                count++;
                $('.conSubs').append('<p>'+$(this).val()+'</p>');
                $('.lastSub').append('<input name="sub[]" value="'+$(this).val()+'">');
            }
        });
        if(count == 5){
            $('#regBtn').modal('show');
        }else{
            alerts('warning', 'Please only select up to 5 subjects');
        }

    }

    function getSubject(val) {
        $('.formSubjects').html('');
        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getSubjects: val
            },
            dataType: 'json',
            success: function (response) {
                var subjects = response.subjects.replaceAll(/'/g,'').split(',');

                $.each(subjects, function (a,i) {
                    $('.formSubjects').append(
                        '<div class="form-control" style="display: flex"> <input class="subs" name="subs[]" type="checkbox" value="'+i+'"> <label style="padding: 5px" ">'+i+'</label></div>'
                    );
                });
                $('.formSubjects').append('<br><button class="btn btn-success regBtn" onclick="event.preventDefault();regBtn()">Register Subjects</button>');
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

</script>

</body>
</html>



