
window.isLogin = true;
$(document).ready(function(){
    sessionStorage.removeItem("id");
    sessionStorage.removeItem("status");
    sessionStorage.removeItem("id_organization");
    sessionStorage.removeItem("role");
    sessionStorage.removeItem("phone");
    sessionStorage.removeItem("name");
    sessionStorage.removeItem("email");

    showSigUp();
});



function showSigUp(){
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


$('.sign > section > div > div form > .switch').on('click', function() {
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

    } else {
        $('.two > section > div > div form > .submit.global').attr('do', 'register');
        $('.two > section > div > div form .doz').val('register');
        $('.sign > section > div > div form .login').addClass('d-none');
        $('.sign > section > div > div form .register,.sign .regsep').removeClass('d-none');
        $('.sign > section > div > div form > .sub').addClass('d-none');
        $(this).addClass('log');
        window.isLogin = false;
        $("#fieldRepeatPassword").show();

    }
    var qn = $('.sign > section > div > div form > .switch > i').text();
    $('.sign > section > div > div form > .switch > i').text($('.sign > section > div > div form > .switch').attr('qn'));
    $('.sign > section > div > div form > .switch').attr('qn', qn);

    var btn2 = $('.two > section > div > div form > .switch > span').text();
    $('.two > section > div > div form > .switch > span').text($('.sign > section > div > div form > .switch').attr('btn'));
    $('.sign > section > div > div form > .switch').attr('btn', btn2);
    $('body').fadeIn();
});

$('.sign > section > div > div form > .sub > span:last-child').on('click', function() {
    console.log('asafsdf');
    $('body').hide();
    $('.two > section > div > div form .doz').val('forgot');
    $('.sign > section > div > div form .register').addClass('d-none');
    $('.sign > section > div > div form .login,.two > section > div > div form > .submit.reset').removeClass('d-none');
    $('.sign > section > div > div form .global,.sign > section > div > div form > .sub').addClass('d-none');
    $(this).removeClass('log');
    $('body').fadeIn();
});
$('.sign > section > div > div .logo').on('click', function() {
    location.reload();
});
$('.sign > section > div > div form > .sub > span.rmbr').on('click', function() {
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
$(window).load(function() {
    if (Cookies.get('grconsent') !== 'notified') {
        setTimeout(function() {
            $('.gr-consent').show();
            $('.gr-consent').animate({
                marginBottom: '0px'
            }, 500);
        }, 1000);
    }
});
$('.gr-consent > span > span >i').on('click', function(e) {
    var data = {
        act: 1,
        do: "terms",
    };
    var s = '$(".sign > section > div > div form,.two > section > div > div .logo,.gr-consent").hide();';
    s = s+'$(".sign > section > div > div > .box").animate({ width: "80%" }, function(e) {$(".sign > section > div > div .tos > p").getNiceScroll().onResize();});';
    s = s+'$(".sign > section > div > div .tos > p").html(data);$(".sign > section > div > div .tos").fadeIn();';
    ajxx($(this), data, s, e);
});
$("body").on("contextmenu", "img", function(e) {
    return false;
});
$('.sign > section > div > div .tos > h4 > i').on('click', function() {
    $('.sign > section > div > div .tos').hide();
    $(".sign > section > div > div .tos > p").getNiceScroll().onResize();
    $(".sign > section > div > div > .box").animate({
        width: "300px"
    });
    $('.sign > section > div > div form,.two > section > div > div .logo,.gr-consent').fadeIn();
});

$('.gr-consent > span > i').on('click', function() {
    Cookies.set('grconsent', 'notified', {
        expires: 1
    });
    $('.gr-consent').fadeOut();
});


$("#txtSecretKey").change(function(event){
    if ( $(this).val().length >= 5 ) {
       var searchOrganization = searchOrganizationBySecretKey($(this).val());
       if(searchOrganization.exist){
            $("#txtOrganizationName").val(searchOrganization.data.organization);
       }
    }
});

function searchOrganizationBySecretKey(secret_key){
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method" : "searchOrganizationBySecretKey", "secret_key" : secret_key}),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) {},
        async: false,
        error: function (err) {
            console.log(err);
        }
    }).responseText;
    return JSON.parse(searchOrg);
}



function existUser(phone){
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method" : "existUser", "phone" : phone}),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) {},
        async: false,
        error: function (err) {
            console.log(err);
        }
    }).responseText;
    return JSON.parse(searchOrg);
}


