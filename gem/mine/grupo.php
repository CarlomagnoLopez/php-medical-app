<?php if(!defined('s7V9pz')) {die();}?>
window.idUserSelectedAct = '';
$('.swr-grupo .aside > .tabs > ul > li,.loadside').on('click', function(e) {
    $(this).attr('type', 'json');
    $(this).find('i').html('');
    $('.tooltip').remove();
    $('.swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li').removeClass("active");
    if ($(this).hasClass('loadside')) {
        $('.swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li.xtra').html('<span>'+$(this).text()+'</span>');
        $('.swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li.xtra').addClass('active');
        $('.swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li.xtra').attr('side', $(this).attr('side'));
        $('.swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li.xtra').attr('act', $(this).attr('act'));
        $('.swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li.xtra').attr('zero', $(this).attr('zero'));
        $('.swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li.xtra').attr('zval', $(this).attr('zval'));
    } else {
        $(this).addClass("active");
    }
    var data = {
        act: 1,
        do: "list",
        type: $(this).attr('act'),
        gid: $('.swr-grupo .panel').attr('no'),
        hid: $('.dumb .hidid').val(),
        ex: $(this).data(),
    };
    var newStyle = ($(this).attr('act')=='files') ? 'listFiles' : '';
    var s = '$(".swr-grupo .aside > .content > .list").removeClass();$(".swr-grupo .aside > .content > ul").addClass("list fh scroller '+$(this).attr('act')+'").attr("id","'+newStyle+'"  );';
    s = s+'$(".swr-grupo .'+$(this).attr('side')+' > .content > .list").hide();';
    s = s+'var tcount=0;var list="";$.each(data, function(k, v) {';
    s = s+'list=list+"<li "+data[k].id+" onclick=onClickList('+"'"+'"+htmlDecode(data[k].filename)+"'+"'"+','+"'"+'"+htmlDecode(data[k].typefile)+"'+"'"+')  > <div><span class= left><img loadimg="+data[k].img+">';
    s = s+'</span><span class=center><b><span data-toggle=tooltip title='+"'"+'"+htmlDecode(data[k].name)+"'+"'"+'>"+htmlDecode(data[k].name)+"</span></b><i class="+data[k].icon+"></i>";';
    s = s+'if(data[k].count!="0"){tcount=parseInt(tcount)+parseInt(data[k].count);if(data[k].countag!="0"){list=list+"<u cnt="+data[k].count+">"+data[k].count+" "+data[k].countag+"</u>";}}';
    s = s+'list=list+"<span>"+data[k].sub+"</span></span><span class=right>';
    s = s+'<span class=opt "+data[k].rtag+"><i>"+data[k].right+"</i><ul>";';
    s = s+'if(data[k].oa!==0){list=list+"<li "+data[k].oat+">"+data[k].oa+"</li>";}';
    s = s+'if(data[k].ob!==0){list=list+"<li "+data[k].obt+">"+data[k].ob+"</li>";}';
    s = s+'if(data[k].oc!==0){list=list+"<li "+data[k].oct+">"+data[k].oc+"</li>";}';
    s = s+'list=list+"</ul></span></span></div></li>";';
    s = s+'});if(data===null || data.length===0){list="<div class=zeroelem> <div> <span>'+$(this).attr('zero')+'<span>'+$(this).attr('zval')+'</span> </span> </div> </div>";}';
    s = s+'$(".swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li.active > i").html("");';
    s = s+'if(tcount!=0){$(".swr-grupo .'+$(this).attr('side')+' > .tabs > ul > li.active > i").html("<i>"+tcount+"</i>");}';
    s = s+'$(".swr-grupo .'+$(this).attr('side')+' > .content > .list").html(list);lazyload();$("[data-toggle=tooltip]").tooltip();';
    s = s+'var sdr="'+$(this).attr('side')+'";if (sdr=="rside") {';
    s = s+'$(".swr-grupo .rside > .content .profile").hide();}';

    if ($(this).hasClass('dofirst')) {
        s = s+'$(".swr-grupo .'+$(this).attr('side')+' > .content > .list > li:first-child").trigger("click");';
        $(this).removeClass('dofirst');
    }

    if ($(this).attr('list') !== undefined) {
        s = s+'$(".swr-grupo .'+$(this).attr('side')+' > .content > .list > li[no='+$(this).attr('list')+']").trigger("click");';
        $(this).removeAttr('list');
    }

    if ($(this).attr('act') === 'groups' || $(this).attr('act') === 'online' || $(this).attr('act') === 'crew' || $(this).attr('act') === 'users') {
        s = s+'$(".swr-grupo .'+$(this).attr('side')+' > .content > .list > li[no="+$(".swr-grupo .panel").attr("no")+"]").addClass("active");';
        s = s+'$(function() { $(".'+$(this).attr('side')+' > .content > .list > li").sort(sort_li).appendTo(".'+$(this).attr('side')+' > .content > .list");';
        s = s+'function sort_li(a, b) { return ($(b).data("sort")) > ($(a).data("sort")) ? 1 : -1; } });';
        if ($(this).attr('openid') !== undefined) {
            s = s+'$(".swr-grupo .'+$(this).attr('side')+' > .content > .list > li[no='+$(this).attr('openid')+']").trigger("click");';
            $(this).removeAttr('openid');
        }

    }
    s = s+'$(".swr-grupo .'+$(this).attr('side')+' > .content > .list").fadeIn();';
    ajxx($(this), data, s, e);
});



$("body").on('mouseenter', '.swr-grupo .panel > .room > .msgs > li > div > .msg', function(e) {
    $('.swr-grupo .msgopt > ul').hide();
    autotimez('do', $(this).parent().parent());
    $(this).parent().parent().find('.msgopt i').hide();
    $(this).parent().parent().find('.msgopt ul').css('display', 'inline');
});

$("body").on('mouseleave', '.swr-grupo .panel > .room > .msgs > li > div > .msg', function(e) {
    $('.swr-grupo .msgopt > ul').hide();
});

$("body").on('mouseenter', '.swr-grupo .aside > .content > .list > li .opt', function(e) {
    $('.swr-grupo .opt > ul').hide();
    if ($(window).width() > 767.98) {
        $('.swr-grupo .opt > i').show();
    }
    $(this).find('i').hide();
    $(this).find('ul').css('display', 'inline');
});

$("body").on('mouseleave', '.swr-grupo .aside > .content > .list > li .opt', function(e) {
    if ($(window).width() > 767.98) {
        $('.swr-grupo .opt > i').show();
    }
    $('.swr-grupo .opt > ul').hide();
});

$('body').on('click', '.swr-grupo', function(e) {
    if (!$(e.target).parent().parent().hasClass('swr-menu') && !$(e.target).hasClass('subnav')) {
        if (!$(e.target).parent().hasClass('langswitch')) {
            $('.swr-menu').hide();

        }
    }
});

$('body').on('click', '.swr-grupo .panel > .room > .msgs > li > div i.usrnameno', function(e) {
    if ($(this).attr("mention") != 0 && $('.swr-grupo .panel').attr('ldt') != 'user') {
        var ta = $(".swr-grupo .panel > .textbox > .box > textarea").data("emojioneArea");
        if ($('.emojionearea > .emojionearea-editor:contains("'+$(this).attr("mention")+'")').length == 0) {
            ta.setText('@'+$(this).attr("mention")+ta.getText());
            $('.emojionearea > .emojionearea-editor').focus();
            placeCaretAtEnd($(".emojionearea > .emojionearea-editor").data("emojioneArea").editor[0]);
        }
    }
});
$('body').on('click', '.swr-grupo .loadgroup', function(e) {
    $(this).find('div > .center > u').hide();
    $('.swr-grupo .panel > .textbox').addClass('disabled');
    $('.swr-grupo .panel').attr('no', $(this).attr('no'));
    $('.swr-grupo .panel').attr('ldt', $(this).attr('ldt'));
    if ($(this).attr('ldt') == 'user') {
        $('.swr-grupo .panel > .head > .left > span').addClass('vwp');
        $('.swr-grupo .panel > .head > .left > span').attr('no', $(this).attr('no'));
        $('.swr-grupo .panel > .head > .right > .ti-view-grid').hide();
    } else {
        $('.swr-grupo .panel > .head > .left > span').removeClass('vwp');
        $('.swr-grupo .panel > .head > .right > .ti-view-grid').show();
    }
    loadgroup($(this).attr('no'), $(this));
    $(".swr-grupo .rside > .tabs > ul > li").eq(2).find('i').html("");
    $(".swr-grupo .rside > .tabs > ul > li").eq(2).attr('comp', 0);
    if ($(window).width() > 767.98) {
        $('.grtab.active').trigger("click");
    }
    $('.swr-grupo .aside > .content > .list > li').removeClass("active");
    $(this).addClass("active");
    if ($(window).width() <= 767.98) {
        $('.swr-grupo .lside').addClass('bwmob');
        if ($(this).hasClass('pm')) {
            $('.swr-grupo .rside').addClass('bwmob');
            $('.swr-grupo .rside').css('zIndex', 20);
            $('.swr-grupo .rside').removeClass('abmob');
            $('.swr-grupo .rside').animate({
                marginLeft: '800px'
            }, 500);
            setTimeout(function() {
                $('.swr-grupo .rside').addClass('nomob');
                $('.swr-grupo .rside').css('zIndex', 1);
            }, 800);
        } else {
            $('.swr-grupo .panel').css('margin-left', '800px');
        }
        setTimeout(function() {
            $('.swr-grupo .panel').removeClass('nomob');
            $('.swr-grupo .panel').addClass('abmob');
            $('.swr-grupo .panel').animate({
                marginLeft: '0px'
            }, 500);
        }, 200);
    }
    $('.emojionearea > .emojionearea-editor').focus();
});
$('body').on('click', '.swr-grupo .aside > .content > .list > li', function(e) {
    if ($(window).width() <= 767.98 && !$(this).hasClass('loadgroup')) {
        $('.swr-grupo .aside .opt > ul').hide();
        $(this).find('.opt > ul').css('display', 'inline');
    }
});
$('body').on('click', '.swr-grupo .panel > .room > .msgs > li', function(e) {
    if ($(window).width() <= 767.98) {
        $('.swr-grupo .msgopt > ul').hide();
        $(this).find('.msgopt > ul').css('display', 'inline');
    }
});

