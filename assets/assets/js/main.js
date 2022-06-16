
//Add User Validation
function ValidateMobile() {
    let contact = $('input[name=mobile]').val();
    if (contact.length === 0) {
        $('#verifyMobile').html('');
    }

    if (contact.length < 10) {
        $('#verifyMobile').css('color', 'red').html('<i>**the number is invalid!**</i>');
    }

    if ((contact.length === 10 && contact[0] === "0" && (contact[1] === "6" || contact[1] === "7" || contact[1] === "8"))
        || (contact.length === 11 && contact[0] === "2" && contact[1] === "7")) {

        // $.ajax({
        //     type: 'POST',
        //     url: './customRegister.php',
        //     data: {
        //         checkValues:contact},
        //     dataType: 'json',
        //     success: function(response){
        //         console.log(response)
        //         if(response.length > 0){
        //             $('#verifyMobile').css('color', 'red').html(' <i>the number already exist</i>');
        //         }
        //         else{
        //
        //             $('#verifyMobile').css('color', 'Green').html(' <i>the number is valid</i>');
        //         }
        //     }
        // });
        $('#verifyMobile').css('color', 'Green').html(' <i>the number is valid</i>');

    } else if (contact.length > 10) {
        $('#verifyMobile').css('color', 'red').html('<i>**the number is invalid!**</i>');

    }
    else {
        $('#verifyMobile').css('color', 'red').html('<i>**the number is invalid!**</i>');

    }
}

function ValidateEmail() {

    var count =0;
    let email = $('#email').val();
    let dotpos = email.indexOf(".");
    let afterDot = email.substr(dotpos,email.length -1);
    var iChar = ".";

    for (var i = 0; i < email.length; i++) {
        if (iChar.indexOf(email.charAt(i)) != -1) {
            count= count+1;
        }
    }

    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
    {
        if(count > 2 || count ==0){
            $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
        }else{
            if(afterDot=='.com' ||afterDot=='.co.za' ||afterDot=='.org.za' ||afterDot=='.org' ||afterDot=='.tv'){

                $.ajax({
                    type: 'POST',
                    url: 'sql.php',
                    data: {
                        checkEmail:email},
                    dataType: 'json',
                    success: function(response){
                        if(response.length > 0){
                            $('#verifyEmail').css('color','#dc3545').html('<span>Email already exists <i class="fa fa-warning"></i></span>');
                        }
                        else{
                            $('#verifyEmail').css('color','green').html('<span>Valid Email Provided <i class="fa fa-handshake-o"></i></span>');
                        }
                    }
                });

            }else{
                $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
            }
        }

    }else{
        $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
    }
}

function ValidateID(idNo) {
    if($('select[name=accountType]').val()==''){
        $('select[name=accountType]').focus();
        $('#idNo').val('');
        alert('Please select account type');
        return;
    }

    if(idNo=='idNo'){
        let id = $('#idNo').val();
        let month = id.substr(2,2);
        let day = id.substr(4,2);
        let gender = id.substr(6,1);

        if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){
            if($('select[name=accountType]').val()=='parent'){

                $.ajax({
                    type: 'POST',
                    url: 'sql.php',
                    data: {
                        checkParentID:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.length > 0){
                            $('#verifyID').css('color', 'green').html(' <i>ID Number Found</i>');
                        }
                        else{
                            $('#verifyID').css('color', 'red').html(' <i>ID Number Not Found</i>');
                        }
                    }
                });
            }else{
                $.ajax({
                    type: 'POST',
                    url: 'sql.php',
                    data: {
                        checkID:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.length > 0){
                            $('#verifyID').css('color', 'red').html(' <i>ID number already exist</i>');
                        }
                        else{
                            gender >= 5 ? $('#verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                                : $('#verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');

                        }
                    }
                });


            }


        }else{
            $('#verifyID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');
            $('input[name=gender]').val('');
        }
    }else{
        let id = $('#PidNo').val();
        let month = id.substr(2,2);
        let day = id.substr(4,2);
        let gender = id.substr(6,1);

        if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){

            gender >= 5 ? $('#verifyPID').css('color','green').html('<span>Parent Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                : $('#verifyPID').css('color','green').html('<span>Parent Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');

            gender >= 5 ? $('input[name=gender]').val('male') : $('input[name=gender]').val('female');
        }else{
            $('#verifyPID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');
            $('input[name=gender]').val('');
        }
    }

}

function CreatePassword() {

    let password = $('#password').val();
    if(password.length > 0) {

        if(password.length < 8){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }
        else if(!(/[a-z]/.test(password))){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }
        else if(!(/[A-Z]/.test(password))){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }
        else if(!(/[0-9]/.test(password))){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }
        else if(!(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password))){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }else{
            $('#verifyPass').css('color','green').html('<span>Strong <i class="fa fa-handshake-o"></i></span>');
        }
    }else{
        $('#verifyPass').html('');
    }
}

