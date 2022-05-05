<?php $img = empty(isset($_SESSION['image']))? '../assets/img/profile.png' : '../assets/img/profile/'.isset($_SESSION['image']); ?>
<!--books-->
<div class="modal fade" id="add-service">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Add Service</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="add-service" value="add-service" hidden>
                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Category</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="category" required>
                                <option value="" selected disabled>Select Category</option>
                                <?php

                                $conn = $pdo->open();
                                $sql = $conn->prepare("SELECT * FROM category");
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    foreach ($sql as $data){
                                        echo '<option value="'.$data["id"].'">'.$data["categoryName"].'</option>';
                                    }
                                }
                                $pdo->close();
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Service&nbsp;</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="service" name="service" placeholder="Enter service name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Price&nbsp;</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="price" placeholder="Enter service price" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>



<div class="modal fade" id="edit-service">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Edit Service</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="edit-service" hidden>
                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Category</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="category" required>
                                <option value="" disabled>Select Category</option>
                                <?php

                                $conn = $pdo->open();
                                $sql = $conn->prepare("SELECT * FROM category");
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    foreach ($sql as $data){
                                        echo '<option value="'.$data["id"].'">'.$data["categoryName"].'</option>';
                                    }
                                }
                                $pdo->close();
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="book" class="col-sm-3 control-label">Service</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="service" placeholder="Enter service name"  required>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Price&nbsp;</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="price" placeholder="Enter service price" required>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="delete-service">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Delete Service</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="delete-service" hidden>

                    <span id="lbl-service"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<!--student-->

<div class="modal fade" id="add-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Add new user</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data" onsubmit="return sendForm('addUser')">

                    <div class="form-group row">
                        <label for="add-user" class="col-md-4 col-form-label text-md-right">Select user</label>

                        <div class="col-md-6">
                            <select class="form-control" name="user" required>
                                <option value="" selected disabled>Select user to add</option>
                                <option>Admin</option>
                                <option>Student</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="add-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="add-name" type="text" class="form-control is-invalid" name="add-name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="add-email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="add-email" type="email" class="form-control is-invalid" name="add-email" maxlength="30" onkeyup="validateEmail('addUser')"  required autocomplete="">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyEmail"></strong>
                            </span>
                    </div>


                    <div class="form-group row">
                        <label for="add-idNo" class="col-md-4 col-form-label text-md-right">ID Number</label>

                        <div class="col-md-6">
                            <input id="add-idNo" type="text" class="form-control is-invalid" name="add-idNo" minlength="13" maxlength="13" onkeypress="return /[0-9]/i.test(event.key)" onkeyup="validateID('addUser')" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyID"></strong>
                            </span>
                    </div>


                    <input id="add-gender" type="text" class="form-control is-invalid" name="add-gender" hidden>



                    <div class="form-group row">
                        <label for="add-password" class="col-md-4 col-form-label text-md-right">Password&nbsp;</label>

                        <div  class="col-md-6">
                            <input id="add-password" type="text" class="form-control" name="add-password" placeholder="e.g 1234*Abcd" minlength="8" onkeyup="createPassword('addUser')" required autocomplete="off">

                        </div>

                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyPass"></strong>
                            </span>
                    </div>



                    <div class="form-group row">
                        <label for="add-passwordMatch" class="col-md-4 col-form-label text-md-right">Confirm Password&nbsp;</label>

                        <div class="col-md-6">
                            <input id="add-passwordMatch" type="password" class="form-control" name="add-passwordMatch" minlength="8" onkeyup="matchPassword('addUser')" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyMatch"></strong>
                            </span>
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Submit</button>
                </form>
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

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data"  onsubmit="return sendForm('editStudent')">
                    <input class="form-control" type="text" name="edit-student" hidden>

                    <div class="form-group row">
                        <label for="edit-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="edit-name" type="text" class="form-control is-invalid" name="edit-name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
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

<div class="modal fade" id="delete-student">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Delete Book</span>
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

<!--admin-->

<div class="modal fade" id="add-admin">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Add Books</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="add-book" value="add-book" hidden>
                    <div class="form-group">
                        <label for="book" class="col-sm-3 control-label">Book</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="book" name="book" placeholder="Enter book name"  required>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Author&nbsp;</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="author" name="author" placeholder="Enter author name" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Category</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="category" required>
                                <option value="" selected disabled>Select Category</option>
                                <?php

                                $conn = $pdo->open();
                                $sql = $conn->prepare("SELECT * FROM category");
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    foreach ($sql as $data){
                                        echo '<option value="'.$data["id"].'">'.$data["categoryName"].'</option>';
                                    }
                                }
                                $pdo->close();
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="shelve" class="col-sm-3 control-label">Shelve</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="shelve" name="shelve" required>
                                <option value="" selected disabled>Select Shelve Number</option>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4">4</option>
                                <option value="5" >5</option>
                                <option value="6" >6</option>
                                <option value="7" >7</option>
                                <option value="8" >8</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="quantity" class="col-sm-3 control-label">Quantity</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="enter quantity number" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-sm-3 control-label">Price</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="price" name="price" placeholder="enter book price" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
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
                    <label class=" col-form-label">E-Mail Address: <span class="admin-email"></span></label>
                    <label class=" col-form-label">ID Number: <span class="admin-idNo"></span></label>
                    <label class=" col-form-label">Age: <span class="admin-age"></span></label>
                    <label class=" col-form-label">Gender: <span class="admin-gender"></span></label>

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
                <span>Delete Book</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="delete-book" hidden>

                    <span id="lbl-admin"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<!--<div class="modal fade" id="add-category">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>-->
<!--            <div class="modal-header">-->
<!--                <span>Add Category</span>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!---->
<!--                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">-->
<!---->
<!--                    <input name="add-category" value="add-category" hidden>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="category" class="col-sm-3 control-label">Category&nbsp;</label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input class="form-control" type="text" id="category" name="category" placeholder="Enter category name" required>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="modal-footer">-->
<!--                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</div></div>-->


