<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_register($do) {
    if (gr_default('get', 'userreg') == 'enable') {
        if (!empty($do["g-recaptcha-response"]) && gr_captcha($do["g-recaptcha-response"]) || gr_default('get', 'recaptcha') != 'enable') {
            if (gr_usip('check')) {
                gr_prnt('$.toast("'.gr_lang('get', 'ip_blocked').'","e");');
                exit;
            }
            $do["email"] = vc($do["email"], 'email');
            // $do["name"] = vc($do["name"], 'alphanum');
            $do["name"]  = vc($do["name"]);
            $do["fname"] = vc($do["fname"], 'strip');
            if (empty($do["fname"]) || empty($do["name"]) || empty($do["email"]) || empty($do["pass"]) || empty($do["fphonenumber"]) || empty($do['fcomplementPhone'])  ) { 
              //gr_prnt('$.toast("'.gr_lang('get', 'invalid_value').'");');
                gr_prnt('$.toast("'.gr_lang('get', 'invalid_value').'");$.loadingBlockHide();');

            } else {
                $reg = usr('Grupo', 'register', $do["name"], $do["email"], $do["pass"], $do["fphonenumber"], $do["fIdOrganization"], $do['fStatusUser'], $do['fcomplementPhone'], $do['faddress'] , $do['fzipcode'], $do['fname'], $do['flastname']);
                if ($reg[0]) {
                    $id = $reg[1];
                    gr_data('i', 'profile', 'name', $do["fname"], $id);
                   // gr_mail('verify', $id, 0, rn(5));
                   // gr_prnt('$.toast("'.gr_lang('get', 'check_inbox').'","s");');
                   if($do["fStatusUser"] == '1'){
                        $id              = $reg[2]['id'];
                        $status          = $reg[2]['status'];
                        $id_organization = $reg[2]['id_organization'];
                        $role            = $reg[2]['role'];
                        $phone           = $reg[2]['phone'];
                        $name            = $reg[2]['name'];
                        $email           = $reg[2]['email'];
                        
                        gr_prnt('setTimeout(function() {
                                sessionStorage.setItem("id","'.$id.'");
                                sessionStorage.setItem("status","'.$status.'");
                                sessionStorage.setItem("id_organization","'.$id_organization.'");
                                sessionStorage.setItem("role","'.$role.'");
                                sessionStorage.setItem("phone","'.$phone.'");
                                sessionStorage.setItem("name","'.$name.'");
                                sessionStorage.setItem("email","'.$email.'");
                                location.reload(); }, 2000);');
                    }else{
                        $username = $do["name"];
                        gr_prnt('$.toast("User $username created successfully.");$(".clearValues").val("");$("#selComplementPhone").val(1);$.loadingBlockHide();');
                    }
                }else{
                    gr_prnt('$.toast("plese try again.");$.loadingBlockHide();');
                }
            }
        } else {
            gr_prnt('$.toast("'.gr_lang('get', 'invalid_captcha').'");$.loadingBlockHide();');
        }
    }
}

function gr_login($do) {
    if (!empty($do["g-recaptcha-response"]) && gr_captcha($do["g-recaptcha-response"]) || gr_default('get', 'recaptcha') != 'enable') {
        if (gr_usip('check')) {
            gr_prnt('$.toast("'.gr_lang('get', 'ip_blocked').'","e");');
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
          //  $phone_number = '+'.$do["fcomplementPhoneLogin"].''.$do["fphonenumberlogin"];
            $username = $do["usernamelogin"];
            $login = usr('Grupo', 'login', $do["sign"], $do["pass"], 3, $do["rmbr"],$username);
            if ($login[0]) {
                $id              = $login[2]['id'];
                $status          = $login[2]['status'];
                $id_organization = $login[2]['id_organization'];
                $role            = $login[2]['role'];
                $phone           = $login[2]['phone'];
                $name            = $login[2]['name'];
                $email           = $login[2]['email'];

                gr_prnt('sessionStorage.setItem("id","'.$id.'");
                         sessionStorage.setItem("status","'.$status.'");
                         sessionStorage.setItem("id_organization","'.$id_organization.'");
                         sessionStorage.setItem("role","'.$role.'");
                         sessionStorage.setItem("phone","'.$phone.'");
                         sessionStorage.setItem("name","'.$name.'");
                         sessionStorage.setItem("email","'.$email.'");
                        location.reload();');
            } else {
                if ($login[1] === 'blocked') {
                  //  gr_prnt('$.toast("'.gr_lang('get', 'device_blocked').'");');
                    gr_prnt('$.toast("'.gr_lang('get', 'device_blocked').'");$.loadingBlockHide();');

                } else {
                    gr_prnt('$.toast("'.gr_lang('get', 'invalid_login').'");$.loadingBlockHide();');
                    //gr_prnt('$.toast("'.gr_lang('get', 'invalid_login').'");');
                }
            }
        }
    } else {
        gr_prnt('$.toast("'.gr_lang('get', 'invalid_captcha').'");');
    }
}

function gr_forgot($do) {
    if (!empty($do["g-recaptcha-response"]) && gr_captcha($do["g-recaptcha-response"]) || gr_default('get', 'recaptcha') != 'enable') {
        if (empty($do["sign"])) {
            gr_prnt('$.toast("'.gr_lang('get', 'invalid_value').'");');
        } else {
            $usr = usr('Grupo', 'select', $do["sign"]);
            if (isset($usr['id'])) {
                gr_mail('reset', $usr['id'], 0, rn(5));
                gr_prnt('$.toast("'.gr_lang('get', 'check_inbox').'","s");');
                gr_prnt('setTimeout(function() { location.reload(); }, 2000);');
            } else {
                gr_prnt('$.toast("'.gr_lang('get', 'user_does_not_exist').'","e");');
            }
        }
    } else {
        gr_prnt('$.toast("'.gr_lang('get', 'invalid_captcha').'");');
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