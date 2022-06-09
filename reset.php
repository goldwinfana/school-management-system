<?php include 'layouts/alerts.php';include 'layouts/session.php'; $page='register'?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>School Management System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="assets/assets/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="assets/assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/assets/css/custom.css">
    <link rel="stylesheet" href="assets/assets/css/chats.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/assets/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9] -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>

<?php include 'layouts/header.php'; ?>
<body style="background: darkslategrey">


<div style="width:100%;position:absolute;">
    <div class="row justify-content-center register-card">
        <div class="col-md-8">
            <div class="card" style="height: auto;">
                <div class="card-header" style="border-bottom: 1px dark solid;">Reset Password</div>

                <div class="card-body">

                    <form id="regForm" method="POST" action="customRegister.php" enctype="multipart/form-data" onsubmit="return sendForm()">
                        <input name="reset" value="reset" hidden>


                        <div class="form-group row regNo" >
                            <label class="col-md-4 col-form-label text-md-right">ID Number</label>

                            <div class="col-md-6">
                                <input id="idNo" type="text" class="form-control is-invalid idNumber" name="idNumber" minlength="13" maxlength="13" onkeyup="validateID(this.value)" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off" required>
                            </div>

                            <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyID"></strong>
                            </span>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password&nbsp;</label>

                            <div  class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="e.g 1234*Abcd" minlength="8" onkeyup="createPassword()" required autocomplete="off">
                                <span class="fa fa-eye" style="margin-top: -30px;position: absolute;right: 25px;"></span>
                            </div>

                            <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyPass"></strong>
                            </span>
                        </div>



                        <div class="form-group row">
                            <label for="passwordMatch" class="col-md-4 col-form-label text-md-right">Confirm Password&nbsp;</label>

                            <div class="col-md-6">
                                <input id="passwordMatch" type="password" class="form-control" name="passwordMatch" minlength="8" onkeyup="matchPassword()" required autocomplete="off">
                            </div>
                            <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyMatch"></strong>
                            </span>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success form-control text-white">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>
</body>
</html>

<script src="assets/js/jquery.min.js"></script>
<script>
    function validateID(idNo) {
        $.ajax({
            type: 'POST',
            url: 'customRegister.php',
            data: {
                checkID:idNo},
            dataType: 'json',
            success: function(response){
               console.log(response)
                if(response.length > 0){
                    $('#verifyID').css('color', 'green').html(' <i>ID number found</i>');
                }else{
                    $('#verifyID').css('color', '#dc3545').html(' <i>ID number does not exist</i>');
                }
            }
        });

    }

    function createPassword() {

        let password = $('#password').val();
        if(password.length > 0) {

            if(password.length < 8){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[a-z]/.test(password))){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[A-Z]/.test(password))){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[0-9]/.test(password))){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password))){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }else{
                $('#verifyPass').css('color','green').html('<span>Strong <i class="fa fa-handshake-o"></i></span>');
            }
        }else{
            $('#verifyPass').html('');
        }
    }

    function matchPassword(){
        let password = $('#password').val();
        let password_confirm = $('#passwordMatch').val();

        if (password_confirm.length === 0) {
            $('#verifyMatch').html('');
            return;
        }

        if (password === password_confirm) {
            $('#verifyMatch').css('color','green').html('<span>Match <i class="fa fa-handshake-o"></i></span>');
            return;
        }
        else {
            $('#verifyMatch').css('color','#dc3545').html('<span>Password Dont Match <i class="fa fa-warning"></i></span>');
            return;
        }
    }

    function sendForm(){

        if($('#verifyID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=idNo]').focus();
            return false;
        }

        if($('#verifyMatch').css('color') =='rgb(220, 53, 69)'){
            $('input[name=passwordMatch]').focus();
            return false;
        }
        if($('input[name=password]').val() !== $('input[name=passwordMatch]').val()){
            $('#verifyMatch').css('color','#dc3545').html('<span>Password Dont Match <i class="fa fa-warning"></i></span>');
            $('input[name=passwordMatch]').focus();
            return false;
        }

        if($('#verifyPass').css('color') =='rgb(220, 53, 69)'){
            $('input[name=password]').focus();
            return false;
        }


        return true;
    }

    $('.fa-eye').on('click', function () {
        $('#password').attr('type') =='password'? $('#password').attr('type', 'text'): $('#password').attr('type', 'password');
        $('.fa-eye').toggleClass("fa-eye-slash");
    });
</script>