function MatchPassword(){
    let password = $('#password').val();
    let password_confirm = $('#passwordMatch').val();

    if (password_confirm.length === 0) {
        $('#verifyMatch').html('');
        return;
    }

    if (password === password_confirm) {
        $('#verifyMatch').css('color','green').html('<span>Match <i class="fa fa-handshake-o"></i></span>');
        return;
    }
    else {
        $('#verifyMatch').css('color','#dc3545').html('<span>Password Dont Match <i class="fa fa-warning"></i></span>');
        return;
    }
}

function SendForm(){

    if($('#verifyMatch').css('color') =='rgb(220, 53, 69)'){
        $('input[name=passwordMatch]').focus();
        return false;
    }
    if($('input[name=password]').val() !== $('input[name=passwordMatch]').val()){
        $('#verifyMatch').css('color','#dc3545').html('<span>Password Dont Match <i class="fa fa-warning"></i></span>');
        $('input[name=passwordMatch]').focus();
        return false;
    }
    if($('#verifyEmail').css('color') =='rgb(220, 53, 69)'){
        $('input[name=email]').focus();
        return false;
    }
    if($('#verifyPass').css('color') =='rgb(220, 53, 69)'){
        $('input[name=password]').focus();
        return false;
    }
    if($('select[name=accountType]').val()!='admin') {
        if ($('#verifyID').css('color') == 'rgb(220, 53, 69)') {
            $('input[name=idNo]').focus();
            return false;
        }

        if ($('#verifyMobile').css('color') == 'rgb(220, 53, 69)') {
            $('input[name=mobile]').focus();
            return false;
        }

        if($('#verifyPID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=PidNumber]').focus();
            return false;
        }
    }

    if($('select[name=accountType]').val()=='student'){
        if($('#verifyPID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=PidNumber]').focus();
            return false;
        }
    }

    return true;
}


///////////////////////////

function validateEmail(n) {

    if(n == 'editStudent'){
        var count =0;
        let email = $('#edit-st-email').val();
        let dotpos = email.indexOf(".");
        let afterDot = email.substr(dotpos,email.length -1);
        var iChar = ".";

        for (var i = 0; i < email.length; i++) {
            if (iChar.indexOf(email.charAt(i)) != -1) {
                count= count+1;
            }
        }

        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
        {
            if(count > 2 || count ==0){
                $('#edit-st-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
            }else{
                if(afterDot=='.com' ||afterDot=='.co.za' ||afterDot=='.org.za' ||afterDot=='.org' ||afterDot=='.tv'){
                    $('#edit-st-verifyEmail').css('color','green').html('<span>Valid Email Provided <i class="fa fa-handshake-o"></i></span>');
                }else{
                    $('#edit-st-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
                }
            }

        }else{
            $('#edit-st-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
        }
    }
    if(n == 'editAdmin'){
        var count =0;
        let email = $('#edit-admin-email').val();
        let dotpos = email.indexOf(".");
        let afterDot = email.substr(dotpos,email.length -1);
        var iChar = ".";

        for (var i = 0; i < email.length; i++) {
            if (iChar.indexOf(email.charAt(i)) != -1) {
                count= count+1;
            }
        }

        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
        {
            if(count > 2 || count ==0){
                $('#edit-admin-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
            }else{
                if(afterDot=='.com' ||afterDot=='.co.za' ||afterDot=='.org.za' ||afterDot=='.org' ||afterDot=='.tv'){
                    $('#edit-admin-verifyEmail').css('color','green').html('<span>Valid Email Provided <i class="fa fa-handshake-o"></i></span>');
                }else{
                    $('#edit-admin-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
                }
            }

        }else{
            $('#edit-admin-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
        }
    }
    if(n == 'addUser'){
        var count =0;
        let email = $('#add-email').val();
        let dotpos = email.indexOf(".");
        let afterDot = email.substr(dotpos,email.length -1);
        var iChar = ".";

        for (var i = 0; i < email.length; i++) {
            if (iChar.indexOf(email.charAt(i)) != -1) {
                count= count+1;
            }
        }

        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
        {
            if(count > 2 || count ==0){
                $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
            }else{
                if(afterDot=='.com' ||afterDot=='.co.za' ||afterDot=='.org.za' ||afterDot=='.org' ||afterDot=='.tv'){
                    $('#verifyEmail').css('color','green').html('<span>Valid Email Provided <i class="fa fa-handshake-o"></i></span>');
                }else{
                    $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
                }
            }

        }else{
            $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
        }
    }


}

function validateID(n) {

    if(n == 'addUser'){
        let id = $('#add-idNo').val();
        let month = id.substr(2,2);
        let day = id.substr(4,2);
        let gender = id.substr(6,1);

        if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){

            gender >= 5 ? $('#verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                : $('#verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');

            gender >= 5 ? $('input[name=gender]').val('male') : $('input[name=add-gender]').val('female');
        }else{
            $('#verifyID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');
            $('input[name=add-gender]').val('');
        }
    }

    if(n == 'editStudent'){
        let id = $('#edit-st-idNo').val();
        let month = id.substr(2,2);
        let day = id.substr(4,2);
        let gender = id.substr(6,1);

        if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){

            gender >= 5 ? $('#edit-st-verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                : $('#edit-st-verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');


        }else{
            $('#edit-st-verifyID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');

        }
    }

    if(n == 'editAdmin'){
        let id = $('#edit-admin-idNo').val();
        let month = id.substr(2,2);
        let day = id.substr(4,2);
        let gender = id.substr(6,1);

        if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){

            gender >= 5 ? $('#edit-admin-verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                : $('#edit-admin-verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');

            gender >= 5 ? $('input[name=edit-admin-gender]').val('male') : $('input[name=edit-admin-gender]').val('female');
        }else{
            $('#edit-admin-verifyID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');
            $('input[name=edit-admin-gender]').val('');
        }
    }

}

function createPassword(n) {

    if(n == 'addUser') {
        let password = $('#add-password').val();
        if(password.length > 0) {

            if(password.length < 8){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[a-z]/.test(password))){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[A-Z]/.test(password))){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[0-9]/.test(password))){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password))){
                $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }else{
                $('#verifyPass').css('color','green').html('<span>Strong <i class="fa fa-handshake-o"></i></span>');
            }
        }else{
            $('#verifyPass').html('');
        }
    }

    if(n == 'editStudent') {
        let password = $('#edit-password').val();
        if(password.length > 0) {

            if(password.length < 8){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[a-z]/.test(password))){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[A-Z]/.test(password))){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[0-9]/.test(password))){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password))){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }else{
                $('#edit-verifyPass').css('color','green').html('<span>Strong <i class="fa fa-handshake-o"></i></span>');
            }
        }else{
            $('#edit-verifyPass').html('');
        }
    }

    if(n == 'editAdmin') {
        let password = $('#edit-admin-password').val();
        if(password.length > 0) {

            if(password.length < 8){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[a-z]/.test(password))){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[A-Z]/.test(password))){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[0-9]/.test(password))){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password))){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }else{
                $('#edit-admin-verifyPass').css('color','green').html('<span>Strong <i class="fa fa-handshake-o"></i></span>');
            }
        }else{
            $('#edit-admin-verifyPass').html('');
        }
    }

}

