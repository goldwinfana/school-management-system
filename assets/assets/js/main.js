
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

        if($('input[name=edit-st-email]').val() =='' && $('#edit-st-verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-st-email]').focus();
            return false;
        }
        if($('input[name=idNo]').val() =='' && $('#edit-st-verifyID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-st-idNo]').focus();
            return false;
        }

    }

    if(n == 'editAdmin') {

        if($('#edit-admin-verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-admin-email]').focus();
            return false;
        }
        if($('#edit-admin-verifyPass').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-admin-password]').focus();
            return false;
        }
        if($('#edit-admin-verifyID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-admin-idNo]').focus();
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
                $('input[name=edit-p-idNo]').val(response.id_number);
                $('input[name=edit-p-mobile]').val(response.mobile);
                // $('input[name=edit-st-password]').val(response.password);

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
                age = "19"+age;
                age = year.getFullYear()- parseInt(age);
                $('.student-name').html(response.name);
                $('.student-surname').html(response.surname);
                $('.student-email').html(response.email);
                $('.student-idNo').html(response.id_number);
                $('.student-age').html(age);
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
                $('input[name=edit-admin-email]').val(response.email);
                $('input[name=edit-admin-idNo]').val(response.id_number);
                $('input[name=edit-admin-gender]').val(response.gender);
                $('input[name=edit-admin-password]').val(response.password);

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
console.log(response);
                // var year = new Date();
                // var age=response.id_number;
                // age = age.substr(0,2);
                // age = "19"+age;
                // age = year.getFullYear()- parseInt(age);
                // $('.admin-name').html(response.name);
                // $('.admin-email').html(response.email);
                // $('.admin-idNo').html(response.id_number);
                // $('.admin-gender').html(response.gender);
                // $('.admin-age').html(age);

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

    // $('.book-session').on('click', function () {
    //     $('#book-session').modal('show');
    //
    // });

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
                // $('input[name=edit-st-password]').val(response.password);

            }});


        $('#edit-student').modal('show');
    });

});

setTimeout(function () {
    $('.message-alert').fadeOut('slow');
},8000);
