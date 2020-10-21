var clickSwitchInvite = true;
$(document).ready(function () {

    $("#modalCreateUser").hide();
});


function existGroup(group) {
    var searchOrg = $.ajax({
        url: 'door/grform/main.php',
        data: JSON.stringify({ "method": "existGroup", "group": group }),
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


function existUser(email, phone) {
    var searchOrg = $.ajax({
        url: 'door/user/main.php',
        data: JSON.stringify({ "method": "existUser", "email": email, "phone": phone }),
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

function validatePasswords(password, repeatPassword) {
    return password === repeatPassword;
}



function updateStatusUser(uid, status) {
    var getData = $.ajax({
        url: 'door/grform/main.php',
        data: JSON.stringify({ method: 'updateStatusUser', uid: uid, status: status }),
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





function onClickStatusUser(event) {
    if ($("#selActionUser").val() == "") {
        say("Please select any option.", "s");
        $("#selActionUser").focus();
        return false;
    }
    if (window.idUserSelectedAct !== '') {
        $.loadingBlockShow({
            imgPath: './asset/default.svg',
            text: 'Loading...',
            style: { position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
        });

        var update = updateStatusUser(window.idUserSelectedAct, $("#selActionUser").val());
        if (update.error) {
            say(update.message, "s");
            $.loadingBlockHide();
        } else {
            $("#modalTakeAction").fadeOut();
            window.idUserSelectedAct = '';
            // $("#liOptions").children().html()
            $("#liOptions").click();
            $.loadingBlockHide();
            if ($("#selActionUser").val() == "0") {
                say("The user was disables.", "s");
            } else {
                say("The user was enabled.", "s");
            }

            $("#selActionUser").val("");


        }

    }


}

function onClickFormCreateGroup(event) {
    if (event.value !== "Create Group") {
        return false;
    }
    if ($("#txtGroupName").val() == "") {
        say("the group name is required", "s");
        $("#txtGroupName").focus();
        return false;
    }
    if ($("#txtGroupPassword").val() == "") {
        say("the password group is required", "s");
        $("#txtGroupPassword").focus();
        return false;
    }

    if (!validatePasswords($("#txtGroupPassword").val(), $("#txtGroupRepeatPassword").val())) {
        say("The given passwords do not match", "s");
        $("#txtGroupRepeatPassword").focus();
        return false;
    }


    $.loadingBlockShow({
        imgPath: './asset/default.svg',
        text: 'Loading...',
        style: { position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
    });

    var exist = existGroup($("#txtGroupName").val());

    if (exist.exist) {
        $.loadingBlockHide();
        say(exist.message, "s");
        return false;
    }

    var payload = {
        method: "createGroup",
        group: $("#txtGroupName").val(),
        password: $("#txtGroupPassword").val(),
        id_user: $("#global_id_user").val(),
        role: $("#global_role").val(),
        id_organization: $("#global_id_organization").val()
    }

    $.ajax({
        type: "POST",
        contentType: "application/json",
        processData: false,
        url: 'door/grform/main.php',
        data: JSON.stringify(payload),
        success: function (data) {
            $.loadingBlockHide();
            if (data.data == 0) {
                say("Please try again", "s");
            } else {

                $('#liGroups').click();

                say("The group: " + $("#txtGroupName").val() + " was creaded successfully", "s");
                $("#txtGroupPassword").val("");
                $("#txtGroupRepeatPassword").val("");
                $("#txtGroupName").val("");
                $("#modalCreateGroup").fadeOut();

            }
        },
        error: function (err) {
            say("Please try again", "s");
            $.loadingBlockHide();
        }
    });


}

function onClickCancelCreateUser() {
    $("#modalCreateUser").fadeOut();
}
function onClickCancelCreateGroup() {
    $("#modalCreateGroup").fadeOut();
}
function onClickCancelTakeAction() {
    $("#modalTakeAction").fadeOut();
}
function onClickCancelProfileUser() {
    $("#modalEditProfile").fadeOut();
}
function onClickCancelInvite() {
    $("#modalInvite").fadeOut();
}


$("#chkFilterModalInvite").change(function (event) {
    console.log("check:");
    if (clickSwitchInvite) {
        // show list user
        var users = getUsers();

        $(".divByPhone").hide();
        $(".divByUser").show();
        $("#formModalInvite").removeClass("sizeModalInviteByPhone")
        $("#formModalInvite").addClass("sizeModalInviteByUser")
        var list = '';
        $("#ulListUsers li").remove();
        var total = users.data.length - 1;
        $("#totalUsers").text("Total users: " + total);
        users.data.forEach(function (user, index) {
            if ($("#global_id_user").val() != user.id) {
                list = list + "<li class='list-group-item' data='" + JSON.stringify(user) + "'  >" + user.username + "</li>";
            }
        });
        $("#ulListUsers").append(list);
        $("#titleInvite").html("Invite by username")
        clickSwitchInvite = false;
    } else {
        $(".divByPhone").show();
        $(".divByUser").hide();
        $("#formModalInvite").removeClass("sizeModalInviteByUser")
        $("#formModalInvite").addClass("sizeModalInviteByPhone")
        $("#titleInvite").html("Invite by phone")
        clickSwitchInvite = true;
    }
    console.log(clickSwitchInvite)
});

$("#ulListUsers").on('click', 'li', function () {
    if ($(this).hasClass("active")) {
        $(this).removeClass('active');
    } else {
        $(this).addClass('active');
    }

});

$(".msgs").on('click', 'li div span i span', function () {
    console.log($(this).html());
    var filename = $(this).parent().find('span').attr('data-filename')
    var typefile = $(this).parent().find('span').attr('data-typefile')
    // var routefile = "grupo/files/182"+filename;
    showFileViewer(filename, typefile);
});


$("body").on("click", ".list  > li", function (e) {
    $("#global_group_selected").val($(this).attr('no'));

});
function onClickList(filename, typefile) {
    showFileViewer(filename, typefile);
}
function showFileViewer(filename, typefile) {
    if (filename != "undefined") {
        $(".previewPDF").hide();
        $("#wrap").hide();
        if (typefile !== 'application/pdf') {
            var link = "gem/ore/" + filename;


            if (typefile === "image/tiff") {
                var xhr = new XMLHttpRequest();
                xhr.responseType = 'arraybuffer';
                xhr.open('GET', link);
                xhr.onload = function (e) {
                    var tiff = new Tiff({ buffer: xhr.response });
                    var canvas = tiff.toCanvas();
                    canvas.id = "canvasTiff";
                    if ($("#canvasTiff").length) {
                        $("#canvasTiff").detach()
                    }
                    $("#wrap").show();
                    $("#wrap").append(canvas);
                };
                xhr.send();
            } else {
                $("#wrap").show();
                // var link = "gem/ore/" + filename;
                var viewer = new ViewBigimg();
                viewer.show(link)
            }
        } else {
            $(".previewPDF").show();
            var link = "dist/ViewerJS/#../../gem/ore/" + filename;
            $("#iframeViewer").attr('src', link);

        }
        $("#modalViewer").fadeIn();
    }
}


$('body').on('click', '.iv-close', function (e) {
    console.log("iv-close!");
    onClickCloseModalViewer();
});


function onClickCloseModalViewer(event) {
    console.log('close')
    $("#iframeViewer").attr('src', null);
    $("#modalViewer").fadeOut();
}



function getUsers() {
    var getData = $.ajax({
        url: 'door/grform/main.php',
        data: JSON.stringify({ "method": "getUsers" }),
        processData: false,
        type: 'POST',
        contentType: "application/json",
        success: function (data) { },
        async: false,
        error: function (error) {
            console.log(error);
        }
    }).responseText;
    return JSON.parse(getData);
}


function existGroup(group) {
    var searchOrg = $.ajax({
        url: 'door/grform/main.php',
        data: JSON.stringify({ "method": "existGroup", "group": group }),
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



function onClickFormCreateUser(event) {
    if ($("#txtName").val() == "") {
        say("the name is required", "s");
        $("#txtName").focus();
        return false;
    }
    // if ($("#txtLastName").val() == "") {
    //     say("the last name is required", "s");
    //     $("#txtLastName").focus();
    //     return false;
    // }
    // if ($("#txtAddress").val() == "") {
    //     say("the address is requited", "s");
    //     $("#txtAddress").focus();
    //     return false;
    // }
    // if ($("#txtZipCode").val() == "") {
    //     say("the zipcode is requited", "s");
    //     $("#txtZipCode").focus();
    //     return false;
    // }
    if ($("#txtPhoneNumber").val() == "") {
        say("the phone is required", "s");
        $("#txtPhoneNumber").focus();
        return false;
    }

    if ($("#txtEmail").val() == "") {
        say("the email is required", "s");
        $("#txtEmail").focus();
        return false;
    }
    if (!validateEmail($("#txtEmail").val())) {
        say("Email format incorrect.", "s");
        $("#txtEmail").focus();
        return false;
    }
    // if ($("#txtPassword").val() == "") {
    //     say("the password is requited", "s");
    //     $("#txtPassword").focus();
    //     return false;
    // }
    // if (!checkPassword($("#txtPassword").val())) {
    //     say("Password must be between 8 and 16 characters, at least one number, one lowercase and one uppercase letter.", "s");
    //     $("#txtPassword").focus();
    //     return false;
    // }

    // if (!validatePasswords($("#txtPassword").val(), $("#txtRepeatPassword").val())) {
    //     say("The given passwords do not match", "s");
    //     return false;
    // }

    if ($("#selRole").val() == "0") {
        say("the rol is required", "s");
        $("#selRol").focus();
        return false;
    }
    $.loadingBlockShow({
        imgPath: './asset/default.svg',
        text: 'Loading...',
        style: { position: 'fixed', width: '100%', height: '100%', background: 'rgba(0, 0, 0, .8)', left: 0, top: 0, zIndex: 10000 }
    });

    var phone    = "+" + $("#selComplementPhone").val() + $("#txtPhoneNumber").val();
    var username = $("#txtEmail").val().split("@")[0];

    var exist = existUser($("#txtEmail").val(), phone);

    if (exist.exist) {
        $.loadingBlockHide();
        say(exist.message, "s");
        return false;
    }

    var payload = {
        method: "saveUserByOrg",
        record: {
            name: $("#txtName").val(),
            // lastname: $("#txtLastName").val(),
            phoneNumber: phone,
            email: $("#txtEmail").val(),
            // username: username,
            // password: $("#txtPassword").val(),
            // address: $("#txtAddress").val(),
            // zipcode: $("#txtZipCode").val(),
            role: parseInt($("#selRole").val()),
            orgid: parseInt($("#global_id_organization").val())
        }

    }

    $.ajax({
        type: "POST",
        contentType: "application/json",
        processData: false,
        url: 'door/integration/main.php',
        data: JSON.stringify(payload),
        success: function (data) {
            $.loadingBlockHide();
            if (data.error) {
                say(data.message, "s");
            } else {
                $("#txtName").val("");
                $("#txtLastName").val("");
                $("#txtAddress").val("");
                $("#txtZipCode").val("");
                $("#txtEmail").val("");
                $("#txtPassword").val("");
                $("#txtRepeatPassword").val("");
                $("#txtPhoneNumber").val("");
                $("#selRole").val("0");
                $("#selComplementPhone").val("1");
                say("The user: " + username + " was created successfully", "s");
                $("#modalCreateUser").fadeOut();
              //  sendSMS(phone);
            }
        },
        error: function (err) {
            say("Please try again", "s");
            $.loadingBlockHide();
        }
    });
}


function sendSMS(phone) {
    var getData = $.ajax({
        url: 'https://c4ymficygk.execute-api.us-east-1.amazonaws.com/dev/sendsms',
        data: JSON.stringify({ "sms": "", "type": "signin", phone: phone }),
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
