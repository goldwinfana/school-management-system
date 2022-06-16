<?php include './../layouts/session.php'; include './../layouts/alerts.php'; $page='document';?>


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
                <h2 class="h5 no-margin-bottom">Documents</h2>
            </div>
        </div>




        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">
                    <h4>List of all files uploaded by student.</h4>

                    <table id="users_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>No#</th>
                            <th>Student Names</th>
                            <th>Student ID No</th>
                            <th>Description</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                    <?php

                    if(isset($_GET['stud'])){
                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT * FROM upload,student WHERE student_id=user_id AND user_id='$_GET[stud]'");
                        $sql->execute();
                        if($sql->rowCount() > 0){
                            foreach ($sql as $key => $data) {
                                $filename = "../student/uploads/".$data["file_name"];

                                echo '
                                     <tr>
                                        <td>' . $key . '</td>
                                        <td>' . $data["name"].' '.$data["surname"] . '</td>
                                        <td>' . $data["id_number"] . '</td>
                                        <td>' . $data["description"] . '</td>
                                        <td>' . $data["date"] . '</td>
                                        <td>
                                            <div class="d-flex" >'?>
                                <button onclick='window.open("<?php echo $filename; ?>","_blank");' class="btn btn-warning" title="View">View File</button>
                                <?php echo '</div>
                                        </td>
                                     </tr>
                                ';
                            }

                        }
                        $pdo->close();
                    }


                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>

</div>


<?php include('./../layouts/footer.php') ?>
</body>
</html>