$('body').on('click', '.swr-grupo .mbopen', function(e) {
    if ($(window).width() <= 767.98 && !$(this).hasClass('loadgroup')) {
        if ($(this).attr('data-block') == 'panel' && $('.swr-grupo .panel').attr('no') != 0) {
            $('.swr-grupo .lside').addClass('bwmob');
            $('.swr-grupo .panel').css('margin-left', '800px');
            setTimeout(function() {
                $('.swr-grupo .panel').removeClass('nomob');
                $('.swr-grupo .panel').addClass('abmob');
                $('.swr-grupo .panel').animate({
                    marginLeft: '0px'
                }, 500);
            }, 200);
        } else if ($(this).attr('data-block') == 'rside') {
            $('.swr-grupo .lside .opt > ul').hide();
            $('.swr-grupo .rside > .top > .left > .icon').attr('data-block', $(this).attr('data-block'));
            $('.swr-grupo .lside,.swr-grupo .panel').addClass('bwmob');
            $('.swr-grupo .rside').css('margin-left', '800px');
            $('.grtab').addClass('d-none');
            setTimeout(function() {
                $('.swr-grupo .rside').removeClass('nomob');
                $('.swr-grupo .rside').addClass('abmob');
                $('.swr-grupo .rside').animate({
                    marginLeft: '0px'
                }, 500);
            }, 200);
        }
    }
});

$('body').on('click', '.swr-grupo .standby', function() {
    $.when($('.swr-grupo > .window').fadeOut())
    .then(function() {
        $('.grupo-standby').fadeIn();
    });

});
$('body').on('click', '.grupo-standby', function() {
    $.when($('.grupo-standby').fadeOut())
    .then(function() {
        $('.swr-grupo > .window').fadeIn();
    });

});

$('body').on('click', '.swr-grupo .goback', function(e) {
    if ($(window).width() <= 767.98) {
        $('.swr-grupo .lside .opt > ul').hide();

        var block = $(this).attr('data-block');
        if (block == 'alerts' || block == 'rside') {
            $('.swr-grupo .rside').animate({
                marginLeft: '800px'
            }, 200);
            setTimeout(function() {
                $('.swr-grupo .rside').addClass('nomob');
                $('.swr-grupo .rside').removeClass('abmob');
                $('.swr-grupo .lside').removeClass('bwmob');
            }, 600);
        } else if (block == 'crew') {
            $('.swr-grupo .rside').animate({
                marginLeft: '800px'
            }, 200);
            setTimeout(function() {
                $('.swr-grupo .rside').addClass('nomob');
                $('.swr-grupo .rside').removeClass('abmob');
                $('.swr-grupo .panel').removeClass('bwmob');
                $('.swr-grupo .panel').addClass('abmob');
            }, 200);
        } else {
            $(".swr-grupo .panel > .textbox").addClass('disabled');
            $('.swr-grupo .panel').animate({
                marginLeft: '800px'
            }, 200);
            setTimeout(function() {
                $('.swr-grupo .panel').addClass('nomob');
                $('.swr-grupo .panel').removeClass('abmob');
                $('.swr-grupo .lside').removeClass('bwmob');
            }, 200);
            if (block == 'files') {
                $('.swr-grupo .lside > .tabs > ul > li[act=files]').trigger('click');
            }
        }
    }
});


$(".swr-grupo .panel > .textbox > .box > textarea").blur(function() {
    if ($(window).width() <= 767.98) {
        setTimeout(function() {}, 200);
    }
});
$('body').on('click', '.swr-grupo .goright', function(e) {
    $('.swr-grupo .lside .opt > ul').hide();
    $('.swr-grupo .rside > .top > .left > .icon').attr('data-block', $(this).attr('data-block'));
    $('.swr-grupo .lside,.swr-grupo .panel').addClass('bwmob');
    $('.swr-grupo .rside').css('margin-left', '800px');
    if ($(this).attr('data-block') == 'crew') {
        $('.swr-grupo .lside,.swr-grupo .panel').removeClass('abmob');
        $('.swr-grupo .rside > .tabs > ul > li').eq(1).trigger('click');
        $('.grtab').removeClass('d-none');
    } else {
        $('.grtab').addClass('d-none');
        $(".swr-grupo .aside > .head > .icons > i.malert").html("");
        $('.swr-grupo .rside > .tabs > ul > li').eq(0).trigger('click');
    }
    setTimeout(function() {
        $('.swr-grupo .rside').removeClass('nomob');
        $('.swr-grupo .rside').addClass('abmob');
        $('.swr-grupo .rside').animate({
            marginLeft: '0px'
        }, 500);
    }, 200);
});

$('.swr-grupo .aside > .head > .logo').on('click', function() {
    location.reload();
});

$('body').on('click', '.swr-grupo .panel > .room > .msgs > li > div > .msg > i > span.block > i', function(e) {
    var data = {
        act: 1,
        do: $(this).parent().attr('type'),
        type: $(this).parent().attr('act'),
        gid: $('.swr-grupo .panel').attr('no'),
        id: $(this).parent().attr('no'),
        ldt: $('.swr-grupo .panel').attr('ldt'),
    };
    ajxx($(this), data, '', e);
});

$('body').on('click', '.swr-grupo .opt > ul > li', function(e) {
    if (!$(this).hasClass('formpop') && !$(this).hasClass('paj') && !$(this).hasClass('vwp')) {
        $(this).attr('type', 'html');
        var data = {
            act: 1,
            do: $(this).parent().parent().attr('type'),
            type: $(this).attr('act'),
            gid: $('.swr-grupo .panel').attr('no'),
            id: $(this).parent().parent().attr('no'),
            ldt: $('.swr-grupo .panel').attr('ldt'),
        };
        data = $.extend(data, $(this).data());
        var s = '';
        if (data['do'] === 'group' && data['type'] === 'msgs') {
            $(this).attr('type', 'json');
            s = 'loadmsg(data,1);';
        }
        data = $.extend(data, $(this).data());
        ajxx($(this), data, s, e);
    }
});
function menuclick(c, i) {
    $('.'+c+' > .swr-menu > ul > li[act="'+i+'"]').trigger('click');
    $('.'+c+' > .swr-menu').hide();
}
function loadgroup($id, e ,ldt) {
    console.log("loadgroup:");
    console.log(ldt);
    e.attr('type', 'json');
    e.attr('turn', 'on');
    var ldt = (typeof ldt == 'undefined') ? e.attr('ldt') : ldt;
    var data = {
        act: 1,
        do: "group",
        type: 'msgs',
        id: $id,
        ldt: (typeof ldt !== 'undefined') ?  ldt : 'ldt'
    };
    var s = 'loadmsg(data,1);';
    s = s+'$(".swr-grupo .groupnav > .left > span > img").attr("src", data[0].pnimg);';
    s = s+'$(".swr-grupo .groupnav > .left > span > span").html(data[0].pntitle+"<span>"+data[0].pnsub+"</span>");';
    s = s+'if(data[0].blocked==1 || data[0].deactiv==1){$(".swr-grupo .panel > .textbox").addClass("animated slideOutDown");';
    s = s+'$(".swr-grupo .panel > .head > .left > span").removeClass("vwp");}else{';
    s = s+'$(".swr-grupo .panel > .textbox").removeClass("animated slideOutDown");}';
    s = s+'$(".swr-grupo .panel > .textbox").removeClass("disabled");';
    s = s+'$(".swr-grupo .panel .swr-menu > ul").html("");';
    s = s+'$.each(data[1], function(k, v) {';
    s = s+'$(".swr-grupo .panel .swr-menu > ul").append("<li "+v[1]+">"+v[0]+"</li>");';
    s = s+'});';
    ajxx(e, data, s, e);
    $('.groupreload').fadeOut();
    $('.swr-grupo .panel > .textbox,.swr-grupo .groupnav').removeClass('d-none');
    $('.grtab').addClass('d-none');
    if ($('.swr-grupo .panel').attr('ldt') != 'user') {
        $('.grtab').removeClass('d-none');
    }
}

