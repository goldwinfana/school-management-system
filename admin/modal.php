<?php $img = empty(isset($_SESSION['image']))? '../assets/img/profile.png' : '../assets/img/profile/'.isset($_SESSION['image']); ?>



<div class="modal fade" id="add-user">
    <div class="modal-dialog" style="width: 150%">
        <div class="modal-content" style="width: inherit">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Add New Account</span>
            </div>
            <div class="modal-body">
                <form id="regForm" method="POST" action="sql.php" onsubmit="return SendForm()">
                    <input name="add-user" value="register" hidden>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Account Type</label>

                        <div class="col-md-6">
                            <select type="text" class="form-control" name="accountType" required>
                                <option value="">Select account type</option>
                                <option value="admin">Admin Account</option>
                                <option value="student">Student Account</option>
                                <option value="teacher">Teacher Account</option>
                                <option value="parent">Parent Account</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control is-invalid" name="name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Surname</label>

                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control is-invalid" name="surname" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control is-invalid" name="email" maxlength="30" onkeyup="ValidateEmail()"  required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyEmail"></strong>
                            </span>
                    </div>


                    <div class="form-group row userID" >
                        <label class="col-md-4 col-form-label text-md-right">ID Number</label>

                        <div class="col-md-6">
                            <input id="idNo" type="text" class="form-control is-invalid idNumber" name="idNumber" minlength="13" maxlength="13" onkeyup="ValidateID('idNo')" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off" required>
                        </div>

                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyID"></strong>
                            </span>
                    </div>

                    <div class="form-group row parentID" hidden>
                        <label class="col-md-4 col-form-label text-md-right">Parent ID Number</label>

                        <div class="col-md-6">
                            <input id="PidNo" type="text" class="form-control is-invalid PidNumber" name="PidNumber" minlength="13" maxlength="13" onkeyup="ValidateID('PidNo')" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                        </div>

                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyPID"></strong>
                            </span>
                    </div>


                    <div class="form-group row userMobile">
                        <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile</label>

                        <div class="col-md-6">
                            <input id="mobile" type="text" class="form-control is-invalid" name="mobile" minlength="10" maxlength="10" onkeyup="ValidateMobile()" onkeypress="return /[0-9]/i.test(event.key)" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyMobile"></strong>
                            </span>
                    </div>



                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password&nbsp;</label>

                        <div  class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" placeholder="e.g 1234*Abcd" minlength="8" onkeyup="CreatePassword()" required autocomplete="off">
                            <span class="fa fa-eye" style="margin-top: -30px;position: absolute;right: 25px;"></span>
                        </div>

                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyPass"></strong>
                            </span>
                    </div>



                    <div class="form-group row">
                        <label for="passwordMatch" class="col-md-4 col-form-label text-md-right">Confirm Password&nbsp;</label>

                        <div class="col-md-6">
                            <input id="passwordMatch" type="password" class="form-control" name="passwordMatch" minlength="8" onkeyup="MatchPassword()" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyMatch"></strong>
                            </span>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success form-control text-white">
                                Register
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</div></div>
<!--student-->

<div class="modal fade" id="approve-student">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Approve Student</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="acc_approval" hidden>
                    <input name="acc_student" hidden>
                    <span id="apv-student"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="view-student">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Student Profile</span>
            </div>
            <div class="modal-body">


                <div style="text-align: center"><img src="../assets/img/profile.png" alt="..." class="img-fluid rounded-circle"></div>

                <hr/>
                <div style="display: grid;float: left;">
                    <label class=" col-form-label">Name: <span class="st-name"></span></label>
                    <label class=" col-form-label">Surname: <span class="st-surname"></span></label>
                    <label class=" col-form-label">E-Mail Address: <span class="st-email"></span></label>
                    <label class=" col-form-label">ID Number: <span class="st-idNo"></span></label>
                    <label class=" col-form-label">Age: <span class="st-age"></span></label>
                    <label class=" col-form-label">Grade: <span class="st-grade"></span></label>
                    <label class=" col-form-label">Parent: <span class="st-parent"></span></label>

                </div>

            </div>
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

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data" onsubmit="return sendForm('editStudent')">

                    <input type="text" name="edit-st" hidden>

                    <div class="form-group row">
                        <label for="edit-st-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="edit-st-name" type="text" class="form-control is-invalid" name="edit-st-name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-st-surname" class="col-md-4 col-form-label text-md-right">Surname</label>

                        <div class="col-md-6">
                            <input id="edit-st-surname" type="text" class="form-control is-invalid" name="edit-st-surname" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-st-email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="edit-st-email" type="email" class="form-control is-invalid" name="edit-st-email" maxlength="30" onkeyup="validateEmail('editStudent')"  required autocomplete="">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-st-verifyEmail"></strong>
                            </span>
                    </div>


                    <div class="form-group row">
                        <label for="edit-st-idNo" class="col-md-4 col-form-label text-md-right">ID Number</label>

                        <div class="col-md-6">
                            <input id="edit-st-idNo" type="text" class="form-control is-invalid" name="edit-st-idNo" minlength="13" maxlength="13" onkeypress="return /[0-9]/i.test(event.key)" onkeyup="validateID('editStudent')" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-st-verifyID"></strong>
                            </span>
                    </div>


                    <input id="edit-st-gender" type="text" class="form-control is-invalid" name="edit-st-gender" hidden>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="delete-student">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header text-danger">
                <span>Delete Student</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="delete-student" hidden>

                    <span id="lbl-student"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<!--Admin-->

