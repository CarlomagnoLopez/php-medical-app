<?php if(!defined('s7V9pz')) {die();}?>$(document).ready(function() {
    $("head").append("<link rel='stylesheet' type='text/css' href='<?php echo url();?>ajx.css' />");
    $('body').append("<div class='ajxprocess'><span></span></div>");
    $('body').append("<div class='ajxcnf'><div><div><span></span><span><i class=nocnf>No</i><i class=yescnf>Yes</i></span></div></div></div><span class='ajxout'></span>");
    ajx('.ajx');
});
$('body').on('click', ".say", function(na) {
    na.preventDefault();
    var c = $(this).attr('say');
    var t = $(this).attr('type');
    var m = $(this).attr('sec');
    if (m == undefined) {
        m = 5000;
    }
    say(c, t, m);
});
function say(c, t, m, d) {
if (m == undefined) {
        m = 5000;
    }
    if (d == undefined) {
        d = 0;
    }
    setTimeout(function() {
        var s = "orange";
        if (t == "s") {
            s = "green";
        } else if (t == "e") {
            s = "red";
        }
        $(".ajxout").addClass(s);
        $(".ajxout").html(c);
        $(".ajxout").fadeIn();
        setTimeout(function() {
            $(".ajxout").hide();
            $(".ajxout").removeClass(s);
            $(".ajxout").html("");
        }, m);
    }, d);
}
function roll(d, l, t, e) {
    if (d == undefined) {
        d = "on";
    }
    if (d == "off") {
        $('.ajxprocess > .'+l).remove(); if (t == "off") {
            $(".ajxprocess").removeClass("ajxturn");
        }
    } else if (d == "er") {
        if (e == undefined || e == null) {
            e = "Request Failed";
        } $('.ajxprocess > .'+l).find("span").html("Halted<span>"+e+"</span>"); setTimeout(function() {
                $('.ajxprocess > .'+l).remove(); if (t == "off") {
                    $(".ajxprocess").removeClass("ajxturn");
                }
            }, 2000);
    } else {
        var vr = new Date().getTime(); if (l == undefined || l == null || l == "") {
            l = "Loading";
        }	if (t == "off") {
            $(".ajxprocess").addClass("ajxturn");
        }	$('.ajxprocess').append("<div class='"+vr+"'><div class='ajx-ripple'><div></div><div></div></div><span>"+l+"<span>Please Wait</span></span></div>");
        return vr;
    }
}
function ajx(e, d, s, f) {
    $(e).click(function(na) {
        na.preventDefault();
        ajxx($(this), d, s, na, f);
    });
}
function ajxx(e, d, s, na, f) {
    if (!$(na.target).hasClass("na") && !e.hasClass("na")) {
        var url = e.attr("url"),
        out = e.attr("out"),
        frm = e.attr("form"),
        load = e.attr("load"),
        data = e.data(),
        error = e.attr("error"),
        cnf = e.attr("cnf"),
        btns = e.attr("btns"),
        type = e.attr("type"),
        spin = e.attr("spin"),
        turn = e.attr("turn"),
        vr = new Date().getTime();
        if (frm !== undefined && frm !== null) {
            var form = $(frm)[0];
            data = new FormData(form);
            $.ajaxSetup({
                contentType: false,
                processData: false
            });
        } else {
            $.ajaxSetup({
                contentType: "application/x-www-form-urlencoded",
                processData: true
            });
        }
        if (d !== undefined && d.length !== 0) {
            data = d;
        }
        if (load == undefined || load == null) {
            load = "Loading";
        }
        if (error == undefined || error == null) {
            error = "Request Failed";
        }
        if (turn == "off") {
            $(".ajxprocess").addClass("ajxturn");
        }
        data["txt"] = e.text();
        data["val"] = e.val();
        if (cnf != undefined && cnf != null) {
            $('.ajxcnf').find("span").eq(0).html(cnf);
            if (btns != undefined && btns != null) {
                btns = btns.split(",");
                $('.ajxcnf').find(".yescnf").text(btns[0]);
                $('.ajxcnf').find(".nocnf").text(btns[1]);
            }

            $('.ajxcnf').fadeIn();
            $(".ajxcnf .yescnf").off('click').one("click", function() {
                $('.ajxcnf').fadeOut();
                ajxpr();
            });
            $(".ajxcnf .nocnf").off('click').one("click", function() {
                $('.ajxcnf').fadeOut();
                if (f !== undefined && f.length !== 0) {
                    eval(f);
                }
                return false;
            });
        } else {
            ajxpr();
        }
        function ajxpr() {
            if (spin !== "off") {
                $('.ajxprocess').append("<div class='"+vr+"'><div class='ajx-ripple'><div></div><div></div></div><span>"+load+"<span>Please Wait</span></span></div>");
            }
            e.addClass("na");
            $.ajaxSetup({
                timeout: 120000
            });
            $.post(url, data, function(data) {
                $('.ajxprocess > .'+vr).remove();
                e.removeClass("na");
                if (turn == "off") {
                    $(".ajxprocess").removeClass("ajxturn");
                }
            }) .done(function(data) {
                if (type === "json") {
                    var data = $.parseJSON(data);
                }
                if (out !== undefined && out.length !== 0) {
                    $(out).html(data);
                }
                if (s !== undefined && s.length !== 0) {
                    eval(s);
                } else if (out === undefined) {
                    eval(data);
                }
            }) .fail(function(qXHR, textStatus, errorThrown) {
                if (textStatus === "timeout") {
                    error = "Time Out";
                }
                if (f !== undefined && f.length !== 0) {
                    eval(f);
                }
                $('.ajxprocess > .'+vr).find("span").html("Halted<span>"+error+"</span>");
                setTimeout(function() {
                    $('.ajxprocess > .'+vr).remove();
                    e.removeClass("na");
                    if (turn == "off") {
                        $(".ajxprocess").removeClass("ajxturn");
                    }
                }, 2000);
            });
        }

    }}