$('body').on('click', '.swr-grupo .panel > .room > .msgs > li > div > .msg > i > i.rply > i', function() {
    var id = $(this).attr('no');
    var el = $(".swr-grupo .panel > .room > .msgs > li[no="+id+"]");
    var scr = $(".swr-grupo .panel > .room > .msgs > li:nth-child("+el.index()+")")[0].offsetTop - $(".swr-grupo .panel > .room > .msgs")[0].offsetTop;
    $(".swr-grupo .panel > .room > .msgs").animate({
        scrollTop: scr
    }, 1000);
    el.addClass('highlight');
    setTimeout(function() {
        el.removeClass('highlight');
    }, 3000);
});


function scrollmsgs() {
    $(".swr-grupo .panel > .room > .msgs").animate({
        scrollTop: $(".swr-grupo .panel > .room > .msgs").prop("scrollHeight")}, 1000);
}
function lazyload() {
    $('img').each(function() {
        if ($(this).attr('loadimg') !== undefined) {
            $(this).attr('src', $(this).attr('loadimg'));
            $(this).removeAttr('loadimg');
            $(this).load(function() {
                $(this).parent().addClass('imgld');
            });
        }
    });
}
$('.swr-grupo .sendbtn').on('click', function(e) {
    var msgd = $(".swr-grupo .panel > .textbox > .box > textarea").data("emojioneArea").getText();
    if ($.trim(msgd) != '') {
        $(this).attr('spin', 'off');
        $(this).attr('type', 'json');
        $(this).attr('turn', 'on');
        var data = {
            act: 1,
            do: "group",
            type: 'sendmsg',
            msg: $(".swr-grupo .panel > .textbox > .box > textarea").data("emojioneArea").getText(),
            rid: $('.swr-grupo .panel > .textbox .replyid').val(),
            id: $('.swr-grupo .panel').attr('no'),
            ldt: $('.swr-grupo .panel').attr('ldt'),
            from: $('.swr-grupo .panel > .room > .msgs > li:last-child').attr('no'),
        };
        $(".swr-grupo .panel > .textbox > .box > textarea").data("emojioneArea").setText('');
        $(".swr-grupo .panel > .textbox .replyid").val(0);
        $(".swr-grupo .panel > .room > .msgs > li").removeClass("selected");
        var s = 'if($(".swr-grupo .panel").attr("no")==data[2].gid){loadmsg(data);}';
        ajxx($(this), data, s, e);
    }
    $('.emojionearea > .emojionearea-editor').focus();
});

function loadmsg(d, n) {
if (n == undefined) {
        n = 0;
    }
    if (n == 1) {
        $(".swr-grupo .panel > .room > .msgs").html('');
    }
    var oldmsg = '';
    $.each(d, function(k, v) {
        if (k !== 0 && k !== 1) {
            var m = d[k];
            if (m.id === undefined) {
                m = d;
            }
            var msg = '<li class="'+m.send+'" no="'+m.id+'"> <div>';
            msg = msg+'<i class="status '+m.status+'"></i><span class="img">';
            if (m.status == 'deactivated') {
                msg = msg+'<img no="'+m.userid+'" loadimg="'+m.img+'"> </span>';
            } else {
                msg = msg+'<img class="vwp" no="'+m.userid+'" loadimg="'+m.img+'"> </span>';
            }
            msg = msg+'<span class="msg"><i>';
            if (m.type === 'msg' || m.type === 'system') {
                if (m.rid != 0) {
                    msg = msg+'<i class="rply"><i no="'+m.rid+'"><i>'+m.rusr+'</i>'+emojione.shortnameToImage(asciiemoji(url2link(m.reply)))+'</i></i>';
                }
                msg = msg+'<i class="usrname vwp" no="'+m.userid+'" mention="'+m.user+' ">'+m.name+'</i>'+emojione.shortnameToImage(asciiemoji(url2link(m.msg)));
            } else if (m.type === 'file') {
                msg = msg+'<i class="usrname" mention="'+m.user+' ">'+m.name+'</i><span class="block" type="files" act="download" data-filename="'+m.filename+'"  data-typefile="'+m.typefile+'" no="'+m.msg+'">';
                msg = msg+'<span>'+m.sfile+' <span></span></span> <i>View</i> </span>';
            }
            msg = msg+'</i><span class="time">';

            if ($('.swr-grupo .panel').attr('ldt') == 'group' && d[0]['viewlike'] == 1) {
                var lksy = 'enabled';
                if (d[0]['likemsgs'] != 'enabled') {
                    lksy = 'say disabled';
                }
                msg = msg+'<i class="likes '+lksy+'" say="'+d[0]['likemsgs']+'" type="e"><b>'+m.lvn+'</b><i class="'+m.lvc+'"></i></i>';
            }
            msg = msg+'<span title="'+m.date+'" data-toggle="tooltip">'+m.date+' '+m.time+'</span><span class="msgopt"><ul>';

            if (m.type != 'system' && m.tmrdel != 0) {
                msg = msg+'<li class="autodel" timer="'+m.tmrdel+'">0m 0s</li>';
            }
            if (m.opta != 0) {
                msg = msg+'<li '+m.optda+'>'+m.opta+'</li>';
            }
            msg = msg+'<li '+m.optdb+'>'+m.optb+'</li>';
            msg = msg+'</ul></span> </li>';
            if (n == 2) {
                oldmsg = oldmsg+msg;
            } else {
                $('.swr-grupo .panel > .room > .msgs').append(msg);
            }
            if (d.length === undefined) {
                return false;
            }
        }
    });
    if (n == 2) {
        $(".swr-grupo .panel > .room > .msgs").prepend(oldmsg);
        $(".swr-grupo .panel > .room > .msgs").scrollTop(10);
    } else {
        setTimeout(
            function() {
                if (!$(".swr-grupo .panel > .textbox").hasClass('disabled')) {} else {}
            }, 200);
        if (!$(".swr-grupo .panel > .room > .msgs").hasClass('noscroll')) {
            scrollmsgs();
        }
    }
    lazyload();
    if (!$('.swr-grupo .panel > .room > .msgs > li').last().hasClass('you')) {
        if (!$('.swr-grupo .panel > .textbox').hasClass('disabled')) {
            $("#gralert")[0].play();
        }
    }
    $('[data-toggle="tooltip"]').tooltip();
}


var autodelinterval;
function autotimez($do, $elem) {
if ($do == undefined) {
        $do = 'do';
    }
    if ($do == 'reset') {
        clearInterval(autodelinterval);
    } else {
        clearInterval(autodelinterval);
        if ($elem.find('.autodel').attr("timer") != 0) {
            autodelinterval = setInterval(function() {
                if (!$elem.hasClass('system')) {
                    var countDownDate = new Date($elem.find('.autodel').attr("timer")).getTime();
                    var now = new Date().getTime();
                    var distance = countDownDate - now;
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    var outp = '';
                    if (days != 0) {
                        outp = outp+days+"d ";
                    }
                    if (hours != 0) {
                        outp = outp+hours+"h ";
                    }
                    if (minutes != 0) {
                        outp = outp+minutes+"m ";
                    }
                    if (seconds != 0) {
                        outp = outp+seconds+"s";
                    }
                    if (distance < 0) {
                        $elem.find('.autodel').html("0m 0s");
                        clearInterval(autodelinterval);
                        $elem.fadeOut();
                    } else {
                        $elem.find('.autodel').html(outp);
                    }

                }
            }, 1000);
        }
    }

}

$('body').on('click', '.swr-grupo .msgopt > ul > li.run', function(e) {
    $(this).attr('spin', 'off');
    $(this).attr('turn', 'on');
    var data = {
        act: 1,
        do: "group",
        type: $(this).attr('do'),
        mid: $(this).parents('li').attr('no'),
        id: $('.swr-grupo .panel').attr('no'),
        ldt: $('.swr-grupo .panel').attr('ldt'),
    };
    ajxx($(this), data, '', e);
});




