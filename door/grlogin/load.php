<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_register($do) {
    if (gr_default('get', 'userreg') == 'enable') {
        if (!empty($do["g-recaptcha-response"]) && gr_captcha($do["g-recaptcha-response"]) || gr_default('get', 'recaptcha') != 'enable') {
            if (gr_usip('check')) {
                gr_prnt('say("'.gr_lang('get', 'ip_blocked').'","e");');
                exit;
            }
            $do["email"] = vc($do["email"], 'email');
            $do["name"] = vc($do["name"], 'alphanum');
            $do["fname"] = vc($do["fname"], 'strip');
            if (empty($do["fname"]) || empty($do["name"]) || empty($do["email"]) || empty($do["pass"]) || empty($do["fphonenumber"]) ) {
                gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
            } else if (usr('Grupo', 'exist', $do["name"])) {
                gr_prnt('say("'.gr_lang('get', 'username_exists').'");');
            } else if (usr('Grupo', 'exist', $do["email"])) {
                gr_prnt('say("'.gr_lang('get', 'email_exists').'");');
            } else {
                $reg = usr('Grupo', 'register', $do["name"], $do["email"], $do["pass"], $do["fphonenumber"]);
                if ($reg[0]) {
                    $id = $reg[1];
                    gr_data('i', 'profile', 'name', $do["fname"], $id);
                    gr_mail('verify', $id, 0, rn(5));
                    gr_prnt('say("'.gr_lang('get', 'check_inbox').'","s");');

                    gr_prnt('setTimeout(function() { location.reload(); }, 2000);');
                }
            }
        } else {
            gr_prnt('say("'.gr_lang('get', 'invalid_captcha').'");');
        }
    }
}

function gr_login($do) {
    if (!empty($do["g-recaptcha-response"]) && gr_captcha($do["g-recaptcha-response"]) || gr_default('get', 'recaptcha') != 'enable') {
        if (gr_usip('check')) {
            gr_prnt('say("'.gr_lang('get', 'ip_blocked').'","e");');
            exit;
        }
        if (empty($do["sign"]) && empty($do["pass"]) && gr_default('get', 'guest_login') == 'enable') {
            $usrn = rn(8);
            $sign = rn(4).rn(3).'@'.rn(13).'.com';
            $pasw = rn(12);
            $nme = 'Guest#'.rn(6);
            $reg = usr('Grupo', 'register', $usrn, $sign, $pasw);
            db('Grupo', 'u', 'users', 'role', 'id', 5, $reg[1]);
            gr_data('i', 'profile', 'name', $nme, $reg[1]);
            usr('Grupo', 'forcelogin', $usrn);
            gr_prnt('location.reload();');
            exit;
        } else {
            $login = usr('Grupo', 'login', $do["sign"], $do["pass"], 3, $do["rmbr"]);
            if ($login[0]) {
                gr_prnt('location.reload();');
            } else {
                if ($login[1] === 'blocked') {
                    gr_prnt('say("'.gr_lang('get', 'device_blocked').'");');
                } else {
                    gr_prnt('say("'.gr_lang('get', 'invalid_login').'");');
                }
            }
        }
    } else {
        gr_prnt('say("'.gr_lang('get', 'invalid_captcha').'");');
    }
}

function gr_forgot($do) {
    if (!empty($do["g-recaptcha-response"]) && gr_captcha($do["g-recaptcha-response"]) || gr_default('get', 'recaptcha') != 'enable') {
        if (empty($do["sign"])) {
            gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
        } else {
            $usr = usr('Grupo', 'select', $do["sign"]);
            if (isset($usr['id'])) {
                gr_mail('reset', $usr['id'], 0, rn(5));
                gr_prnt('say("'.gr_lang('get', 'check_inbox').'","s");');
                gr_prnt('setTimeout(function() { location.reload(); }, 2000);');
            } else {
                gr_prnt('say("'.gr_lang('get', 'user_does_not_exist').'","e");');
            }
        }
    } else {
        gr_prnt('say("'.gr_lang('get', 'invalid_captcha').'");');
    }
}

function gr_captcha($response) {
    $response;
    $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';
    $post_data = http_build_query(
        array(
            'secret' => gr_default('get', 'rsecretkey'),
            'response' => $response,
            'remoteip' => (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'])
        )
    );
    if (function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec')) {
        $ch = curl_init($verifyURL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/x-www-form-urlencoded'));
        $response = curl_exec($ch);
        curl_close($ch);
    } else {
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
        );
        $context = stream_context_create($opts);
        $response = file_get_contents($verifyURL, false, $context);
    }
    if ($response) {
        $result = json_decode($response);
        if ($result->success === true) {
            return true;
        } else {
            return $result;
        }
    }
    return false;
}
?>