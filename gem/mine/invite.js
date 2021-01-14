window.codeInvitation = '';
window.codeOTP        = '';
window.dataInvitation = '';
$(document).ready(function(){


        var params = window.location.pathname.split('/')[2].split('$')[1].split('&')
        if(params[0]!=""){
            window.codeInvitation = params[0].replace('code=','');
            $.loadingBlockShow({
                imgPath: './asset/default.svg',
                text: 'Loading...',
                style: { position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
            });
    
            var search = searchOTP(window.codeInvitation);
            $.loadingBlockHide();
            if(search.exist && search.data.v4 == '0'){
                window.codeOTP = generateCode();
                console.log(window.codeOTP)
                var sms        = sendSMS( window.codeOTP, search.user.phone);
                if (sms.statusCode == 200) {
                    window.dataInvitation = search;
                }
            }
            

        }

});

function generateCode() {
    var length = 6,
        charsetnum = "0123456789",
        password = "";

    for (var i = 0, n = charsetnum.length; i < length; ++i) {
        password += charsetnum.charAt(Math.floor(Math.random() * n));
    }
    return password;
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

function getInvitation(otp) {
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "getInvitation", "otp": otp }),
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

$('.otpCodeLimit').on('keydown keypress', function (e) {
    if (e.key.length === 1) {
        if ($(this).val().length < 6 && !isNaN(parseFloat(e.key))) {
            $(this).val($(this).val() + e.key);
        }
        return false;
    }
});


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

$('#formOTP').on('submit', function (e) {
    console.log("login");
    e.preventDefault();

    
    if ($("#txtOTP").val() == "") {
        toast("Please input the OTP", 'error');
        $("#txtOTP").focus();
        return false;
    }

    if ($("#txtOTP").val() !== window.codeOTP) {
        toast("The OTP is invalid", 'error');
        $("#txtOTP").focus();
        return false;
    }


     
        $.loadingBlockShow({
            imgPath: './asset/default.svg',
            text: 'Loading...',
            style: { position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
        });

        var search = window.dataInvitation;
        console.log(search);
        var user = search.user;
        var login = fastLogin(user.id,user.pass,user.phone,user.status,search.data.v5);
        console.log(login);
        if(login[0]){
            setTimeout(function() {
                sessionStorage.setItem("id", login[2]['data']['id']);
                sessionStorage.setItem("status", login[2]['data']['status']);
                sessionStorage.setItem("id_organization", login[2]['data']['id_organization']);
                sessionStorage.setItem("role", login[2]['data']['role']);
                sessionStorage.setItem("phone", login[2]['data']['phone']);
                sessionStorage.setItem("name", login[2]['data']['name']);
                sessionStorage.setItem("email", login[2]['data']['email']);
                sessionStorage.setItem("ldt",'group');
                sessionStorage.setItem("idchat",search.data.v5);

                window.location.href = window.location.protocol + '//'+window.location.host + '/' + window.location.pathname.split("/")[1]; 
            
            }, 2000);
        }


});


function fastLogin(id_username,psw_encrypt,phone,status_user,$id_chat) {
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "fastLogin", "id_username": id_username , "psw_encrypt": psw_encrypt , "phone": phone , "status_user": status_user, "id_chat":$id_chat, codeInvitation : window.codeInvitation }),
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

function searchOTP(otp) {
    var getData = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "searchOTP", "otp": otp }),
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