function searchOrganization(organization, secret_key){
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method" : "searchOrganization", "organization" :  organization, "secret_key" : secret_key}),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) {},
        async: false,
        error: function (err) {
            console.log(err);
        }
    }).responseText;
    return JSON.parse(searchOrg);
}


function getDataUserByPhone(phone){
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method" : "getDataUserByPhone", "phone" :  phone}),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) {},
        async: false,
        error: function(error){
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return getData;
}


function sendSMS(code,phone){
    console.log(code);
    var getData = $.ajax({
        url: 'https://c4ymficygk.execute-api.us-east-1.amazonaws.com/dev/sendsms',
        data: JSON.stringify( { "sms" : code, "type" : "MFA" , phone : phone } ),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) {},
        async: false,
        error: function(error){
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return JSON.parse(getData);
}
function createUser(payload){
    console.log(code);
    var getData = $.ajax({
        url: 'door/grform/main.php',
        data: JSON.stringify( payload ),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) {},
        async: false,
        error: function(error){
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return JSON.parse(getData);
}

function updateStatusUser(phone,status){
    console.log(code);
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify( {phone:phone,status:status} ),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) {},
        async: false,
        error: function(error){
            console.log(error);
            $.loadingBlockHide();
        }
    }).responseText;
    return JSON.parse(getData);
}

 


$('.two > section > div > div form > .submit.global').on('click', function(e) {
    var doer = 1;

    $("form").find('input').each(function() {
        if (!$(this).val() && $(this).is(":visible")) {
            doer = 0;
            if ($(this).hasClass('gstdep') && !$('.sign > section > div > div form > .switch').hasClass('log')) {
                if ($('.two > section > div > div form > .submit.global').attr('glog') == 'enable') {
                    doer = 1;
                }
            }
        }
    });
    doer=1;
    if (doer === 1) {
    

        var _self = $(this);    

        if(window.isLogin){
            if($("#txtPhoneNumberLogin").val()=="") {
                $.toast("the phone number is requited");
                $("#txtPhoneNumberLogin").focus();
                return false;
            }
            
            if($("#txtPassword").val()=="") {
                $.toast("the password is requited");
                $("#txtPassword").focus();
                return false;
            }
            
            $.loadingBlockShow({
                imgPath: './asset/default.svg',
                text: 'Loading...',
                style: {  position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
            });
 
          
                var phone = $("#selComplementPhoneLogin").val()+$("#txtPhoneNumberLogin").val();
                var code  = generateCode();
                console.log(code);
                $.ajax({
                    url: 'https://c4ymficygk.execute-api.us-east-1.amazonaws.com/dev/sendsms',
                    data: JSON.stringify( { "sms" : code, "type" : "MFA" , phone : phone } ),
                    processData: false,
                    contentType: "application/json",
                    type: 'POST',
                    beforeSend: function(){
                        var username = $("#txtEmail").val().split("@")[0];
                        $("#txtUsername").val(username);
                    },
                    success: function ( data ) {
                        console.log(data);
                        var verificationCode = prompt('Please input verification code', '');
                        if(verificationCode === code){
                           // var getData = getDataUserByPhone( phone );
                            var s = 'eval(data);';
                            ajxx(_self, '', s, 0, e);
                        }else{
                            $.toast("invalida code");
                        }
                    },
                    error: function(error){
                        $.loadingBlockHide();
                    }
                });
        }else{

            if($("#txtName").val()=="") {
                $.toast('the name is requited');
                $("#txtName").focus();
                return false;
            }
            if($("#txtLastName").val()=="") {
                $.toast("the last name is requited");
                $("#txtLastName").focus();
                return false;
            }
            if($("#txtAddress").val()=="") {
                $.toast("the address is requited");
                $("#txtAddress").focus();
                return false;
            }
            if($("#txtZipCode").val()=="") {
                $.toast("the zipcode is requited");
                $("#txtZipCode").focus();
                return false;
            }
            if($("#txtPhoneNumber").val()=="") {
                $.toast("the phone is requited");
                $("#txtPhoneNumber").focus();
                return false;
            }

            if($("#txtEmail").val()=="") {
                $.toast("the email is requited");
                $("#txtEmail").focus();
                return false;
            }
            if(!validateEmail($("#txtEmail").val())){
                $.toast("Email format incorrect.");
                $("#txtEmail").focus();
                return false;
            }
            if($("#txtPassword").val()=="") {
                $.toast("the password is requited");
                $("#txtPassword").focus();
                return false;
            }
            if(!checkPassword($("#txtPassword").val())) {
                $.toast("Password must be between 8 and 16 characters, at least one number, one lowercase and one uppercase letter.");
                $("#txtPassword").focus();
                return false;
            }

            if(!validatePasswords($("#txtPassword").val(),$("#txtRepeatPassword").val())){
                $.toast("The given passwords do not match");
                return false;
            }

            
            $.loadingBlockShow({
                imgPath: './asset/default.svg',
                text: 'Loading...',
                style: {  position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
            });
            var username = $("#txtEmail").val().split("@")[0];
            $("#txtUsername").val(username);
            var phone     = $("#selComplementPhone").val() + $("#txtPhoneNumber").val();
            var exist     = existUser(phone);
            
            if(exist.exist && exist.data.status==1){
                $.loadingBlockHide();
                $.toast(exist.message);
                return false;
            }

            if( $("#txtOrganizationName").val() == "" && $("#txtSecretKey").val() == "" ){
                $("#txtStatusUser").val(0);
            }else{    
                var searchOrg = searchOrganization( $("#txtOrganizationName").val(), $("#txtSecretKey").val());
                console.log(searchOrg);
                if(!searchOrg.exist){
                    $.loadingBlockHide();
                    $.toast("The organization name and secret key doesn't exist.");
                    return false;
                }else{
                    $("#txtIdOrganization").val(searchOrg.data.id_organization);
                    $("#txtStatusUser").val(1);
                }
            }
            

            var code = generateCode();
            var sms  = sendSMS(code,phone);
            console.log(code);
            if(sms.statusCode==200){
                var verificationCode = prompt('Please input verification code', '');
                if(verificationCode === code){
                    $("#txtStatusUser").val(1);
                    var s = 'eval(data);';
                    ajxx(_self, '', s, 0, e);
                }else{
                    $.toast("invalida code");
                    return;
                }
            }else{
                $.loadingBlockHide();
            }

        
        
        } // end else

    } else {
        $.loadingBlockHide();
        say($('.two > section > div > div form > .submit.global').attr('em'));
    }

});


function toast(message){
    $.toast(message);
}

function generateCode(){
    var length = 5,
    charsetnum = "0123456789",
    password = "";

    for (var i = 0, n = charsetnum.length; i < length; ++i) {
        password += charsetnum.charAt(Math.floor(Math.random() * n));
    }
    return password;
}

function validatePasswords(password, repeatPassword){
    return password===repeatPassword;
}
function validatePhoneNumber(phone_number){
        var re = /\D*(^[0-9]{6,15}$)\D*/
        return re.test(phone_number);
}

function validateEmail(email){
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
}
function checkPassword(str){
  // at least one number, one lowercase and one uppercase letter
  // at least six characters
  var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
  return re.test(str);
}


$('.only-numbers').keydown(function(event) {
    if(event.shiftKey)
    {
         event.preventDefault();
    }
 
    if (event.keyCode == 46 || event.keyCode == 8 ||  event.keyCode == 9)    {
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

$('.zipCodeLimit').on('keydown keypress',function(e){
    if(e.key.length === 1){ 
        if($(this).val().length < 5 && !isNaN(parseFloat(e.key))){ 
            $(this).val($(this).val() + e.key); 
        }
        return false;
    }
});

$('.phoneNumberLimit').on('keydown keypress',function(e){
    if(e.key.length === 1){ 
        if($(this).val().length < 10 && !isNaN(parseFloat(e.key))){ 
            $(this).val($(this).val() + e.key); 
        }
        return false;
    }
});


$(document).on('keypress', function(e) {
    if (e.which == 13) {
        $('.two > section > div > div form > .submit.global').trigger('click');
    }
});

$('.demologin').on('change', function(e) {
 var log=$(this).val();
 var pass='pass';
 if(log!='0'){
 if(log=='guest'){
 log=pass='';
}
$('.two > section > div > div form label > input.usrn').val(log);
$('.two > section > div > div form label > input.pswd').val(pass);
setTimeout(function() {
$('.two > section > div > div form > .submit').trigger('click');
        }, 300);
 }
});

