<?php include './../layouts/session.php'; ?>

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
                <h2 class="h5 no-margin-bottom">Transportation</h2>
            </div>
        </div>

        <div style="margin:15px">
            <button class="btn btn-primary add-transport">Add Transport</button>
        </div>


        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="driver_table" class="table table-bordered" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>No#</th>
                        <th>Bus Name</th>
                        <th>Driver Details</th>
                        <th>ID Number</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                       <?php

                            $init = $pdo->open();
                            $sql = $init->prepare("SELECT * FROM transport");
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
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["transport_id"].'" class="contributions bg-info text-white action_spans view-bus" title="View"><i class="fa fa-eye"></i></a>
                                                <a hidden id="'.$data["transport_id"].'" class="contributions bg-warning text-white action_spans edit-bus" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="'.$data["transport_id"].'" class="contributions bg-danger text-white action_spans delete-bus" title="Delete"><i class="fa fa-trash"></i></a>
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