<div class="modal fade" id="view-admin-profile">
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
                    <label class=" col-form-label">Name: <span class="admin-name"></span></label>
                    <label class=" col-form-label">Surname: <span class="admin-surname"></span></label>
                    <label class=" col-form-label">Email Address: <span class="admin-email"></span></label>

                </div>

            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="edit-admin">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Edit Admin</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data" onsubmit="return sendForm('editAdmin')">

                    <input type="text" name="edit-admin" hidden>

                    <div class="form-group row">
                        <label for="edit-admin-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="edit-admin-name" type="text" class="form-control is-invalid" name="edit-admin-name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-admin-email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="edit-admin-email" type="email" class="form-control is-invalid" name="edit-admin-email" maxlength="30" onkeyup="validateEmail('editAdmin')"  required autocomplete="">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-admin-verifyEmail"></strong>
                            </span>
                    </div>


                    <div class="form-group row">
                        <label for="edit-admin-idNo" class="col-md-4 col-form-label text-md-right">ID Number</label>

                        <div class="col-md-6">
                            <input id="edit-admin-idNo" type="text" class="form-control is-invalid" name="edit-admin-idNo" minlength="13" maxlength="13" onkeypress="return /[0-9]/i.test(event.key)" onkeyup="validateID('editAdmin')" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-admin-verifyID"></strong>
                            </span>
                    </div>


                    <input id="edit-admin-gender" type="text" class="form-control is-invalid" name="edit-admin-gender" hidden>



                    <div class="form-group row">
                        <label for="edit-admin-password" class="col-md-4 col-form-label text-md-right">Password&nbsp;</label>

                        <div  class="col-md-6">
                            <input id="edit-admin-password" type="text" class="form-control" name="edit-admin-password" placeholder="e.g 1234*Abcd" minlength="8" onkeyup="createPassword('editAdmin')" required autocomplete="off">
                        </div>

                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-admin-verifyPass"></strong>
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


<div class="modal fade" id="delete-admin">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Delete Admin</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="delete-admin" hidden>

                    <span id="lbl-admin"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<!--Parenet-->
<div class="modal fade" id="approve-parent">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Approve Parent</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="acc_approval" hidden>
                    <input name="acc_parent" hidden>
                    <span id="apv-parent"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<!--Teacher-->
<div class="modal fade" id="approve-teacher">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Approve Teacher</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="acc_approval" hidden>
                    <input name="acc_teacher" hidden>
                    <span id="apv-teacher"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<!--Drivers-->

<div class="modal fade" id="add-transport">
    <div class="modal-dialog" style="width: 150%">
        <div class="modal-content" style="width: inherit">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Add Transportation</span>
            </div>
            <div class="modal-body">
                <form id="regForm" method="POST" action="sql.php" >
                    <input name="add-transport" value="register" hidden>


                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control is-invalid" name="name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Surname</label>

                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control is-invalid" name="surname" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>


                    <div class="form-group row userID" >
                        <label class="col-md-4 col-form-label text-md-right">ID Number</label>

                        <div class="col-md-6">
                            <input id="DidNo" type="text" class="form-control is-invalid idNumber" name="DidNo" minlength="13" maxlength="13" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off" required>
                        </div>

                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyDiD"></strong>
                            </span>
                    </div>


                    <div class="form-group row userMobile">
                        <label for="Dmobile" class="col-md-4 col-form-label text-md-right">Mobile</label>

                        <div class="col-md-6">
                            <input id="Dmobile" type="text" class="form-control is-invalid" name="Dmobile" minlength="10" maxlength="10" onkeyup="ValidateMobile()" onkeypress="return /[0-9]/i.test(event.key)" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyDmobile"></strong>
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="bus" class="col-md-4 col-form-label text-md-right">Bus Name</label>

                        <div class="col-md-6">
                            <input id="bus" type="text" class="form-control is-invalid" name="bus" minlength="5" maxlength="10" required autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success form-control text-white">
                                Register
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</div></div>