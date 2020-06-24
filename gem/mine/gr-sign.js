
$(document).ready(function(){
   // showSigUp();
   

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

}


$('.sign > section > div > div form > .switch').on('click', function() {
    $('body').hide();
    var btn = $('.two > section > div > div form > .submit.global').text();
    $('.two > section > div > div form > .submit.global').text($('.two > section > div > div form > .submit.global').attr('btn'));
    $('.two > section > div > div form > .submit.global').attr('btn', btn);
    $('.sign > section > div > div form .global').removeClass('d-none');
    $('.two > section > div > div form > .submit.reset').addClass('d-none');
    if ($(this).hasClass('log')) {
        $('.two > section > div > div form > .submit.global').attr('do', 'login');
        $('.two > section > div > div form .doz').val('login');
        $('.sign > section > div > div form .register,.sign .regsep').addClass('d-none');
        $('.sign > section > div > div form .login').removeClass('d-none');
        $('.sign > section > div > div form > .sub').removeClass('d-none');
        $(this).removeClass('log');
    } else {
        $('.two > section > div > div form > .submit.global').attr('do', 'register');
        $('.two > section > div > div form .doz').val('register');
        $('.sign > section > div > div form .login').addClass('d-none');
        $('.sign > section > div > div form .register,.sign .regsep').removeClass('d-none');
        $('.sign > section > div > div form > .sub').addClass('d-none');
        $(this).addClass('log');
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
$('.two > section > div > div form > .submit.global').on('click', function(e) {
    var doer = 1;

    $.loadingBlockShow({
        imgPath: './asset/default.svg',
        text: 'Loading...',
        style: {  position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
    });
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
    if (doer === 1) {
    


        if(!validatePhoneNumber($("#txtPhoneNumber").val())){
            alert("Phone number format incorrect.");
            $("#txtPhoneNumber").focus();
            return false;
        }
        if(!checkPassword($("#txtPassword").val())) {
            alert("Password must be between 8 and 16 characters, at least one number, one lowercase and one uppercase letter.");
            $("#txtPassword").focus();
            return false;
        }
        if(!validateEmail($("#txtEmail").val())){
            alert("Email format incorrect.");
            $("#txtEmail").focus();
            return false;
        }


         var s = 'eval(data);';
       // var s = '';
      //   ajxx($(this), '', s, 0, e);
        // signup
        var values = {
            txtName        : $("#txtName").val(),
            txtLastName    : $("#txtLastName").val(),
            txtAddress     : $("#txtAddress").val(),
            txtZipCode     : $("#txtZipCode").val(),
            txtPhoneNumber : $("#txtPhoneNumber").val(),
            txtEmail       : $("#txtEmail").val(),
            txtUsername    : $("#txtUsername").val(),
            txtPassword    : $("#txtPassword").val()
        }
        signUpCognito(values).then(function(data){
            var cognitoUser = data.user;
           
         }).catch(function(err) {
             console.log(err.message || JSON.stringify(err));
         });
 
        // data = new FormData();
        // data.append('act',1);
        // data.append('do','register');
        // data.append('fname', 'george');
        // data.append('email', 'george@george.com' );
        // data.append('name','George' );
        // data.append('pass', 'george' );
        // data.append('sign', '');
        // data.append('rmbr', '');        
        // $.ajax({
        //     url: './signin',
        //     data: data,
        //     processData: false,
        //     type: 'POST',
        //     success: function ( data ) {
        //         alert( data );
        //     }
        // });

    } else {
        say($('.two > section > div > div form > .submit.global').attr('em'));
    }

});

function validatePhoneNumber(phone_number) 
    {
        var re = /\D*(^[0-9]{6,15}$)\D*/
        return re.test(phone_number);
    }
    function validateEmail(email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
function checkPassword(str)
{
  // at least one number, one lowercase and one uppercase letter
  // at least six characters
  var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
  return re.test(str);
}
function signUpCognito(data){
  
    return new Promise((resolve, reject) => {
        var CognitoUserPool = AmazonCognitoIdentity.CognitoUserPool;
        var poolData = {
          UserPoolId: "us-east-1_zgFW3AEob", // Your user pool id here
          ClientId: "13pbrvceiogtq8ikiv1l9v89t4", // Your client id here
        };
        var userPool = new CognitoUserPool(poolData);
        var attributeList = [];

       var dataAddress          = {Name: 'address',Value: data.txtAddress.trim()};     
       var dataName             = {Name: 'name',Value: data.txtName.trim() + ' ' + data.txtLastName.trim()};       
       var dataPhoneNumber      = {Name: 'phone_number',Value: data.txtPhoneNumber};     
       var dataEmail            = {Name: 'email',Value: data.txtEmail};     
       var dataRole             = {Name: 'custom:role',Value:'OrgAdmin'};   
       var dataPK               = {Name: 'custom:pk',Value: 'mcp-org-19b6f5ae-36bd-4664-9266-d43d491df1eb'};

        attributeList.push(new AmazonCognitoIdentity.CognitoUserAttribute(dataAddress));
        attributeList.push(new AmazonCognitoIdentity.CognitoUserAttribute(dataName));
        attributeList.push(new AmazonCognitoIdentity.CognitoUserAttribute(dataPhoneNumber));
        attributeList.push(new AmazonCognitoIdentity.CognitoUserAttribute(dataEmail));
        attributeList.push(new AmazonCognitoIdentity.CognitoUserAttribute(dataRole));
        attributeList.push(new AmazonCognitoIdentity.CognitoUserAttribute(dataPK));
        userPool.signUp(data.txtEmail, data.txtPassword, attributeList, null, function(
          err,
          result
          ) {
              if (err) {
                  reject(err)
              }else{
                  resolve(result);
              }
          });
      })

  }



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

// $('body').on('keyup', '.gstdep', function() {
//     if (!$('.sign > section > div > div form > .switch').hasClass('log')) {
//         var dlg = $('.two > section > div > div form > .submit.global').attr('dlg');
//         var gst = $('.two > section > div > div form > .submit.global').attr('gst');
//         if ($(this).val().length != 0 && gst == 0) {
//             $('.two > section > div > div form > .submit.global').attr('dlg', $('.two > section > div > div form > .submit.global').text());
//             $('.two > section > div > div form > .submit.global').attr('gst', 1);
//             $('.two > section > div > div form > .submit.global').text(dlg);
//         } else if ($(this).val().length == 0 && gst == 1) {
//             $('.two > section > div > div form > .submit.global').attr('dlg', $('.two > section > div > div form > .submit.global').text());
//             $('.two > section > div > div form > .submit.global').attr('gst', 0);
//             $('.two > section > div > div form > .submit.global').text(dlg);
//         }
//     }
// });