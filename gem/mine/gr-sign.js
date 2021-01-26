
window.isLogin = true;
window.codeForgotPsw = '';
var dialogForgotPsw;
$(document).ready(function () {
    $("#forgotPsw").hide();
    sessionStorage.removeItem("id");
    sessionStorage.removeItem("status");
    sessionStorage.removeItem("id_organization");
    sessionStorage.removeItem("role");
    sessionStorage.removeItem("phone");
    sessionStorage.removeItem("name");
    sessionStorage.removeItem("email");
    sessionStorage.removeItem("ldt");
    sessionStorage.removeItem("idchat");
    if(window.location.pathname!="/track-it/signin"){
        $("#fieldRepeatPassword").hide();
        $("#forgotPsw").show();
    }else{
        showSigUp();
        $("#forgotPsw").hide();

      //  $('.sign > section > div > div form > .switch').click();
    }


});


function onClickOpenModalForgPsw(){
    var html = `
    <div class="container">
    <div class="row">
		<div class="col-sm-12">
            <div class="stepOne">
                <label>Phone Number</label>
                <div class="form-group"> 
                <div class="phone-list">
                        <div class="input-group phone-input">
                            <span class="input-group-btn">
                                <select class="form-control" id="forgotCodeCountry">
                                <option value="1" selected>+1</option>
                                <option value="86">+86</option>
                                <option value="87">+87</option>
                                <option value="91">+91</option>
                                <option value="55">+55</option>
                                <option value="52">+52</option>
                                </select>
                            </span>
                            <input type="text" id="forgotPhone" class="form-control formForgotPassword" placeholder="(999) 999 9999" />
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger stepOneError" role="alert" style="display:none"  style="display:none">
                    The phone number doesn't exist.
                </div>                
                <div class="alert alert-danger stepOneDanger" role="alert" style="display:none">
                    Please, complete the information.
                </div>
                <div class="form-group"> 
                <button class="btn btn-default" onclick="onClickCancelForg()">Cancel</button>
                <button class="btn btn-primary" onclick="onClickContinueForg()">Continue</button>
                </div>
            </div>
            <div class="stepTwo col-md-12" style="display:none">
                    <div class="alert alert-success stepTwoSuccess" role="alert">
                        You will recive a CODE in you phone.
                    </div>
                    <div class="alert alert-danger stepTwoDanger" role="alert" style="display:none">
                        The code is incorrect, please try again.
                    </div>
                    <label>Code</label>
                    <div class="form-group "> 
                        <input type="text" id="forgotCode" class="form-control formForgotPassword"> 
                    </div> 
                    <div class="form-group"> 
                    <button class="btn btn-default" onclick="onClickCancelCodeForg()">Cancel</button>
                    <button class="btn btn-primary" onclick="onClickContinueCodeForg()">Continue</button>
                    </div>
            </div> 
            <div class="stepThree" style="display:none">
                <label>New Password</label>
                <div class="form-group"> 
                    <input type="password" id="forgotPassword" class="form-control formForgotPassword" /> 
                </div> 
                <label>Confirm Password</label>
                <div class="form-group"> 
                    <input type="password" id="forgotRepeatPassword" class="form-control formForgotPassword" /> 
                </div> 
                <div class="alert alert-success stepThreeSuccess text-center" role="alert"  style="display:none">
                     Password changed successfully. <hr class="my-4"> <button class="btn btn-primary" onclick="goLogin()"> Go Login</button>
                </div>
                <div class="alert alert-warning stepThreeWarning" role="alert" style="display:none"  style="display:none">
                     Password must be between 8 and 16 characters, at least one number, one lowercase and one uppercase letter.
                </div>
                <div class="alert alert-danger stepThreeDanger" role="alert" style="display:none"  style="display:none">
                    The given passwords do not match
                </div>
                <div class="alert alert-danger stepThreeDangerServerError" role="alert" style="display:none"  style="display:none">
                  Error, please try again.
                </div>                
                <div class="form-group stepThreeButtons"> 
                <button class="btn btn-default" onclick="onClickCancelPswForg()">Cancel</button>
                <button class="btn btn-primary" onclick="onClickContinuePswForg()">Changed Password</button>
                </div>
            </div
            </div>  
        </div>
    </div>
    `;
    dialogForgotPsw = bootbox.dialog({
        message: html,
        closeButton: false
    });
}

