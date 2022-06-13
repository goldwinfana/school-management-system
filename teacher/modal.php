<div class="modal fade" id="view-teacher-profile">
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
                    <label class=" col-form-label">Name: <span class="teacher-name"></span></label>
                    <label class=" col-form-label">Surname: <span class="teacher-surname"></span></label>
                    <label class=" col-form-label">E-Mail Address: <span class="teacher-email"></span></label>
                    <label class=" col-form-label">ID Number: <span class="teacher-idNo"></span></label>
                    <label class=" col-form-label">Age: <span class="teacher-age"></span></label>
                    <label class=" col-form-label">Gender: <span class="teacher-gender"></span></label>

                </div>

            </div>
            <button id="<?php echo $_SESSION['id'] ?>" class="btn btn-warning edit-teacher"><i class="fa fa-edit"></i> Edit</button>
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
                    <input class="form-control" type="text" name="edit-teacher" hidden>

                    <div class="form-group row">
                        <label for="edit-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="edit-name" type="text" class="form-control is-invalid" name="edit-name" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-name" class="col-md-4 col-form-label text-md-right">Surname</label>

                        <div class="col-md-6">
                            <input id="edit-surname" type="text" class="form-control is-invalid" name="edit-surname" required autocomplete="false">
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



                    <input id="edit-gender" type="text" class="form-control is-invalid" name="edit-gender" hidden>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="regBtn">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Confirm Registration</span>
            </div>
            <div class="modal-body">
                <div class=" conSubs"></div>
                <form method="post" action="sql.php" class="lastSub" name="regSubjects" hidden>
                </form>

                    <div class="modal-footer">
                        <button class="btn btn-danger btn-flat" onclick="$('#regBtn').modal('hide');"><i class="fa fa-close"></i> Cancel</button>
                        <button class="btn btn-success btn-flat" onclick="$('.lastSub').submit();"><i class="fa fa-save"></i> Save</button>

            </div>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="activate_test">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Activate Test</span>
            </div>
            <div class="modal-body">
                <div id="lbl-test"></div>
                <form method="post" action="sql.php">
                    <input name="activate_test" hidden>

                <div class="modal-footer">
                    <button class="btn btn-danger btn-flat" onclick="event.preventDefault();$('#activate_test').modal('hide');"><i class="fa fa-close"></i> Cancel</button>
                    <button class="btn btn-success btn-flat" ><i class="fa fa-check"></i> Activate</button>

                </div>
                </form>

            </div>
        </div>
    </div>
</div></div>

<div class="modal fade" id="deactivate_test">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Deactivate Test</span>
            </div>
            <div class="modal-body">
                <div id="_test"></div>
                <form method="post" action="sql.php">
                    <input name="deactivate_test" hidden>

                    <div class="modal-footer">
                        <button class="btn btn-danger btn-flat" onclick="event.preventDefault();$('#deactivate_test').modal('hide');"><i class="fa fa-close"></i> Cancel</button>
                        <button class="btn btn-success btn-flat" ><i class="fa fa-check"></i> Deactivate</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div></div>






