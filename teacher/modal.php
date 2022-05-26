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
                    <button class="btn btn-danger btn-flat" onclick="$('#activate_test').modal('hide');"><i class="fa fa-close"></i> Cancel</button>
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
                        <button class="btn btn-danger btn-flat" onclick="$('#deactivate_test').modal('hide');"><i class="fa fa-close"></i> Cancel</button>
                        <button class="btn btn-success btn-flat" ><i class="fa fa-check"></i> Deactivate</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div></div>






