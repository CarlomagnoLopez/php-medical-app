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
                <div class="logo">  
                     <img width="100" style="width: 40%;" src="<?php pr(mf("grupo/global/logo-main.png")); ?>" />
                </div>
                <div class='box'>
                    <div class="logo">
                        <img src="<?php pr(mf("grupo/global/logo.png")); ?>" />
                    </div>
                    <form autocomplete='off' class='gr_sign'>
                        <div class="elements">
                            <input type="hidden" name="act" value=1 />
                            <input type="hidden" name="do" class='doz' value='login' />
                            <div class='register d-none'>
                                <label><i class="ti-user"></i>
                                    <input type="text" autocomplete='off' name="fname" placeholder="<?php pr(gr_lang('get', 'full_name')) ?>" />
                                </label>
                                <label><i class="ti-email"></i>
                                    <input type="email" autocomplete='off' name="email" placeholder="<?php pr(gr_lang('get', 'email_address')) ?>" />
                                </label>
                                <label><i class="ti-world"></i>
                                    <input type="text" autocomplete='off' name="name" placeholder="<?php pr(gr_lang('get', 'username')) ?>" />
                                </label>
                            </div>
                            <div class='login'>
                                <label><i class="ti-user"></i>
                                    <input type="text" autocomplete='off' name="sign" id="txtUser" placeholder="<?php pr(gr_lang('get', 'email_username')) ?>" />
                                </label>
                            </div>
                            <div class='global'>
                                <label><i class="ti-lock"></i>
                                    <input type="password" class='gstdep' autocomplete='off' id="txtPsw" name="pass" placeholder="<?php pr(gr_lang('get', 'password')) ?>" />
                                </label>
                            </div>
                        </div>
                        <div class="regsep d-none"></div>
                        <div class="sub">
                            <span class='rmbr'><i><b></b><input type="hidden" name="rmbr" /></i> <?php pr(gr_lang('get', 'remember_me')) ?></span>
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
</body>

<?php
css("custom");
cdn("npm/jquery@3.3.1/dist/jquery.min.js");
cdn("npm/jquery-migrate@3.0.1/dist/jquery-migrate.min.js");
cdn("npm/popper.js@1.14.7/dist/umd/popper.min.js");
cdn("npm/bootstrap@4.3.1/dist/js/bootstrap.min.js");
cdn("npm/jquery.nicescroll@3.7.6/jquery.nicescroll.min.js");
cdn("npm/js-cookie@2/src/js.cookie.min.js");
js("ajx", "gr-sign");
if (pg('signin') == 'unverified/') {
    pr("<script> alert('".gr_lang('get', 'check_inbox')."'); </script>");
}
?>
<script src="../asset/jquery.loading.block.js"></script>


<script>

    $.loadingBlockShow({
        imgPath: '../asset/default.svg',
        text: 'Loading...',
        style: {
            position: 'fixed',
            width: '100%',
            height: '100%',
            background: 'rgba(0, 0, 0, .8)',
            left: 0,
            top: 0,
            zIndex: 10000
        }
    });
</script>

</html>