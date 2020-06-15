<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_sys() {
    $arg = func_get_args();
    $uid = usr('Grupo')['id'];
    if ($arg[0]['type'] === 'appearance' || $arg[0]['type'] === 'hf') {
        if ($arg[0]['type'] === 'appearance') {
            if (!gr_role('access', 'sys', '2')) {
                exit;
            }
            $css = db('Grupo', 's', 'customize', 'type|,type|,type', 'style', 'customcss', 'mstyle');
        } else {
            if (!gr_role('access', 'sys', '5')) {
                exit;
            }
            $css = db('Grupo', 's', 'customize', 'type', 'hf');
        }
        foreach ($css as $c) {
            $key = $c['id'];
            if ($c['v2'] == 'background' && !empty($c['v4']) || $c['v2'] == 'text-color') {
                $a = $key.'a';
                $b = $key.'b';
                if (!empty($arg[0][$a]) && $arg[0][$a] != $c['v3']) {
                    db('Grupo', 'u', 'customize', 'v3', 'id', $arg[0][$a], $key);
                }
                if (!empty($arg[0][$b]) && $arg[0][$b] != $c['v4']) {
                    db('Grupo', 'u', 'customize', 'v4', 'id', $arg[0][$b], $key);
                }
            } else if ($c['type'] == 'customcss') {
                $d = $key.'custom';
                if ($arg[0][$d] != $c['v1']) {
                    db('Grupo', 'u', 'customize', 'v1', 'id', $arg[0][$d], $key);
                }
            } else if ($c['type'] == 'hf') {
                if ($arg[0][$key] != $c['v1']) {
                    db('Grupo', 'u', 'customize', 'v1#', 'id', $arg[0][$key], $key);
                }
            } else {
                if (!empty($arg[0][$key]) && $arg[0][$key] != $c['v3']) {
                    db('Grupo', 'u', 'customize', 'v3', 'id', $arg[0][$key], $key);
                }
            }

        }
        gr_prnt('say("'.gr_lang('get', 'updated').'","s");');
        gr_prnt('location.reload(); ');
    } else if ($arg[0]['type'] === 'banip') {
        if (gr_role('access', 'sys', '3')) {
            if (!empty($arg[0]['blist'])) {
                db('Grupo', 'u', 'options', 'v2', 'type', $arg[0]['blist'], 'blacklist');
                gr_prnt('say("'.gr_lang('get', 'updated').'","s");$(".grupo-pop").fadeOut();');
            }
        }
        exit;
    } else if ($arg[0]['type'] === 'filterwords') {
        if (gr_role('access', 'sys', '4')) {
            if (!empty($arg[0]['blist'])) {
                db('Grupo', 'u', 'options', 'v2', 'type', $arg[0]['blist'], 'filterwords');
                gr_prnt('say("'.gr_lang('get', 'updated').'","s");$(".grupo-pop").fadeOut();');
            }
        }
        exit;
    } else if ($arg[0]['type'] === 'settings') {
        if (gr_role('access', 'sys', '1')) {
            $sys = db('Grupo', 's', 'options', 'type', 'default');
            foreach ($sys as $s) {
                $key = $s['id'];
                if (!empty($arg[0][$key]) && $arg[0][$key] != $s['v2'] || $s['v1'] == 'autogroupjoin') {
                    db('Grupo', 'u', 'options', 'v2', 'id', $arg[0][$key], $key);
                }
            }
            if (isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name'])) {
                if (flr('upload', 'logo', 'grupo/global/', 'logo', 'jpg,png,gif', 1, 1, 'png', 1)) {
                    if (!is_array(getimagesize('gem/ore/grupo/global/logo.png'))) {
                        flr('delete', 'grupo/global/logo.png');
                    }
                }
            }
            if (isset($_FILES['emaillogo']['name']) && !empty($_FILES['emaillogo']['name'])) {
                if (flr('upload', 'emaillogo', 'grupo/global/', 'emaillogo', 'jpg,png,gif', 1, 1, 'png', 1)) {
                    if (!is_array(getimagesize('gem/ore/grupo/global/emaillogo.png'))) {
                        flr('delete', 'grupo/global/emaillogo.png');
                    }
                }
            }
            if (isset($_FILES['defaultbg']['name']) && !empty($_FILES['defaultbg']['name'])) {
                if (flr('upload', 'defaultbg', 'grupo/global/', 'bg', 'jpg,png,gif', 1, 1, 'jpg', 1)) {
                    if (@is_array(getimagesize('gem/ore/grupo/global/bg.jpg'))) {
                        flr('compress', 'grupo/global/bg.jpg', 50);
                    } else {
                        flr('delete', 'grupo/global/bg.jpg');
                    }
                }
            }
            if (isset($_FILES['loginbg']['name']) && !empty($_FILES['loginbg']['name'])) {
                if (flr('upload', 'loginbg', 'grupo/global/', 'login', 'jpg,png,gif', 1, 1, 'jpg', 1)) {
                    if (@is_array(getimagesize('gem/ore/grupo/global/login.jpg'))) {
                        flr('compress', 'grupo/global/login.jpg', 50);
                    } else {
                        flr('delete', 'grupo/global/login.jpg');
                    }
                }
            }
            if (isset($_FILES['favicon']['name']) && !empty($_FILES['favicon']['name'])) {
                if (flr('upload', 'favicon', 'grupo/global/', 'favicon', 'jpg,png,gif', 1, 1, 'png', 1)) {
                    if (!is_array(getimagesize('gem/ore/grupo/global/favicon.png'))) {
                        flr('delete', 'grupo/global/favicon.png');
                    }
                }
            }
            gr_prnt('say("'.gr_lang('get', 'updated').'","s");');
            gr_prnt('location.reload(); ');
        }
    }
}
?>