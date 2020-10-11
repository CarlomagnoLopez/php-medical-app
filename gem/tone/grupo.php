<?php if (!defined('s7V9pz')) {
  die();
} ?>body,html
{
height: 100%;
margin: 0px;
width: 100%;
}

body
{
font-family: 'Montserrat', sans-serif;
background: url(gem/ore/grupo/global/background-img.png);
background-size: cover;
background-position: center;
overflow-x: hidden;
}

.vwp
{
cursor: pointer;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > i.vwp.usrname {
color: inherit;
}

.gr-preloader
{
position: fixed;
bottom: 0px;
z-index: 999;
left: 0px;
width: 100%;
height: 100%;
text-align: center;
display: block;
background: linear-gradient(to right,#000000e0,#000000f5);
}

.gr-preloader > div
{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
min-height: 100%;
-webkit-box-pack: center;
-webkit-justify-content: center;
-ms-flex-pack: center;
justify-content: center;
}

.gr-preloader > div > span
{
background-image: url(gem/ore/grupo/global/loading.svg);
background-repeat: no-repeat;
background-position: center;
background-size: 80px;
display: block;
width: 80px;
height: 80px;
}

.swr-grupo
{
height: 100%;
display: none;
}

.swr-grupo .fh
{
height: 100%;
}

.swr-grupo .subnav
{
cursor: pointer;
}

.swr-grupo > .window
{
  filter: drop-shadow(2px 4px 6px black);

<!-- padding: 4%; -->
}

.swr-grupo .aside
{

background: #f7f7f7;
padding: 0px;
z-index: 1;
height: 100%;
border-radius: 5px 0px 0px 5px;
overflow: hidden;
position: relative;
transition: 0.4s;
}

.swr-grupo .aside > .head
{
padding: 18px 15px;
text-align: center;
font-weight: 600;
height: 60px;
position: absolute;
width: 100%;
z-index: 7;
}

.swr-grupo .aside > .head > .menu
{
float: left;
}

.swr-grupo .aside > .head > .logo
{
display: inline-block;
background: linear-gradient(to right,#000000,#000000);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
font-size: 16px;
cursor: pointer;
}

.swr-grupo .aside > .head > .icons
{
float: right;
}

.swr-grupo .aside > .head > .icons > i
{
margin-left: 8px;
}

.swr-grupo .aside > .head > .icons > i.malert > i
{
font-style: normal;
background: red;
color: white;
border-radius: 100%;
padding: 4px;
font-size: 10px;
position: absolute;
width: 20px;
height: 20px;
margin-left: -31px;
}

.swr-grupo .aside > .head i
{
border-radius: 100%;
font-size: 18px;
color: #a9a9a9;
cursor: pointer;
transition: 0.4s;
}

.swr-grupo .aside > .search
{
padding: 7px 15px;
text-align: left;
background: #f7f9fb;
border: 1px solid #dfe7ef;
border-right: 0px;
border-left: 0px;
margin-top: 60px;
position: absolute;
width: 100%;
height: 60px;
z-index: 6;
}

.swr-grupo .aside > .search > i
{
position: absolute;
padding: 14px 0px;
padding-bottom: 0px;
padding-left: 28px;
color: #00000038;
left: 0px;
}

.swr-grupo .aside > .search > input
{
outline: 0px;
width: 100%;
background: #ffffff;
border-radius: 26px;
padding: 10px 13px;
color: #676767;
padding-left: 35px;
font-size: 14px;
border: 1px solid #dfe7ef;
}

.swr-grupo .aside > .tabs
{
padding: 0px 15px;
border-bottom: 1px solid #dfe7ef;
margin-bottom: 10px;
position: absolute;
margin-top: 120px;
height: 46px;
width: 100%;
z-index: 5;
}

.swr-grupo .aside > .tabs > ul
{
list-style: none;
padding: 0px;
margin: 0px;
}

.swr-grupo .aside > .tabs > ul > li
{
display: inline-block;
font-size: 13px;
cursor: pointer;
color: #808080;
padding: 12px 10px;
}

.swr-grupo .aside > .tabs > ul > li.xtra
{
padding: 0px;
}

.swr-grupo .aside > .tabs > ul > li.xtra > span
{
display: block;
padding: 12px 10px;
}

.swr-grupo .aside > .tabs > ul > li.active
{
font-weight: 600;
color: black;
border-bottom: 3px solid #0c0c0c;
}

.swr-grupo .aside > .tabs > ul > li > i > i
{
font-weight: 600;
font-style: normal;
margin-right: 4px;
font-size: 11px;
background: linear-gradient(to right,#F44336,#E91E63);
color: white;
border-radius: 3px;
padding: 2px 4px;
}

.swr-grupo .aside > .content .profile
{
display: none;
height: 100%;
}

.swr-grupo .aside > .content .profile > .top
{
padding: 15px;
background: #E91E63;
background: linear-gradient(to right,#E91E63,#9C27B0);
color: white;
padding-bottom: 35px;
height: 190px;
position: absolute;
width: 100%;
}

.swr-grupo .aside > .content .profile > .middle
{
text-align: center;
margin-bottom: 0px;
border-bottom: 1px solid;
height: 85px;
border-color: #DFE7EF;
margin-top: 190px;
position: absolute;
width: 100%;
background: white;
}

.swr-grupo .aside > .content .profile > .bottom
{
background: #F7F9FB;
padding-top: 275px;
padding-bottom: 15px;
min-height: 180px;
border-bottom: 1px solid;
border-color: #DFE7EF;
height: 100%;
}

.swr-grupo .aside > .content .profile > .bottom > div
{
height: 100%;
}

.swr-grupo .aside > .content .profile > .bottom > div > div
{
display: none;
height: 100%;
}

.swr-grupo .aside > .content .profile > .bottom > div > div > div
{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
min-height: 100%;
-webkit-box-pack: center;
-webkit-justify-content: center;
-ms-flex-pack: center;
justify-content: center;
}

.swr-grupo .aside > .content .profile > .bottom > div > div > div > span
{
font-size: 57px;
text-align: center;
font-weight: 700;
line-height: 39px;
color: #c3c7ca;
display: block;
}

.swr-grupo .aside > .content .profile > .bottom > div > div > div > span > span
{
display: block;
font-size: 13px;
font-weight: 500;
}

.swr-grupo .aside > .content .profile > .bottom > div > ul
{
list-style: none;
padding: 0px 15px;
height: 100%;
overflow: scroll;
overflow-x: hidden;
}

.swr-grupo .aside > .content .profile > .bottom > div > ul > li
{
padding: 5px 0px;
}

.swr-grupo .aside > .content .profile > .bottom > div > ul > li > b
{
display: block;
font-size: 14px;
}

.swr-grupo .aside > .content .profile > .bottom > div > ul > li > span
{
font-size: 14px;
display: block;
}

.swr-grupo .aside > .content .profile > .top > span
{
display: block;
text-align: center;
}

.swr-grupo .aside > .content .profile > .top > span.edit
{
text-align: right;
min-height: 27px;
}

.swr-grupo .aside > .content .profile > .top > span.edit > i
{
font-style: normal;
padding: 3px 7px;
border: 1px solid #FFC107;
font-size: 13px;
color: #FFC107;
border-radius: 5px;
cursor: pointer;
display: inline-block;
}

.swr-grupo .aside > .content .profile > .top > span.dp
{
margin-bottom: 12px;
margin-top: 4px;
}

.swr-grupo .aside > .content .profile > .top > span.name
{
font-size: 15px;
font-weight: 600;
line-height: 14px;
}

.swr-grupo .aside > .content .profile > .top > span.role
{
font-size: 14px;
text-transform: lowercase;
font-weight: 500;
color: #ffffffad;
cursor: pointer;
}

.swr-grupo .aside > .content .profile > .top > span.dp > img
{
border-radius: 100%;
width: 70px;
border: 3px solid #fff;
}

.swr-grupo .aside > .content .profile > .middle > span.stats
{
display: block;
}

.swr-grupo .aside > .content .profile > .middle > span.pm
{
display: inline-block;
background: white;
padding: 4px 15px;
border-radius: 5px;
box-shadow: 0px 1px 2px #33333354;
color: #E91E63;
font-size: 14px;
margin-bottom: 11px;
cursor: pointer;
top: -15px;
position: relative;
}

.swr-grupo .aside > .content .profile > .middle > span.stats > span
{
display: inline-block;
padding: 0px 8px;
font-weight: 700;
font-size: 19px;
color: #727273;
line-height: 19px;
border-right: 1px solid #33333338;
}

.swr-grupo .aside > .content .profile > .middle > span.stats > span:last-child
{
border-right: 0px solid #33333338;
}

.swr-grupo .aside > .content .profile > .middle > span.stats > span > i
{
display: block;
font-style: normal;
font-weight: 600;
font-size: 12px;
text-transform: uppercase;
color: #9a9a9a;
}

.swr-grupo .aside > .content
{
height: 100%;
padding-top: 166px;
}

.swr-grupo .aside > .content > .list
{
padding: 0px;
list-style: none;
margin: 0px;
overflow: hidden;
overflow-y: scroll;
}

.swr-grupo .aside > .content > .list > li
{
display: block;
margin-bottom: 0px;
width: 100%;
padding: 11px 15px;
cursor: pointer;
border-bottom: 1px solid #fff;
border-top: 1px solid #fff;
transition: 0.5s;
}

.swr-grupo .aside > .content > .list > li.active,.swr-grupo .aside > .content > .list > li:hover
{
background: #f7f9fb;
border-bottom: 1px solid #dfe7ef;
border-top: 1px solid #dfe7ef;
font-weight: 600;
}

.swr-grupo .aside > .content > .list > li.active > div > .center
{
color: #E91E63;
}

.swr-grupo .aside > .content > .list > li > div
{
display: flex;
align-items: center;
}

.swr-grupo .aside > .content > .list > li > div > .left
{
text-align: center;
padding: 0px;
width: 40px;
margin-right: 10px;
display: inline-block;
background: url('gem/ore/grupo/global/load.gif');
height: 40px;
background-size: cover;
border-radius: 100%;
}

.swr-grupo .aside > .content > .list > li > div > .left > img
{
width: 40px;
height: 40px;
border-radius: 5px;
}

.swr-grupo .aside > .content > .list > li > div > .center
{
width: 66%;
display: block;
font-size: 13px;
color: #696767;
font-weight: 600;
}

.swr-grupo .aside > .content > .list > li > div > .center > b
{
font-weight: 600;
max-width: 59%;
height: 17px;
overflow: hidden;
display: inline-block;
word-break: break-all;
}

.swr-grupo .aside > .content > .list > li > div > .center > b > span
{
display: inline-block;
}

.swr-grupo .aside > .content > .list > li > div > .center > i
{
margin-left: 3px;
}

.swr-grupo .aside > .content > .list > li > div > .center > u
{
font-style: normal;
margin-left: 5px;
font-size: 11px;
border: 1px solid;
color: #E91E63;
font-weight: 600;
text-decoration: none;
border-radius: 4px;
padding: 2px 4px;
}

.swr-grupo .aside > .content > .list > li > div > .center > span
{
font-size: 12px;
color: #828588;
word-break: break-all;
display: block;
font-weight: 500;
max-width: 65%;
overflow: hidden;
}

.swr-grupo .aside > .content > .list > li > div > .right
{
display: inline-block;
color: #a4a5a7;
font-size: 11px;
text-align: right;
right: 0px;
width: 70px;
margin-right: 0px;
}

.swr-grupo .panel
{
background: #f7f7f7;
padding: 0px;
padding-top: 0px;
height: 100%;
overflow: hidden;
z-index: 2;
border-left: 1px solid #dfe7ef;
position: relative;
}

.swr-grupo .panel > .room
{
padding: 15px 0px;
padding-top: 60px;
padding-bottom: 115px;
}

.swr-grupo .panel > .room > .groupreload
{
position: absolute;
width: 100%;
text-align: center;
display: none;
z-index: 99;
}

.swr-grupo .panel > .room > .groupreload > i
{
background: linear-gradient(to right,#E91E63,#9C27B0);
color: white;
border-radius: 25px;
font-style: normal;
padding: 3px 12px;
font-size: 13px;
cursor: pointer;
}

.swr-grupo .panel > .room > .groupreload > i > i
{
margin-right: 4px;
font-size: 11px;
}

.swr-grupo .panel > .room > .msgs
{
list-style: none;
margin: 0px;
overflow: hidden;
padding: 0px;
overflow-y: scroll;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > i.rply > i > a,.swr-grupo .panel > .room > .msgs > li > div > .msg > i > a
{
color: inherit;
text-decoration: none;
opacity: 1;
transition: 0.2s;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.ti-alarm-clock
{
margin-right: 2px;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.autodel
{
font-style: normal;
font-weight: 600;
opacity: 0.8;
}

.swr-grupo .panel > .room > .msgs > li
{
padding: 6px 15px;
}

.swr-grupo .panel > .room > .msgs > li > div
{
}

.swr-grupo .panel > .room > .msgs > li > div > .img
{
text-align: center;
padding: 0px;
width: 31px;
margin-right: 15px;
background: url(gem/ore/grupo/global/load.gif);
height: 31px;
background-size: cover;
border-radius: 100%;
float: left;
cursor: pointer;
}

.swr-grupo .panel > .room > .msgs > li > div > .img > img
{
width: 100%;
border-radius: 100%;
margin-right: 0px;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg
{
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i .emojione
{
width: 17px;
padding: 0px;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > i.vwp
{
font-style: normal;
color: #FFEB3B;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i
{
text-align: left;
border-radius: 4px;
display: inline-block;
max-width: 65%;
padding: 8px 9px;
font-size: 13px;
font-style: normal;
word-break: break-word;
background-color: #ffffff;
color: #333333;
box-shadow: 0px 1px 2px #d6d6d6;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > .time
{
display: block;
margin-left: 55px;
margin-top: 4px;
text-align: left;
border-radius: 4px;
max-width: 100%;
color: #676767;
font-size: 11px;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.likes
{
font-style: normal;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.likes > b
{
font-style: normal;
font-weight: 500;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.likes > i
{
font-family: 'entypo', sans-serif;
color: #a2a2a2;
font-style: normal;
padding: 0px 3px;
font-size: 11px;
cursor: pointer;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.likes > i:before
{
content: "\2665";
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.likes > i.liked:before,.swr-grupo .panel > .room > .msgs > li > div > .msg > .time > i.likes > i:hover:before
{
color: #ff0000;
}

.swr-grupo .panel > .room > .msgs > li.system
{
text-align: center;
opacity: 0.6;
transition: 0.2s;
}

.swr-grupo .panel > .room > .msgs > li.system > div > .msg > i
{
padding: 0px;
background: transparent;
box-shadow: 0px 0px 0px;
font-size: 11px;
}

.swr-grupo .panel > .room > .msgs > li.system > div > .msg > .time
{
margin: 0px;
padding: 0px;
text-align: center;
margin-top: -5px;
}

.swr-grupo .panel > .room > .msgs > li.system > div > .msg > .time .msgopt
{
display: none;
}

.swr-grupo .panel > .room > .msgs > li.system > div > .img
{
float: none;
display: inline-block;
margin: 0px;
}

.swr-grupo .panel > .room > .msgs > li.system > div > .msg
{
display: block;
}

.swr-grupo .panel > .room > .msgs > li.system > div i.status
{
display: none;
}

.swr-grupo .panel > .room > .msgs > li.system:hover
{
opacity: 1;
}

.swr-grupo .panel > .room > .msgs > li.you
{
text-align: right;
}

.swr-grupo .panel > .room > .msgs > li > div i.status
{
float: left;
border: 2px solid #fff;
margin-right: -5px;
position: relative;
z-index: 4;
}

.swr-grupo .panel > .room > .msgs > li.you > div i.status
{
float: right;
margin-top: 0px;
margin-left: -5px;
margin-right: 0px;
display: none;
}

.swr-grupo .panel > .room > .msgs > li.you > div i.usrname
{
display: none;
}

.swr-grupo .panel > .room > .msgs > li > div i.usrname
{
display: block;
font-style: normal;
cursor: pointer;
margin-right: 3px;
font-weight: 600;
opacity: 0.8;
font-size: 12px;
}

.swr-grupo .panel > .room > .msgs > li.system > div i.usrname
{
margin: 0px;
line-height: 12px;
margin-top: 6px;
text-align: center;
}

.swr-grupo .panel > .room > .msgs > li.highlight > div > .msg > i
{
cursor: pointer;
box-shadow: 0 0 0 rgba(0, 0, 0, 0.4);
animation: pulse 2s infinite;
}

.swr-grupo .panel > .room > .msgs > li.selected > div > .msg > i
{
cursor: pointer;
box-shadow: 0 0 0 rgba(0, 0, 0, 0.4);
animation: pulse 2s infinite;
}

.swr-grupo .panel > .room > .msgs > li.you > div > .msg > i
{
text-align: right;
}

.swr-grupo .panel > .room > .msgs > li.you > div > .img
{
float: right;
margin-right: 0px;
margin-left: 15px;
display: none;
}

.swr-grupo .panel > .room > .msgs > li.you > div > .msg > .time
{
text-align: right;
margin-left: 0px;
margin-right: 0px;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > i.rply
{
font-style: normal;
display: block;
opacity: 0.8;
text-align: left;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > i.rply > i
{
display: block;
font-style: normal;
margin-bottom: 6px;
padding: 0px;
padding-left: 6px;
padding-right: 15px;
cursor: pointer;
font-size: 12px;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > i.rply > i > i
{
display: block;
font-style: normal;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > span.block
{
display: flex;
text-align: left;
align-items: center;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > span.block > i
{
display: inline-block;
border-radius: 10px;
font-style: normal;
padding: 1px 8px;
background: linear-gradient(to right,#231d1c,#261229);
cursor: pointer;
color: #fff;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > span.block > span
{
display: inline-block;
margin-right: 5px;
}

.swr-grupo .panel > .room > .msgs > li > div > .msg > i > span.block > span > span
{
font-size: 12px;
display: block;
}

.swr-grupo .panel > .room > .msgs > li.you > div > .msg > i > span.block > i
{
}

.swr-grupo .panel > .head
{
color: #8b8e90;
background: white;
padding: 10px 15px;
border-bottom: 1px solid #dfe7ef;
position: absolute;
width: 100%;
height: 60px;
z-index: 9;
}

.swr-grupo .panel > .head > .left
{
display: inline-block;
max-width: 60%;
overflow: hidden;
}

.swr-grupo .panel > .head > .left > span
{
display: flex;
align-items: center;
}

.swr-grupo .panel > .head > .left > span > img
{
width: 30px;
border-radius: 4px;
display: inline-block;
margin-right: 6px;
}

.swr-grupo .panel > .head > .left > span > span
{
display: inline-block;
font-weight: 600;
font-size: 13px;
color: #E91E63;
}

.swr-grupo .panel > .head > .left > span > span > span
{
display: block;
font-size: 12px;
font-weight: 500;
color: #8b8e90;
margin-top: -2px;
}

.swr-grupo .panel > .head > .right
{
float: right;
}

.swr-grupo .panel > .head > .right > i
{
padding-top: 12px;
display: inline-block;
margin-left: 10px;
cursor: pointer;
}

.swr-grupo .panel > .textbox
{
position: absolute;
bottom: -4px;
box-shadow: 0px -1px 2px #dfe7ef;
width: 100%;
background: white;
z-index: 99;
}

.swr-grupo .panel > .textbox > .mentions
{
position: relative;
z-index: 5;
margin-top: 10px;
bottom: 0px;
background: white;
margin-left: 10px;
border-radius: 7px;
display: none;
}

.swr-grupo .panel > .textbox > .mentions > ul
{
padding: 0px;
margin: 0px;
list-style: none;
}

.swr-grupo .panel > .textbox > .mentions > ul > li
{
font-size: 14px;
padding: 0px 12px;
max-width: 190px;
overflow: hidden;
float: left;
cursor: pointer;
}

.swr-grupo .panel > .textbox > .mentions > ul > li > img
{
width: 35px;
float: left;
margin-right: 6px;
border-radius: 3px;
margin-top: 4px;
}

.swr-grupo .panel > .textbox > .mentions > ul > li > span
{
display: inline-block;
max-width: 100px;
overflow: hidden;
font-size: 13px;
}

.swr-grupo .panel > .textbox > .mentions > ul > li > span > i
{
display: block;
font-weight: 600;
font-style: normal;
font-size: 13px;
color: #a2a2a2;
}

.swr-grupo .panel > .textbox > .mentions > ul > li:last-child
{
border: 0px;
}

.swr-grupo .panel > .textbox > .mentions > ul > li:hover
{
}

.swr-grupo .panel > .textbox > .box
{
display: inline-block;
padding: 16px;
width: 100%;
padding-right: 73px;
}

.swr-grupo .panel > .textbox > .box > textarea
{
width: 100%;
display: block;
border: 0px;
outline: none;
resize: none;
padding: 21px 130px;
height: 65px;
padding-left: 22px;
color: #676767;
font-size: 13px;
border: 1px solid #dfe7ef;
background: #f7f9fb;
border-radius: 5px;
}

.swr-grupo .panel > .textbox > .box > .icon
{
position: absolute;
margin-right: 90px;
margin-top: 17px;
font-size: 15px;
color: #828588cf;
font-weight: 900;
right: 0px;
z-index: 99;
}

.gr-emoji
{
background: url('gem/ore/grupo/global/emoji.svg')no-repeat;
background-position: center;
background-size: 60%;
}

.gr-response
{
background: url(gem/ore/grupo/global/response.svg)no-repeat;
background-position: center;
background-size: 60%;
}

.gr-attach
{
background: url(gem/ore/grupo/global/attach.svg)no-repeat;
background-position: center;
background-size: 60%;
border: 0px!important;
}

.swr-grupo .panel > .textbox > .box > .icon > i
{
cursor: pointer;
display: inline-flex;
width: 30px;
height: 30px;
color: transparent;
padding: 6px;
opacity: 0.3;
}

.swr-grupo .panel > .textbox > .box > .icon > i:hover
{
opacity: 1;
}

.swr-grupo .panel > .textbox > .box > .icon > i > form
{
position: absolute;
margin-left: -9px;
width: 33px;
opacity: 0;
display: inline-block;
overflow: hidden;
margin-top: -5px;
cursor: pointer;
}

.swr-grupo .panel > .textbox > .box > i
{
right: 0px;
margin-top: -57px;
margin-left: 0px;
margin-right: 12px;
color: white;
width: 45px;
padding: 10px;
position: absolute;
border-radius: 100%;
cursor: pointer;
background: linear-gradient(to right,#000000,#101010);
}

.swr-grupo .panel > .textbox > .box > i > i
{
background: url(gem/ore/grupo/global/send.svg)no-repeat;
background-position: center;
background-size: contain;
display: block;
height: 24px;
}

.swr-menu
{
position: absolute;
z-index: 1000;
background: linear-gradient(to right,#969696,#a9a0ab);
font-family: 'Montserrat', sans-serif;
font-weight: 500;
color: #ffffff;
font-style: normal;
display: none;
border-radius: 4px;
}

.swr-menu.l-end
{
right: 0px;
margin-right: 45px;
}

.swr-menu.r-end
{
right: 0px;
margin-right: 10px;
}

.swr-menu > ul
{
cursor: pointer;
list-style: none;
font-size: 14px;
width: max-content;
padding: 0px;
text-align: left;
margin: 0px;
}

.swr-menu > ul > li
{
padding: 7px 10px;
cursor: pointer;
}

.swr-menu > ul > li:hover,.swr-menu > ul > li.active
{
background: #10101038;
}

.swr-menu > ul > li > img
{
width: 15px;
margin-right: 6px;
}

.grupo-video
{
position: fixed;
bottom: 0px;
z-index: 999;
left: 0px;
width: 100%;
height: 100%;
text-align: center;
display: none;
background-color: #000000e0;
background-image: url(gem/ore/grupo/global/loading.svg);
background-repeat: no-repeat;
background-position: center;
background-size: 80px;
}

.grupo-video > div
{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
min-height: 100%;
-webkit-box-pack: center;
-webkit-justify-content: center;
-ms-flex-pack: center;
justify-content: center;
width: 100%;
height: 100%;
}

.grupo-video > div > div
{
display: inline-block;
text-align: right;
color: white;
width: 70%;
height: 70%;
}

.grupo-video > div > div > iframe
{
display: block;
width: 100%;
height: 100%;
}

.grupo-video > div > div > span
{
display: block;
color: white;
margin-bottom: 11px;
font-size: 18px;
font-weight: 600;
cursor: pointer;
}

.grupo-standby
{
display: none;
position: fixed;
width: 100%;
top: 0px;
left: 0px;
height: 100%;
animation: standby 2s infinite;
-webkit-animation: standby 2s infinite;
-moz-animation: standby 2s infinite;
-o-animation: standby 2s infinite;
cursor: pointer;
}

@-webkit-keyframes standby
{
0%, 20%, 50%, 80%, 100%
{
-webkit-transform: translateY(0);
}

40%
{
-webkit-transform: translateY(-30px);
}

60%
{
-webkit-transform: translateY(-15px);
}
}

@-moz-keyframes standby
{
0%, 20%, 50%, 80%, 100%
{
-moz-transform: translateY(0);
}

40%
{
-moz-transform: translateY(-30px);
}

60%
{
-moz-transform: translateY(-15px);
}
}

@-o-keyframes standby
{
0%, 20%, 50%, 80%, 100%
{
-o-transform: translateY(0);
}

40%
{
-o-transform: translateY(-30px);
}

60%
{
-o-transform: translateY(-15px);
}
}

@keyframes standby
{
0%, 20%, 50%, 80%, 100%
{
transform: translateY(0);
}

40%
{
transform: translateY(-30px);
}

60%
{
transform: translateY(-15px);
}
}

.grupo-standby > div
{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
min-height: 100%;
-webkit-box-pack: center;
-webkit-justify-content: center;
-ms-flex-pack: center;
justify-content: center;
}

.grupo-standby > div > span
{
width: 150px;
display: block;
}

.grupo-standby > div > span > img
{
width: 100%;
}

.grupo-pop
{
position: fixed;
bottom: 0px;
z-index: 999;
left: 0px;
width: 100%;
height: 100%;
text-align: center;
display: none;
background: linear-gradient(to right,#000000e0,#000000f5);
}

.grupo-pop > div
{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
min-height: 100%;
-webkit-box-pack: center;
-webkit-justify-content: center;
-ms-flex-pack: center;
justify-content: center;
}

.grupo-pop > div > form
{
display: inline-block;
background: #f0f2f5;
background: linear-gradient(to right,#f6faff,#ffffff);
text-align: center;
box-shadow: 0px 0px 6px #d0cdcd85;
border-radius: 5px;
color: white;
width: 300px;
}

.grupo-pop > div > form > .head
{
display: block;
margin-bottom: 18px;
text-align: center;
font-size: 14px;
font-weight: 600;
padding: 14px 0px;
background: linear-gradient(to right,#464646,#444444);
border-radius: 5px 5px 0px 0px;
}

.grupo-pop > div > form > div
{
padding: 0px 30px;
max-height: 400px;

}

.grupo-pop > div > form > div > .imglist
{
list-style: none;
padding: 0px;
}

.grupo-pop > div > form > div > .imglist > li
{
display: inline-block;
padding: 2px 2px;
cursor: pointer;
}

.grupo-pop > div > form > div > .imglist > li.active
{
opacity: 0.3;
}

.grupo-pop > div > form > div > .imglist > li > img
{
width: 52px;
border: 2px solid white;
}

.grupo-pop > div > form > div > .imglist > li > input
{
opacity: 0;
width: 0px;
}

.grupo-pop > div > form > div > label
{
display: block;
color: black;
text-align: left;
font-size: 14px;
padding: 8px 0px;
}

.grupo-pop > div > form > .fields > span
{
display: block;
background: #35353500;
border: 0px;
border-bottom: 1px solid #ffffff63;
outline: 0px;
color: #000000e3;
border-radius: 0px;
padding: 10px 0px;
cursor: pointer;
margin-bottom: 3px;
font-family: 'Montserrat', sans-serif;
text-align: left;
}

.grupo-pop > div > form > .fields > span > span
{
display: block;
}

.grupo-pop > div > form > div > input,.grupo-pop > div > form > div > select,.grupo-pop > div > form > div > textarea
{
display: block;
background: #35353500;
border: 0px;
border-bottom: 1px solid #00000063;
outline: 0px;
color: #000000e3;
border-radius: 0px;
padding: 0px 0px;
padding-bottom: 5px;
width: 100%;
margin-bottom: 5px;
font-family: 'Montserrat', sans-serif;
}

select
{
color: #736a6a;
}

.grupo-pop > div > form > div > select > option
{
outline: none;
background: #c0cae8;
}

.grupo-pop > div > form > input[type="submit"]
{
background: linear-gradient(to right,#000000,#000000);
border: 0px;
border-radius: 66px;
color: white;
width: 100%;
padding: 8px 0px;
font-family: 'Montserrat', sans-serif;
font-size: 14px;
margin-top: 21px;
font-weight: 600;
outline: none;
width: 200px;
}

.grupo-pop > div > form > .fields > div.checkbox
{
text-align: left;
color: #9fabb1e3;
}

.grupo-pop > div > form > .fields > div.checkbox > span > input
{
margin-right: 4px;
float: left;
margin-top: 6px;
}

.grupo-pop > div > form > .fields > div.checkbox >span
{
margin-right: 4px;
font-size: 15px;
display: block;
}

.grupo-pop > div > form > span.cancel
{
display: block;
font-size: 13px;
margin-top: 11px;
color: #00000096;
margin-bottom: 22px;
cursor: pointer;
}

.swr-grupo .rside
{
background: #f7f7f7;
padding: 0px;
z-index: 3;
height: 100%;
border-left: 1px solid #dfe7ef;
border-radius: 0px 5px 5px 0px;
}

.swr-grupo .rside > .top
{
color: #8b8e90;
background: #f7f7f7;
padding: 9px 15px;
display: flex;
width: 100%;
height: 60px;
position: absolute;
z-index: 7;
}

.swr-grupo .rside > .top > .left
{
display: inline-block;
}

.swr-grupo .panel > .head > .icon,.swr-grupo .rside > .top > .left > .icon
{
float: left;
margin-top: 10px;
margin-right: 8px;
cursor: pointer;
}

.swr-grupo .rside > .top > .left > span
{
display: flex;
align-items: center;
}

.swr-grupo .rside > .top > .left > span > img
{
width: 41px;
height: 41px;
border-radius: 100%;
display: inline-block;
margin-right: 9px;
}

.swr-grupo .rside > .top > .left > span > span
{
display: inline-block;
font-weight: 600;
font-size: 13px;
color: #5a5a5a;
line-height: 14px;
}

.swr-grupo .rside > .top > .left > span > span > span
{
display: block;
font-size: 12px;
font-weight: 500;
color: #8b8e90;
}

.swr-grupo .rside > .top > .right
{
float: right;
position: absolute;
right: 0px;
margin-right: 15px;
}

.swr-grupo .rside > .top > .right > i
{
display: block;
font-size: 18px;
}

.swr-grupo .rside > .top > .right > i.langswitch
{
padding-top: 3px;
}

.swr-grupo .rside > .top > .right > i.langswitch > img
{
width: 20px;
border-radius: 100%;
}

.swr-grupo .opt
{
display: block;
}

.swr-grupo .opt > i
{
font-style: normal;
}

.swr-grupo .opt > ul
{
text-align: left;
display: none;
background: white;
padding: 0px;
border: 1px solid #dfe7ef;
border-radius: 5px;
margin-left: -100px;
z-index: 99;
position: relative;
}

.swr-grupo .opt > ul > li
{
display: inline;
padding: 3px 7px;
}

.swr-grupo .opt > ul > li:hover
{
background: linear-gradient(to right,#231d1c,#261229);
color: white;
border-radius: 3px;
}

.swr-grupo i.status
{
background: #939491;
padding: 4px;
border-radius: 100%;
display: inline-block;
margin-bottom: 3px;
}

.swr-grupo i.status.online
{
background: #8BC34A;
}

.swr-grupo i.status.idle
{
background: #FFC107;
}

.swr-grupo .zeroelem
{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
min-height: 85%;
-webkit-box-pack: center;
-webkit-justify-content: center;
-ms-flex-pack: center;
justify-content: center;
}

.swr-grupo .zeroelem > div
{
}

.swr-grupo .zeroelem > div > span
{
font-size: 57px;
text-align: center;
display: block;
font-weight: 700;
line-height: 39px;
color: #c3c7ca;
}

.swr-grupo .zeroelem > div > span > i
{
font-style: normal;
display: inline;
color: transparent;
background: url('gem/ore/grupo/global/empty.png');
background-size: 75px;
background-position: center;
background-repeat: no-repeat;
opacity: 0.2;
}

.swr-grupo .uploadfiles
{
position: absolute;
opacity: 0;
overflow: hidden;
width: 100%;
height: 23px;
margin-left: -9px;
margin-top: -2px;
}

.swr-grupo .zeroelem > div > span > span
{
display: block;
font-size: 13px;
font-weight: 500;
margin-top: 5px;
}

.swr-grupo .msgopt
{
display: inline-block;
}

.swr-grupo .msgopt > i
{
margin-left: 4px;
font-size: 10px;
display: inline-block;
cursor: pointer;
}

.swr-grupo .msgopt > ul
{
text-align: left;
display: none;
background: #f7f9fb;
margin: 0px;
border-radius: 5px;
z-index: 99;
position: relative;
padding: 0px;
list-style: none;
top: -1px;
margin-left: 3px;
}

.swr-grupo .msgopt > ul > li
{
display: inline;
padding: 2px 5px;
cursor: pointer;
}

.swr-grupo .msgopt > ul > li:hover
{
background: linear-gradient(to right,#F44336,#9C27B0);
color: white;
border-radius: 3px;
}

.swr-grupo .msgopt > ul > li.autodel
{
cursor: default;
}

.swr-grupo .msgopt > ul > li.autodel:before
{
content: "\e6a5";
font-family: 'themify';
speak: none;
font-style: normal;
font-weight: normal;
font-variant: normal;
text-transform: none;
line-height: 1;
margin-right: 3px;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
}

.swr-grupo .msgopt > ul > li.autodel:hover
{
background: transparent;
color: inherit;
}

.imgld
{
background: none!important;
}

.emojionearea .emojionearea-button
{
display: none;
}

.emojionearea .emojionearea-picker.emojionearea-picker-position-top
{
right: 0px;
}

.emojionearea.focused
{
border: 1px solid #CCC;
outline: 0;
-moz-box-shadow: inset 0 0px 0px rgba(0,0,0,.075), 0 0 0px rgba(102,175,233,.6);
-webkit-box-shadow: inset 0 0px 0px rgba(0,0,0,.075), 0 0 0px rgba(102,175,233,.6);
box-shadow: inset 0 1px 0px rgba(0,0,0,.075), 0 0 0px rgba(102,175,233,.6);
}

.emojionearea > .emojionearea-editor
{
min-height: 50px;
max-height: 1200px;
width: 100%;
display: block;
border: 0px;
outline: none;
resize: none;
padding: 21px 130px;
height: 65px;
padding-left: 22px;
color: #676767;
font-size: 13px;
background: #fff;
border-radius: 5px;
}

img
{
-webkit-user-drag: none;
-khtml-user-drag: none;
-moz-user-drag: none;
-o-user-drag: none;
user-drag: none;
}

::placeholder
{
color: inherit;
opacity: 1;
}

:-ms-input-placeholder
{
color: inherit;
}

::-ms-input-placeholder
{
color: inherit;
}

input:focus::-webkit-input-placeholder
{
color: transparent;
}

input:focus:-moz-placeholder
{
color: transparent;
}

input:focus::-moz-placeholder
{
color: transparent;
}

input:focus:-ms-input-placeholder
{
color: transparent;
}

input[type=file], input[type=file]::-webkit-file-upload-button
{
cursor: pointer;
}

.ajxout
{
right: 4%!important;
top: 8px!important;
}

@media screen and (min-width:770.98px)
{
.swr-grupo .aside,.swr-grupo .panel
{
margin-left: 0px!important;
}
}

@media (max-width:400px)
{
.emojionearea .emojionearea-picker
{
width: 100%;
}

.emojionearea .emojionearea-picker .emojionearea-filters
{
overflow: SCROLL;
}

.emojionearea .emojionearea-picker .emojionearea-wrapper
{
width: 100%;
}
}

@media (max-width:767.98px)
{
.swr-grupo > .window
{
padding: 0px;
}

.swr-grupo .msgopt > i,.swr-grupo .opt > i,.nomob
{
display: none;
}

.bwmob
{
position: absolute!important;
width: 100%;
height: 100%!important;
}

.abmob
{
position: relative!important;
z-index: 10!important;
}

.swr-grupo .aside
{
border-radius: 0px;
}

.swr-grupo .aside > .head,.swr-grupo .panel > .head,.swr-grupo .rside > .top
{
background: linear-gradient(to right,#E91E63,#9C27B0);
border: 0px;
}

.swr-grupo .aside > .head > .logo
{
-webkit-text-fill-color: white;
}

.swr-grupo .aside > .head i,.swr-grupo .panel > .head > .left > span > span,.swr-grupo .panel > .head > .left > span > span > span,.swr-grupo .panel > .head,.swr-grupo .rside > .top,.swr-grupo .rside > .top > .left > span > span,.swr-grupo .rside > .top > .right > i,.swr-grupo .rside > .top > .left > span > span > span
{
color: white;
}

.swr-grupo .aside > .search
{
background: black;
border: 0px;
}

.swr-grupo .aside > .search > i
{
color: white;
padding-left: 15px;
}

.swr-grupo .aside > .search > input
{
background: transparent;
border: 0px;
color: WHITE;
padding-left: 22px;
}

.grupo-video > div > div
{
width: 90%;
height: 60%;
}
}

@-webkit-keyframes pulse
{
0%
{
-webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.4);
}

70%
{
-webkit-box-shadow: 0 0 0 10px rgba(204,169,44, 0);
}

100%
{
-webkit-box-shadow: 0 0 0 0 rgba(204,169,44, 0);
}
}

@keyframes pulse
{
0%
{
-moz-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.4);
box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.4);
}

70%
{
-moz-box-shadow: 0 0 0 10px rgba(204,169,44, 0);
box-shadow: 0 0 0 10px rgba(204,169,44, 0);
}

100%
{
-moz-box-shadow: 0 0 0 0 rgba(204,169,44, 0);
box-shadow: 0 0 0 0 rgba(204,169,44, 0);
}
}

.margin-input{
margin-top: -18px;
}

.color-label{
color: #736a6a;
}


.button-submit-form {
background: linear-gradient(to right,#000000,#000000);
border: 0px;
border-radius: 66px;
color: white;
width: 100%;
padding: 8px 0px;
font-family: 'Montserrat', sans-serif;
font-size: 14px;
margin-top: 21px;
font-weight: 600;
outline: none;
width: 200px;
}

.style-form-modal {
display: inline-block;
background: #f0f2f5;
background: linear-gradient(to right,#f6faff,#ffffff);
text-align: center;
box-shadow: 0px 0px 6px #d0cdcd85;
border-radius: 5px;
color: white;
width: 300px;
}



.grupo-pop-modal
{
position: fixed;
bottom: 0px;
z-index: 999;
left: 0px;
width: 100%;
height: 100%;
text-align: center;
display: none;
background: linear-gradient(to right,#000000e0,#000000f5);
}

.grupo-pop-modal > div
{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
min-height: 100%;
-webkit-box-pack: center;
-webkit-justify-content: center;
-ms-flex-pack: center;
justify-content: center;
}

.grupo-pop-modal > div > form
{
display: inline-block;
background: #f0f2f5;
background: linear-gradient(to right,#f6faff,#ffffff);
text-align: center;
box-shadow: 0px 0px 6px #d0cdcd85;
border-radius: 5px;
color: white;
width: 300px;
}

.grupo-pop-modal > div > form > .head
{
display: block;
margin-bottom: 18px;
text-align: center;
font-size: 14px;
font-weight: 600;
padding: 14px 0px;
background: linear-gradient(to right,#464646,#444444);
border-radius: 5px 5px 0px 0px;
}

.grupo-pop-modal > div > form > div
{
padding: 0px 30px;
max-height: 550px;

}

.grupo-pop-modal > div > form > div > .imglist
{
list-style: none;
padding: 0px;
}

.grupo-pop-modal > div > form > div > .imglist > li
{
display: inline-block;
padding: 2px 2px;
cursor: pointer;
}

.grupo-pop-modal > div > form > div > .imglist > li.active
{
opacity: 0.3;
}

.grupo-pop-modal > div > form > div > .imglist > li > img
{
width: 52px;
border: 2px solid white;
}

.grupo-pop-modal > div > form > div > .imglist > li > input
{
opacity: 0;
width: 0px;
}

.grupo-pop-modal > div > form > div > label
{
display: block;
text-align: left;
font-size: 14px;
padding: 8px 0px;
}

.grupo-pop-modal > div > form > .fields > span
{
display: block;
background: #35353500;
border: 0px;
border-bottom: 1px solid #ffffff63;
outline: 0px;
color: #000000e3;
border-radius: 0px;
padding: 10px 0px;
cursor: pointer;
margin-bottom: 3px;
font-family: 'Montserrat', sans-serif;
text-align: left;
}

.grupo-pop-modal > div > form > .fields > span > span
{
display: block;
}

.grupo-pop-modal > div > form > div > input,.grupo-pop-modal > div > form > div > select,.grupo-pop-modal > div > form > div > textarea
{
display: block;
border: 0px;
background: transparent;  
color: #828282;
border-bottom: 1px solid #00000063;
outline: 0px;
border-radius: 0px;
padding: 0px 0px;
padding-bottom: 5px;
width: 100%;
margin-bottom: 5px;
font-family: 'Montserrat', sans-serif;
}

.grupo-pop-modal > div > form > div > select > option
{
outline: none;
background: #c0cae8;
}

.grupo-pop-modal > div > form > input[type="submit"]
{
background: linear-gradient(to right,#000000,#000000);
border: 0px;
border-radius: 66px;
color: white;
width: 100%;
padding: 8px 0px;
font-family: 'Montserrat', sans-serif;
font-size: 14px;
margin-top: 21px;
font-weight: 600;
outline: none;
width: 200px;
}

.grupo-pop-modal > div > form > .fields > div.checkbox
{
text-align: left;
color: #9fabb1e3;
}

.grupo-pop-modal > div > form > .fields > div.checkbox > span > input
{
margin-right: 4px;
float: left;
margin-top: 6px;
}

.grupo-pop-modal > div > form > .fields > div.checkbox >span
{
margin-right: 4px;
font-size: 15px;
display: block;
}

.grupo-pop-modal > div > form > span.cancel
{
display: block;
font-size: 13px;
margin-top: 11px;
color: #736a6a;
margin-bottom: 22px;
cursor: pointer;
}

.switch {
position: relative;
display: inline-block;
width: 60px;
height: 34px;
}

.switch input {
opacity: 0;
width: 0;
height: 0;
}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;
}

input:checked + .slider {
background-color: #2196F3;
}

input:focus + .slider {
box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
-webkit-transform: translateX(26px);
-ms-transform: translateX(26px);
transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
border-radius: 34px;
}

.slider.round:before {
border-radius: 50%;
}

.sizeModalInviteByPhone{
height: 356px !important;
}

.sizeModalInviteByUser{
height: 600px !important;

}

.liUsers{
position: relative;
display: block;
padding: 10px 15px;
margin-bottom: -1px;
background-color: #fff;
border: 1px solid #ddd;
color: black;
height: 36px;
cursor : pointer;
}

.list-group {
padding-left: 0;
margin-bottom: 20px;

}

.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
z-index: 2;
color: #fff;
background-color: #337ab7;
border-color: #337ab7;

}

.list-group-item {
position: relative;
display: block;
padding: 10px 15px;
margin-bottom: -1px;
background-color: #fff;
border: 1px solid #000;
color: black;
height: 36px;
cursor : pointer;
}

.closeFrame{
position: absolute;
top: 1rem;
border: none;
background: url(dist/close.png) no-repeat;
cursor: pointer;
z-index: 10000000000000000;
width: 66px;
height: 66px;
}

.closeFrameD{
position: absolute;
/* margin-top: -38%; */
top: 1rem;
border: none;
background: url(dist/close.png) no-repeat;
cursor: pointer;
z-index: 10000000000000000;
width: 66px;
height: 66px;
}

.wrap{
display:none;
}
.previewPDF{
display:none;
}