function matchPassword(n){
    let password = $('#add-password').val();
    let password_confirm = $('#add-passwordMatch').val();

    if (password_confirm.length === 0) {
        $('#verifyMatch').html('');
        return;
    }

    if (password === password_confirm) {
        $('#verifyMatch').css('color','green').html('<span>Match <i class="fa fa-handshake-o"></i></span>');
        return;
    }
    else {
        $('#verifyMatch').css('color','#dc3545').html('<span>Password Dont Match <i class="fa fa-warning"></i></span>');
        return;
    }
}

function sendForm(n){

    if(n == 'addUser') {
        if($('#verifyMatch').css('color') =='rgb(220, 53, 69)'){
            $('input[name=passwordMatch]').focus();
            return false;
        }
        if($('input[name=add-password]').val() !== $('input[name=add-passwordMatch]').val()){
            $('#verifyMatch').css('color','#dc3545').html('<span>Password Dont Match <i class="fa fa-warning"></i></span>');
            $('input[name=add-passwordMatch]').focus();
            return false;
        }
        if($('#verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=add-email]').focus();
            return false;
        }
        if($('#verifyPass').css('color') =='rgb(220, 53, 69)'){
            $('input[name=add-password]').focus();
            return false;
        }
        if($('#verifyID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=add-idNo]').focus();
            return false;
        }

    }

    if(n == 'editStudent') {

        if($('#edit-st-verifyEmail').html()!='' && $('#edit-st-verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-st-email]').focus();
            return false;
        }

    }

    if(n == 'editAdmin') {

        if($('#edit-admin-verifyEmail').html()!='' && $('#edit-admin-verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-admin-email]').focus();
            return false;
        }

    }

    if(n == 'editParent') {

        if($('#edit-parent-verifyEmail').html()!='' && $('#edit-parent-verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-parent-email]').focus();
            return false;
        }

        if($('#verifyMobile').html()!='' && $('#verifyMobile').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-p-mobile]').focus();
            return false;
        }

    }

    if(n == 'editTeacher') {

        if($('#edit-teacher-verifyEmail').html()!='' && $('#edit-teacher-verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-teacher-email]').focus();
            return false;
        }

    }

    return true;

}

