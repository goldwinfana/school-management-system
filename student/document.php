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
        <div class="container-fluid">
            <div class="row">
            <?php
                $init = $pdo->open();
                $grade = '';
                $sql = $init->prepare("SELECT * FROM student WHERE student_id='$_SESSION[id]'");
                $sql->execute();
                if($sql->fetch()['grade'] ==NULL){
                   echo '<h1 class="text-warning">You currently do not have any grade, upload a report and admin will assign you a grade</h1>';
                }
                $pdo->close();
            ?>
            </div>
        </div>

        <form action="sql.php" method="post" enctype="multipart/form-data">
            <h4>Upload you documents here</h4>
        <div style="display: flex;width: 100%">

            <div style="margin:15px;width: 25%">
                <textarea class="form-control" rows="3" style="width: 100%;border-radius: 8px" name="description" type="text" placeholder="Type your description..." required></textarea>
            </div>

            <div class="select-grade" style="margin:15px;">
                <input class="form-control" name="file_name" type="file" style="width: auto;border-radius: 8px" required>
            </div>

            <div class="select-grade" style="margin:15px;">
                <button class="btn btn-success" style="width: auto" name="upload-file"><i class="fa fa-upload"></i> Upload</button>
            </div>
        </div>
        </form><hr>




        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">
                    <h4>List of all files you have uploaded.</h4>

                    <table id="users_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>No#</th>
                            <th>Description</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                    <?php

                    $init = $pdo->open();
                    $sql = $init->prepare("SELECT * FROM upload WHERE user_id='$_SESSION[id]'");
                    $sql->execute();
                    if($sql->rowCount() > 0){
                            foreach ($sql as $key => $data) {
                                $filename = "uploads/".$data["file_name"];

                                echo '
                                     <tr>
                                        <td>' . $key . '</td>
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



