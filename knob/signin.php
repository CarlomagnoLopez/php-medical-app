<?php if(!defined('s7V9pz')) {die();}?><?php
fnc('grupo');
usr('Grupo', 'remember');
if (usr('Grupo')['active']) {
    rt('index');
}
grupofns();
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no shrink-to-fit=no">    <title><?php pr(gr_default('get', 'sitename')); ?></title>
    <meta name="description" content="<?php pr(gr_default('get', 'sitedesc')); ?>">
    <meta name="author" content="Silwr">
    <meta name="generator" content="Grupo">
    <link rel="shortcut icon" type="image/png" href="<?php pr(mf("grupo/global/favicon.png")); ?>" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700,700i,800" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" rel="stylesheet">

    <?php
    cdn("npm/bootstrap@4.3.1/dist/css/bootstrap.min.css", "npm/cd-themify-icons@0.0.1/index.css");
    css("gr-sign");
    ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="sign two bgone">
    <div class="gr-lselect">
    <?php pr(gr_lang('list', 2)) ?>
    </div>
    <section>
        <div>
            <div>
                <div class='box'>
                    <div class="logo">
                        <img style="width: 130px;" src="<?php pr(mf("grupo/global/logo-main.png")); ?>" />
                    </div>
                    <form autocomplete='off' class='gr_sign'>
                        <div class="elements">
                            <input type="hidden" name="act" value=1 />
                            <input type="hidden" name="do" class='doz' value='login' />
                            <div class='register d-none'>
                                <label><i class="ti-key"></i>
                                    <input type="password" autocomplete='off' id="txtSecretKey" name="fsecretkey" class="clearValues" placeholder="e.g. 14cfr" maxlength="5"/>
                                </label>
                                <label><i class="ti-layout-cta-right"></i>
                                    <input type="text" autocomplete='off' id="txtOrganizationName" name="forganizationname" class="clearValues" placeholder="Organization name"/>
                                </label>
                                <label><i class="ti-user"></i>
                                    <input type="text" autocomplete='off' id="txtName" name="fname" class="clearValues" placeholder="Name" />
                                </label>
                                <label><i class="ti-user"></i>
                                    <input type="text" autocomplete='off' id="txtLastName" name="flastname" class="clearValues" placeholder="Last Name" />
                                </label>
                                <label><i class="ti-home"></i>
                                    <input type="text" autocomplete='off' id="txtAddress" name="faddress" class="clearValues" placeholder="Address" />
                                </label>
                                <label><i class="ti-location-pin"></i>
                                    <input type="text" class="only-numbers zipCodeLimit clearValues" autocomplete='off' id="txtZipCode" name="fzipcode" placeholder="ZipCode" />
                                </label>
                                <div style="position: absolute;margin-left: 31px;margin-top: 10px;color: black;">
                                        <select name="fcomplementPhone" id="selComplementPhone">
                                            <option value="1" selected>+1</option>
                                            <option value="86">+86</option>
                                            <option value="87">+87</option>
                                            <option value="91">+91</option>
                                            <option value="55">+55</option>
                                            <option value="52">+52</option>
                                        </select>
                                </div>
                                <div>
                                    <label><i class="ti-mobile"></i>
                                        <input type="text" class="only-numbers phoneNumberLimit clearValues" autocomplete='off' id="txtPhoneNumber" name="fphonenumber" placeholder="Phone Number" style="padding-left: 101px;"/>                                  
                                    </label>
                                </div>
                                <label><i class="ti-user"></i>
                                    <input type="text" autocomplete='off' id="txtUsername" name="name" class="clearValues" placeholder="<?php pr(gr_lang('get', 'username')) ?>" />
                                </label>
                                <label><i class="ti-email"></i>
                                     <input type="email" autocomplete='off' id="txtEmail" name="email" class="clearValues" placeholder="Email" />
                                </label>
                                    <input type="hidden" autocomplete='off' id="txtIdOrganization" class="clearValues" name="fIdOrganization" />
                                    <input type="hidden" autocomplete='off' id="txtStatusUser" class="clearValues" name="fStatusUser" />
                            </div>
                            <div class='login'>
                                <label><i class="ti-user"></i>
                                    <!-- <input type="text" autocomplete='off' id="txtEmailLogin" name="sign" placeholder="Username" /> -->
                                    <input type="text" autocomplete='off' id="txtUsernameLogin" name="usernamelogin" placeholder="<?php pr(gr_lang('get', 'username')) ?>" />
                                </label>
                                <!-- <div style="position: absolute;margin-left: 31px;margin-top: 10px;color: black;">
                                        <select name="fcomplementPhoneLogin" id="selComplementPhoneLogin">
                                            <option value="1" selected>+1</option>
                                            <option value="86">+86</option>
                                            <option value="87">+87</option>
                                            <option value="91">+91</option>
                                            <option value="55">+55</option>
                                            <option value="52">+52</option>
                                        </select>
                                </div>
                                <div>
                                    <label><i class="ti-mobile"></i>
                                        <input type="text" class="only-numbers phoneNumberLimit" autocomplete='off' id="txtPhoneNumberLogin" name="fphonenumberlogin" placeholder="Phone Number" style="padding-left: 101px;"/>                                  
                                    </label>
                                </div> -->

                            </div>
                            <div class='global'>
                                <label><i class="ti-lock"></i>
                                    <input type="password" class='gstdep clearValues' autocomplete='off' id="txtPassword" name="pass" placeholder="<?php pr(gr_lang('get', 'password')) ?>" />
                                </label>
                            </div>
                            <label id="fieldRepeatPassword"><i class="ti-lock"></i>
                                <input type="password" class='gstdep clearValues' autocomplete='off' id="txtRepeatPassword" name="repeat_pass" placeholder="Repeat Password" />
                            </label>

                        </div>
                        <div class="regsep d-none"></div>
                        <div class="sub">
                            <span class='rmbr' style="color: black;"><i><b></b><input type="hidden" name="rmbr" /></i> <?php pr(gr_lang('get', 'remember_me')) ?></span>
                            <span class="doer" data-do="forgot"><?php pr(gr_lang('get', 'forgot_password')) ?></span>
                        </div>
                        <?php if (gr_default('get', 'recaptcha') == 'enable') {
                            ?>
                            <div class='recaptcha'>
                                <div class="g-recaptcha" data-theme='dark' data-sitekey="<?php pr(gr_default('get', 'rsitekey')) ?>"></div>
                            </div>
                            <?php
                        } ?>
                        <span class="submit global" form='.gr_sign' do='login' btn='<?php pr(gr_lang('get', 'register')); ?>' em='<?php pr(gr_lang('get', 'invalid_value')); ?>' gst=0 dlg='<?php pr(gr_lang('get', 'login')); ?>' glog='<?php pr(gr_default('get', 'guest_login')); ?>'>
                            <?php
                            if (gr_default('get', 'guest_login') == 'enable') {
                                pr(gr_lang('get', 'login_as_guest'));
                            } else {
                                pr(gr_lang('get', 'login'));
                            }
                            ?>
                        </span>
                        <span class="submit ajx reset d-none" form='.gr_sign'><?php pr(gr_lang('get', 'reset')); ?></span>
                        <?php if (gr_default('get', 'userreg') == 'enable') {
                            ?>
                            <div class="switch" qn='<?php pr(gr_lang('get', 'already_have_account')); ?>' btn='<?php pr(gr_lang('get', 'login')); ?>'>
                                <i><?php pr(gr_lang('get', 'dont_have_account')); ?></i>
                                <span><?php pr(gr_lang('get', 'create')); ?></span>
                            </div>
                            <?php
                        } ?>
                    </form>
                    <div class='tos'>
                        <h4><span><?php pr(gr_lang('get', 'tos')); ?></span><i class="ti-close"></i></h4>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class='gr-consent'>
        <span>
            <span><?php pr(gr_lang('get', 'cookie_constent')); ?> <i><?php pr(gr_lang('get', 'tos')); ?></i></span>
            <i><?php pr(gr_lang('get', 'got_it')); ?></i>
        </span>
    </div>
    <div class='ajxprocess'><span></span></div>