$('.swr-grupo .uploadfiles > input').change(function(e) {
    if ($(this).prop('files').length > 0) {
        $(this).attr('form', '.uploadfiles');
        var data = new FormData($(".swr-grupo .uploadfiles")[0]);
        var files = $(".swr-grupo .uploadfiles > input").get(0).files;
        for (var i = 0; i < files.length; i++) {
            data.append("ufiles["+i+"]", files[i]);
        }

        ajxx($(this), data, '', e);
    }
    $(this).val('');
});

$('.swr-grupo .attachfile').change(function(e) {
    if ($(this).prop('files').length > 0) {
        $(this).attr('form', '.atchmsg');
        $('.swr-grupo .atchmsg').find('.gid').val($('.swr-grupo .panel').attr('no'));
        $(".swr-grupo .panel > .textbox .replyid").val(0);
        $('.swr-grupo .panel > .room > .msgs > li').removeClass('selected');
        var s = 'if($(".swr-grupo .panel").attr("no")==data[0].gid){loadmsg(data);}';
        var data = new FormData($(".swr-grupo .atchmsg")[0]);
        var files = $(".swr-grupo .atchmsg > input.attachfile").get(0).files[0];
        data.append("attachfile", files);
        data.append("from", $('.swr-grupo .panel > .room > .msgs > li:last-child').attr('no'));
        data.append("ldt", $('.swr-grupo .panel').attr('ldt'));
        $(this).attr('type', 'json');
        ajxx($(this), data, s, e);
    }
    $('.swr-grupo .attachfile').val('');
    $(this).attr('type', 'file');
});

$('.swr-grupo .panel > .textbox > .box > textarea').on('keypress', function(e) {
    if (e.which == 13) {
        if (!e.shiftKey) {
            e.preventDefault();
            $('.swr-grupo .sendbtn').trigger('click');
        }
    }
});


$('body').on('click keyup', '.emojionearea-editor', function(e) {
    if ($('.swr-grupo .panel').attr('ldt') != 'user') {
        textAreaAdjust($(this), 190);
        var el = document.getElementById("test");
        var caretPosEl = document.getElementById("caretPos");
        var el = $(".emojionearea-editor").get(0);
        var result = /\S+$/.exec(this.innerHTML.slice(0, getCaretPosition(el)));
        result = $.trim(result);

        $('.emojionearea-editor').attr('inx', getCaretPosition(el));
        var memser = '';
        if (result.indexOf("@") >= 0) {
            memser = result;
        }

        $(".swr-grupo .panel > .textbox > .mentions").hide();
        if (memser != '' && memser.length > 1) {
            var data = {
                act: 1,
                do: "list",
                type: 'memsearch',
                ser: memser,
                gid: $('.swr-grupo .panel').attr('no'),
            };
            $(".swr-grupo .panel > .textbox > .mentions > input").val(memser);
            $.post("", data, function(data) {
                var data = $.parseJSON(data);
                console.log("parseJSON");
                console.log(data);
                $(".swr-grupo .panel > .textbox > .mentions > ul").html("");
                $.each(data, function(k, v) {
                    $(".swr-grupo .panel > .textbox > .mentions > ul").append("<li> <img src="+data[k].img+"><span>"+data[k].name+"<i>@"+data[k].uname+"</i> </span> </li>");
                });
                if (data.length > 0) {
                    $(".swr-grupo .panel > .textbox > .mentions").fadeIn();
                }
            });
        } else {
            $(".swr-grupo .panel > .textbox > .mentions").hide();
        }
    } else {
        $(".swr-grupo .panel > .textbox > .mentions").hide();
    }
});

