<?php include './../layouts/session.php'; include './../layouts/alerts.php';
$page='home';
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
                <h2 class="h5 no-margin-bottom">Teacher Dashboard</h2>
            </div>
        </div>


        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">


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