</body>

<!-- <section id="modalInvite" class="grupo-pop-modal" style="display: none;">
         <div>
            <form autocomplete="off" id="formModalInvite" class="sizeModalInviteByPhone" >
                <span class="head" id="titleInvite">Invite</span>
                <div class="fields scroller" tabindex="5" style="overflow-y: hidden; outline: none;">
                    <div style="position: relative;">
                        <label>Invite by phone</label>
                    </div>
                    <div style="position: relative;float: right;">
                        <label class="switch">
                        <input id="chkFilterModalInvite" type="checkbox" checked>
                        <span class="slider round"></span>
                        </label>
                    </div>
                    <label>Invite by phone</label>


                    <div class="divByPhone">
                        <div style="margin-top: 30px;position: absolute;">
                            <select name="fcomplementPhoneInvite" id="selProfileComplementPhoneInvite">
                                <option value="+1" selected>+1</option>
                                <option value="+86">+86</option>
                                <option value="+87">+87</option>
                                <option value="+91">+91</option>
                                <option value="+55">+55</option>
                                <option value="+52">+52</option>
                            </select>
                        </div>
                        <label class="color-label">Phone Number</label>
                        <input type="text" name="fPhoneNumberInvite" id="txtProfilePhoneNumberInvite" class="margin-input only-numbers phoneNumberLimit" style="margin-left: 60px;width: 178px;">
                    </div>
                    <div class="divByUser">
                        <label style="color: black;" id="totalUsers"></label>
                        <div>
                            <ul id="ulListUsers" class="list-group">

                            </ul>
                        </div>
                        
                    </div>


                </div>
                <button type="button" onclick="onClickInvite(this)" class="button-submit-form  ajx grsub">Invite</button>
                <span class="cancel" onclick="onClickCancelInvite()">Cancel</span>
            </form>
        </div>
    </section> -->


<?php
css("custom");
cdn("npm/jquery@3.3.1/dist/jquery.min.js");
cdn("npm/jquery-migrate@3.0.1/dist/jquery-migrate.min.js");
cdn("npm/popper.js@1.14.7/dist/umd/popper.min.js");
cdn("npm/bootstrap@4.3.1/dist/js/bootstrap.min.js");
cdn("npm/jquery.nicescroll@3.7.6/jquery.nicescroll.min.js");
cdn("npm/js-cookie@2/src/js.cookie.min.js");

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script src="./dist/jquery.loading.block.js"></script>
<script src="./dist/bootbox/bootbox.all.js"></script>


<script src="./gem/mine/ajx.js"></script>
<script src="./gem/mine/gr-sign.js"></script>
</html>