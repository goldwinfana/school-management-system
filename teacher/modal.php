<div class="modal fade" id="view-student-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>User Profile</span>
            </div>
            <div class="modal-body">


                <div style="text-align: center"><img src="../assets/img/profile.png" alt="..." class="img-fluid rounded-circle"></div>

                <hr/>
                <div style="display: grid;float: left;">
                    <label class=" col-form-label">Student Number: <span class="student-number"></span></label>
                    <label class=" col-form-label">Name: <span class="student-name"></span></label>
                    <label class=" col-form-label">E-Mail Address: <span class="student-email"></span></label>
                    <label class=" col-form-label">ID Number: <span class="student-idNo"></span></label>
                    <label class=" col-form-label">Age: <span class="student-age"></span></label>
                    <label class=" col-form-label">Gender: <span class="student-gender"></span></label>

                </div>

            </div>
        </div>
    </div>
</div></div>

<div class="modal fade" id="edit-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Edit Profile</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data"  onsubmit="return sendForm('editStudent')">
                    <input class="form-control" type="text" name="edit-student" hidden>

                    <div class="form-group row">
                        <label for="edit-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="edit-name" type="text" class="form-control is-invalid" name="edit-name" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="edit-email" type="email" class="form-control is-invalid" name="edit-email" maxlength="30" onkeyup="validateEmail('editStudent')"  required autocomplete="">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-verifyEmail"></strong>
                            </span>
                    </div>


                    <div class="form-group row">
                        <label for="edit-idNo" class="col-md-4 col-form-label text-md-right">ID Number</label>

                        <div class="col-md-6">
                            <input id="edit-idNo" type="text" class="form-control is-invalid" name="edit-idNo" minlength="13" maxlength="13" onkeypress="return /[0-9]/i.test(event.key)" onkeyup="validateID('editStudent')" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-verifyID"></strong>
                            </span>
                    </div>


                    <input id="edit-gender" type="text" class="form-control is-invalid" name="edit-gender" hidden>



                    <div class="form-group row">
                        <label for="edit-password" class="col-md-4 col-form-label text-md-right">Password&nbsp;</label>

                        <div  class="col-md-6">
                            <input id="edit-password" type="text" class="form-control" name="edit-password" placeholder="e.g 1234*Abcd" minlength="8" onkeyup="createPassword('editStudent')" required autocomplete="off">
                        </div>

                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-verifyPass"></strong>
                            </span>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="cancelBooking">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Cancel Booking</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php">

                    <div class="form-group row">
                        <h3 style="padding: 15px" class="lbl-service"></h3>

                        <div class="col-md-6">
                            <input type="text" class="form-control is-invalid" name="cancelBooking" hidden>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-close"></i> Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="view-saloon">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Cancel Booking</span>
            </div>
            <div class="modal-body text-center">

                <div class="d-block align-items-center">
                    <strong class="d-block">
                        <a class="post-title lbl-saloon" style="color: cadetblue;"></a>

                    </strong>
                    <div class="row margin-bottom-sm margin-top-sm">
                        <div style="margin: auto">
                            <img class="" src="./../assets/img/profile.png">
                        </div>

                        <div class="margin-top-sm contributions">

                            <strong class="lbl-about"></strong><hr>
                            <p>Services offered</p>
                            <div class="service-offered">
                            </div>

                        </div>
                    </div>

                </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="upload-image">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Book Session</span>
            </div>
            <div class="modal-body">

                <form action="sql.php" method="POST" enctype="multipart/form-data" class="text-center">
                    <div>
                        <label>Description Of hair-Style You Wish To Search For...</label>
                        <textarea class="form-control" type="text" name="description" required>
                        </textarea>
                    </div>
                    <div>
                        <label>Upload Picture Of hair-Style You Wish To Search For...</label>
                        <input class="form-control" type="image" name="img" required>
                    </div>

                    <div class="modal-footer">

                    <button type="submit" name="upload-image" class="btn btn-success"><i class="fa fa-check-circle"></i> Upload Image</button>
                </form>
            </div>
        </div>
    </div></div>


<div class="modal fade" id="book-session">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Book Session</span>
            </div>
            <div class="modal-body">

                <div style="margin:15px;display: grid">
                    <span class="saloon"></span>
                    <span class="category"></span>
                    <span class="service"></span>
                    <span class="duration"></span>
                    <span class="price"></span>
                    <span class="date"></span>
                    <span class="start"></span>
                    <span class="end"></span>
                    <span class="error"></span>
                    <span class="stuff"></span>
                </div>

                <form action="sql.php" method="POST" class="text-center">
                    <div>
                        <label>Pick Date and Time</label>
                        <input class="form-control" type="datetime-local" name="date-time" onchange="changeStuff()" required>
                    </div>

                    <div>
                        <label>Pick Stuff</label>
                        <select id="stuff" class="form-control" name="stuff" onchange="$('.stuff').text('Stuff Name: '+$('#stuff option:selected').text());" required>
                            <option value="" selected disabled>Select Available Stuff</option>
                        </select>
                    </div>

                    <input name="saloon" hidden>
                    <input name="category" hidden>
                    <input name="service" hidden>
                    <input name="duration" hidden>
                    <input name="price" hidden>
                    <input name="date" hidden>
                    <input name="start" hidden>
                    <input name="end" hidden>
                    <hr/>
                    <button type="submit" name="booking" class="btn btn-success"><i class="fa fa-check-circle"></i> Confirm Booking</button>
                </form>
        </div>
    </div>
</div></div>
