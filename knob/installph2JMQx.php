<?php if(!defined('s7V9pz')) {die();}?><?php
fnc('grupo');
grupofns();
?>
<!doctype html>
<html lang="en">
<head>
<meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Grupo Installation</title>
    <meta name="description" content="Grupo Chatrooms">
    <meta name="author" content="Silwr">
    <meta name="generator" content="Grupo">
    <link rel="shortcut icon" type="image/png" href="<?php pr(mf("grupo/global/favicon.png")); ?>" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700,700i,800" rel="stylesheet">
    <?php
    cdn("npm/bootstrap@4.3.1/dist/css/bootstrap.min.css", "npm/cd-themify-icons@0.0.1/index.css");
    css("gr-sign");
    ?>
</head>
<body class="sign two bgtwo">
    <section>
        <div>
            <div>
                <div class='box'>
                    <div class="logo">
                        <img src="<?php pr(mf("grupo/global/grupo.png")); ?>" />
                    </div>
                    <form autocomplete='off' class='gr_install'>
                        <div class="elements">
                            <input type="hidden" name="act" value=1 />
                            <input type="hidden" name="do" class='doz' value='install' />
                            <div class='stepone'>
                                <label><i class="ti-home"></i>
                                    <input type="text" autocomplete='off' name="site" placeholder="Site Name" />
                                </label>
                                <label><i class="ti-rss-alt"></i>
                                    <input type="text" autocomplete='off' name="host" placeholder="Database Host" />
                                </label>
                                <label><i class="ti-server"></i>
                                    <input type="text" autocomplete='off' name="db" placeholder="Database Name" />
                                </label>
                                <label><i class="ti-user"></i>
                                    <input type="text" autocomplete='off' name="user" placeholder="Database Username" />
                                </label>
                                <label><i class="ti-lock"></i>
                                    <input type="text" autocomplete='off' name="pass" placeholder="Database Password" />
                                </label>
                            </div>
                            <div class='steptwo d-none'>
                                <label><i class="ti-link"></i>
                                    <input type="text" autocomplete='off' class='surl' name="url" placeholder="Site URL" />
                                </label>
                                <label><i class="ti-email"></i>
                                    <input type="text" autocomplete='off' class='semail' name="email" placeholder="Email Address" />
                                </label>

                                <label><i class="ti-user"></i>
                                    <input type="text" autocomplete='off' name="username" placeholder="Username" />
                                </label>

                                <label><i class="ti-lock"></i>
                                    <input type="password" autocomplete='off' name="password" placeholder="Password" />
                                </label>
                            </div>
                        </div>
                        <div class="regsep"></div>
                        <span class="submit global" form='.gr_install' url='<?php pr(url()); ?>install/'>Next Step</span>
                        <div class="switch">
                            <i>Stuck at Somewhere?</i>
                            <span class='say' say='Write a mail to hello@baevox.com' sec='8000'><a href="mailto:hello@baevox.com">Contact Us</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

<?php
cdn("npm/jquery@3.3.1/dist/jquery.min.js");
cdn("npm/jquery-migrate@3.0.1/dist/jquery-migrate.min.js");
cdn("npm/popper.js@1.14.7/dist/umd/popper.min.js");
cdn("npm/bootstrap@4.3.1/dist/js/bootstrap.min.js");
cdn("npm/jquery.nicescroll@3.7.6/jquery.nicescroll.min.js");
cdn("npm/js-cookie@2/src/js.cookie.min.js");
js('ajx', 'gr-install');
?>
</html>