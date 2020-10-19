<?php if(!defined('s7V9pz')) {die();}?><?php
fnc('grupo');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php pr(gr_lang('get', '404_page_title')) ?>">
    <meta name="author" content="Baevox">
    <meta name="generator" content="Grupo">
    <title><?php pr(gr_lang('get', '404_page_title')) ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php pr(mf("grupo/global/favicon.png")); ?>" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700,700i,800" rel="stylesheet">
    <?php
    css("404");
    ?>
</head>
<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1><?php pr(gr_lang('get', '404_page_oops')) ?></h1>
            </div>
            <h2><?php pr(gr_lang('get', '404_page_heading')) ?></h2>
            <p>
                <?php pr(gr_lang('get', '404_page_desc')) ?>
            </p>
            <a href="<?php pr(url()); ?>"><?php pr(gr_lang('get', '404_page_go_to_btn')) ?></a>
        </div>
    </div>

</body>
</html>