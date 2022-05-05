<?php include './../layouts/session.php'; ?>
<?php

//if(isset($_SESSION['user']) == 'admin'){
//    header('location: ./../admin/welcome.php');
//}
//
//
//if(!isset($_SESSION['loggedin'])){
//    header('location: ./../login.php');
//}


?>

<!DOCTYPE html>
<html lang="en">
<?php include './../layouts/header.php'; ?>
<body style="display: flex;width: -webkit-fill-available;">
<div style="display:flex;background: #2d3035;">
    <?php include './../layouts/navbar.php'; ?>

    <!--    {{--BODY --}}-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Student Dashboard</h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="fa fa-list"></i></div><strong>Total Posts (0)</strong>
                                </div>
                                <!--                                {{--                                @if(!empty($tickets))--}}-->
                                <!--                                {{--                                    <div class="number">{{count($tickets)}}</div>--}}-->
                                <!--                                {{--                                @else--}}-->
                                <!--                                {{--                                    <div class="number">{{__('0')}}</div>--}}-->
                                <!--                                {{--                                @endif--}}-->

                            </div>
                            <div class="progress progress-template">
                                <div title="{{((count($posts)/50)*100)}}%" role="progressbar" style="width: 0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="20" class="progress-bar progress-bar-template"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="fa fa-hourglass-half fa-fw pending"></i></div><strong class="pending">Pending (0)</strong>
                                </div>
                                <div class="number "></div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="fa fa-clock-o active"></i></div><strong class="active">Active (0)</strong>
                                </div>
                                <div class="number "></div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 0%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="statistic-block block">
                            <div class="progress-details d-flex align-items-end justify-content-between">
                                <div class="title">
                                    <div class="icon"><i class="fa fa-users" style="color: cornflowerblue"></i></div><strong style="color: cornflowerblue">Applications (0)</strong>
                                </div>
                                <div class="number"></div>
                            </div>
                            <div class="progress progress-template">
                                <div role="progressbar" style="width: 0%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template textbg-white-50"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="no-padding-top no-padding-bottom">
            <div class="container-fluid">
                <label>Search for other available job posts</label>
                <div class="row" style="display: flex">
                    <div style="width: 80%"><input class="form-control" placeholder="Search jobs by title"></div>
                    <div><i type="button" class="fa fa-search" style="padding: 10px"></i></div>
                </div>
            </div>
        </section>


        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="ticket_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <th>Available Posts</th>
                        <a href="https://manytools.org/image/colorize-filter/">Pick a color and create Monochrome / Monotone images online</a>
                        </thead>
                        <tbody>

<!--                        @if(!empty($posts))-->
<!--                        @foreach($posts as $key=>$post)-->
<!--                        <tr>-->
<!--                            <td>-->
<!--                                <div class="public-user-block block">-->
<!--                                    <div class="align-items-center">-->
<!--                                        <div class="d-flex float-right sec_actions" >-->
<!--                                            {{--                                                    <a class="contributions bg-info text-white action_spans" title="{{ _('View')}}"><i class="fa fa-eye"></i></a>--}}-->
<!--                                            <a id="{{$post->postID}}" class="contributions bg-warning text-white action_spans edit-post" title="{{ _('Edit')}}"><i class="fa fa-edit"></i></a>-->
<!--                                            <a id="{{$post->postID}}" class="contributions bg-danger text-white action_spans delete-post" title="{{ _('Delete')}}"><i class="fa fa-trash"></i></a>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="d-block align-items-center">-->
<!--                                            <strong class="d-block">-->
<!--                                                <a id="{{$post->postID}}" class="post-title" style="color: cadetblue;" href="#pNo={{$post->postID}}">{{$post->title}} <small class="text-white-50 font-weight-lighter">({{$post->postID}})</small></a>-->
<!--                                                <span class="contributions status_show {{$post->status}}">{{$post->status}}</span>-->
<!--                                                <a href="#applicants" style="text-decoration: none;color: currentColor;" title="click to view applications" class="contributions status_show">{{__('0')}} applicants</a>-->
<!--                                            </strong>-->
<!--                                            <span class="d-block padding-top-sm padding-bottom-sm">{{$post->description}}</span>-->
<!--                                            <div class="contributions text-danger">Closing Date: {{$post->closeDate}}</div>-->
<!--                                        </div>-->
<!---->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        @endforeach-->
<!--                        @else-->
<!--                        <h5>No Posts Available...</h5>-->
<!--                        @endif-->

                        </tbody>
                    </table>

                </div>
            </div>
        </section>


    </div>
    <!--    {{--END BODY--}}-->
</div>


</body>
</html>

<script>
    var variable=null;
    $(function() {
        $(document).on('click', '.anim_view', function (e) {

            e.preventDefault();
            var id = this.id;
            viewAnim(id);
            $('#anim_view').modal('show');
        });

        $(document).on('click', '.anim_delete', function (e) {

            e.preventDefault();
            var id = this.id;
            $('.anim_span').html('<h5>Serial No: <span style="color: orange">'+id+'</span></h5>');
            $('.anim_delete').val(id);
            $('#amin_delete').modal('show');
        });

        $(document).on('click', '.editFarmer', function (e) {

            e.preventDefault();
            editFarmer();
            $('#edit').modal('show');
        });

        $(document).on('click', '.addnew', function (e) {

            e.preventDefault();
            $('#addnew').modal('show');
        });


        $(document).on('click', '.anim_trace', function (e) {

            e.preventDefault();
            var id = this.id;
            variable=id;
            getCoords(id);
            $('#maps').modal('show');
        });

    });

    function viewAnim(id){
        $.ajax({
            type: 'POST',
            url: './../farmer/farmer_handle.php',
            data: {viewAnim:id},
            dataType: 'json',
            success: function(response){

                $('.anim-ser').html('Serial No: '+response.serial_no);
                $('.anim-type').html('Type: '+response.animal_type);
                $('.anim-btype').html('Breed Type: '+ response.breed_type);
                $('.anim-desc').html('Description: '+response.description);
                $('.anim-weight').html('Weight: '+response.weight);
                $('.anim-img').attr('src','../assets/img/info_animals/'+response.image);

            }
        });

    }

    function editFarmer(){
        $.ajax({
            type: 'POST',
            url: './../farmer/farmer_handle.php',
            data: {profile:5},
            dataType: 'json',
            success: function(response){

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

</script>
