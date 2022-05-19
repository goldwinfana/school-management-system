<?php $img = empty(isset($_SESSION['image']))? '../assets/img/profile.png' : '../assets/img/profile/'.isset($_SESSION['image']); ?>
<!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="img_cont">
            <img src="<?php echo $img; ?>" class="rounded-circle user_img">
            <span class="online_icon"></span>
        </div>
<!--{{--        <div class="avatar"><img src="{{asset('ask/img/profile.png')}}" alt="..." class="img-fluid rounded-circle"></div>--}}-->
        <div class="title" style="padding: 20px;">
            <h1 class="h5"><?php if($_SESSION['user']) echo $_SESSION['user'] ?></h1>
            <p><?php if(isset($_SESSION['name'])) echo $_SESSION['name'] ?></p>
        </div>
    </div>
<!--     Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">

        <?php
        if($_SESSION['user'] == 'admin'){
            echo '
            <li class="active"><a href="./../admin/dashboard.php"> <i class="fa fa-home"></i>Home </a></li>
            <li><a id="'.$_SESSION['id'].'" class="update-user-profile edit-admin"> <i class="fa fa-user-circle"></i>Profile</a></li>
            <li><a href="./../admin/users.php" > <i class="fa fa-users"></i>Users</a></li>
            <li><a href="./../admin/transport.php"> <i class="fa fa-bus"></i>Transport</a></li>
            <li><a href="./message.php" class="maps"> <i class="fa fa-comment-o"></i>Messages</a></li>
        
       ';}

        if($_SESSION['user'] == 'student'){
            echo '
            <li class="active"><a href="./../student/dashboard.php"> <i class="fa fa-home"></i>Home </a></li>
            <li><a id="'.$_SESSION['id'].'" class="update-user-profile view-student-profile"> <i class="fa fa-user-circle"></i>Profile</a></li>
            <li><a href="./subject.php" class="maps"> <i class="fa fa-book"></i>Subjects</a></li>
            <li><a href="./transport.php"> <i class="fa fa-bus"></i>Transport</a></li>
            <li><a href="./message.php" class="maps"> <i class="fa fa-comment-o"></i>Messages</a></li>
       ';}

        if($_SESSION['user'] == 'teacher'){
            echo '
            <li class="'.($page=='home'?'active':'').'"><a href="./dashboard.php"> <i class="fa fa-home"></i>Home </a></li>
            <li class="'.($page=='edit-profile'?'active':'').'"><a id="'.$_SESSION['id'].'" class=" update-user-profile edit-profile"> <i class="fa fa-user-circle"></i>Profile</a></li>
            <li class="'.($page=='exam'?'active':'').'"><a href="./exam.php"> <i class="fa fa-book"></i>Exam</a></li>
            <li class="'.($page=='setexam'?'active':'').'"><a href="./setexam.php"> <i class="fa fa-bookmark-o"></i>Set Exam</a></li>
            <li class="'.($page=='message'?'active':'').'"><a href="./message.php"> <i class="fa fa-comment-o"><small class="msg-count text-white">5</small></i>Messages</a></li>
       ';}

        if($_SESSION['user'] == 'parent'){
            echo '
            <li class="active"><a href="./../saloon/dashboard.php"> <i class="fa fa-home"></i>Home </a></li>
            <li><a id="'.$_SESSION['id'].'" class="view-parent-profile"> <i class="fa fa-user-circle"></i>Profile</a></li>
            <li hidden><a class="create-shout book-session"> <i class="fa fa-plus-circle"></i>Book Session</a></li>
       ';}
        ?>
        <li><a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>

    </ul>
</nav>
<!-- Sidebar Navigation end-->

<!--<li><a class="view-books"> <i class="fa fa-book"></i>Issued Books</a></li>-->
