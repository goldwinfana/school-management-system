<?php include './../layouts/session.php'; include './../layouts/alerts.php';
if(isset($_SESSION["islogged"])){

    if($_SESSION['user']=='admin'){
        header('location: ./../admin/dashboard.php');
    }else if($_SESSION['user']=='saloon'){
        header('location: ./../saloon/dashboard.php');
    }
}else{
    header('location: ./../login.php');
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
                <h2 class="h5 no-margin-bottom">Dashboard</h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="container-fluid">
                <div class="row">
                    <a class="top-bannner col-md-3 col-sm-6" href="bookings.php">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="fa fa-list"></i></div><h15 class="tot-booking"></h15>
                                </div>

                            </div>
                            <div class="progress progress-template">
                                <div title="{{((count($posts)/50)*100)}}%" role="progressbar" style="width: 0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="20" class="progress-bar progress-bar-template"></div>
                            </div>
                        </div>
                    </a>
                    <a class=" top-bannner col-md-3 col-sm-6" href="schedulled.php">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="fa fa-hourglass-half fa-fw pending"></i></div><h15 class="act-booking"></h15>
                                </div>
                                <div class="number "></div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template"></div>
                            </div>
                        </div>
                    </a>

                    <a class="top-bannner col-md-3 col-sm-6" href="cancelled.php">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="fa fa-check-circle" style="color: cornflowerblue"></i></div><h15 class="can-booking" style="color: cornflowerblue"></h15>
                                </div>
                                <div class="number"></div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 0%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template textbg-white-50"></div>
                            </div>
                        </div>
                    </a>

                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon">
                                        <i class="fa fa-clock-o active"></i>
                                    </div>
                                    <h15 class="active">Session Duration (<i class="time-bar-count">0</i>)</h15>

                                </div>
                                <div class="number "></div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template time-bar"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="example1" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <th>Available Services</th>
                        </thead>
                        <tbody>

                        <?php
                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT * FROM saloon");
                        $sql->execute();

                        if($sql->rowCount() > 0){
                            foreach ($sql as $data){

                                echo '

                        <tr>
                            <td>
                                <div class="public-user-block block">
                                    <div class="align-items-center">
                                        <div class="d-flex float-right sec_actions" >
                                        
                                        
                                        </div>

                                        <div class="d-block align-items-center">
                                            <strong class="d-block">
                                                <a id="'.$data["id"].'" class="post-title view-saloon" style="color: cadetblue;" href="#'.$data["name"].'">'.$data["name"].' <small style="text-decoration: none;color: currentColor;" class="text-white-50 font-weight-lighter">'.$data["address"].'</small></a>
                                             
                                            </strong>
                                            <div class="row d-flex d-flex margin-bottom-sm margin-top-sm">
                                               <div class="mar-5" style="margin-left: auto">
                                                  <img class="" src="./../assets/img/profile.png" align="left">
                                                 
                                               </div>
                   
                                               <div class="margin-top-sm contributions" style="width: 70%;margin-left: auto;margin-top:0px !important;">
                            
                                                   <strong>About Us: '.$data["about"].'</strong><hr/>
                                                   <p>Services offered</p>
                                                   '?>

                                                    <?php
                                                    $services = $init->prepare("SELECT * FROM service WHERE saloonID=:id");
                                                    $services->execute(['id'=>$data["id"]]);

                                                    if($services->rowCount() > 0) {
                                                        foreach ($services as $service) {
                                                           echo '<div class="contributions bg-gray-dark">'.$service["serviceName"].'  R'.$service["price"].'  <button id="'.$service["id"].'" class="btn btn-success book-btn" > Book</button ></div>';
                                                        }
                                                    }else{
                                                        echo 'No services offered ye!!!';
                                                    }
                                                echo '
                                              </div>
                                           </div>
                                            
                                        </div>

                                    </div>
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
<script type="text/javascript">
    $(document).ready(function () {

        $('.book-btn').on('click',function () {

            $.ajax({
                type: 'POST',
                url: './sql.php',
                data: {getService:this.id},
                dataType: 'json',
                success: function(response){

                    $('.saloon').text('Saloon Name: '+response.name);
                    $('.category').text('Category Name: '+response.categoryName);
                    $('.service').text('Service Name: '+response.serviceName);
                    $('.duration').text('Duration: '+response.duration);
                    $('.price').text('Price: R'+response.price);

                    $('input[name=saloon]').val(response.saloonID);
                    $('input[name=category]').val(response.categoryID);
                    $('input[name=service] ').val(response.serID);
                    $('input[name=duration]').val(response.duration);
                    $('input[name=price]').val(response.price);
                }
            });

            $('#book-session').modal('show');
        });

        $('.view-saloon').on('click',function () {

            $('.service-offered').html('');
            $.ajax({
                type: 'POST',
                url: './sql.php',
                data: {getSaloon:this.id},
                dataType: 'json',
                success: function(response){

                    $('.lbl-saloon').html(response[0].name+
                        '<small style="color: currentColor;background: black !important;" class="contributions mar-5 text-white-50 font-weight-lighter">'+
                        response[0].address+'</small>');

                    $('.lbl-about').text('About Us: '+response[0].about);

                    $.each(response,function (key,data) {
                        $('.service-offered').append('<span>'+data.serviceName+' '+data.price+
                            '  <button id="'+data.serID+'" class="btn btn-success book-btn"> Book</button></span>');
                    });
                }
            });

            $('#view-saloon').modal('show');
        });

        $('.upload-image').on('click',function () {


            $('#upload-image').modal('show');
        });

    });


    function getAllStuff(id) {
        $('select[name=stuff]').html('<option value="" selected disabled>Select Available Stuff</option>');

        var start = $('input[name=start]').val();
        var end = $('input[name=end]').val();

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {getAllStuff:id,
            start:start,
            end:end},
            dataType: 'json',
            success: function(response){
                console.log(response);
                console.log(start);
                $.each(response,function (key,data) {
                    $('select[name=stuff]').append('<option value="'+data.stuffID+'">'+data.stuffName+'</option>');
                });
            }
        });
    }

    function changeStuff() {

        $('select[name=stuff]').html('<option value="" selected disabled>Select Available Stuff</option>');
        $('.stuff').text('');

        var curDate = new Date();
        var duration = $('input[name=duration]').val();
        var date = new Date($('input[name=date-time]').val());
        if(curDate >= date){
            $('.error').css('color','red').text('Please fill in current or future date...');
            $('input[name=date]').val('');
            $('input[name=start]').val('');
            $('input[name=end]').val('');

            $('.date').text('');
            $('.start').text('');
            $('.end').text('');
        }else if(date.getHours()+parseInt(duration) > 20 || date.getHours()+parseInt(duration) < 9){
            $('.error').css('color','red').text('Sorry you can not make you booking as saloons usually opens at 08:00 AM and close at 20:00 PM');
            $('input[name=date]').val('');
            $('input[name=start]').val('');
            $('input[name=end]').val('');

            $('.date').text('');
            $('.start').text('');
            $('.end').text('');
        }
        else{
            if(curDate==date && curDate.getHours()+2 >= date.getHours()){
                $('.error').css('color','red').text('You can only book from at least 2 hours in advance');
                $('input[name=date]').val('');
                $('input[name=start]').val('');
                $('input[name=end]').val('');

                $('.date').text('');
                $('.start').text('');
                $('.end').text('');
            }else{

                $('input[name=date]').val(date.toDateString());
                $('input[name=start]').val(date.getHours()+':00');
                $('input[name=end]').val((date.getHours()+parseInt(duration))+':00');

                $('.date').text('Date: '+date.toDateString());
                $('.start').text('Start Time: '+date.getHours()+':00');
                $('.end').text('End Time: '+(date.getHours()+parseInt(duration))+':00');
                $('.error').css('color','green').text('');

                getAllStuff($('input[name=saloon]').val());
            }

        }

    }

    function loadData(){
        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {loadData:1},
            dataType: 'json',
            success: function(response){

                console.log(response);
                var cancelled=0;
                var active = 0;

                 $.each(response,function (key,data) {
                     if(data.status=='active'){
                        active++;
                     }else{
                        cancelled++;
                     }
                 });

                $('.tot-booking').text('Total Bookings('+response.length+')');
                $('.act-booking').text('Scheduled Booking('+active+')');
                $('.can-booking').text('Cancelled Bookings('+cancelled+')');
            }
        });
    }
    loadData();
</script>

</body>
</html>



