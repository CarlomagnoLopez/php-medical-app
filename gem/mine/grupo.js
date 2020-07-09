$(document).ready(function(){

    $("#modalCreateUser").hide();
});


function existGroup(group){
    var searchOrg = $.ajax({
        url: 'door/grform/main.php',
        data: JSON.stringify({ "method" : "existGroup", "group" : group }),
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


function existUser(email,phone){
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method" : "existUser", "email" : email, "phone" : phone}),
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

function validatePasswords(password, repeatPassword){
    return password===repeatPassword;
}

function onClickFormCreateGroup(){
    if($("#txtGroupName").val()=="") {
        say("the group name is requited","s");
        $("#txtGroupName").focus();
        return false;
    }
    if($("#txtGroupPassword").val()=="") {
        say("the password group is requited","s");
        $("#txtGroupPassword").focus();
        return false;
    }

    if(!validatePasswords($("#txtGroupPassword").val(),$("#txtGroupRepeatPassword").val())){
        say("The given passwords do not match","s");
        $("#txtGroupRepeatPassword").focus();
        return false;
    }


    $.loadingBlockShow({
        imgPath: './asset/default.svg',
        text: 'Loading...',
        style: {  position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
    });

    var exist = existGroup($("#txtGroupName").val());

    if(exist.exist){
        $.loadingBlockHide();
        say(exist.message,"s");
        return false;
    }

    var payload = {
         method   : "createGroup",
         group    : $("#txtGroupName").val(),
         password : $("#txtGroupPassword").val()
     }

        $.ajax({
           type: "POST",
           contentType: "application/json",
           processData: false,
           url: 'door/grform/main.php',
           data: JSON.stringify(payload), 
           success: function(data)
           {
            $.loadingBlockHide();
            if(data.data == 0){
                say("Please try again","s");
            }else{

                $('#liGroups').click();

                say("The group: "+ $("#txtGroupName").val() +" was creaded successfully","s");
                $("#txtGroupPassword").val("");
                $("#txtGroupRepeatPassword").val("");
                $("#txtGroupName").val("");
                $("#modalCreateGroup").fadeOut();
                
            }
           },
           error : function(err){
             say("Please try again","s");
              $.loadingBlockHide();
           }
         });


}


function onClickFormCreateUser(){
    if($("#txtName").val()=="") {
        say("the name is requited","s");
        $("#txtName").focus();
        return false;
    }
    if($("#txtLastName").val()=="") {
        say("the last name is requited","s");
        $("#txtLastName").focus();
        return false;
    }
    if($("#txtAddress").val()=="") {
        say("the address is requited","s");
        $("#txtAddress").focus();
        return false;
    }
    if($("#txtZipCode").val()=="") {
        say("the zipcode is requited","s");
        $("#txtZipCode").focus();
        return false;
    }
    if($("#txtPhoneNumber").val()=="") {
        say("the phone is requited","s");
        $("#txtPhoneNumber").focus();
        return false;
    }

    if($("#txtEmail").val()=="") {
        say("the email is requited","s");
        $("#txtEmail").focus();
        return false;
    }
    if(!validateEmail($("#txtEmail").val())){
        say("Email format incorrect.","s");
        $("#txtEmail").focus();
        return false;
    }
    if($("#txtPassword").val()=="") {
        say("the password is requited","s");
        $("#txtPassword").focus();
        return false;
    }
    if(!checkPassword($("#txtPassword").val())) {
        say("Password must be between 8 and 16 characters, at least one number, one lowercase and one uppercase letter.","s");
        $("#txtPassword").focus();
        return false;
    }
    
    if(!validatePasswords($("#txtPassword").val(),$("#txtRepeatPassword").val())){
        say("The given passwords do not match","s");
        return false;
    }
    
    if($("#selRole").val()=="0") {
        say("the rol is requited","s");
        $("#selRol").focus();
        return false;
    }
    $.loadingBlockShow({
        imgPath: './asset/default.svg',
        text: 'Loading...',
        style: {  position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
    });

    var phone    = $("#selComplementPhone").val()+$("#txtPhoneNumber").val();
    var username = $("#txtEmail").val().split("@")[0];

    var exist    = existUser($("#txtEmail").val(), phone);

    if(exist.exist){
        $.loadingBlockHide();
        say(exist.message,"s");
        return false;
    }



    var payload = {
         method  : "createUser",
         name    : $("#txtName").val() ,
         lastname: $("#txtLastName").val(),
         phone   : phone,
         email   : $("#txtEmail").val(),
         username: username, 
         password: $("#txtPassword").val(), 
        // role    : $("#selRole").val(),
         role    : 2,
         id_organization : parseInt(sessionStorage.getItem("id_organization"))
     }

        $.ajax({
           type: "POST",
           contentType: "application/json",
           processData: false,
           url: 'door/grform/main.php',
           data: JSON.stringify(payload), 
           success: function(data)
           {
            $.loadingBlockHide();
            if(data.data == 0){
                say("Please try again","s");
            }else{
                $("#txtName").val("");
                $("#txtLastName").val("");
                $("#txtEmail").val("");
                $("#txtPassword").val("");
                $("#txtPhoneNumber").val("");
                $("#selRole").val("0");
                say("The user: "+username+" was creaded successfully","s");
                $("#modalCreateUser").fadeOut();
            }
           },
           error : function(err){
             say("Please try again","s");
              $.loadingBlockHide();
           }
         });
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
