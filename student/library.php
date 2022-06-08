<?php include './../layouts/session.php'; include './../layouts/alerts.php'; $page='library';?>


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
                <h2 class="h5 no-margin-bottom">Library</h2>
            </div>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">
                    <table id="users_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>No#</th>
                            <th>Book Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                    $init = $pdo->open();
                    $sql = $init->prepare("SELECT * FROM book");
                    $sql->execute();
                    if($sql->rowCount() > 0){
                        foreach ($sql as $key => $data) {
                            $sql1 = $init->prepare("SELECT * FROM booking WHERE book_id='$data[book_id]' AND student_id='$_SESSION[id]' AND status=0");
                            $sql1->execute();
                            $book = $sql1->fetch();
                            $btn ='<a href="#borrow" id="'.$data["book_id"].'" for="'.$data["book_name"].'" class="contributions bg-secondary text-white action_spans booking" title="Book">Borrow Book</a>';
                            if($sql1->rowCount() > 0){
                                $btn = '<a href="#return" id="'.$book["booking_id"].'" for="'.$data["book_name"].'" class="contributions bg-warning text-white action_spans return" title="Book">Return Book</a>';
                            }

                            echo '
                                 <tr>
                                 <td>' . $key . '</td>
                                    <td>' . $data['book_name'] . '</td>
                                    <td>
                                        <div class="d-flex" >'.$btn.'</div>
                                    </td>
                                 </tr>
                            ';
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



