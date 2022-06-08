<?php include './../layouts/session.php'; include './../layouts/alerts.php';$page='library'?>

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

        <div style="margin:15px">
            <button class="btn btn-primary" onclick="$('#add_book').modal('show')">Add New Book</button>
        </div>

        <div style="margin:15px">
            <select class="form-control" style="width: auto" onchange="window.location.href='?type='+this.value">
                <option value="" selected disabled>Select option to display</option>
                <option value="all">All books</option>
                <option value="borrowed">Borrowed books</option>
                <option value="returned">Returned books</option>
                <option value="history">History</option>
            </select>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <?php
                    $init = $pdo->open();
                    if(isset($_GET['type'])) {
                            if ($_GET['type'] == 'borrowed') {
                                echo '
                                <table id="users_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Student Names</th>
                                    <th>Book Name</th>
                                    <th>Borrowed Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>';

                                $sql = $init->prepare("SELECT * FROM student,booking,book 
                                                WHERE student.student_id=booking.student_id AND book.book_id=booking.book_id  AND booking.status=0");
                                $sql->execute();
                                $book = $sql->fetchAll();
                                if ($sql->rowCount() > 0) {
                                    foreach ($book as $key => $data) {

                                        echo '
                                         <tr>
                                            <td>' . $key . '</td>
                                            <td> 
                                                <div style="display: block">
                                                    <p>Names: ' . $data['name'].' '.$data['surname'] . '</p>
                                                    <p>ID: ' . $data['id_number'] . '</p>
                                                </div>
                                            </td>
                                            <td>' . $data['book_name'] . '</td>
                                            <td>' . $data['borrow_date'] . '</td>
                                            <td class="text-warning">Borrowed</td>
                                         </tr>
                                    ';
                                    }

                                }
                            } else if($_GET['type'] == 'returned') {

                                echo '
                                <table id="users_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Student Names</th>
                                    <th>Book Name</th>
                                    <th>Borrowed Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>';

                                $sql = $init->prepare("SELECT * FROM student,booking,book 
                                                WHERE book.book_id=booking.book_id AND student.student_id=booking.student_id AND booking.status=1");
                                $sql->execute();
                                $book = $sql->fetchAll();
                                if ($sql->rowCount() > 0) {
                                    foreach ($book as $key => $data) {

                                        echo '
                                         <tr>
                                            <td>' . $key . '</td>
                                            <td> 
                                                <div style="display: block">
                                                    <p>Names: ' . $data['name'] . ' ' . $data['surname'] . '</p>
                                                    <p>ID: ' . $data['id_number'] . '</p>
                                                </div>
                                            </td>
                                            <td>' . $data['book_name'] . '</td>
                                            <td>' . $data['borrow_date'] . '</td>
                                            <td class="text-warning">Returned</td>
                                            <td>
                                                <div class="d-flex" >
                                                <a href="#confirm" id="' . $data["booking_id"] . '" for="' . $data["book_name"] . '" class=" bg-success text-white action_spans accept_return" title="Book">Confirm</a>
                                                <a href="#decline" id="' . $data["booking_id"] . '" for="' . $data["book_name"] . '" class=" bg-danger text-white action_spans decline_return" title="Book">Decline</a>
                                                </div>
                                            </td>
                                            
                                         </tr>
                                    ';
                                    }
                                }

                            }else if($_GET['type'] == 'history') {

                                echo '
                                <table id="users_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Student Names</th>
                                    <th>Book Name</th>
                                    <th>Borrowed Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>';

                                $sql = $init->prepare("SELECT * FROM student,booking,book 
                                                WHERE book.book_id=booking.book_id AND student.student_id=booking.student_id AND booking.status=3");
                                $sql->execute();
                                $book = $sql->fetchAll();
                                if ($sql->rowCount() > 0) {
                                    foreach ($book as $key => $data) {

                                        echo '
                                         <tr>
                                            <td>' . $key . '</td>
                                            <td> 
                                                <div style="display: block">
                                                    <p>Names: ' . $data['name'] . ' ' . $data['surname'] . '</p>
                                                    <p>ID: ' . $data['id_number'] . '</p>
                                                </div>
                                            </td>
                                            <td>' . $data['book_name'] . '</td>
                                            <td>' . $data['borrow_date'] . '</td>
                                            <td>' . $data['return_date'] . '</td>
                                            <td class="text-warning">Return Accepted</td>
                                            
                                         </tr>
                                    ';
                                    }
                                }

                            }else {

                                echo '
                                <table id="users_table" class="table table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Book Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>';

                                $sql = $init->prepare("SELECT * FROM book");
                                $sql->execute();
                                if ($sql->rowCount() > 0) {
                                    foreach ($sql as $key => $data) {

                                        echo '
                                         <tr>
                                         <td>' . $key . '</td>
                                          <td>' . $data['book_name'] . '</td>
                                          <td>
                                              <div class="d-flex" >
                                                 <a id="' . $data["book_id"] . '" for="' . $data["book_name"] . '" class="contributions bg-warning text-white action_spans edit_book" title="Edit"><i class="fa fa-edit"></i></a>
                                                 <a id="' . $data["book_id"] . '" for="' . $data["book_name"] . '" class="contributions bg-danger text-white action_spans delete_book" title="Delete"><i class="fa fa-trash"></i></a>
                                              </div>
                                            </td>
                                         </tr>
                                    ';
                                    }
                                }

                            }
                        }else {

                            echo '
                            <table id="users_table" class="table table-bordered" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>No#</th>
                                <th>Book Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';

                            $sql = $init->prepare("SELECT * FROM book");
                            $sql->execute();
                            if ($sql->rowCount() > 0) {
                                foreach ($sql as $key => $data) {

                                    echo '
                                     <tr>
                                     <td>' . $key . '</td>
                                      <td>' . $data['book_name'] . '</td>
                                      <td>
                                          <div class="d-flex" >
                                             <a id="' . $data["book_id"] . '" for="' . $data["book_name"] . '" class="contributions bg-warning text-white action_spans edit_book" title="Edit"><i class="fa fa-edit"></i></a>
                                             <a id="' . $data["book_id"] . '" for="' . $data["book_name"] . '" class="contributions bg-danger text-white action_spans delete_book" title="Delete"><i class="fa fa-trash"></i></a>
                                          </div>
                                        </td>
                                     </tr>
                                ';
                                }
                            }

                        }
                        $pdo->close();
                ?>

                        </tbody>
                    </table>

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