$(function () {

    $('.fa-eye').on('click', function () {
        $('#password').attr('type') =='password'? $('#password').attr('type', 'text'): $('#password').attr('type', 'password');
        $('.fa-eye').toggleClass("fa-eye-slash");
    });

    $('select[name=accountType]').on('change', function () {
        if($('select[name=accountType]').val()=='student'){
            $('.parentID').attr('hidden',false);
            $('#PidNo').attr('required', true);

            $('.userMobile').attr('hidden',false);
            $('#mobile').attr('required', true);
            $('.userID').attr('hidden',false);
            $('#idNo').attr('required', true);
        }else if($('select[name=accountType]').val()=='admin'){
            $('.parentID').attr('hidden',true);
            $('#PidNo').attr('required', false);
            $('.userMobile').attr('hidden',true);
            $('#mobile').attr('required', false);
            $('.userID').attr('hidden',true);
            $('#idNo').attr('required', false);
        }else{
            $('.parentID').attr('hidden',true);
            $('#PidNo').attr('required', false);
            $('.userMobile').attr('hidden',false);
            $('#mobile').attr('required', true);
            $('.userID').attr('hidden',false);
            $('#idNo').attr('required', true);

        }
    });


});



$(function () {

    // ------------------------------------------------------- //
    // Tooltips init
    // ------------------------------------------------------ //

    $('[data-toggle="tooltip"]').tooltip()

    // ------------------------------------------------------- //
    // Universal Form Validation
    // ------------------------------------------------------ //

    $('.form-validate').each(function() {
        $(this).validate({
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(.summernote),.note-editable.card-block',
            errorPlacement: function (error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                //console.log(element);
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
    });

    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });

    // ------------------------------------------------------- //
    // Footer
    // ------------------------------------------------------ //

    var pageContent = $('.page-content');

    $(document).on('sidebarChanged', function () {
        adjustFooter();
    });

    $(window).on('resize', function(){
        adjustFooter();
    })

    function adjustFooter() {
        var footerBlockHeight = $('.footer__block').outerHeight();
        pageContent.css('padding-bottom', footerBlockHeight + 'px');
    }

    // ------------------------------------------------------- //
    // Adding fade effect to dropdowns
    // ------------------------------------------------------ //
    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100).addClass('active');
    });
    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100).removeClass('active');
    });


    // ------------------------------------------------------- //
    // Search Popup
    // ------------------------------------------------------ //
    $('.search-open').on('click', function (e) {
        e.preventDefault();
        $('.search-panel').fadeIn(100);
    })
    $('.search-panel .close-btn').on('click', function () {
        $('.search-panel').fadeOut(100);
    });


    // ------------------------------------------------------- //
    // Sidebar Functionality
    // ------------------------------------------------------ //
    $('.sidebar-toggle').on('click', function () {
        $(this).toggleClass('active');

        $('#sidebar').toggleClass('shrinked');
        $('.page-content').toggleClass('active');
        $(document).trigger('sidebarChanged');

        if ($('.sidebar-toggle').hasClass('active')) {
            $('.navbar-brand .brand-sm').addClass('visible');
            $('.navbar-brand .brand-big').removeClass('visible');
            $(this).find('i').attr('class', 'fa fa-long-arrow-right');
        } else {
            $('.navbar-brand .brand-sm').removeClass('visible');
            $('.navbar-brand .brand-big').addClass('visible');
            $(this).find('i').attr('class', 'fa fa-long-arrow-left');
        }
    });


    // ------------------------------------------------------ //
    // For demo purposes, can be deleted
    // ------------------------------------------------------ //

    if ($('#style-switch').length > 0) {
        var stylesheet = $('link#theme-stylesheet');
        $("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
        var alternateColour = $('link#new-stylesheet');

        if ($.cookie("theme_csspath")) {
            alternateColour.attr("href", $.cookie("theme_csspath"));
        }

        $("#colour").change(function () {

            if ($(this).val() !== '') {

                var theme_csspath = 'css/style.' + $(this).val() + '.css';

                alternateColour.attr("href", theme_csspath);

                $.cookie("theme_csspath", theme_csspath, {
                    expires: 365,
                    path: document.URL.substr(0, document.URL.lastIndexOf('/'))
                });

            }

            return false;
        });
    }

    // STrtas  ----------------------------------------//////////////////////////////////////////

    setTimeout(function () {
        $('.message-alert').fadeOut('slow');
    },8000);

    $('.category').on('click', function () {
        $('#add-category').modal('show');
    });


    $('.add-user').on('click', function () {
        $('#add-user').modal('show');
    });

    // parent

    $('.view-parent-profile').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: 'sql.php',
            data: {
                getParent: id
            },
            dataType: 'json',
            success: function (response) {

                var year = new Date();
                var age=response.id_number;
                age = age.substr(0,2);
                age = age < 20? "20"+age:"19"+age;

                age = year.getFullYear()- parseInt(age);
                $('.p-name').html(response.name);
                $('.p-surname').html(response.surname);
                $('.p-email').html(response.email);
                $('.p-idNo').html(response.id_number);
                $('.p-mobile').html(response.mobile);
                $('.p-age').html(age);

            }});

        $('#view-parent-profile').modal('show');
    });

    $('.edit-parent').on('click', function (){
        var id = this.id;
        $.ajax({
            type: 'POST',
            url: 'sql.php',
            data: {
                getParent: id
            },
            dataType: 'json',
            success: function (response) {

                $('input[name=edit-parent]').val(id);
                $('input[name=edit-p-name]').val(response.name);
                $('input[name=edit-p-surname]').val(response.surname);
                $('input[name=edit-p-email]').val(response.email);
                $('input[name=edit-p-mobile]').val(response.mobile);

            }});


        $('#edit-parent').modal('show');
    });




    // students

    $('.delete-student').on('click', function () {
        var stuNo = this.id;
        $('#lbl-student').html('Confirm deletation of student with ID: '+stuNo+'?');
        $('input[name=delete-student]').val(stuNo);
        $('#delete-student').modal('show');
    });

    $('.edit-profile').on('click', function () {

        $('#edit-profile').modal('show');
    });

    $('.view-student-profile').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: 'sql.php',
            data: {
                getStudent: id
            },
            dataType: 'json',
            success: function (response) {
                var year = new Date();
                var age=response.id_number;
                age = age.substr(0,2);
                age = age < 20? "20"+age:"19"+age;

                age = year.getFullYear()- parseInt(age);
                $('.student-name').html(response.name);
                $('.student-surname').html(response.surname);
                $('.student-email').html(response.email);
                $('.student-idNo').html(response.id_number);
                $('.student-age').html(age);
                $('.student-gender').html(parseInt(response.id_number.substr(7,1)) < 4?'Female':'Male');
                $('.student-parent').html(response.parent_id_number);

            }});

        $('#view-student-profile').modal('show');
    });

    $('.view-student').on('click', function () {
        var id = this.id;
        $.ajax({
            type: 'POST',
            url: 'sql.php',
            data: {
                getStudent: id
            },
            dataType: 'json',
            success: function (response) {
                var year = new Date();
                var age=response.id_number;
                age = age.substr(0,2);
                age = age < 20? "20"+age:"19"+age;


                age = year.getFullYear()- parseInt(age);
                $('.st-name').html(response.name);
                $('.st-surname').html(response.surname);
                $('.st-email').html(response.email);
                $('.st-idNo').html(response.id_number);
                $('.st-parent').html(response.parent_id_number);
                $('.st-age').html(age);
                // $('.st-n').html(response.grade);

            }});


        $('#view-student').modal('show');
    });
    //teacher
    $('.view-teacher-profile').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: 'sql.php',
            data: {
                getTeacher: id
            },
            dataType: 'json',
            success: function (response) {

                var year = new Date();
                var age=response.id_number;
                age = age.substr(0,2);
                age = age < 20? "20"+age:"19"+age;

                age = year.getFullYear()- parseInt(age);
                $('.teacher-name').html(response.name);
                $('.teacher-surname').html(response.surname);
                $('.teacher-email').html(response.email);
                $('.teacher-idNo').html(response.id_number);
                $('.teacher-age').html(age);
                $('.teacher-gender').html(parseInt(response.id_number.substr(7,1)) < 4?'Female':'Male');

            }});

        $('#view-teacher-profile').modal('show');
    });

    $('.edit-teacher').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getTeacher: id
            },
            dataType: 'json',
            success: function (response) {

                $('input[name=edit-teacher]').val(id);
                $('input[name=edit-name]').val(response.name);
                $('input[name=edit-email]').val(response.email);
                $('input[name=edit-surname]').val(response.surname);
            }});


        $('#edit-profile').modal('show');
    });

    // admins
    $('.delete-admin').on('click', function () {
        var id = this.id;
        $('#lbl-admin').html('Confirm deletation of admin with id: '+id+'?');
        $('input[name=delete-admin]').val(id);
        $('#delete-admin').modal('show');
    });

    $('.edit-admin').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getAdmin: id
            },
            dataType: 'json',
            success: function (response) {

                $('input[name=edit-admin]').val(id);
                $('input[name=edit-admin-name]').val(response.name);
                $('input[name=edit-admin-surname]').val(response.surname);
                $('input[name=edit-admin-email]').val(response.email);

            }});


        $('#edit-admin').modal('show');
    });

    $('.view-admin-profile').on('click', function (){
        let id = this.id;

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getAdmin: id
            },
            dataType: 'json',
            success: function (response) {

                $('.admin-name').html(response.name);
                $('.admin-email').html(response.email);
                $('.admin-surname').html(response.surname);

            },
        error: function (e) {
            console.log(e);
        }
        });


        $('#view-admin-profile').modal('show');
    });

    $('.add-service').on('click', function () {
        $('#add-service').modal('show');

    });

    $('.broadcast-btn').on('click', function () {
        $('#broadcast-modal').modal('show');

    });

    //  Delete Post
    $('.approve_student').on('click', function () {
        var id = this.id;
        $('#apv-student').html('Approval Account For Student With Email :<span class="text-danger mar-5">'+id+'</span> ?');
        $('input[name=acc_approval]').val(id);
        $('#approve-student').modal('show');

    });

    $('.approve_parent').on('click', function () {
        var id = this.id;
        $('#apv-parent').html('Approval Account For Parent With Email :<span class="text-danger mar-5">'+id+'</span> ?');
        $('input[name=acc_approval]').val(id);
        $('#approve-parent').modal('show');

    });

    $('.approve_teacher').on('click', function () {
        var id = this.id;
        $('#apv-teacher').html('Approval Account For Teacher With Email :<span class="text-danger mar-5">'+id+'</span> ?');
        $('input[name=acc_approval]').val(id);
        $('#approve-teacher').modal('show');

    });

    $('.edit-student').on('click', function (){
        var id = this.id;
        $.ajax({
            type: 'POST',
            url: 'sql.php',
            data: {
                getStudent: id
            },
            dataType: 'json',
            success: function (response) {

                $('input[name=edit-st]').val(id);
                $('input[name=edit-st-name]').val(response.name);
                $('input[name=edit-st-surname]').val(response.surname);
                $('input[name=edit-st-email]').val(response.email);
                $('input[name=edit-st-idNo]').val(response.id_number);
                $('input[name=edit-st-mobile]').val(response.mobile);
                $('select[name=edit-st-grade]').val(response.grade);
                $('input[name=edit-st-password]').val(response.password);

            }});


        $('#edit-student').modal('show');
    });

    $('.register_grade').on('click', function () {
        var grade = this.id;
        $('#reg-grade').html('Confirm if you would like to enroll for Grade <span class="text-success mar-5">'+grade+'</span> ?');
        $('input[name=reg-grade]').val(grade);
        $('#register_grade').modal('show');

    });


    //drivers
    $('.add-transport').on('click', function () {
        $('#add-transport').modal('show');
    });

    $('.register-transport').on('click', function () {
        var id = this.id;
        var bus_name = $(this).attr('for');
        $('#reg-bus').html('Confirm if you would like to use <span class="text-success mar-5">'+bus_name+'</span> ?');
        $('input[name=reg-bus]').val(id);
        $('#register-transport').modal('show');

    });

    $('.view-bus').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: 'sql.php',
            data: {
                getBus: id
            },
            dataType: 'json',
            success: function (response) {console.log(response)
                $('.bus-name').html(response.bus);
                $('.driver-surname').html(response.surname);
                $('.driver-name').html(response.name);
                $('.driver-contact').html(response.id_number);
                $('.bus-img').attr('src','uploads/bus/'+response.image);

            }});

        $('#view-bus').modal('show');
    });

    $('.view-busx').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: 'sql.php',
            data: {
                getBus: id
            },
            dataType: 'json',
            success: function (response) {
                $('.bus-name').html(response.bus);
                $('.driver-surname').html(response.surname);
                $('.driver-name').html(response.name);
                $('.driver-contact').html(response.id_number);
                $('.bus-img').attr('src','../admin/uploads/bus/'+response.image);

            }});

        $('#view-bus').modal('show');
    });

    $('.delete-bus').on('click', function () {
        var id = this.id;
        $('#lbl-bus').html('Confirm deletation of bus with id: '+id+'?');
        $('input[name=delete-bus]').val(id);
        $('#delete-bus').modal('show');
    });

    //Exams
    $('.q_type').change(function (){
        let q = this.value;
        if(q=='tbox'){
            $('.q2_type').html('<textarea name="tbox" rows="4" placeholder="Type your answer here..." style="width: 100%;border-radius: 5px" required></textarea>\n');
        }else if(q=='tf'){
            $('.q2_type').html(
                '<h5>Choose the correct answer below: </h5>'+
                '<input name="tf_option" type="radio" value="true" required> <label>True</label> <br/>'+
                '<input name="tf_option" type="radio" value="false"> <label>False</label> '

            );
        }else if(q=='options'){
            $('.q2_type').html(
                '<h5>Type in your correct answer on the first box and other three possible options below: </h5>'+
                '<input class="form-control is-valid" name="option[]" type="text" placeholder="Type your correct answer here" required><br/>'+
                '<input class="form-control is-invalid" name="option[]" type="text" placeholder="First option" required><br/>'+
                '<input class="form-control is-invalid" name="option[]" type="text" placeholder="Second option" required><br/>'+
                '<input class="form-control is-invalid" name="option[]" type="text" placeholder="Third option" required>'

            );
        }else{
            $('.q2_type').html('');
        }
    });
    $('input[name=tf_option]:checked').on(':checked',function (){
     console.log('ss')
    });

    $('.activate_test').on('click', function () {
        let id = this.id;
        const date = new Date();
        function len(val) {
            if(val.toString().length < 2){
                val ='0'+val;
            }
            return val;
        }
        const today =date.getFullYear()+'-'+len((date.getMonth()+1))+'-'+len(date.getDate());
        if(today==$(this).attr('is')){
            $('#lbl-test').html('Confirm you want to activate the <i class="text-success">'+$(this).attr('for')+'</i> test?');
            $('input[name=activate_test]').val(id);
            $('#activate_test').modal('show');
        }else{
           alert('Test can only be written on '+$(this).attr('is'));
        }

    });

    $('.deactivate_test').on('click', function () {
        let id = this.id;
        $('#_test').html('Confirm you want to deactivate the <i class="text-success">'+$(this).attr('for')+'</i> test?');
        $('input[name=deactivate_test]').val(id);
        $('#deactivate_test').modal('show');
    });

});
function getSubjects(val) {
    $.ajax({
        type: 'POST',
        url: './sql.php',
        data: {
            getSubjects: val
        },
        dataType: 'json',
        success: function (response) {
            var subjects = response.subjects.replaceAll(/'/g,'').split(',');
            $('.select-sub').html('<select class="form-control" id="choose-sub" name="choose-sub" onchange="conBtn()" required></select>');
            var option = document.createElement("option");
            option.value='';
            option.disabled = true;
            option.selected=true;
            option.text='Select subject from list';
            document.getElementById('choose-sub').add(option);
            $.each(subjects, function (a,i) {
                var option = document.createElement("option");
                option.value=i;
                option.text=i;
                document.getElementById('choose-sub').add(option);
            })
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function getAnswer(form){
     var formData = $('#submitAnswer_'+form).serialize();
    $.ajax({
        type: 'POST',
        url: './sql.php',
        data: {
            testAnswers: formData
        },
        success: function (response) {
            console.log(response)
            response = JSON.parse(response);
            if(response.success==1){

                alerts('success',response.message);
            }else{
                alerts('danger',response.message);
            }

        },
        error: function (e) {
            console.log(e);
            // alerts('danger',e.message);
        }
    });

}

function saveAndSubmit(){
    $('.answerBtn').each(function (a,i) {
        console.log($(this).click());
    });
    $('#saveAnswers').modal('hide');
    setTimeout(function () {
        $('#markAnswers').modal('show');
    },2000);

    setTimeout(function () {
        $('#markAnswers').html('<i  class="text-success fa fa-check-circle" style="font-size: 100px;margin-top: 20%"></i>');
        setTimeout(function () {
            var queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let test_id = urlParams.get('test_id');
            window.location.href='?test_id='+test_id;
        },4000);

    },8000);
}

function enableConBtn(val){
    if(val.length > 0){
        $('.confirm-details').attr('disabled',false);
    }else{
        $('.confirm-details').attr('disabled',true);
    }
}

function createTest(){
    $('input[name=create-grade]').val($('select[name=choose-grade]').val());
    $('input[name=create-subject]').val($('select[name=choose-sub]').val());
    $('input[name=create-test]').val($('input[name=test_name]').val());
    $('input[name=create-date]').val($('input[name=test_date]').val());
    $('input[name=create-duration]').val($('input[name=test_duration]').val());
    let formData = $('#create-test').serialize();

    var grade = $('select[name=choose-grade]').val();
    var sub =$('select[name=choose-sub]').val();
    var test =$('input[name=test_name]').val();
    var date =$('input[name=test_date]').val();
    var duration =$('input[name=test_duration]').val();

    if(sub==null){
        $('select[name=choose-sub]').focus();
        return;
    }
    if(test==null){
        $('input[name=test_name]').focus();
        return;
    }

    if(duration==null){
        $('input[name=test_duration]').focus();
        return;
    }

    if(date==null){
        $('input[name=test_date]').focus();
        return;
    }

    $.ajax({
        type: 'POST',
        url: './sql.php',
        data: {
            createTest: formData
        },
        success: function (response) {
            response = JSON.parse(response);
            console.log((response));
            if(response.teacher ==$('#teacher_id').val()) {
                if (response.message == 'exists') {
                    $('.q_num').html(response.count);
                    $('.q_number').val(response.count);
                    localStorage.setItem('getQ',
                        JSON.stringify({
                            'grade': grade,
                            'subject': sub,
                            'question': response.count,
                            'testName': test
                        })
                    );
                    alerts('warning', 'Test already ' + response.message + ',continue where you left off');

                } else {
                    $('.q_num').html(response.count);
                    $('.q_number').val(response.count);
                    localStorage.setItem('getQ',
                        JSON.stringify({
                            'grade': grade,
                            'subject': sub,
                            'question': response.count,
                            'testName': test
                        })
                    );
                    alerts('success', response.message);

                }
                $('.set_qs').show();
            }else{
                alerts('warning','Test already been set by another teacher, please consult admin');
                $('.set_qs').hide();
            }

        },
        error: function (e) {
            console.log(e);
        }
    });
}

function makeQuestions(grade,subject,testName){
    let getQ = localStorage.getItem('getQ');
    var qCount=0;
    if(getQ==null){
        qCount = 1;
        localStorage.setItem('getQ',
            JSON.stringify({
                    'grade': grade,
                    'subject': subject,
                    'question': qCount,
                    'testName':testName
                })
        );

    }else{
        qCount = JSON.parse(localStorage.getItem('getQ')).question+1;
        localStorage.setItem('getQ',
            JSON.stringify({
                'grade': grade,
                'subject': subject,
                'question': qCount,
                'testName':testName
            })
        );
    }
$('.q_num').html(qCount);$('.q_number').val(qCount);

}

function submitQuestions(){
    let formData = $('#submitQuestions').serialize();
    if($('textarea[name=question]').val()==''){
        $('textarea[name=question]').focus();
        return;
    }
    if($('.q_type').val()==null){
        $('.q_type').focus();
        return;
    }

    if($('.q_type').val()=='tbox' && $('.q2_type').find('textarea').val()==''){
            $('textarea[name=tbox]').focus();
            return;
    }

    if($('.q_type').val()=='tf' && !$('input[name=tf_option]').is(':checked')){
        $('input[name=tf_option]').focus();
        return;
    }
    var count=0;
    if($('.q_type').val()=='options'){
        $('.q2_type').find('input').each(function () {
            if($(this).val()==''){
                $(this).focus();
                count++;
            }
        });
    }
    if(count > 0){
        return;
    }

   $.ajax({
        type: 'POST',
        url: './sql.php',
        data: {
            question_creation: formData
        },
        success: function (response) {
            console.log(response)
            response = JSON.parse(response);
            if(response.success==1){
                var count = JSON.parse(localStorage.getItem('getQ')).question+1;
                var grade = JSON.parse(localStorage.getItem('getQ')).grade;
                var sub =JSON.parse(localStorage.getItem('getQ')).subject;
                var test =JSON.parse(localStorage.getItem('getQ')).testName;
                localStorage.setItem('getQ',
                    JSON.stringify({
                        'grade': grade,
                        'subject': sub,
                        'question': count,
                        'testName':test
                    })
                );

                $('textarea[name=question]').val('');
                $('.q_type').val('');
                $('.q2_type').html('');
                $('.q_num').html(count);$('.q_number').val(count);
                alerts('success',response.message);
            }else{
                alerts('danger',response.message);
            }

        },
        error: function (e) {
            console.log(e);
            // alerts('danger',e.message);
        }
    });
}


function alerts(success,message){
    $('body').append('<div class="alert btn-'+success+' message-alert">'+message+'</div>');
    setTimeout(function () {
        $('.message-alert').fadeOut('slow');
    },10000);
}

setTimeout(function () {
    $('.message-alert').fadeOut('slow');
},8000);

$('.booking').on('click', function () {
    let id = this.id;
    $('#borrow_book').html('Confirm you want to borrow the <i class="text-success">'+$(this).attr('for')+'</i> book?');
    $('input[name=borrow_book]').val(id);
    $('#booking').modal('show');
});

$('.return').on('click', function () {
    let id = this.id;
    $('#return_book').html('Confirm you want to return the <i class="text-success">'+$(this).attr('for')+'</i> book?');
    $('input[name=return_book]').val(id);
    $('#return').modal('show');
});

$('.accept_return').on('click', function () {
    let id = this.id;
    $('#accept_return_').html('Confirm indeed this book has been returned?');
    $('input[name=accept_return]').val(id);
    $('#accept_return').modal('show');
});

$('.decline_return').on('click', function () {
    let id = this.id;
    $('#decline_return_').html('Decline this book has not been returned?');
    $('input[name=decline_return]').val(id);
    $('#decline_return').modal('show');
});

$('.delete_book').on('click', function () {
    let id = this.id;
    $('#delete_book_').html('Are you sure you want to delete this book?');
    $('input[name=delete_book_id]').val(id);
    $('#delete_book').modal('show');
});

$('.edit_book').on('click', function () {
    let id = this.id;
    $('input[name=edit_book]').val($(this).attr('for'));
    $('input[name=edit_book_id]').val(id);
    $('#edit_book').modal('show');
});