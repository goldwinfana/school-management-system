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
                    <label class=" col-form-label">Name: <span class="student-name"></span></label>
                    <label class=" col-form-label">Surname: <span class="student-surname"></span></label>
                    <label class=" col-form-label">E-Mail Address: <span class="student-email"></span></label>
                    <label class=" col-form-label">ID Number: <span class="student-idNo"></span></label>
                    <label class=" col-form-label">Age: <span class="student-age"></span></label>
                    <label class=" col-form-label">Gender: <span class="student-gender"></span></label>
                    <label class=" col-form-label">Parent ID: <span class="student-parent"></span></label>

                </div>

            </div>
            <button id="<?php echo $_SESSION['id'] ?>" class="btn btn-warning edit-student"><i class="fa fa-edit"></i> Edit</button>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="edit-student">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Edit Student</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data"  onsubmit="return sendForm('editStudent')">
                    <input class="form-control" type="text" name="edit-student" hidden>

                    <div class="form-group row">
                        <label for="edit-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="edit-st-name" type="text" class="form-control is-invalid" name="edit-st-name" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-name" class="col-md-4 col-form-label text-md-right">Surname</label>

                        <div class="col-md-6">
                            <input id="edit-st-surname" type="text" class="form-control is-invalid" name="edit-st-surname" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="edit-st-email" type="email" class="form-control is-invalid" name="edit-st-email" maxlength="30" onkeyup="validateEmail('editStudent')"  required autocomplete="">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-verifyEmail"></strong>
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-email" class="col-md-4 col-form-label text-md-right">Mobile</label>

                        <div class="col-md-6">
                            <input id="edit-st-mobile" type="text" class="form-control is-invalid" name="edit-st-mobile" maxlength="30" onkeyup="validateMobile()"  required autocomplete="">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-verifyMobile"></strong>
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


<div class="modal fade" id="register-transport">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Register Transport</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="reg-bus" hidden>
                    <h4 id="reg-bus"></h4>
                    <p class="text-danger"><strong>NB: Note that once you register this, to change it you will need to contact admin</strong></p>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="register_grade">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Register Grade</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="reg-grade" hidden>
                    <h4 id="reg-grade"></h4>
                    <p class="text-danger"><strong>NB: Note that once you register this, to change it you will need to contact admin</strong></p>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="saveAnswers">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Confirm Test Submission</span>
            </div>
            <div class="modal-body">
                <h4>
                    Please note once you click <i class="text-success">submit</i>, all answers will be saved and you will not be able to re-submit,
                    if you wish to continue writing simple press <i class="text-danger">cancel</i> button.
                </h4>

                <div class="modal-footer">
                    <button class="btn btn-danger btn-flat" onclick="$('#saveAnswers').modal('hide');"><i class="fa fa-close"></i> Cancel</button>
                    <button class="btn btn-success btn-flat" onclick="saveAndSubmit();"><i class="fa fa-save"></i> Submit</button>

                </div>
            </div>
        </div>
    </div>
</div></div>

<div class="modal fade text-center" id="markAnswers" >
    <h3 class="text-white" style="margin-top: 20%">Please wait while your test is being marked...</h3><br>
    <i class="fa fa-spinner fa-spin" style="font-size: xx-large"></i>
</div></div>


<div class="modal fade" id="booking">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Borrow Book</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="borrow_book" hidden>
                    <h4 id="borrow_book"></h4>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="return">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Return Book</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="return_book" hidden>
                    <h4 id="return_book"></h4>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

