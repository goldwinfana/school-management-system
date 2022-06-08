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

        <div style="margin:15px" hidden>
            <button class="btn btn-primary add-book">Books</button>
            <button class="btn btn-primary mar-5 category">Category</button>
        </div>

        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="ticket_table" class="table table-bordered" hidden style="width: 100%;">
                        <tr>
                            <th>Book Name</th>
                            <th>Shelve Number</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Author Name</th>
                            <th>Book Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

<!--                        --><?php
//
//                        $init = $pdo->open();
//                        $sql = $init->prepare("SELECT *,book.id AS bookID FROM book,category where book.categoryID=category.id");
//                        $sql->execute();
//
//                        if($sql->rowCount() > 0){
//                            foreach ($sql as $data){
//
//                                echo '
//                                     <tr>
//                                        <td>'.$data["bookName"].'</td>
//                                        <td>'.$data["shelveNumber"].'</td>
//                                        <td>'.$data["categoryName"].'</td>
//                                        <td>'.$data["quantity"].'</td>
//                                        <td>'.$data["author"].'</td>
//                                        <td>R'.$data["price"].'</td>
//                                        <td>
//                                            <div class="d-flex" >
//                                                <a id="'.$data["bookID"].'" class="contributions bg-info text-white action_spans" title="View"><i class="fa fa-eye"></i></a>
//                                                <a id="'.$data["bookID"].'" class="contributions bg-warning text-white action_spans edit-book" title="Edit"><i class="fa fa-edit"></i></a>
//                                                <a id="'.$data["bookID"].'" class="contributions bg-danger text-white action_spans delete-book" title="Delete"><i class="fa fa-trash"></i></a>
//                                            </div>
//                                        </td>
//                                     </tr>
//                                ';
//                            }
//
//                        }
//                        $pdo->close();
//                        ?>

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



