<?php include './../layouts/session.php'; ?>
<?php

    if(isset($_SESSION["islogged"])){

        if($_SESSION['user']=='admin'){
            header('location: ./../admin/dashboard.php');
        }else if($_SESSION['user']=='customer'){
            header('location: ./../customer/dashboard.php');
        }else{
            header('location: ./../login.php');
        }
    }

?>

<?php

if(isset($_SESSION['success'])){
    echo '
                            <div class="alert btn-success message-alert"> '
        .$_SESSION['success'].'
                            </div>';
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])){
    echo '
                            <div class="alert btn-danger message-alert"> '
        .$_SESSION['error'].'
                            </div>';
    unset($_SESSION['error']);
}

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
                <h2 class="h5 no-margin-bottom">Saloon Dashboard</h2>
            </div>
        </div>

        <div style="margin:15px">
            <button class="btn btn-secondary mar-5 add-service">Add Service</button>
        </div>

        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="_table" class="table table-bordered" style="width: 100%;">
                        <thead><tr>
                            <th>Category Name</th>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT *,service.id AS serID,service.name AS serName FROM service,category where service.categoryID=category.id");
                        $sql->execute();

                        if($sql->rowCount() > 0){
                            foreach ($sql as $data){

                                echo '
                                     <tr>
                                        <td>'.$data["categoryName"].'</td>
                                        <td>'.$data["serName"].'</td>
                                        <td>R'.$data["price"].'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["serID"].'" class="contributions bg-info text-white action_spans" title="View"><i class="fa fa-eye"></i></a>
                                                <a id="'.$data["serID"].'" class="contributions bg-warning text-white action_spans edit-service" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="'.$data["serID"].'" class="contributions bg-danger text-white action_spans delete-service" title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
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

        <!--        {{--        ENd Table--}}-->
    </div>
    <!--    {{--END BODY--}}-->
</div>

<?php include('./../layouts/footer.php') ?>
</body>
</html>



