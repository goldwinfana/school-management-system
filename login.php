<?php include 'layouts/session.php';include 'layouts/alerts.php';$page='login'?>
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

</head>

<?php include 'layouts/header.php'; ?>
<body style="background: darkslategrey">

<div style="width:100%;margin-top: 150px;position:absolute;">
    <div class="row justify-content-center login-card">
        <div class="col-md-8">
            <div class="card" style="height: auto;">
                <div class="card-header" style="border-bottom: 1px dark solid;">Login</div>

                <div class="card-body">
                    <form method="POST" action="customRegister.php" >
                        <input name="login" value="login" hidden>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <a  href="./reset.php">
                                        Forgot Password
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success form-control text-white">
                                    Login
                                </button>

<!--                                @if (Route::has('password.request'))-->
<!--                                    <a class="btn btn-link" href="{{ route('password.request') }}">-->
<!--                                        {{ __('Forgot Your Password?') }}-->
<!--                                    </a>-->
<!--                                @endif-->
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
<script src="assets/assets/js/custom.js"></script>