function onClickContinueForg(){
    // step 1
    console.log("step 1");
 
    // $(".stepOne").hide();
    // $(".stepTwo").fadeIn();
    // window.codeForgotPsw = generateCode();
    // console.log("code:"+window.codeForgotPsw);
    if($("#forgotPhone").val()==''){
        $(".stepOneError").hide();
        $(".stepOneDanger").show();
        return;
    }

    $.loadingBlockShow({
        imgPath: './asset/default.svg',
        text: 'Loading...',
        style: { position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
    });
    var phone = '+'+ $("#forgotCodeCountry").val() + $("#forgotPhone").val().trim();
    var exist = existUserForgotPassword(phone);
    if (exist.exist && exist.data.status == 1) {
        $(".stepOneDanger").hide();
        $.loadingBlockHide();
        code = generateCode();
        console.log("code:"+code);
       var sms   = sendSMS(code, phone);
        if (sms.statusCode == 200) {
            window.codeForgotPsw = code;
            $(".stepOneError").hide();
            $(".stepOne").hide();
            $(".stepTwo").fadeIn();
        }
    }else{
        $.loadingBlockHide();
        $(".stepOneDanger").hide();
        $(".stepOneError").show();

    }

}

function onClickCancelForg(){
    // step 1

    $(".formForgotPassword").val('');
    $("#forgotCodeCountry").val('1');
    // $("#divPassword").fadeOut();
    $(".fade").fadeOut();
    $(".stepTwoDanger").hide();
    $(".stepOneError").hide();

}

function onClickCancelCodeForg(){
    // step 2

    $(".stepTwo").hide();
    $(".stepOne").fadeIn();
    $(".formForgotPassword").val('');
    $("#forgotCodeCountry").val('1');
    $(".stepTwoDanger").hide();
}
function onClickCancelPswForg(){
    // step 3

    $(".formForgotPassword").val('');
    $("#forgotCodeCountry").val('1');
    $(".stepThree").hide();
    $(".stepOne").fadeIn();
    $(".stepTwoDanger").hide();
    $(".stepThreeSuccess").hide();
    $(".stepThreeDanger").hide();
    $(".stepThreeButtons").show();
    $(".stepThreeDangerServerError").hide();
    $(".stepThreeWarning").hide();
    $(".stepThreeButtons").show(); 
          

}
function onClickContinueCodeForg(){
    // step 2
    console.log("step 2")

    if($("#forgotCode").val() == window.codeForgotPsw ){
        $(".stepTwoDanger").hide();
        $(".stepTwoSuccess").show();
        $(".stepTwo").hide();
        $(".stepThree").fadeIn();
    }else{
        $(".stepTwoSuccess").hide();
        $(".stepTwoDanger").show();
    }
}



function onClickContinuePswForg(){
    // step 3
    console.log("step 3")
    if($("#forgotPassword").val()==""){
        $(".stepThreeDanger").show();   
        $(".stepThreeDangerServerError").hide();     
        $(".stepThreeWarning").hide();
        return;
    }

    if (!checkPassword($("#forgotPassword").val())) {
        $(".stepThreeWarning").show();
        $(".stepThreeDangerServerError").hide();     
        $(".stepThreeDanger").hide();   
        return;
    }

    if($("#forgotPassword").val() == $("#forgotRepeatPassword").val() ){
        var phone = '+'+ $("#forgotCodeCountry").val() + $("#forgotPhone").val().trim();

        
        var upUser = updatePasswordUser( phone, $("#forgotPassword").val() );
        if (!upUser.error) {
            $(".stepThreeSuccess").show(); 
            $(".stepThreeDangerServerError").hide();     
            $(".stepThreeDanger").hide();
            $(".stepThreeButtons").hide();
            $(".stepThreeWarning").hide();
        }else{
            $(".stepThreeDangerServerError").show();     
            $(".stepThreeSuccess").hide();        
            $(".stepThreeDanger").hide();
            $(".stepThreeWarning").hide();
        }
    }else{
        $(".stepThreeSuccess").hide();
        $(".stepThreeWarning").hide();
        $(".stepThreeDanger").show();
    }

    // 
}

function goLogin(){
    dialogForgotPsw.modal('hide');
}

function showSigUp() {
    $('body').hide();
    var btn = $('.two > section > div > div form > .submit.global').text();
    $('.two > section > div > div form > .submit.global').text($('.two > section > div > div form > .submit.global').attr('btn'));
    $('.two > section > div > div form > .submit.global').attr('btn', btn);
    $('.sign > section > div > div form .global').removeClass('d-none');
    $('.two > section > div > div form > .submit.reset').addClass('d-none');


    $('.two > section > div > div form > .submit.global').attr('do', 'register');
    $('.two > section > div > div form .doz').val('register');
    $('.sign > section > div > div form .login').addClass('d-none');
    $('.sign > section > div > div form .register,.sign .regsep').removeClass('d-none');
    $('.sign > section > div > div form > .sub').addClass('d-none');
    $(this).addClass('log');


    var qn = $('.sign > section > div > div form > .switch > i').text();
    $('.sign > section > div > div form > .switch > i').text($('.sign > section > div > div form > .switch').attr('qn'));
    $('.sign > section > div > div form > .switch').attr('qn', qn);

    var btn2 = $('.two > section > div > div form > .switch > span').text();
    $('.two > section > div > div form > .switch > span').text($('.sign > section > div > div form > .switch').attr('btn'));
    $('.sign > section > div > div form > .switch').attr('btn', btn2);
    $('body').fadeIn();
    window.isLogin = false;
    $("#fieldRepeatPassword").show();
}


function showSigIn() {
    $('body').hide();

    var btn = $('.two > section > div > div form > .submit.global').text();
    $('.two > section > div > div form > .submit.global').text($('.two > section > div > div form > .submit.global').attr('btn'));
    $('.two > section > div > div form > .submit.global').attr('btn', btn);
    $('.sign > section > div > div form .global').removeClass('d-none');
    $('.two > section > div > div form > .submit.reset').addClass('d-none');

    $('.two > section > div > div form > .submit.global').attr('do', 'login');
    $('.two > section > div > div form .doz').val('login');
    $('.sign > section > div > div form .register,.sign .regsep').addClass('d-none');
    $('.sign > section > div > div form .login').removeClass('d-none');
    $('.sign > section > div > div form > .sub').removeClass('d-none');
    $(this).removeClass('log');
    var qn = $('.sign > section > div > div form > .switch > i').text();
    $('.sign > section > div > div form > .switch > i').text($('.sign > section > div > div form > .switch').attr('qn'));
    $('.sign > section > div > div form > .switch').attr('qn', qn);

    var btn2 = $('.two > section > div > div form > .switch > span').text();
    $('.two > section > div > div form > .switch > span').text($('.sign > section > div > div form > .switch').attr('btn'));
    $('.sign > section > div > div form > .switch').attr('btn', btn2);
    $('body').fadeIn();
    window.isLogin = true;
    $("#fieldRepeatPassword").hide();
}


$('.sign > section > div > div form > .switch').on('click', function () {
    $('body').hide();
    var btn = $('.two > section > div > div form > .submit.global').text();
    $('.two > section > div > div form > .submit.global').text($('.two > section > div > div form > .submit.global').attr('btn'));
    $('.two > section > div > div form > .submit.global').attr('btn', btn);
    $('.sign > section > div > div form .global').removeClass('d-none');
    $('.two > section > div > div form > .submit.reset').addClass('d-none');
    if (!window.isLogin) {
        $('.two > section > div > div form > .submit.global').attr('do', 'login');
        $('.two > section > div > div form .doz').val('login');
        $('.sign > section > div > div form .register,.sign .regsep').addClass('d-none');
        $('.sign > section > div > div form .login').removeClass('d-none');
        $('.sign > section > div > div form > .sub').removeClass('d-none');
        $(this).removeClass('log');
        window.isLogin = true;
        $("#fieldRepeatPassword").hide();
        $("#forgotPsw").show();

    } else {
        $('.two > section > div > div form > .submit.global').attr('do', 'register');
        $('.two > section > div > div form .doz').val('register');
        $('.sign > section > div > div form .login').addClass('d-none');
        $('.sign > section > div > div form .register,.sign .regsep').removeClass('d-none');
        $('.sign > section > div > div form > .sub').addClass('d-none');
        $(this).addClass('log');
        window.isLogin = false;
        $("#fieldRepeatPassword").show();
        $("#forgotPsw").hide();

    }
    var qn = $('.sign > section > div > div form > .switch > i').text();
    $('.sign > section > div > div form > .switch > i').text($('.sign > section > div > div form > .switch').attr('qn'));
    $('.sign > section > div > div form > .switch').attr('qn', qn);

    var btn2 = $('.two > section > div > div form > .switch > span').text();
    $('.two > section > div > div form > .switch > span').text($('.sign > section > div > div form > .switch').attr('btn'));
    $('.sign > section > div > div form > .switch').attr('btn', btn2);
    $('body').fadeIn();
});

$('.sign > section > div > div form > .sub > span:last-child').on('click', function () {
    console.log('asafsdf');
    $('body').hide();
    $('.two > section > div > div form .doz').val('forgot');
    $('.sign > section > div > div form .register').addClass('d-none');
    $('.sign > section > div > div form .login,.two > section > div > div form > .submit.reset').removeClass('d-none');
    $('.sign > section > div > div form .global,.sign > section > div > div form > .sub').addClass('d-none');
    $(this).removeClass('log');
    $('body').fadeIn();
});
$('.sign > section > div > div .logo').on('click', function () {
    location.reload();
});
$('.sign > section > div > div form > .sub > span.rmbr').on('click', function () {
    if ($(this).find('i > b').hasClass('active')) {
        $(this).find('i > b').removeClass('active');
        $(this).find('i > input').val(0);
    } else {
        $(this).find('i > b').addClass('active');
        $(this).find('i > input').val(1);
    }
});
$(".sign > section > div > div .tos > p").niceScroll({
    cursorwidth: 8,
    cursoropacitymin: 0.4,
    cursorcolor: "#d4d4d4",
    cursorborder: "none",
    cursorborderradius: 4,
    autohidemode: "leave",
    horizrailenabled: false
});
$(window).load(function () {
    if (Cookies.get('grconsent') !== 'notified') {
        setTimeout(function () {
            $('.gr-consent').show();
            $('.gr-consent').animate({
                marginBottom: '0px'
            }, 500);
        }, 1000);
    }
});
$('.gr-consent > span > span >i').on('click', function (e) {
    var data = {
        act: 1,
        do: "terms",
    };
    var s = '$(".sign > section > div > div form,.two > section > div > div .logo,.gr-consent").hide();';
    s = s + '$(".sign > section > div > div > .box").animate({ width: "80%" }, function(e) {$(".sign > section > div > div .tos > p").getNiceScroll().onResize();});';
    s = s + '$(".sign > section > div > div .tos > p").html(data);$(".sign > section > div > div .tos").fadeIn();';
    ajxx($(this), data, s, e);
});
$("body").on("contextmenu", "img", function (e) {
    return false;
});
$('.sign > section > div > div .tos > h4 > i').on('click', function () {
    $('.sign > section > div > div .tos').hide();
    $(".sign > section > div > div .tos > p").getNiceScroll().onResize();
    $(".sign > section > div > div > .box").animate({
        width: "300px"
    });
    $('.sign > section > div > div form,.two > section > div > div .logo,.gr-consent').fadeIn();
});

$('.gr-consent > span > i').on('click', function () {
    Cookies.set('grconsent', 'notified', {
        expires: 1
    });
    $('.gr-consent').fadeOut();
});


$("#txtSecretKey").change(function (event) {
    if ($(this).val().length >= 5) {
        var searchOrganization = searchOrganizationBySecretKey($(this).val());
        if (searchOrganization.exist) {
            $("#txtOrganizationName").val(searchOrganization.data.organization);
        }
    }
});

function searchOrganizationBySecretKey(secret_key) {
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "searchOrganizationBySecretKey", "secret_key": secret_key }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (err) {
            console.log(err);
        }
    }).responseText;
    return JSON.parse(searchOrg);
}