$('body').on('click', '.swr-grupo .panel > .textbox > .mentions > ul > li', function() {
    var a = $(".swr-grupo .panel > .textbox > .mentions > input").val();
    var b = $(this).find('span > i').text();
    var c = b.replace(a, "");
    var el = $(".emojionearea-editor").get(0);
    var $txt = jQuery(".emojionearea-editor");
    var caretPos = $('.emojionearea-editor').attr('inx');
    var textAreaTxt = $txt.html();
    var chars = parseInt(caretPos)+parseInt(c.length);
    $txt.html(textAreaTxt.substring(0, caretPos) + c + textAreaTxt.substring(caretPos));
    $(".swr-grupo .panel > .textbox > .mentions").hide();
    if (chars >= 0) {
        var selection = window.getSelection();

        range = createRange($(".emojionearea-editor")[0].parentNode, {
            count: chars
        });

        if (range) {
            range.collapse(false);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    }
});


function createRange(node, chars, range) {
    if (!range) {
        range = document.createRange();
        range.selectNode(node);
        range.setStart(node, 0);
    }

    if (chars.count === 0) {
        range.setEnd(node, chars.count);
    } else if (node && chars.count > 0) {
        if (node.nodeType === Node.TEXT_NODE) {
            if (node.textContent.length < chars.count) {
                chars.count -= node.textContent.length;
            } else {
                range.setEnd(node, chars.count);
                chars.count = 0;
            }
        } else {
            for (var lp = 0; lp < node.childNodes.length; lp++) {
                range = createRange(node.childNodes[lp], chars, range);

                if (chars.count === 0) {
                    break;
                }
            }
        }
    }

    return range;
};


$('body').on('keypress', '.emojionearea-editor', function(e) {
    if (e.which == 13) {
        if (!e.shiftKey) {
            e.preventDefault();
            $('.swr-grupo .sendbtn').trigger('click');
        }
    }
});

$('.swr-grupo .subnav').on('click', function() {
    if ($(this).find(".swr-menu").is(':visible')) {
        $(this).find(".swr-menu").hide();
    } else {
        $('.swr-grupo .swr-menu').hide();
        $(this).addClass('active');
        $(this).find(".swr-menu").fadeIn();
    }
});

$('.grupo-pop > div > form > span.cancel').on('click', function(e) {
    $(".grupo-pop").fadeOut();
});

$('body').on('click', '.grupo-pop > div > form > .fields > span.fileup > span', function() {
    $(this).parent().find('input').trigger('click');
});

$('body').on('click', '.swr-grupo .panel > .room > .msgs > li.selected', function() {
    $('.swr-grupo .panel > .room > .msgs > li').removeClass('selected');
    $('.swr-grupo .panel > .textbox .replyid').val(0);
    $('.emojionearea > .emojionearea-editor').focus();
});

$('body').on('click', '.swr-grupo .msgopt > ul > li.reply', function() {
    var id = $(this).parents('li').attr('no');
    $('.swr-grupo .panel > .room > .msgs > li').removeClass('selected');
    $(this).parents('li').addClass('selected');
    $('.swr-grupo .panel > .textbox .replyid').val(id);
    $('.emojionearea > .emojionearea-editor').focus();
});

$("body").on("contextmenu", "img", function(e) {
    return false;
});
$('body').on('click', '.grupo-pop > div > form > div > .imglist > li', function(e) {
    $('.grupo-pop > div > form > div > .imglist > li').removeClass('active');
    $(this).find('input').prop("checked", true);
    $(this).addClass('active');
});

function getDataUser(id){
    var getData = $.ajax({
        url: 'door/grform/main.php',
        data: JSON.stringify( {method:'getDataUser',id:id} ),
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


function onClickFormUpdateUserProfile(event){
    if($("#txtProfilePassword").val()!=='' || $("#txtProfileRepeatPassword").val()!==''){
        if(!checkPassword($("#txtProfilePassword").val())) {
            say("Password must be between 8 and 16 characters, at least one number, one lowercase and one uppercase letter.","s");
            $("#txtProfilePassword").focus();
            return false;
        }
        if(!validatePasswords($("#txtPassword").val(),$("#txtRepeatPassword").val())){
            say("The given passwords do not match","s");
            return false;
        }    
    }
    var phone    = $("#selProfileComplementPhone").val()+$("#txtProfilePhoneNumber").val();
    var username = $("#txtProfileUsername").val().split("@")[0];
    var payload = {
        method          : "updateUser",
        name            : $("#txtProfileName").val() ,
        lastname        : $("#txtProfileLastName").val(),
        phone           : phone,
        email           : $("#txtProfileEmail").val(),
        username        : username, 
        password        : $("#txtProfilePassword").val(), 
        address         : $("#txtProfileAddress").val(), 
        zipcode         : $("#txtProfileZipCode").val(), 
        id              : parseInt($("#txtProfileIdUser").val()),
        changePassword  : ($("#txtProfilePassword").val()!=='')?true:false
    };
       $.ajax({
          type: "POST",
          contentType: "application/json",
          processData: false,
          url: 'door/grform/main.php',
          data: JSON.stringify(payload), 
          success: function(data){
           $.loadingBlockHide();
           if(data.error){
               say(data.message,"s");
           }else{
               $("#txtProfileName").val("");
               $("#txtProfileLastName").val("");
               $("#txtProfileEmail").val("");
               $("#txtProfilePassword").val("");
               $("#txtProfileRepeatPassword").val("");
               $("#txtProfileAddress").val("");
               $("#txtProfileZipCode").val("");
               $("#txtProfileIdUser").val("");
               $("#selProfileComplementPhone").val("+1");
               say(data.message,"s");
               onClickCancelProfileUser();
           }
          },
          error : function(err){
            say("Please try again","s");
             $.loadingBlockHide();
          }
        });
}


function onClickInvite(event){
    var listUsers = [];
    var nameGroup = $(".nameGroup").parent().text().trim();
    if(!clickSwitchInvite){
        $("#ulListUsers li").each(function( index ) {
            if($(this).attr('class').includes('active')){
                var data = JSON.parse($(this).attr('data'));
                listUsers.push(data);
            }
        });
        listUsers.forEach( function(value, index, array) {
            console.log("value:");
            console.log(value);
            sendSMSInvite(value);
        });

    }else{
        if($("#txtProfilePhoneNumberInvite").val()=="") {
                say("the phone is requited","s");
                $("#txtProfilePhoneNumberInvite").focus();
                return false;
        }
        if($("#txtProfilePhoneNumberInvite").val().length != 10) {
                say("Invalid length of phone number","s");
                $("#txtProfilePhoneNumberInvite").focus();
                return false;
        }
        var phone = $("#selProfileComplementPhoneInvite").val()+$("#txtProfilePhoneNumberInvite").val();
        var getData = getDataUserByPhone( phone ); 
        if(!getData.exist){
            say("the phone number: "+phone+" doesn't exist." ,"s");
            return false;
        }
        console.log(getData.data);
        sendSMSInvite(getData.data);
    }
    say("Invitation sent." ,"s");
    $("#modalInvite").fadeOut();
}


function sendSMSInvite(data){
    var getData = $.ajax({
        url: 'https://c4ymficygk.execute-api.us-east-1.amazonaws.com/dev/sendsms',
        data: JSON.stringify( { "sms" : '', "type" : "invite" , phone : data.phone } ),
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
    return JSON.parse(getData);
}

$('body').on('click', '.formpop', function(e) {
    console.log('outerText:'+e.target.outerText);
    console.log('id:'+$(this).attr('no'));
     switch(e.target.outerText){
        case "Create User":
             $("#modalCreateUser").fadeIn();
             return false;
         break;
         case "Create Group":
             $("#modalCreateGroup").fadeIn();
             return false;
         break;
         case "Act":
             window.idUserSelectedAct = $(this).attr('uid');
             $("#modalTakeAction").fadeIn();
             return false;
         break;
         case "Edit Profile":
            if($(this).parent().prevObject[0].dataset.no !=undefined){
                var id = $(this).parent().prevObject[0].dataset.no;                
                var dataUser = getDataUser( id );
                $("#txtProfileIdUser").val(id);
            }else{
                var dataUser = getDataUser( $("#global_id_user").val() );
                $("#txtProfileIdUser").val(dataUser.data.id);
            }
            
            if(!dataUser.error){
                
                $("#txtProfileName").val(dataUser.data.name);
                $("#txtProfileLastName").val(dataUser.data.lastname);
                $("#txtProfileAddress").val(dataUser.data.address);
                $("#txtProfileZipCode").val(dataUser.data.zipcode);
                if(dataUser.data.phone.substring(0, 2)=='+1'){
                    $("#selProfileComplementPhone").val('+1');
                    $("#txtProfilePhoneNumber").val(dataUser.data.phone.substring(2));
                
                }else{
                    $("#selProfileComplementPhone").val(dataUser.data.phone.substring(0, 3));
                    $("#txtProfilePhoneNumber").val( dataUser.data.phone.substring(3) );
                }
                $("#txtProfileUsername").val(dataUser.data.username);
                $("#txtProfileEmail").val(dataUser.data.email);

                $("#txtProfileEmail").attr('disabled','disabled');
                $("#txtProfileEmail").css({'background-color':'gray'});
                $("#txtProfileEmail").css({'color':'black'});
                $("#txtProfileUsername").attr('disabled','disabled');
                $("#txtProfileUsername").css({'background-color':'gray'});
                $("#txtProfileUsername").css({'color':'black'});
                $("#txtProfilePhoneNumber").attr('disabled','disabled');
                $("#txtProfilePhoneNumber").css({'background-color':'gray'});
                $("#txtProfilePhoneNumber").css({'color':'black'});
                $("#selProfileComplementPhone").attr('disabled','disabled');
                $("#selProfileComplementPhone").css({'background-color':'gray'});
                $("#selProfileComplementPhone").css({'color':'black'});


                $("#modalEditProfile").fadeIn();
            }
            return false;
         break;
         case "Invite":
             $("#modalInvite").fadeIn();
             return false;
         break;
     }

    $(this).attr('type', 'json');
    $(this).attr('turn', 'off');
    id = $(this).attr('no');
    if ($(this).attr('pn') == 1) {
        id = $('.swr-grupo .panel').attr('no');
    } else if ($(this).attr('pn') == 2) {
        id = $(this).parent().parent().attr('no');
    } else if ($(this).attr('pn') == 3) {
        id = $(this).parents('li').attr('no')
    }
    var data = {
        act: 1,
        do: "form",
        type: $(this).attr('do')+$(this).attr('act'),
        id: id,
        ldt: $('.swr-grupo .panel').attr('ldt'),
        xtid: $(this).attr('xtid'),
    };
    data = $.extend(data, $(this).data());
    var s = '$(".grupo-pop").fadeIn();var fd="";';
    s = s+'$(".grupo-pop .head").text("'+$(this).attr('title')+'");';
    s = s+'$(".grupo-pop .grsub").val("'+$(this).attr('btn')+'");';
    s = s+'$(".grupo-pop .grdo").val("'+$(this).attr('do')+'");';
    s = s+'$(".grupo-pop .grtype").val("'+$(this).attr('act')+'");';
    s = s+'$.each(data, function(k, v) {var ab=ac="";if(v[1]!=undefined && v[1].indexOf(":") != -1){ab=v[1].split(":")[1]; ac=v[1].split(":")[2]; v[1]=v[1].split(":")[0];}';
    s = s+'if(v[2]==="hidden"){fd=fd+"<input type="+v[2]+" value="+htmlDecode(v[3])+" name="+k+" class='+"'"+'"+ab+" "+ac+"'+"'"+' autocomplete=dsb>"}';
    s = s+'else if(v[2]==="disabled" && v[1]==="textarea"){fd=fd+"<label>"+v[0]+"</label><textarea disabled name="+k+" class="+ab+" "+ac+">"+htmlDecode(v[3])+"</textarea>"}';
    s = s+'else if(v[2]==="disabled"){fd=fd+"<label>"+v[0]+"</label><input type=text value="+htmlDecode(v[3])+" disabled name="+k+" class='+"'"+'"+ab+" "+ac+"'+"'"+' autocomplete=dsb>"}';
    s = s+'else if(v[4]!==undefined && v[1]==="checkbox"){ fd=fd+"<label>"+v[0]+"</label><div class=checkbox>"; var ov=v[4].split(",");var ch=v[2].split(",");var cv=v[3].split(",");$.each(ch, function(ke, va) { fd=fd+"<span><input type="+v[1];if(jQuery.inArray(cv[ke], ov) != -1) {fd=fd+" checked ";}fd=fd+" name="+k+"[] value="+htmlDecode(cv[ke])+">"+va+"</span>"; }); fd=fd+"</div>";}';
    s = s+'else if(v[1]==="checkbox"){ fd=fd+"<label>"+v[0]+"</label><div class=checkbox>"; var ch=v[2].split(",");var cv=v[3].split(",");$.each(ch, function(ke, va) { fd=fd+"<span><input type="+v[1]+" name="+k+"[] class='+"'"+'"+ab+" "+ac+"'+"'"+' value="+htmlDecode(cv[ke])+">"+va+"</span>"; }); fd=fd+"</div>";}';
    s = s+'else if(v[1]==="radio"){ fd=fd+"<label>"+v[0]+"</label><div class=checkbox>"; var ch=v[2].split(",");var cv=v[3].split(",");$.each(ch, function(ke, va) { fd=fd+"<span><input type="+v[1]+" name="+k+" value="+htmlDecode(cv[ke])+" class="+ab+" "+ac+">"+va+"</span>"; }); fd=fd+"</div>";}';
    s = s+'else if(v[2]==="file"){fd=fd+"<label>"+v[0]+"</label><span class=fileup><input type="+v[2]+" name="+k+" class='+"'"+'"+ab+" "+ac+"'+"'"+' autocomplete=dsb><span>"+data["choosefiletxt"][0]+"</span></span>"}';
    s = s+'else if(v[4]!==undefined && v[1]==="input"){fd=fd+"<label>"+v[0]+"</label><input type="+v[2]+" class="+ab+" "+ac+" placeholder="+v[4]+" name='+"'"+'"+k+"'+"'"+' autocomplete=dsb>"}';
    s = s+'else if(v[3]!==undefined && v[1]==="input" && v[2]==="colorpick"){fd=fd+"<label>"+v[0]+"</label><input type=text class=colorpick value="+v[3]+" name="+k+" class='+"'"+'"+ab+" "+ac+"'+"'"+' autocomplete=dsb>"}';
    s = s+'else if(v[3]!==undefined && v[1]==="input"){fd=fd+"<label>"+v[0]+"</label><input type="+v[2]+" value="+htmlDecode(v[3])+" name="+k+" class='+"'"+'"+ab+" "+ac+"'+"'"+' autocomplete=dsb>"}';
    s = s+'else if(v[3]!==undefined && v[1]==="textarea"){fd=fd+"<label>"+v[0]+"</label><textarea name="+k+" class="+ab+" "+ac+">"+htmlDecode(v[3])+"</textarea>"}';
    s = s+'else if(v[3]!==undefined && v[1]==="span"){fd=fd+"<label>"+v[0]+"</label><span name="+k+" class="+ab+" "+ac+">"+v[3]+"</span>"}';
    s = s+'else if(v[1]==="textarea"){fd=fd+"<label>"+v[0]+"</label><textarea name="+k+" class="+ab+" "+ac+"></textarea>"}';
    s = s+'else if(v[1]==="input"){fd=fd+"<label>"+v[0]+"</label><input type="+v[2]+" name="+k+" class='+"'"+'"+ab+" "+ac+"'+"'"+' autocomplete=dsb>"}';
    s = s+'else if(v[1]==="select"){fd=fd+"<label>"+v[0]+"</label><select name="+k+" class="+ab+" "+ac+">";';
    s = s+'if(jQuery.type(v[2])=="object"){';
    s = s+'fd=fd+"<option value=0>------</option>";';
    s = s+'$.each(v[2] , function(index, val) {var sel="";if(index==v[3]){sel="selected";} fd=fd+"<option "+sel+" value="+index+">"+htmlDecode(val)+"</option>";});';
    s = s+'}else{';
    s = s+'for(i=2;i<v.length;i++){fd=fd+"<option value="+v[i]+">"+v[i+1]+"</option>";i=i+1;}}';
    s = s+'fd=fd+"</select>"}';
    s = s+'else if(v[1]==="tmz"){fd=fd+"<label>"+v[0]+"</label><select name="+k+" class="+ab+" "+ac+"><option value=0>------</option>";';
    s = s+'var tm=v[2].split(",");for(i=0;i<tm.length;i++){var sel="";if(tm[i]==v[3]){sel="selected";}fd=fd+"<option "+sel+" value="+tm[i]+">"+htmlDecode(tm[i])+"</option>";}';
    s = s+'fd=fd+"</select>"}';
    s = s+'else if(v[1]==="imglist"){fd=fd+"<label>"+v[0]+"</label><ul class=imglist>";';
    s = s+'if(jQuery.type(v[2])=="object"){';
    s = s+'$.each(v[2] , function(index, val) { fd=fd+"<li><input type=radio name="+k+" value="+index+"><img src="+val+"/></li>";});}';
    s = s+'fd=fd+"</ul>";}';
    s = s+'});';
    s = s+'$(".grupo-pop .fields").html(fd);textAreaAdjust($(".grupo-pop > div > form > div > textarea"), 300);$(".imglist img").load(function() {$(".grupo-pop > div > form > div").getNiceScroll().onResize();});$(".grupo-pop > div > form > .fields > span.fileup > input").hide();$(".colorpick").colorpicker();';
    s = s+'$(".grupo-pop > div > form > div > textarea").niceScroll({ cursorwidth: 8, cursoropacitymin: 0.4, cursorcolor: "#d4d4d4", cursorborder: "none", cursorborderradius: 4, autohidemode: "leave", horizrailenabled: false });';
    ajxx($(this), data, s, e);

});

$(document).ready(function(e) {
    if ($('.lside .ti-plus .swr-menu > ul > li').length === 0) {
        $('.lside .ti-plus').hide();
    }
    $('[data-toggle="tooltip"]').tooltip();
    window.emojioneVersion = "4.5.0";
    $(".swr-grupo .panel > .textbox > .box > textarea").emojioneArea({

        pickerPosition: "top",
        tonesStyle: "radio",
        search: false,
        autocomplete: false,
        hidePickerOnBlur: true,
        saveEmojisAs: "shortname",

    });

    $('.gr-emoji').on('click', function () {
        $('.emojionearea-button').click()
    });
    if(sessionStorage.getItem("ldt") != null && sessionStorage.getItem("idchat") != null){
        console.log("execute if");
       /* sessionStorage.removeItem("ldt");*/
       /* sessionStorage.removeItem("idchat");*/

       if(sessionStorage.getItem("ldt")=='group'){
       /* $("#group"+sessionStorage.getItem("idchat")).click()*/
       }
       loadgroup(sessionStorage.getItem("idchat"), $(this), sessionStorage.getItem("ldt"));
    }

   /* loadgroup(1203, $(this));         */

   /* loadgroup(367, $(this), 'user');  */
   /* loadgroup(367, $(this), 'group'); */ 
});

$("body").on("click", ".dumb .liveupdate", function(e) {
    $(this).attr('turn', 'on');
    $(this).attr('spin', 'off');
    var chat = 'on';
    if ($('.swr-grupo .panel > .textbox').hasClass('disabled')) {
        chat = 'off';
    }
    var data = {
        act: 1,
        do: "liveupdate",
        gid: $('.swr-grupo .panel').attr('no'),
        lastid: $('.swr-grupo .panel > .room > .msgs > li').last().attr('no'),
        unseen: $('.swr-grupo .lside > .tabs > ul > li').eq(0).attr('unseen'),
        unread: $(".swr-grupo .lside > .tabs > ul > li[act='pm']").attr('unread'),
        chat: chat,
        ldt: $('.swr-grupo .panel').attr('ldt'),
    };
    var s = 'eval(data);';
    var f = 'grliveupdates();';
    console.log("data:");
    console.log(data);
    ajxx($(this), data, s, e, f);
});
function grliveupdates(t, data, ex) {
    if (t == undefined) {
        t = 1;
    }
    if (data == undefined) {
        data = 0;
    }
    if (ex == undefined) {
        ex = 0;
    }
    if (t == 'msgs') {
        var msgbox = $(".swr-grupo .panel > .room > .msgs");
        if (msgbox.scrollTop() + msgbox.innerHeight() >= msgbox[0].scrollHeight-400) {
            msgbox.removeClass("noscroll");
        } else {
            msgbox.addClass("noscroll");
        }
        if ($(".swr-grupo .panel").attr("no") == data[0].gid) {
            if ($(".swr-grupo .panel > .room > .msgs > li").last().attr("no") == ex) {
                loadmsg(data);
            }
        }

    } else if (t == 'pm') {
        $(".swr-grupo .lside > .tabs > ul > li[act='pm']").attr('unread', data);
        if (!$(".swr-grupo .lside > .tabs > ul > li[act='pm']").hasClass('active')) {
            if (data == 0) {
                $(".swr-grupo .lside > .tabs > ul > li[act='pm']").find('i').html("");
            } else {
                $(".swr-grupo .lside > .tabs > ul > li[act='pm']").find('i').html("<i>"+data+"</i>");
            }
        } else {
            $(".swr-grupo .lside > .tabs > ul > li[act='pm']").attr('spin', 'off').trigger("click");
            $(".swr-grupo .lside > .tabs > ul > li[act='pm']").removeAttr('spin');
        }

    } else if (t == 'groups' || t == 'alerts') {
        var side = 'lside';
        if (t == 'alerts') {
            side = 'rside';
        }
        var el = $(".swr-grupo ."+side+" > .tabs > ul > li").eq(0);
        if (el.hasClass("active") && $(".swr-grupo ."+side).is(':visible')) {
            el.attr('spin', 'off').trigger("click");
            el.removeAttr('spin');
        }
        if (t == 'groups') {
            $(".swr-grupo .lside > .tabs > ul > li").eq(0).attr('unseen', data);
        } else if (t == 'alerts') {
            if (!$(".swr-grupo .rside > .tabs > ul > li").eq(0).hasClass("active") || $(".swr-grupo .rside").is(':hidden')) {
                $(".swr-grupo .rside > .tabs > ul > li").eq(0).find('i').html("");
                if (data != 0) {
                    $(".swr-grupo .rside > .tabs > ul > li").eq(0).find('i').html("<i>"+data+"</i>");
                    $(".swr-grupo .aside > .head > .icons > i.malert").html("<i>"+data+"</i>");
                }
            }
        }
    } else if (t == 'complaints') {
        $cmp = $(".swr-grupo .rside > .tabs > ul > li").eq(2);
        if ($(".swr-grupo .panel").attr("no") == ex) {
            if (data != $cmp.attr('comp')) {
                $(".swr-grupo .rside > .tabs > ul > li").eq(2).find('i').html("");
                $cmp.attr('comp', data);
                if (data != 0) {
                    $(".swr-grupo .rside > .tabs > ul > li").eq(2).find('i').html("<i>"+data+"</i>");
                    if ($cmp.hasClass("active") && $(".swr-grupo .rside").is(':visible')) {
                        $cmp.attr('spin', 'off').trigger("click");
                        $cmp.removeAttr('spin');
                    }
                }
            }
        }
    } else {
        setTimeout(function() {
            $(".dumb .liveupdate").trigger('click');
            $autodel = $(".autodelmsgz").text();
            if ($autodel.length != 0 && $('.swr-grupo .panel').attr('ldt') == 'group') {
                $('.swr-grupo .panel > .room > .msgs > li').each(function() {
                    if (!$(this).hasClass('system')) {
                        var countDownDate = new Date($(this).find('.autodel').attr("timer")).getTime();
                        var now = new Date().getTime();
                        var distance = countDownDate - now;
                        if (distance < 0) {
                            $(this).fadeOut();
                        }
                    }
                });
            }
        }, 2000);
    }

}

$("body").on("keyup", ".swr-grupo .lside > .search > input", function() {

    var search = $(this).val();
    search=search.toLowerCase();
    var elem = ".swr-grupo .lside > .content > .list > li";
    var elemb = ".swr-grupo .rside > .content > .list > li";
    $(elem).show();
    $(elemb).show();
    if (search != "") {
        $(elem).hide();
        $(elemb).hide();
        $(elem).each(function() {
            var str = $(this).text();
            if (str.toLowerCase().indexOf(search) >= 0) {
                $(this).show();
            }
        });
        $(elemb).each(function() {
            var str = $(this).text();
            if (str.toLowerCase().indexOf(search) >= 0) {
                $(this).show();
            }
        });

    }
});

$("body").on("keyup", ".swr-grupo .rside > .search > input", function(e) {
    var search = $(this).val();
    if (search != "") {
        turn_chat();
        $(this).attr('type', 'json');
        $(this).attr('turn', 'off');
        var data = {
            act: 1,
            do: "group",
            type: 'msgs',
            id: $('.swr-grupo .panel').attr('no'),
            search: $(this).val(),
            ldt: $('.swr-grupo .panel').attr('ldt'),
        };
        var s = 'if($(".swr-grupo .panel").attr("no")==data[0].gid){loadmsg(data,1);}';
        ajxx($(this), data, s, e);
    } else {
        turn_chat('on');
    }
});
$("body").on("click", ".grupo-video > div > div > span", function(e) {
    $(".grupo-video").hide();
    $(".grupo-video > div > div > iframe").remove();
});
$("body").on("click", ".swr-grupo .panel > .room > .msgs > li a.embedvideo", function(e) {
    e.preventDefault();
    var video = urlParser.parse($(this).attr('href')),
    link = '',
    extra = 'allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen';
    if (video['provider'] === 'youtube') {
        link = 'https://www.youtube.com/embed/'+video['id']+'?autoplay=1';
    } else if (video['provider'] === 'dailymotion') {
        link = 'https://www.dailymotion.com/embed/video/'+video['id']+'?autoplay=1';
    } else if (video['provider'] === 'vimeo') {
        extra = 'webkitallowfullscreen mozallowfullscreen allowfullscreen';
        link = 'https://player.vimeo.com/video/'+video['id']+'?autoplay=1';
    } else if (video['provider'] === 'twitch') {
        link = 'https://player.twitch.tv/?'+video['id']+'?autoplay=1';
    } else if (video['provider'] === 'youku') {
        link = 'http://player.youku.com/embed/'+video['id']+'?autoplay=1';
    }
    $(".grupo-video > div > div").append('<iframe src="'+link+'" '+extra+' frameborder="0" ></iframe>');
    $(".grupo-video").fadeIn();
});
$("body").on("click", ".turnchat", function(e) {
    var turn = $(this).attr('do');
    turn_chat(turn);
});
function turn_chat($d) {
    if ($d == undefined) {
        $d = 'off';
    }
    if ($d === 'on') {
        $('.groupreload').fadeOut();
        $('.swr-grupo .panel > .textbox').removeClass('animated slideOutDown disabled');
        loadgroup($('.swr-grupo .panel').attr('no'), $(".dumb > .loadgroup"));
        $('.swr-grupo .panel > .textbox').addClass('animated slideInUp');
    } else {
        $('.groupreload').fadeIn();
        $('.swr-grupo .panel > .textbox').removeClass('animated slideInUp');
        $('.swr-grupo .panel > .textbox').addClass('animated slideOutDown disabled');
    }
}

$('.swr-grupo .panel > .room > .msgs').on('scroll', function(e) {
    if (!$(".swr-grupo .panel > .textbox").hasClass('disabled')) {
        var scrollTop = $(this).scrollTop();
        if (scrollTop <= 0) {
            $(this).attr('type', 'json');
            $(this).attr('turn', 'off');
            var data = {
                act: 1,
                do: "group",
                type: 'msgs',
                id: $('.swr-grupo .panel').attr('no'),
                to: $('.swr-grupo .panel > .room > .msgs > li:first-child').attr('no'),
                ldt: $('.swr-grupo .panel').attr('ldt'),
            };
            var s = 'if($(".swr-grupo .panel").attr("no")==data[0].gid){loadmsg(data,2);}';
            ajxx($(this), data, s, e);
        }
    }
});
function htmlDecode(input) {
    var e = document.createElement('div');
    e.innerHTML = input;
    if (e.childNodes[0] == undefined) {
        return input;
    } else {
        var f = e.childNodes[0].nodeValue.substr(e.childNodes[0].nodeValue.length - 5);
        if(f.indexOf(".") !== -1){
            e.childNodes[0].nodeValue = e.childNodes[0].nodeValue.replaceAll(" ", "%20");
        }
        return e.childNodes[0].nodeValue;
    }
}

$(window).load(function() {
    $('.gr-preloader').fadeOut();
    $('.swr-grupo').fadeIn();
    $('.swr-grupo .lside > .tabs > ul > li').eq(0).trigger('click');
    if ($(".swr-grupo .rside").is(':visible')) {
        $('.swr-grupo .rside > .tabs > ul > li').eq(0).trigger('click');
    }

});

$(".scroller").niceScroll({
    cursorwidth: 8,
    cursoropacitymin: 0.4,
    cursorcolor: '#d4d4d4',
    cursorborder: 'none',
    cursorborderradius: 4,
    autohidemode: 'leave',
    horizrailenabled: false
});

function asciiemoji(str) {

    var emojis = {
        "<3": ":heart:", "</3": ":broken_heart:", ":')": ":joy:", ":'-)": ":joy:", ":D": ":smiley:", ":-D": ":smiley:", "=D": ":smiley:",
        ":)": ":slight_smile:", ":-)": ":slight_smile:", "=]": ":slight_smile:", "=)": ":slight_smile:",
        ":]": ":slight_smile:", "':)": ":sweat_smile:", "':-)": ":sweat_smile:", "'=)": ":sweat_smile:", "':D": ":sweat_smile:",
        "':-D": ":sweat_smile:", ">:)": ":laughing:", ">;)": ":laughing:", ">:-)": ":laughing:", ">=)": ":laughing:",
        ";)": ":wink:", ";-)": ":wink:", "*-)": ":wink:", "*)": ":wink:", ";-]": ":wink:", ";]": ":wink:", ";D": ":wink:", ";^)": ":wink:",
        "':(": ":sweat:", "':-(": ":sweat:", "'=(": ":sweat:", ":*": ":kissing_heart:", ":-*": ":kissing_heart:", "=*": ":kissing_heart:",
        ":^*": ":kissing_heart:", ">:P": ":stuck_out_tongue_winking_eye:", "X-P": ":stuck_out_tongue_winking_eye:",
        "x-p": ":stuck_out_tongue_winking_eye:", ">:[": ":disappointed:", ":-(": ":disappointed:", ":(": ":disappointed:",
        ":-[": ":disappointed:", ":[": ":disappointed:", "=(": ":disappointed:", ">:(": ":angry:",
        ">:-(": ":angry:", ":@": ":angry:", ":'(": ":cry:", ":'-(": ":cry:", ";(": ":cry:", ";-(": ":cry:", ">.<": ":persevere:",
        "D:": ":fearful:", ":$": ":flushed:", "=$": ":flushed:", "#-)": ":dizzy_face:", "#)": ":dizzy_face:", "%-)": ":dizzy_face:",
        "%)": ":dizzy_face:", "X)": ":dizzy_face:", "X-)": ":dizzy_face:", "*\0/*": ":ok_woman:", "\0/": ":ok_woman:",
        "\O/": ":ok_woman:", "O:-)": ":innocent:", "0:-3": ":innocent:", "0:3": ":innocent:", "0:-)": ":innocent:",
        "0:)": ":innocent:", "0;^)": ":innocent:", "O:-)": ":innocent:", "O:)": ":innocent:", "O;-)": ":innocent:", "O=)": ":innocent:",
        "0;-)": ":innocent:", "O:-3": ":innocent:", "O:3": ":innocent:", "B-)": ":sunglasses:", "B)": ":sunglasses:", "8)": ":sunglasses:",
        "8-)": ":sunglasses:", "B-D": ":sunglasses:", "8-D": ":sunglasses:", "-_-": ":expressionless:", "-__-": ":expressionless:",
        "-___-": ":expressionless:", ">:/": ":confused:", ":-/": ":confused:", ":-.": ":confused:",
        "=/": ":confused:", ":L": ":confused:",
        ":P": ":stuck_out_tongue:", ":-P": ":stuck_out_tongue:", ":-p": ":stuck_out_tongue:",
        ":-ÃƒÅ¾": ":stuck_out_tongue:", ":-O": ":open_mouth:", ":O": ":open_mouth:", ":-o": ":open_mouth:",
        "O_O": ":open_mouth:", ">:O": ":open_mouth:", ":-X": ":no_mouth:", ":X": ":no_mouth:", ":-#": ":no_mouth:",
        ":#": ":no_mouth:", ":x": ":no_mouth:", ":-x": ":no_mouth:",
    };
    for (var key in emojis) {
        if (emojis.hasOwnProperty(key)) {
            str = str.replace(key, emojis[key]);
        }
    }
    return str;
}

function url2link(text) {

    return (text || "").replace(
        /([^\S]|^)(((https?\:\/\/)|(www\.))(\S+))/gi,
        function(match, space, url) {
            var hyperlink = url;
            if (!hyperlink.match('^https?:\/\/')) {
                hyperlink = 'http://' + hyperlink;
            }
            var video = urlParser.parse(hyperlink);
            var em = 'link';
            if (video) {
                if (video['provider'] === 'youtube' || video['provider'] === 'dailymotion' || video['provider'] === 'vimeo' || video['provider'] === 'twitch' || video['provider'] === 'youku') {
                    em = 'embedvideo';
                    url = '<i class="ti-control-play"></i>'+video['provider'];
                }
            } else {
                var a = document.createElement('a');
                a.href = hyperlink;
                url = '<i class="gi-link"></i>'+a.hostname;
            }
            return space + '<a class="'+em+'" href="' + hyperlink + '" target="_blank">' + url + '</a>';
        }
    );

};

function placeCaretAtEnd(el) {
    if (typeof window.getSelection != "undefined" && typeof document.createRange != "undefined") {
        var range = document.createRange();
        range.selectNodeContents(el);
        range.collapse(false);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } else if (typeof document.body.createTextRange != "undefined") {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(el);
        textRange.collapse(false);
        textRange.select();
    }
}
$('body').on('click', '.swr-grupo .aside > .content .profile > .middle > span.editprf', function(e) {
    $('.swr-grupo .aside > .content .profile > .top > span.edit > i').trigger('click');
    
});

$('body').on('click', '.swr-grupo .vwp', function(e) {

    var kr = 3;
    var ths = $(this);
    var et = e;
    if ($(window).width() <= 767.98) {
        $(".swr-grupo .lside .opt > ul").hide();
        $('.swr-grupo .lside,.swr-grupo .panel').removeClass('abmob');
        $(".swr-grupo .lside,.swr-grupo .panel").addClass("bwmob");
        $(".grtab").addClass("d-none");
        $('.swr-grupo .rside > .top > .left > .icon').attr('data-block', 'alerts');
        if (!$('.rside').hasClass('abmob')) {
            $(".swr-grupo .rside").css("margin-left", "800px");
            setTimeout(function() {
                $(".swr-grupo .rside").removeClass("nomob");
                $(".swr-grupo .rside").addClass("abmob");
                $(".swr-grupo .rside").animate({
                    marginLeft: "0px"
                }, 500);
            }, 200);
        }
    }
    setTimeout(function() {
        $('.swr-grupo .rside > .content > .list').hide();
        $('.swr-grupo .rside > .tabs > ul > li').removeClass('active');
        $(".swr-grupo .rside > .content .profile").fadeOut();
        ths.attr('type', 'json');
        var data = {
            act: 1,
            do: "list",
            type: 'getuserinfo',
            id: ths.attr('no'),
        };
        var s = '$(".swr-grupo .aside > .content .profile > .top > span.name").text(data[0].nameuser);';
        s = s+'$(".swr-grupo .aside > .content .profile > .top > span.dp > img").attr("src",data[0].img);';
        s = s+'$(".swr-grupo .aside > .content .profile > .top > span.role").text(data[0].uname);';
        s = s+'$(".swr-grupo .aside > .content .profile > .top > span.refresh").attr("no",data[0].id);';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").attr("no",data[0].id);';
        s = s+'$(".swr-grupo .aside > .content .profile > .top > span.edit > i").attr("xtid",data[0].id);';
        s = s+'$(".swr-grupo .aside > .content .profile > .top > span.edit > i").attr("data-no",data[0].id);';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.stats > span").eq(1).find("span").text(data[0].shares);';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.stats > span").eq(0).find("span").text(data[0].loves);';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").text(data[0].btn);';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.stats > span").eq(2).find("span").text(data[0].lastlg);';
        s = s+'if(data[0].edit==1){$(".swr-grupo .aside > .content .profile > .top > span.edit > i").show();';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").addClass("loadgroup");';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").removeClass("editprf");';
        s = s+'if(data[0].msgoff==1){$(".swr-grupo .aside > .content .profile > .middle > span.pm").removeClass("loadgroup");';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").addClass("say");';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").attr("say",data[0].msgoffmsg);';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").attr("type","e");';
        s = s+'}}';
        s = s+'else if(data[0].edit==2){$(".swr-grupo .aside > .content .profile > .top > span.edit > i").hide();';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").removeClass("loadgroup");';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").addClass("editprf");';
        s = s+'}';
        s = s+'else{$(".swr-grupo .aside > .content .profile > .top > span.edit > i").hide();';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").addClass("loadgroup");';
        s = s+'$(".swr-grupo .aside > .content .profile > .middle > span.pm").removeClass("editprf");';
        s = s+'}';
        s = s+'$(".swr-grupo .aside > .content .profile > .bottom > div > ul").html("");';
        s = s+'var pbtm=$(".swr-grupo .aside > .content .profile > .bottom > div > ul");';
        s = s+'var pnent=$(".swr-grupo .aside > .content .profile > .bottom > div > div");';
        s = s+'if(data.length===1){pbtm.hide();pnent.show();}else{pnent.hide();pbtm.show();$.each(data, function(k, v) {if(k!=0){';
        s = s+'pbtm.append("<li><b>"+data[k].name+"</b><span>"+htmlDecode(data[k].cont)+"</span></li>");';
        s = s+'}});}$(".swr-grupo .rside > .content .profile").fadeIn();';

        ajxx(ths, data, s, et);
    }, 300);
});


$('body').on('click keyup', '.grupo-pop > div > form > div > textarea', function(e) {
    textAreaAdjust($(this), 300);
});

function textAreaAdjust(o, m) {
    o.css("height", "1px");
    var hgh = o.prop('scrollHeight');
    if (m != undefined) {
        if (hgh > m) {
            hgh = m;
        }
    }
    o.css("height", (hgh+15)+"px");
}

$('body').on('click', '.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.likes > i', function(e) {
    if (!$(this).parent().hasClass('disabled')) {
        var id = $(this).parents('li').attr('no');
        $(this).attr('type', 'json');
        var data = {
            act: 1,
            do: "love",
            type: 'lovedit',
            id: id,
        };
        var s = 'if(data[0].do=="like"){$(".swr-grupo .panel > .room > .msgs > li[no="+data[0].id+"]").find(".likes > i").addClass("liked");}';
        s = s+'else{$(".swr-grupo .panel > .room > .msgs > li[no="+data[0].id+"]").find(".likes > i").removeClass("liked");}';
        s = s+'if(data[0].count==0){data[0].count="";}';
        s = s+'$(".swr-grupo .panel > .room > .msgs > li[no="+data[0].id+"]").find(".likes > b").text(data[0].count);';
        ajxx($(this), data, s, e);
    }
});