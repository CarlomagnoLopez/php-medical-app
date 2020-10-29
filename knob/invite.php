<?php if (!defined('s7V9pz')) {
    die();
} ?><?php
    fnc('grupo');
    ?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Invitation">
    <meta name="author" content="Baevox">
    <meta name="generator" content="Grupo">
    <title>Invitation</title>
    <link rel="shortcut icon" type="image/png" href="<?php pr(mf("grupo/global/favicon.png")); ?>" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700,700i,800" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" rel="stylesheet">

    <?php
    css("404");
    ?>
</head>

<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>Hello!</h1>
            </div>
            <h2> some one invite you.</h2>
            <p>
                <h2>You will get a OTP soon.</h2>
            </p>
            <form id="formOTP">

                <label><i class="ti-location-pin"></i>
                    <input type="text" id="txtOTP" class="only-numbers otpCodeLimit" autocomplete='off' id="" name="" placeholder="Type your OTP" />
                </label>
               <button type="submit" id="btnLogin">Log in</button>
            </form>
        </div>
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

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script src="./dist/jquery.loading.block.js"></script>
<script src="./dist/bootbox/bootbox.all.js"></script>


<script src="./gem/mine/ajx.js"></script>
<script src="./gem/mine/invite.js"></script>

</html>