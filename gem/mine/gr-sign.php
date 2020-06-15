<?php if(!defined('s7V9pz')) {die();}?>$('.sign > section > div > div form > .switch').on('click', function() {
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
        var s = 'eval(data);';
        ajxx($(this), '', s, 0, e);
    } else {
        say($('.two > section > div > div form > .submit.global').attr('em'));
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

$('body').on('keyup', '.gstdep', function() {
    if (!$('.sign > section > div > div form > .switch').hasClass('log')) {
        var dlg = $('.two > section > div > div form > .submit.global').attr('dlg');
        var gst = $('.two > section > div > div form > .submit.global').attr('gst');
        if ($(this).val().length != 0 && gst == 0) {
            $('.two > section > div > div form > .submit.global').attr('dlg', $('.two > section > div > div form > .submit.global').text());
            $('.two > section > div > div form > .submit.global').attr('gst', 1);
            $('.two > section > div > div form > .submit.global').text(dlg);
        } else if ($(this).val().length == 0 && gst == 1) {
            $('.two > section > div > div form > .submit.global').attr('dlg', $('.two > section > div > div form > .submit.global').text());
            $('.two > section > div > div form > .submit.global').attr('gst', 0);
            $('.two > section > div > div form > .submit.global').text(dlg);
        }
    }
});

$(document).ready(function(){
  $('.box').css('display','none');

 if(window.location.search!=''){
  var id = window.location.search.split('=')[1].substring(0, window.location.search.split('=')[1].length - 1);
  $('#txtUser').val(id);
  $('#txtPsw').val(id);
  $('#txtId').val(id);
  $('.two > section > div > div form > .submit.global').click();
 }else{
     $.loadingBlockHide();
 }

});