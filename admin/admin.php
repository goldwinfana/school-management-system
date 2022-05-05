<?php include './../includes/session.php'; ?>
<?php include './../includes/navbar.php';

if($_SESSION['user'] == 'farmer'){
    header('location: ./../farmer/welcome.php');
}

if(!isset($_SESSION['loggedin'])){
    header('location: ./../login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style type="text/css"> body{ font: 14px sans-serif;text-align: center; }</style>
</head>
<body style="display: flex">
<?php include("../includes/side-menu.php")?>
<div class="body-content">
    <div class="intro-text" style="padding-top: 50px">
        <?php
        if(isset($_SESSION['error'])){
            echo "
                        <div class='alert alert-warning beautiful' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                           ".$_SESSION['error']."</div>
                        ";
            unset($_SESSION['error']);
        }

        if(isset($_SESSION['success'])){
            echo "
                        <div class='alert btn-success  beautiful' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                           ".$_SESSION['success']."</div>
                        ";
            unset($_SESSION['success']);
        }

        ?>
    </div>
    <input type="hidden" class="user_token" value="<?php echo $_SESSION['admin']?>">
    <div class="page-header">
        <h1>ADMINISTRATION DASHBOARD</h1>
    </div>
    <button style="padding: 5px;margin: 5px" class="btn-secondary add"><i class="fa fa-plus-square-o"></i> Add Member</button><br/>
    <div class="bs-example w3layouts">

        <?php
        $conn = $pdo->open();
        echo '
            <table class="table" id="orderTable">
                 <tr style="background: dimgrey;">
                    <th>No #</th>
                     <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
                ';
        try {
            $stmt = $conn->prepare("SELECT * from admin");
            $stmt->execute();


        }
        catch (Exception $e){
            print_r($e->getMessage());
        }

        $key=1;
        if($stmt->rowCount() > 0) {

            foreach ($stmt as $row) {

                echo '<tr>
                                 <td>' . $key . '</td>
                                 <td>' . $row['id'] . '</td>
                                 <td>' . $row['name'] . '</td>
                                 <td>' . $row['email'] . '</td>
                                 <td>' . $row['mobile'] . '</td>
                                     <td>
                                         
                                         <button class="btn-warning editAdmin" id="' . $row['id'] . '"><i class="fa fa-check-circle-o"></i> Edit</button>
                                         <button class="btn-danger deleteAdmin" id="' . $row['id'] . '"><i class="fa fa-trash-o"></i> Delete</button>
                                     </td>
                                </tr>
                                </tr>';
                $key++;
            }

            echo '</table>';

        }else{
                echo '<tr>No Records Found ...</tr>';
            }

        $pdo->close();
        ?>



    </div>
</div>
</body>
</html>
<?php include('./../includes/scripts.php') ?>
<?php include('./files/admin_modal.php') ?>
<script>
    $(function() {

        $(document).on('click', '.editAdmin', function (e) {

            e.preventDefault();
            var id = this.id;
            editAdmin(id);
            $('#edit').modal('show');
        });
        $(document).on('click', '.editFarmer', function (e) {

            e.preventDefault();
            var id = this.id;
            editFarmer(id);
            $('#edit').modal('show');
        });
        $(document).on('click', '.deleteAdmin', function (e) {

            e.preventDefault();
            var id = this.id;
            deleteAdmin(id);
            $('#delete').modal('show');
        });
        $(document).on('click', '.deleteFarmer', function (e) {

            e.preventDefault();
            var id = this.id;
            deleteFarmer(id);
            $('#delete').modal('show');
        });
        $(document).on('click', '.add', function (e) {

            e.preventDefault();
            $('#add').modal('show');
        });

        $(document).on('click', '.profile', function (e) {

            e.preventDefault();

            var id = $('.user_token').val();
            getUser(id);
            $('#profile').modal('show');
        });

    });

    function editFarmer(id){
        $.ajax({
            type: 'POST',
            url: './../admin/admin_handle.php',
            data: {user_id:id},
            dataType: 'json',
            success: function(response){


                $('.editUsers').html('      <input type="hidden" id="edit_id" name="edit_farmer">\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="text" class="form-control" id="firstname" name="firstname" required>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="lastname" class="col-sm-3 control-label">Lastname</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="text" class="form-control" id="lastname" name="lastname" required>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="email" class="col-sm-3 control-label">Email</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="email" class="form-control" id="email" name="email" required>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="password" class="col-sm-3 control-label">Password</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="password" class="form-control" id="password" name="password" required>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="mobile" class="col-sm-3 control-label">Mobile</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="text" class="form-control" id="mobile" name="mobile" required>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="gender" class="col-sm-3 control-label">Gender</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <select class="form-control" id="gender" name="gender" required>\n' +
                    '                                <option value="" selected hidden>Select Gender</option>\n' +
                    '                                <option value="male">Male</option>\n' +
                    '                                <option value="female">Female</option>\n' +
                    '                                <option value="other">Other</option>\n' +
                    '                            </select>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="address" class="col-sm-3 control-label">Home Address</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="text" class="form-control" id="address" name="address" required>\n' +
                    '                        </div>\n' +
                    '                    </div>');




                $('input[name=edit_farmer]').val(response.id);
                $('input[name=firstname]').val(response.firstName);
                $('input[name=lastname]').val(response.lastName);
                $('input[name=email]').val(response.email);
                $('input[name=gender]').val(response.gender);
                $('input[name=mobile]').val(response.mobile);
                $('input[name=address]').val(response.address);

            }
        });

    }

    function editAdmin(id){
        $.ajax({
            type: 'POST',
            url: './../admin/admin_handle.php',
            data: {admin_id:id},
            dataType: 'json',
            success: function(response){


                $('.editUsers').html('      <input type="hidden" id="edit_id" name="edit_admin">\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="name" class="col-sm-3 control-label">Name</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="text" class="form-control" id="name" name="name" required>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="email" class="col-sm-3 control-label">Email</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="email" class="form-control" id="email" name="email" required>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="password" class="col-sm-3 control-label">Password</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="password" class="form-control" id="password" name="password" required>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="mobile" class="col-sm-3 control-label">Mobile</label>\n' +
                    '\n' +
                    '                        <div class="col-sm-9">\n' +
                    '                            <input type="text" class="form-control" id="mobile" name="mobile" required>\n' +
                    '                        </div>\n' +
                    '                    </div>');

                $('input[name=edit_admin]').val(response.id);
                $('input[name=name]').val(response.name);
                $('input[name=email]').val(response.email);
                $('input[name=mobile]').val(response.mobile);
                $('input[name=password]').val(response.password);

            }
        });

    }

    function deleteFarmer(id){

        $.ajax({
            type: 'POST',
            url: './../admin/admin_handle.php',
            data: {farmer_id:id},
            dataType: 'json',
            success: function(response){

                $('.id_delete').attr('name','farmer_delete');
                $('.id_delete').val(id);
                $('.fullname').html('Delete Farmer: '+response.firstName+' '+response.lastName);
            }
        });
    }

    function deleteAdmin(id){

        $.ajax({
            type: 'POST',
            url: './../admin/admin_handle.php',
            data: {admin_id:id},
            dataType: 'json',
            success: function(response){

                $('.id_delete').attr('name','admin_delete');
                $('.id_delete').val(id);
                $('.fullname').html('Delete Admin: '+response.name);
            }
        });
    }

    function getUser(id){
        $.ajax({
            type: 'POST',
            url: './../admin/admin_handle.php',
            data: {admin_id:id},
            dataType: 'json',
            success: function(response){

                $('input[name=edit_id]').val(response.id);
                $('input[name=name]').val(response.name);
                $('input[name=email]').val(response.email);
                $('input[name=mobile]').val(response.mobile);
                $('input[name=password]').val(response.password);

            }
        });

    }


    function changeForm(){

        var name = $('select[name=form]').val();
        if(name =='admin'){
            $('.admin-form').css('display','block');
            $('.farmer-form').css('display','none');
        }else{
            $('.farmer-form').css('display','block');
            $('.admin-form').css('display','none');
        }

    }
</script>

