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
                <h2 class="h5 no-margin-bottom">All Bookings</h2>
            </div>
        </div>
        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="example1" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Saloon</th>
                        <th>Stuff</th>
                        <th>Action</th>
                        </thead>
                        <tbody>

                        <?php
                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT *,session.id AS bookID FROM session,stuff,saloon,service 
                                                        WHERE customerID=:id AND session.stuffID=stuff.stuffID
                                                        AND session.service=service.id AND saloon.id=session.saloonID");
                        $sql->execute(['id'=>$_SESSION['id']]);

                        if($sql->rowCount() > 0){
                            foreach ($sql as $data){

                                echo '

                                <tr>
                                    <td>'.$data["date"].'</td>
                                    <td>'.$data["startTime"].'</td>
                                    <td>'.$data["endTime"].'</td>
                                    <td>'.$data["duration"].'</td>
                                    <td>'.$data["serviceName"].'</td>
                                    <td>'.$data["price"].'</td>
                                    <td>'.$data["name"].'</td>
                                    <td>'.$data["stuffName"].'</td>
                                    <td>
                                      <button class="btn btn-danger cancel-booking" id="'.$data["bookID"].'" for="'.$data["serviceName"].' @ '.$data["name"].'"><i class="fa fa-close"></i> Cancel</button>
                                      <button class="btn btn-warning"><i class="fa fa-eye"></i> View</button>
                                    
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

        $('.cancel-booking').on('click',function () {

            $('.lbl-service').text('Are you sure you want to cancel booking for '+$(this).attr('for')+'?');
            $('input[name=cancelBooking]').val(this.id);

            $('#cancelBooking').modal('show');
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
                // $('.category').text('Category Name: '+response.categoryName);
                // $('.service').text('Service Name: '+response.serviceName);
                // $('.duration').text('Duration: '+response.duration);
                // $('.price').text('Price: R'+response.price);
            }
        });
    }
    loadData();
</script>

</body>
</html>