function existUser(phone, username, email) {
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "existUserSign", "phone": phone, "username": username, "email": email }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (err) {
            console.log(err);
        }
    }).responseText;
    return JSON.parse(searchOrg);
}

function existUserForgotPassword(phone) {
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "existUserForgotPassword", "phone": phone }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (err) {
            console.log(err);
        }
    }).responseText;
    return JSON.parse(searchOrg);
}



function searchOrganization(organization, secret_key) {
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "searchOrganization", "organization": organization, "secret_key": secret_key }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (err) {
            console.log(err);
        }
    }).responseText;
    return JSON.parse(searchOrg);
}


function getDataUserByPhone(phone) {
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "getDataUserByPhone", "phone": phone }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (error) {
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return getData;
}

function getDataUserByUsername(username) {
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "getDataUserByUsername", "username": username }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (error) {
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return getData;
}


function sendSMS(code, phone) {
    console.log(code);
    var getData = $.ajax({
        url: 'https://qow7oum5sd.execute-api.us-east-1.amazonaws.com/dev/sendsms',
        data: JSON.stringify({ "sms": code, "type": "MFA", phone: phone }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (error) {
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return JSON.parse(getData);
}
function createUser(payload) {
    console.log(code);
    var getData = $.ajax({
        url: 'door/grform/main.php',
        data: JSON.stringify(payload),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (error) {
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return JSON.parse(getData);
}

function updateStatusUser(phone, status) {
    console.log(code);
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({  phone: phone, status: status }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (error) {
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return JSON.parse(getData);
}


function updatePasswordUser(phone, password) {
    console.log(code);
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ method: "updatePasswordUser", phone: phone, password: password }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (error) {
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return JSON.parse(getData);
}




$('.two > section > div > div form > .submit.global').on('click', function (e) {
    var doer = 1;

    $("form").find('input').each(function () {
        if (!$(this).val() && $(this).is(":visible")) {
            doer = 0;
            if ($(this).hasClass('gstdep') && !$('.sign > section > div > div form > .switch').hasClass('log')) {
                if ($('.two > section > div > div form > .submit.global').attr('glog') == 'enable') {
                    doer = 1;
                }
            }
        }
    });
    doer = 1;
    if (doer === 1) {

        var _self = $(this);

        if (window.isLogin) {
            if ($("#txtUsernameLogin").val() == "") {

                // $.toast("the username is requited");
                toast("the username is required", 'error');
                $("#txtUsernameLogin").focus();
                return false;
            }

            if ($("#txtPassword").val() == "") {
                // $.toast("the password is requited");
                toast("the password is required", 'error');
                $("#txtPassword").focus();
                return false;
            }
            $.loadingBlockShow({
                imgPath: './asset/default.svg',
                text: 'Loading...',
                style: { position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
            });

            var getData = JSON.parse(getDataUserByUsername($("#txtUsernameLogin").val()));
            if (!getData.exist) {
                // $.toast("the username: " + $("#txtUsernameLogin").val() + " doesn't exist.");
                toast("the username: " + $("#txtUsernameLogin").val() + " doesn't exist.", 'error');

                $("#txtUsernameLogin").focus();
                $.loadingBlockHide();
                return false;
            }
            if (getData.data.status == '0') {
                // $.toast("Username:" + $("#txtUsernameLogin").val() + " inactive.");
                toast("Username:" + $("#txtUsernameLogin").val() + " inactive.", 'info');

                $.loadingBlockHide();
                return false;
            }
            if (getData.data.deleted == '1') {
                // $.toast("Username:" + $("#txtUsernameLogin").val() + " deleted.");
                toast("Username:" + $("#txtUsernameLogin").val() + " deleted.", 'info');

                $.loadingBlockHide();
                return false;
            }
            var phone = getData.data.phone;
            var code = generateCode();
            console.log(code);
            $.ajax({
                url: 'https://qow7oum5sd.execute-api.us-east-1.amazonaws.com/dev/sendsms',
                data: JSON.stringify({ "sms": code, "type": "MFA", phone: phone }),
                processData: false,
                contentType: "application/json",
                type: 'POST',
                success: function (data) {
                    console.log(data);
                    $.loadingBlockHide();

                    bootbox.prompt("Please input verification code", function (result) {
                        console.log(result);
                        if (result === code) {
                            // var getData = getDataUserByPhone( phone ); 
                            var s = 'eval(data);';
                            if(window.location.pathname!="/track-it/signin"){
                                var params = window.location.pathname.split('/')[2].split('$')[1].split('&')
                                if(params[0]!=""){
                                    var ldt    = params[0].replace('ldt=','');
                                    var id     = params[1].replace('id=','');
                                    sessionStorage.setItem("ldt",ldt);
                                    sessionStorage.setItem("idchat",id);
                                }
                            }
                            ajxx(_self, '', s, 0, e);
                        } else {
                            // $.toast("invalida code");
                            toast("invalida code", 'error');

                        }
                    });

                },
                error: function (error) {
                    $.loadingBlockHide();
                }
            });
        } else {

            if ($("#txtName").val() == "") {


                toast('The name is required', 'error')
                // $.toast('the name is requited');
                $("#txtName").focus();
                return false;
            }
            if ($("#txtLastName").val() == "") {
                // $.toast("the last name is requited");
                toast("The last name is required", 'error');

                $("#txtLastName").focus();
                return false;
            }
            // if ($("#txtAddress").val() == "") {
            //     // $.toast("the address is requited");
            //     toast("The address is required", 'error');

            //     $("#txtAddress").focus();
            //     return false;
            // }
            // if ($("#txtZipCode").val() == "") {
            //     $.toast("the zipcode is requited");
            //     $("#txtZipCode").focus();
            //     return false;
            // }
            if ($("#txtPhoneNumber").val() == "") {
                // $.toast("the phone is requited");
                toast("The phone is required", 'error');

                $("#txtPhoneNumber").focus();
                return false;
            }
            if ($("#txtPhoneNumber").val().length != 10) {
                // $.toast("Invalid length of phone number");
                toast("Invalid length of phone number is required", 'error');

                $("#txtPhoneNumber").focus();
                return false;
            }

            if ($("#txtUsername").val() == "") {
                // $.toast("theusername is requited");
                toast("the username is required", 'error');

                $("#txtUsername").focus();
                return false;
            }
            if ($("#txtEmail").val() == "") {
                // $.toast("the email is requited");
                toast("the email is required", 'error');

                $("#txtEmail").focus();
                return false;
            }
            if (!validateEmail($("#txtEmail").val())) {
                // $.toast("Email format incorrect.");
                toast("Email format is required", 'error');

                $("#txtEmail").focus();
                return false;
            }
            if ($("#txtPassword").val() == "") {
                toast("Password is required", 'error');

                // $.toast("the password is requited");
                $("#txtPassword").focus();
                return false;
            }
            if (!checkPassword($("#txtPassword").val())) {
                // $.toast("Password must be between 8 and 16 characters, at least one number, one lowercase and one uppercase letter.");
                toast("Password must be between 8 and 16 characters, at least one number, one lowercase and one uppercase letter.", 'error');

                $("#txtPassword").focus();
                return false;
            }

            if (!validatePasswords($("#txtPassword").val(), $("#txtRepeatPassword").val())) {
                // $.toast("The given passwords do not match");
                toast("The given passwords do not match", 'error');

                return false;
            }


            $.loadingBlockShow({
                imgPath: './asset/default.svg',
                text: 'Loading...',
                style: { position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
            });
            var username = $("#txtUsername").val();
            // $("#txtEmail").val(username+'@phpmedical.com');
            // $("#txtEmail").val(username);
            var phone = $("#selComplementPhone").val() + $("#txtPhoneNumber").val();
            var exist = existUser(phone, username, $("#txtEmail").val());

            if (exist.exist && exist.data.status == 1) {
                $.loadingBlockHide();
                // $.toast(exist.message);
                toast(exist.message, 'error');

                return false;
            }


            if ($("#txtOrganizationName").val() == "" && $("#txtSecretKey").val() == "") {
                $("#txtStatusUser").val(0);
            } else {
                var searchOrg = searchOrganization($("#txtOrganizationName").val(), $("#txtSecretKey").val());
                console.log(searchOrg);
                if (!searchOrg.exist) {
                    $.loadingBlockHide();
                    // $.toast("The organization name and secret key doesn't exist.");
                    toast("The organization name and secret key doesn't exist.", 'error');


                    return false;
                } else {
                    if ($("#txtSecretKey").val() == "") {
                        $("#txtIdOrganization").val(searchOrg.data.id_organization);
                        $("#txtStatusUser").val(0);
                    } else {
                        $("#txtIdOrganization").val(searchOrg.data.id_organization);
                        $("#txtStatusUser").val(1);
                    }

                }
            }


            var code = generateCode();
            var sms = sendSMS(code, phone);
            console.log(code);
            if (sms.statusCode == 200) {
                $.loadingBlockHide();



                bootbox.prompt("Please input verification code", function (result) {
                    console.log(result);
                    if (result === code) {
                        //  $("#txtStatusUser").val(1);
                        var s = 'eval(data);';
                        ajxx(_self, '', s, 0, e);
                    } else {
                        $.loadingBlockHide();
                        // $.toast("Invalid code");
                        toast("Invalid code", 'error');

                        return;
                    }
                });

            } else {

                $.loadingBlockHide();
            }



        } // end else

    } else {
        $.loadingBlockHide();
        say($('.two > section > div > div form > .submit.global').attr('em'));
    }

});


function toast(message, type) {
    var messageHead = "Information:";
    switch (type) {
        case "error":
            messageHead = "Error message:"
            break;
    }
    var _type = type;
    if (!_type) {
        _type = "info";
    }
    $.toast({
        heading: messageHead,
        text: message,
        icon: _type,
        position: 'mid-center',
        loader: true,        // Change it to false to disable loader
        loaderBg: '#9EC600'  // To change the background
    });


}

function generateCode() {
    var length = 6,
        charsetnum = "0123456789",
        password = "";

    for (var i = 0, n = charsetnum.length; i < length; ++i) {
        password += charsetnum.charAt(Math.floor(Math.random() * n));
    }
    return password;
}

function validatePasswords(password, repeatPassword) {
    return password === repeatPassword;
}
function validatePhoneNumber(phone_number) {
    var re = /\D*(^[0-9]{6,15}$)\D*/
    return re.test(phone_number);
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
function checkPassword(str) {
    // at least one number, one lowercase and one uppercase letter
    // at least six characters
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    return re.test(str);
}


$('.only-numbers').keydown(function (event) {
    if (event.shiftKey) {
        event.preventDefault();
    }

    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
    }
    else {
        if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
            }
        }
        else {
            if (event.keyCode < 96 || event.keyCode > 105) {
                event.preventDefault();
            }
        }
    }
});

$('.zipCodeLimit').on('keydown keypress', function (e) {
    if (e.key.length === 1) {
        if ($(this).val().length < 5 && !isNaN(parseFloat(e.key))) {
            $(this).val($(this).val() + e.key);
        }
        return false;
    }
});

$('.phoneNumberLimit').on('keydown keypress', function (e) {
    if (e.key.length === 1) {
        if ($(this).val().length < 10 && !isNaN(parseFloat(e.key))) {
            $(this).val($(this).val() + e.key);
        }
        return false;
    }
});


$(document).on('keypress', function (e) {
    if (e.which == 13) {
        $('.two > section > div > div form > .submit.global').trigger('click');
    }
});

$('.demologin').on('change', function (e) {
    var log = $(this).val();
    var pass = 'pass';
    if (log != '0') {
        if (log == 'guest') {
            log = pass = '';
        }
        $('.two > section > div > div form label > input.usrn').val(log);
        $('.two > section > div > div form label > input.pswd').val(pass);
        setTimeout(function () {
            $('.two > section > div > div form > .submit').trigger('click');
        }, 300);
    }
});

