
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>School Management System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <meta name="_token" content="{{{ csrf_token() }}}"/>
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="../assets/assets/vendor/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="../assets/assets/vendor/font-awesome/css/font-awesome.min.css">
        <!-- Custom Font Icons CSS-->
        <link rel="stylesheet" href="../assets/assets/css/font.css">
        <!-- Google fonts - Muli-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="../assets/assets/css/style.default.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="../assets/assets/css/custom.css">
        <link rel="stylesheet" href="../assets/assets/css/chats.css">
        <!-- Favicon-->
        <link rel="shortcut icon" href="../assets/assets/img/favicon.ico">
        <!-- Tweaks for older IEs--><!--[if lt IE 9] -->

    </head>
    <?php



    $pth = isset($_SESSION['islogged'])? '../assets' : 'assets';

    $img = empty(isset($_SESSION['image']))? '../assets/img/profile.png' : '../assets/img/profile/'.isset($_SESSION['image']);
    if(isset($_SESSION['islogged'])){

        $class = $_SESSION['user'] =='student'? 'view-student-profile' : 'view-admin-profile';
        $id =  $_SESSION['id'];
        if($_SESSION['user']=='student'){
            include('./../student/modal.php');
        }
        if($_SESSION['user'] =='student'){
            $class='view-student-profile';




        }else if($_SESSION['user'] =='admin'){
            $class='view-admin-profile';
        }else if($_SESSION['user'] =='parent'){
            $class='view-parent-profile';
        }else{
            $class='view-teacher-profile';
        }
    }
    ?>
    <!-- Header Navigation-->
    <header class="header">
        <nav class="navbar navbar-expand-lg">

            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <!-- Navbar Header-->
                    <a href="#" class="navbar-brand" style="display: flex" onclick="location.reload()">
                        <div class="brand-text brand-big visible text-uppercase">
                            <strong class="text-primary full-logo">School Management System <i class="fa fa-book"></i></strong>
<!--                            <strong class="text-primary short-logo"><img src='--><?php //echo $pth.'/img/short-logo.png'; ?><!--' width="100"></strong>-->
                        </div>

<!--                     Sidebar Toggle Btn-->
                        <?php if(isset($_SESSION['islogged'])) {
//                            echo '<button class="sidebar-toggle btn-secondary">☰</button>';
                        }?>
                    </a></div>
                <div class="right-menu list-inline no-margin-bottom">
                    <!-- Notifications-->
                    <?php
                    if(isset($_SESSION['islogged'])){

                        echo '<div hidden class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle"><i class="fa fa-bell"></i><span class="badge dashbg-2">5</span></a>
                                    <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#" class="dropdown-item message d-flex align-items-center">
                                            <div class="profile"><img src="img/avatar-3.jpg" alt="..." class="img-fluid">
                                                <div class="status online"></div>
                                            </div>
                                            <div class="content">   <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                                            <div class="profile"><img src="img/avatar-2.jpg" alt="..." class="img-fluid">
                                                <div class="status away"></div>
                                            </div>
                                            <div class="content">   <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                                            <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                                                <div class="status busy"></div>
                                            </div>
                                            <div class="content">   <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                                            <div class="profile"><img src="img/avatar-5.jpg" alt="..." class="img-fluid">
                                                <div class="status offline"></div>
                                            </div>
                                            <div class="content">   <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div></a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i class="fa fa-angle-right"></i></strong></a></div>
                                </div>';

                    ?>
                <!-- End Notifications-->



                <!-- Name-->

                        <div class="list-inline-item dropdown"><?php if(isset($_SESSION['name'])) echo $_SESSION['name'] ?></div>

                <!-- End Name-->

                    <!-- Profile-->
                    <?php

                    echo '<div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle">
                            <div class="avatar">
                                <img src="'.$img.'" alt="..." width="25" class="img-fluid rounded-circle"></div></a>
                        <div aria-labelledby="navbarDropdownMenuLink3" class="dropdown-menu messages">
                            <a id="'.$id.'" href="#" class="dropdown-item message d-flex align-items-center '.$class.'">
                                <div class="content">   <strong class="d-block">View Profile  <span class="fa fa-eye"></span></strong>
                                </div>
                            </a>

                            <a href="../logout.php" class="dropdown-item message d-flex align-items-center">
                                <div class="content">   <strong class="d-block">Logout  <span class="fa fa-sign-out"></span></strong>
                                </div>
                            </a>
                        </div>
                    </div>';
                }
                else{
                    echo '
                        <div class="d-flex">
                            <a href="login.php" class="dropdown-item d-flex align-items-center ">Login</a>
                            <a href="register.php" class=" dropdown-item d-flex align-items-center">Register</a>
                        </div>';
                }
                ?>
<!--                    @endif-->
                </div>
            </div>
        </nav>
    </header>
    <!-- Header Navigation end-->




