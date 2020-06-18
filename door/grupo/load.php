<?php if(!defined('s7V9pz')) {die();}?><?php
fnc('guard', 'db', 'user', 'dir');
function grupofns() {
    $do = get();
    if (file_exists('knob/install.php')) {
        fnc('grinstall');
        gr_install($do);
    } else {
        gr_iplook();
    }
    if (isset($do["act"])) {
        if (!usr('Grupo')['active']) {
            fnc('grlogin');
            if ($do["do"] == "login") {
                gr_login($do);
            } else if ($do["do"] == "register") {
                gr_register($do);
            } else if ($do["do"] == "forgot") {
                gr_forgot($do);
            } else if ($do["do"] == "terms") {
                gr_prnt(nl2br(gr_lang('get', 'terms')));
            } else if ($do["do"] == "language") {
                gr_lang($do);
            }
        } else {
            if ($do["do"] == "list") {
                fnc('grlist');
                gr_list($do);
            } else if ($do["do"] == "form") {
                fnc('grform');
                gr_form($do);
            } else if ($do["do"] == "love") {
                fnc('grlove');
                gr_love($do);
            } else if ($do["do"] == "profile") {
                gr_profile($do);
            } else if ($do["do"] == "create") {
                gr_create($do['type'], $do);
            } else if ($do["do"] == "edit") {
                gr_edit($do['type'], $do);
            } else if ($do["do"] == "group") {
                gr_group($do['type'], $do);
            } else if ($do["do"] == "logout") {
                gr_profile('ustatus', 'offline');
                usr('Grupo', 'logout');
                gr_prnt('location.reload();');
            } else if ($do["do"] == "files") {
                fnc('grfiles');
                gr_files($do);
            } else if ($do["do"] == "role") {
                gr_role($do);
            } else if ($do["do"] == "language") {
                gr_lang($do);
            } else if ($do["do"] == "system") {
                fnc('grsys');
                gr_sys($do);
            } else if ($do["do"] == "liveupdate") {
                fnc('grlive');
                gr_live($do);
            } else if ($do["do"] == "customfield") {
                gr_customfield($do);
            } else if ($do["do"] == "alert") {
                gr_alerts($do);
            }
        }
        exit;
    }
}
function gr_unverified() {
    $uid = usr('Grupo')['id'];
    $role = usr('Grupo', 'select', $uid)['role'];

    if ($role == '1') {
        usr('Grupo', 'logout', $uid);
        rt('signin/unverified');
    } else if ($role == '4') {
        usr('Grupo', 'logout', $uid);
        rt('banned');
    }
}
function gr_reactprof() {
    $uid = usr('Grupo')['id'];
    $dect = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $uid);
    if ($dect && count($dect) > 0) {
        db('Grupo', 'd', 'options', 'type,v1,v3', 'deaccount', 'yes', $uid);
        gr_prnt('<script>$(window).load(function() {say("'.gr_lang('get', 'account_reactivated').'","s");});</script>');
    }
}
function gr_cbg() {
    $uid = usr('Grupo')['id'];
    $bg = gr_img('userbg', $uid);
    if (!empty($bg)) {
        gr_prnt('<style>');
        gr_prnt('body{background: url("'.$bg.'"); background-size: cover; background-position: center;}');
        gr_prnt('</style>');
    }
}
function gr_img() {
    $arg = vc(func_get_args());
    if ($arg[0] == 'userbg') {
        $r = 0;
    } else {
        $r = "gem/ore/grupo/".$arg[0]."/default.png";
    }
    foreach (glob("gem/ore/grupo/".$arg[0]."/".$arg[1]."-gr-*.*") as $im) {
        $r = $im;
    }
    return $r;
}

function gr_tmz() {
    $tzo = null;
    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    foreach ($tzlist as $tz) {
        if (!empty($tz)) {
            $tzo = $tzo.','.$tz;
        }
    }
    return ltrim($tzo, ",");
}
function gr_role() {
    $uid = usr('Grupo')['id'];
    $arg = func_get_args();
    if ($arg[0] === 'access') {
        $r = false;
        if (isset($arg[3])) {
            $uid = $arg[3];
        }
        $role = usr('Grupo', 'select', $uid)['role'];
        $cr = db('Grupo', 's', 'permissions', 'id', $role);
        if (isset($cr[0])) {
            $ac = explode(',', $cr[0][$arg[1]]);
            if (in_array($arg[2], $ac)) {
                $r = true;
            }
        }
        return $r;
    } else if ($arg[0] === 'var') {
        $r = false;
        if (isset($arg[1])) {
            $uid = $arg[1];
        }
        $role = usr('Grupo', 'select', $uid)['role'];
        $cr = db('Grupo', 's', 'permissions', 'id', $role);
        $r = array();
        foreach ($cr as $array) {
            $tablename = array_keys($array);
        }
        foreach ($tablename as $ky) {
            $ky = vc($ky, 'alpha');
            if (!empty($ky) && $ky != 'id' && $ky != 'name') {
                $ac = explode(',', $cr[0][$ky]);
                foreach ($ac as $c) {
                    $r[$ky][$c] = true;
                }
            }
        }
        return $r;
    } else if ($arg[0]['type'] === 'view') {
        if (!gr_role('access', 'roles', '3')) {
            exit;
        }
        gr_prnt('$(".dumb .hidid").val("'.$arg[0]['id'].'");$(".ruserz").trigger("click");');
    } else if ($arg[0]['type'] === 'delete') {
        if ($arg[0]['id'] == 1 || $arg[0]['id'] == 2 || $arg[0]['id'] == 3 || $arg[0]['id'] == 4 || $arg[0]['id'] == 5) {
            gr_prnt('say("'.gr_lang('get', 'deny_default_role').'","e");');
        } else {
            if (!gr_role('access', 'roles', '2')) {
                exit;
            }
            db('Grupo', 'u', 'users', 'role', 'role', 3, $arg[0]['id']);
            db('Grupo', 'd', 'permissions', 'id', $arg[0]['id']);
            foreach (glob("gem/ore/grupo/roles/".$arg[0]['id']."-gr-*.*") as $filename) {
                unlink($filename);
            }
            gr_prnt('say("'.gr_lang('get', 'deleted').'","s");menuclick("mmenu","roles");');
            gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
        }
    }
}
function gr_noswear($text) {
    $bw = db('Grupo', 's', 'options', 'type', 'filterwords')[0]['v2'];
    $bw = preg_split('/\n+/', $bw);
    usort($bw, function($a, $b) {
        return strlen($b) - strlen($a);
    });
    foreach ($bw as $w) {
        $w = trim($w);
        $cw = str_repeat("*", strlen($w));
        if (preg_match('/[^a-zA-Z]+/', $w)) {
            $text = str_replace($w, $cw, $text);
        } else {
            $text = preg_replace("/\b".$w."\b/", $cw, $text);
        }
    }
    return $text;
}
function gr_customfield() {
    $uid = usr('Grupo')['id'];
    $arg = func_get_args();
    if ($arg[0]['type'] === 'delete') {
        if (gr_role('access', 'fields', '3')) {
            $oldfield = db('Grupo', 's', 'profiles', 'type,id', 'field', $arg[0]['id']);
            if (!empty($arg[0]['id']) && count($oldfield) > 0) {
                $r = db('Grupo', 'd', 'profiles', 'type,id', 'field', $arg[0]['id']);
                $dlng = db('Grupo', 's', 'phrases', 'type', 'lang');
                foreach ($dlng as $dl) {
                    db('Grupo', 'd', 'phrases', 'type,short', 'phrase', $oldfield[0]['name']);
                }
                gr_prnt('say("'.gr_lang('get', 'deleted').'","s");menuclick("mmenu","ufields");$(".grupo-pop").fadeOut();');
            } else {
                gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
            }
        }
    }

}
function gr_profile() {
    $uid = usr('Grupo')['id'];
    $arg = func_get_args();

    if ($arg[0] === 'get') {
        $r = gr_lang('get', 'unknown');
        if ($arg[2] === 'tmz') {
            $r = gr_default('get', 'timezone');
        } else if ($arg[2] === 'language') {
            $r = gr_default('get', 'language');
        }
        if (isset($arg[3])) {
            $r = $arg[3];
        }
        $cr = db('Grupo', 's', 'options', 'type,v1,v3', 'profile', $arg[2], $arg[1]);
        if ($cr && count($cr) > 0) {
            $r = $cr[0]['v2'];
            if ($arg[2] === 'status' && $r === 'invisible') {
                $r = 'offline';
            }
            if ($arg[2] === 'status' && $r === 'online' || $r === 'idle') {
                $idle = strtotime(dt()) - strtotime($cr[0]['tms']);
                $idle = round(abs($idle) / 60);
                if ($idle > 60) {
                    gr_profile('ustatus', 'offline', $arg[1]);
                } else if ($idle > 20 && $r !== 'idle') {
                    gr_profile('ustatus', 'idle', $arg[1]);
                }
            }
        }
        return $r;
    } else if ($arg[0] === 'blocked') {
        $chkblocked = db('Grupo', 's,count(*)', 'options', 'type,v1,v2', 'pblock', $uid, $arg[1])[0][0];
        $chkblocked = $chkblocked+db('Grupo', 's,count(*)', 'options', 'type,v2,v1', 'pblock', $uid, $arg[1])[0][0];
        if ($chkblocked > 0) {
            return true;
        } else {
            return false;
        }
    } else if ($arg[0] === 'mode') {
        if (gr_profile('get', $uid, 'status') === 'offline') {
            pr(gr_lang('get', 'go_online'));
        } else {
            pr(gr_lang('get', 'go_offline'));
        }

    } else if ($arg[0] === 'ustatus') {
        if (!empty($arg[1]) && !empty($uid)) {
            if (isset($arg[2])) {
                $uid = $arg[2];
            }
            $ct = db('Grupo', 's', 'options', 'type,v1,v3', 'profile', 'status', $uid);
            if ($ct && count($ct) > 0) {
                if ($ct[0]['v2'] !== 'invisible' || isset($arg[2])) {
                    gr_data('u', 'v2', 'type,v1,v3', $arg[1], 'profile', 'status', $uid);
                }
            } else {
                gr_data('i', 'profile', 'status', $arg[1], $uid);
            }
        }
    } else if ($arg[0]['type'] === 'block') {
        $ct = db('Grupo', 's,count(*)', 'options', 'type,v1,v2', 'pblock', $uid, $arg[0]["id"])[0][0];
        if ($ct > 0) {
            db('Grupo', 'd', 'options', 'type,v1,v2', 'pblock', $uid, $arg[0]["id"]);
            gr_prnt('say("'.gr_lang('get', 'unblocked').'","s");');
        } else {
            db('Grupo', 'i', 'options', 'type,v1,v2', 'pblock', $uid, $arg[0]["id"]);
            gr_prnt('say("'.gr_lang('get', 'blocked').'","e");');
        }
        gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
        gr_prnt('location.reload();');
    } else if ($arg[0]['type'] === 'mode') {
        $ct = db('Grupo', 's', 'options', 'type,v1,v3', 'profile', 'status', $uid);
        if ($ct && count($ct) > 0) {
            $s = 'invisible';
            if ($ct[0]['v2'] === 'invisible') {
                $s = 'online';
            }
            gr_data('u', 'v2', 'type,v1,v3', $s, 'profile', 'status', $uid);
            gr_prnt('location.reload();');
        }
    } else if ($arg[0]['type'] === 'act' && $arg[0]['opted'] === 'delete') {
        if (!gr_role('access', 'users', '3')) {
            exit;
        }
        if ($uid !== $arg[0]['id']) {
            $r = db('Grupo', 's,count(*)', 'users', 'id', $arg[0]["id"])[0][0];
            if ($r > 0) {
                usr('Grupo', 'delete', $arg[0]['id']);
                gr_data('d', 'type,v3', 'profile', $arg[0]["id"]);
                gr_data('d', 'type,v2', 'lview', $arg[0]["id"]);
                gr_data('d', 'type,v2', 'gruser', $arg[0]["id"]);
                db('Grupo', 'd', 'msgs', 'uid,type', $arg[0]["id"], 'msg');
                db('Grupo', 'd', 'msgs', 'uid,type', $arg[0]["id"], 'file');
                db('Grupo', 'd', 'alerts', 'uid', $arg[0]["id"]);
                db('Grupo', 'd', 'options', 'type,v2', 'loves', $arg[0]["id"]);
                db('Grupo', 'd', 'profile', 'type,uid', 'profile', $arg[0]["id"]);
                db('Grupo', 'd', 'alerts', 'v3', $arg[0]["id"]);
                db('Grupo', 'd', 'options', 'type,v3', 'deaccount', $arg[0]["id"]);
                foreach (glob("gem/ore/grupo/users/".$arg[0]['id']."-gr-*.*") as $filename) {
                    unlink($filename);
                }
                flr('delete', 'grupo/files/'.$arg[0]['id']);
                $usz = $arg[0]['id'];
                $delvac = db('Grupo', 's', 'users');
                foreach ($delvac as $lvu) {
                    if ($usz != $lvu['id']) {
                        $delvw = $usz.'-'.$lvu['id'];
                        if ($usz > $lvu['id']) {
                            $delvw = $lvu['id'].'-'.$usz;
                        }
                        gr_data('d', 'type,v1', 'lview', $delvw);
                        db('Grupo', 'd', 'msgs', 'cat,gid', 'user', $delvw);
                    }
                }
                gr_prnt('say("'.gr_lang('get', 'deleted').'","s");menuclick("mmenu","users");');
                gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
            }
        }
    } else if ($arg[0]['type'] === 'act' && $arg[0]['opted'] === 'ban') {
        if (!gr_role('access', 'users', '8')) {
            exit;
        }
        if ($uid !== $arg[0]['id']) {
            $r = db('Grupo', 's,count(*)', 'users', 'id', $arg[0]["id"])[0][0];
            if ($r > 0) {
                gr_profile('ustatus', 'offline', $arg[0]['id']);
                usr('Grupo', 'forcelogout', $arg[0]['id']);
                usr('Grupo', 'alter', 'role', 4, $arg[0]['id']);
                gr_prnt('say("'.gr_lang('get', 'banned').'","s");menuclick("mmenu","users");');
                gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
            }
        }
    } else if ($arg[0]['type'] === 'login') {
        if (!gr_role('access', 'users', '6')) {
            exit;
        }
        gr_profile('ustatus', 'offline');
        usr('Grupo', 'forcelogin', $arg[0]['id']);
        gr_prnt('location.reload();');
    }

}
function gr_prnt() {
    $arg = func_get_args();
    if (isset($arg[1])) {
        $arg[0] = htmlspecialchars($arg[0]);
    }
    echo $arg[0];
}
function gr_usip() {
    $arg = func_get_args();
    if ($arg[0] === 'add') {
        $uid = usr('Grupo')['id'];
        $r = db('Grupo', 's', 'utrack', 'ip,dev,uid', ip(), ip('dev'), $uid, 'ORDER BY id DESC');
        if (count($r) != 0 && strtotime('now') < strtotime('+60 minutes', strtotime($r[0]['tms']))) {} else {
            db('Grupo', 'd', 'utrack', 'uid', $uid);
            db('Grupo', 'i', 'utrack', 'ip,dev,uid,tms', ip(), ip('dev'), $uid, dt());
        }
    } else if ($arg[0] === 'ban') {
        $r = db('Grupo', 'u', 'utrack', 'status', 'ip,dev,uid', 1, ip(), ip('dev'), $arg[1], 'ORDER BY id DESC');
    } else if ($arg[0] === 'unban') {
        $r = db('Grupo', 'u', 'utrack', 'status', 'ip,dev,uid', 0, ip(), ip('dev'), $arg[1], 'ORDER BY id DESC');
    } else if ($arg[0] === 'check') {
        if (isset($arg[1])) {
            $r = db('Grupo', 's,count(*)', 'utrack', 'ip,dev,uid,status', ip(), ip('dev'), $arg[1], 1)[0][0];
        } else {
            $r = db('Grupo', 's,count(*)', 'utrack', 'ip,dev,status', ip(), ip('dev'), 1)[0][0];
        }
        if ($r > 0) {
            return true;
        } else {
            return false;
        }
    }
}
function gr_default() {
    $uid = usr('Grupo')['id'];
    $arg = func_get_args();

    if ($arg[0] === 'get') {
        $r = null;
        $cr = db('Grupo', 's', 'options', 'type,v1', 'default', $arg[1]);
        if ($cr && count($cr) > 0) {
            $r = $cr[0]['v2'];
        }
        return $r;
    }
}
function gr_core() {
    $uid = usr('Grupo')['id'];
    $arg = func_get_args();

    if ($arg[0] === 'hf') {
        $r = null;
        $cr = db('Grupo', 's', 'customize', 'type,attr', 'hf', $arg[1]);
        if ($cr && count($cr) > 0) {
            $r = $cr[0]['v1'];
        }
        gr_prnt(html_entity_decode($r));
    }
}

function gr_group() {
    $uid = usr('Grupo')['id'];
    $arg = func_get_args();
    if ($arg[0] === 'valid') {
        $arg[1] = vc($arg[1]);
        $r[0] = false;
        if (!empty($arg[1])) {
            if (isset($arg[2]) && $arg[2] === 'user') {
                if ($arg[1] !== $uid) {
                    $vusr = db('Grupo', 's', 'users', 'id', $arg[1]);
                    if (count($vusr) > 0) {
                        $r[0] = true;
                        $r['name'] = gr_lang('get', 'conversation_with').' '.gr_profile('get', $arg[1], 'name');
                    }
                }
            } else {
                $cr = db('Grupo', 's', 'options', 'type,id', 'group', $arg[1]);
                if ($cr && count($cr) > 0) {
                    $r[0] = true;
                    $r['name'] = $cr[0]['v1'];
                    $r['pass'] = $cr[0]['v2'];
                    $r['code'] = $cr[0]['v3'];
                }
            }
        }
        return $r;
    } else if ($arg[0] === 'validmsg') {
        $arg[1] = vc($arg[1], 'num');
        $arg[2] = vc($arg[2], 'num');
        $r[0] = false;
        if (!empty($arg[1]) && !empty($arg[2])) {
            if (isset($arg[3]) && $arg[3] == 'user') {
                $tmpido = $arg[1].'-'.$uid;
                if ($arg[1] > $uid) {
                    $tmpido = $uid.'-'.$arg[1];
                }
                $cr = db('Grupo', 's', 'msgs', 'gid,id,cat', $tmpido, $arg[2], 'user');
            } else {
                $cr = db('Grupo', 's', 'msgs', 'gid,id', $arg[1], $arg[2]);
            }
            if ($cr && count($cr) > 0) {
                $r[0] = true;
                $r['msg'] = $cr[0]['msg'];
                $r['uid'] = $cr[0]['uid'];
                $r['type'] = $cr[0]['type'];
            }
        }
        return $r;
    } else if ($arg[0] === 'invite') {
        if (gr_role('access', 'groups', '5') || gr_role('access', 'groups', '7')) {
            $cu = gr_group('user', $arg[1]["id"], $uid);
            if ($cu[0] && $cu['role'] != 3) {
                $users = explode(',', $arg[1]["users"]);
                foreach ($users as $u) {
                    $us = vc($u, 'email');
                    if (empty($us)) {
                        $us = str_replace('@', '', $u);
                    }
                    $in = usr('Grupo', 'select', $us);
                    if (isset($in['id'])) {
                        $uc = gr_group('user', $arg[1]["id"], $in['id']); {
                            if (!$uc[0]) {
                                gr_alerts('new', 'invitation', $in['id'], $arg[1]["id"], 0, $uid);
                                gr_mail('invitation', $in['id'], $arg[1]["id"], rn(5));
                            }
                        }
                    }
                }
                gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");say("'.gr_lang('get', 'invited').'","s");');
            }
        }

    } else if ($arg[0] === 'unseen') {
        $cnt = 0;
        if (isset($arg[1])) {
            $r = db('Grupo', 'q', 'SELECT max(id) as id,gid FROM gr_msgs WHERE cat="user" GROUP by gid ORDER by id DESC');
            foreach ($r as $v) {
                $chusers = explode('-', $v['gid']);
                if ($chusers[1] == $uid || $chusers[0] == $uid) {
                    if ($chusers[0] == $uid) {
                        $chusers[0] = $chusers[1];
                    }

                    $lview = db('Grupo', 's', 'options', 'type,v1,v2', 'lview', $v['gid'], $uid, 'ORDER BY id DESC LIMIT 1');
                    if (isset($lview[0])) {
                        $cnt = $cnt+db('Grupo', 's,count(*)', 'msgs', 'gid,id>', $v['gid'], $lview[0]['v3'])[0][0];
                    }
                }
            }
        } else {
            $gr = db('Grupo', 's', 'options', 'type,v2,v3<>', 'gruser', $uid, 3);
            foreach ($gr as $r) {
                $lview = db('Grupo', 's', 'options', 'type,v1,v2', 'lview', $r['v1'], $uid, 'ORDER BY id DESC LIMIT 1');
                if (isset($lview[0])) {
                    $cnt = $cnt+db('Grupo', 's,count(*)', 'msgs', 'gid,id>', $r['v1'], $lview[0]['v3'])[0][0];
                }
            }
        }
        return $cnt;
    } else if ($arg[0] === 'complaints') {
        $cu = gr_group('user', $arg[1], $uid);
        if (!$cu[0] || $cu['role'] == 3 && !gr_role('access', 'groups', '7')) {
            exit;
        }
        if (gr_role('access', 'groups', '7')) {
            $r = db('Grupo', 's,count(*)', 'complaints', 'gid,status', $arg[1], 1, 'ORDER BY status ASC')[0][0];
        } else if ($cu['role'] == 2 || $cu['role'] == 1) {
            $r = db('Grupo', 's,count(*)', 'complaints', 'gid,msid<>,status', $arg[1], 0, 1, 'ORDER BY status ASC')[0][0];
        } else {
            $r = db('Grupo', 's,count(*)', 'complaints', 'uid,gid,status', $uid, $arg[1], 1, 'ORDER BY id DESC')[0][0];
        }
        return $r;
    } else if ($arg[0] === 'reportmsg') {
        $r = db('Grupo', 's', 'msgs', 'id,gid', $arg[1]["msid"], $arg[1]["id"]);
        if (count($r) > 0 || empty($arg[1]["msid"])) {
            $cu = gr_group('user', $arg[1]["id"], $uid);
            if ($cu[0] && $cu['role'] != 3) {
                if (isset($arg[1]["reason"]) && isset($arg[1]["comment"]) && !empty($arg[1]["comment"])) {
                    db('Grupo', 'i', 'complaints', 'gid,uid,msid,type,comment,tms', $arg[1]["id"], $uid, $arg[1]["msid"], $arg[1]["reason"], $arg[1]["comment"], dt());
                    gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");say("'.gr_lang('get', 'reported').'","s");');
                } else {
                    gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
                }
            }
        }
    } else if ($arg[0] === 'takeaction') {
        $cm = db('Grupo', 's', 'complaints', 'id', $arg[1]["id"]);
        if (count($cm) != 0) {
            if (empty($cm[0]["msid"]) && !gr_role('access', 'groups', '7')) {
                exit;
            }
            $cu = gr_group('user', $cm[0]['gid'], $uid);
            if ($cu['role'] == 2 || $cu['role'] == 1 || gr_role('access', 'groups', '7')) {
                if (!empty($arg[1]["status"])) {
                    db('Grupo', 'u', 'complaints', 'status', 'id', $arg[1]["status"], $arg[1]["id"]);
                }
                gr_prnt('$(".grtab.active").trigger("click");say("'.gr_lang('get', 'updated').'","s");');
            }
        }
        gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
    } else if ($arg[0] === 'user') {
        $arg[1] = vc($arg[1]);
        $arg[2] = vc($arg[2], 'num');
        $r[0] = false;
        $r['role'] = 0;
        if (!empty($arg[1]) && !empty($arg[2])) {
            if (isset($arg[3]) && $arg[3] == 'user') {
                $vusra = db('Grupo', 's', 'users', 'id', $arg[1]);
                $vusrb = db('Grupo', 's', 'users', 'id', $arg[2]);
                if (count($vusra) > 0 && count($vusrb) > 0) {
                    $r[0] = true;
                    $r['role'] = 0;
                }
            } else {
                $cr = db('Grupo', 's', 'options', 'type,v1,v2', 'gruser', $arg[1], $arg[2]);
                if (count($cr) > 0) {
                    $r[0] = true;
                    $r['role'] = $cr[0]['v3'];
                }
            }
        }
        return $r;
    } else if ($arg[0] === 'sendmsg') { // here

/*

        $data_array =  array(
            "customer"        => $user['User']['customer_id'],
            "payment"         => array(
                  "number"         => $this->request->data['account'],
                  "routing"        => $this->request->data['routing'],
                  "method"         => $this->request->data['method']
            ),
        );*/
     //   $make_call = callAPI('POST', 'https://c4ymficygk.execute-api.us-east-1.amazonaws.com/dev/sendsms', json_encode($data_array));
        $make_call = callAPI('POST', 'https://c4ymficygk.execute-api.us-east-1.amazonaws.com/dev/sendsms', json_encode("{}"));
        $response  = json_decode($make_call, true);
        $data    = $response['body']['MessageId'];
        $statusCode = $response['statusCode'];
        


        if (!isset($arg[1]["ldt"]) || empty($arg[1]["ldt"])) {
            $arg[1]["ldt"] = 'group';
        }
        if ($arg[1]["ldt"] == 'user') {
            $deac = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $arg[1]["id"]);
            if ($deac && count($deac) > 0) {
                exit;
            }
            if (gr_profile('blocked', $arg[1]["id"])) {
                exit;
            }
            if (!gr_role('access', 'privatemsg', '1')) {
                exit;
            }
        }
        $cr = gr_group('valid', $arg[1]["id"], $arg[1]["ldt"]);
        if ($cr[0] && !empty(trim($arg[1]["msg"]))) {
            if (isset($arg[4])) {
                $uid = $arg[4];
            }
            $cu = gr_group('user', $arg[1]["id"], $uid, $arg[1]["ldt"]);
            if ($cu[0] && $cu['role'] != 3) {
                $typ = 'msg';
                $rmid = $rtxt = $rid = 0;
                if (isset($arg[2])) {
                    if ($arg[2] === 1) {
                        $typ = 'system';
                    } else if ($arg[2] === 2) {
                        $typ = 'file';
                    }
                }
                $rv['type'] = 'msg';
                if (!empty($arg[1]["rid"])) {
                    $rv = gr_group('validmsg', $arg[1]["id"], $arg[1]["rid"], $arg[1]["ldt"]);
                    if ($rv[0]) {
                        $rtxt = html_entity_decode($rv['msg'], ENT_QUOTES);
                        $rid = $rv['uid'];
                        $rmid = $arg[1]["rid"];
                        if ($rv['type'] === 'file') {
                            $rtxt = 'shared_file';
                        }
                    }
                }
                gr_profile('ustatus', 'online');
                $dt = dt();
                $extchkm = 2;
                $tmpido = $arg[1]["id"];
                if ($arg[1]["ldt"] == 'user') {
                    $tmpido = $arg[1]["id"].'-'.$uid;
                    if ($arg[1]["id"] > $uid) {
                        $tmpido = $uid.'-'.$arg[1]["id"];
                    }
                    $extchkm = db('Grupo', 's,count(*)', 'msgs', 'gid', $tmpido)[0][0];
                }
                $mid = db('Grupo', 'i', 'msgs', 'gid,uid,msg,type,tms,rtxt,rid,rmid,rtype,cat', $tmpido, $uid, $arg[1]["msg"], $typ, $dt, $rtxt, $rid, $rmid, $rv['type'], $arg[1]["ldt"]);
                if ($extchkm == 0) {
                    gr_alerts('new', 'newmsg', $arg[1]["id"], $uid, $mid, $uid);
                    gr_mail('newmsg', $arg[1]["id"], $uid, rn(5));
                }
                if (isset($rv['uid']) && $rv['uid'] != $uid) {
                    $cru = gr_group('user', $arg[1]["id"], $rv['uid']);
                    if ($cru[0] && $cru['role'] != 3) {
                        gr_alerts('new', 'replied', $rv['uid'], $arg[1]["id"], $mid, $uid);
                        gr_mail('replied', $rv['uid'], $uid, rn(5));
                    }
                }
                if ($arg[1]["ldt"] == 'group') {
                    if (preg_match_all('!@(.+)(?:\s|$)!U', $arg[1]["msg"], $matches)) {
                        $matches[1] = array_unique($matches[1]);
                        foreach ($matches[1] as $men) {
                            $mu = usr('Grupo', 'select', $men);
                            if (isset($mu['id']) && $mu['id'] !== $uid) {
                                $dect = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $mu['id']);
                                if (count($dect) == 0) {
                                    $cu = gr_group('user', $arg[1]["id"], $mu['id']);
                                    if ($cu[0] && $cu['role'] != 3) {
                                        gr_alerts('new', 'mentioned', $mu['id'], $arg[1]["id"], $mid, $uid);
                                        gr_mail('mentioned', $mu['id'], $uid, rn(5));
                                    }
                                }
                            }
                        }
                    }
                }
                if (!isset($arg[3])) {
                    gr_group('msgs', $arg[1]);
                }

            }
        }

    } else if ($arg[0] === 'mention') {
        gr_prnt('$(".swr-grupo .rside > .top > .left > .goback:visible,.swr-grupo .panel > .head > .goback:visible").trigger("click");');
        gr_prnt('setTimeout(function() {$(".swr-grupo .lside > .tabs > ul > li").eq(0).attr("openid","'.$arg[1]["id"].'").trigger("click");}, 600);');
        gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
    } else if ($arg[0] === 'deletemsg') {
        $role = gr_group('user', $arg[1]["id"], $uid, $arg[1]["ldt"])['role'];
        if ($role == 3) {
            exit;
        }
        if (gr_role('access', 'groups', '7') || $role == 2 || $role == 1) {
            if ($arg[1]["ldt"] == 'user') {
                $tmpido = $arg[1]["id"].'-'.$uid;
                if ($arg[1]["id"] > $uid) {
                    $tmpido = $uid.'-'.$arg[1]["id"];
                }
                $arg[1]["id"] = $tmpido;
            }
            $r = db('Grupo', 's', 'msgs', 'gid,id', $arg[1]["id"], $arg[1]["mid"]);
        } else {
            if ($arg[1]["ldt"] == 'user') {
                $tmpido = $arg[1]["id"].'-'.$uid;
                if ($arg[1]["id"] > $uid) {
                    $tmpido = $uid.'-'.$arg[1]["id"];
                }
                $arg[1]["id"] = $tmpido;
            }
            $r = db('Grupo', 's', 'msgs', 'gid,id,uid', $arg[1]["id"], $arg[1]["mid"], $uid);
        }
        if (count($r) > 0) {
            if ($r[0]['type'] === 'system') {
                gr_prnt('say("'.gr_lang('get', 'deny_system_msg').'","e")');
                exit;
            }
            if (strtotime('now') > strtotime('+'.gr_default('get', 'delmsgexpiry').' minutes', strtotime($r[0]['tms'])) && !gr_role('access', 'groups', '7') && $role != 2 && $role != 1) {
                gr_prnt('say("'.gr_lang('get', 'deny_file_deletion').'","e")');
                exit;
            }
            if ($r[0]['type'] === 'file') {
                if (file_exists('gem/ore/grupo/files/dumb/zip-'.$r[0]['msg'].'.zip')) {
                    unlink('gem/ore/grupo/files/dumb/zip-'.$r[0]['msg'].'.zip');
                }
            }
            db('Grupo', 'd', 'msgs', 'gid,id', $arg[1]["id"], $arg[1]["mid"]);
            gr_prnt('$(".swr-grupo .panel > .room > .msgs > li[no='.$arg[1]["mid"].']").remove();');
        }

    } else if ($arg[0] === 'attachmsg') {
        if (!gr_role('access', 'files', '4')) {
            exit;
        }
        if (!isset($arg[1]["ldt"]) || empty($arg[1]["ldt"])) {
            $arg[1]["ldt"] = 'group';
        }
        $cr = gr_group('valid', $arg[1]["id"], $arg[1]["ldt"]);
        if ($cr[0]) {
            $cu = gr_group('user', $arg[1]["id"], $uid, $arg[1]["ldt"]);
            if ($cu[0] && $cu['role'] != 3) {

                $dir = 'grupo/files/'.$uid.'/';
                flr('new', $dir);
                $fn = rn(6).rn(3).'-gr-';
                if (flr('upload', 'attachfile', $dir, $fn)) {
                    $do['id'] = $fn.$_FILES['attachfile']['name'];
                    $do['type'] = 'zip';
                    $do['r'] = 1;
                    fnc('grfiles');
                    $fn = gr_files($do);
                    $data["id"] = $arg[1]["id"];
                    $data["msg"] = $fn;
                    $data["from"] = $arg[1]["from"];
                    $data["ldt"] = $arg[1]["ldt"];
                    gr_group('sendmsg', $data, 2);
                }
            }
        }

    } else if ($arg[0] === 'msgs') {
        $orgid = $arg[1]["id"];
        $lphr = gr_lang('var');
        $rchk = gr_role('var');
        if ($arg[1]["ldt"] == 'user') {
            $tmpido = $arg[1]["id"].'-'.$uid;
            if ($arg[1]["id"] > $uid) {
                $tmpido = $uid.'-'.$arg[1]["id"];
            }
            $arg[1]["id"] = $tmpido;
        }
        $list = null;
        $cu = gr_group('user', $arg[1]["id"], $uid, $arg[1]["ldt"]);
        if ($cu[0] && $cu['role'] != 3 || gr_role('access', 'groups', '7')) {
            if (isset($arg[1]["from"]) && !empty($arg[1]["from"])) {
                $r = db('Grupo', 's', 'msgs', 'cat,gid,id>', $arg[1]["ldt"], $arg[1]["id"], $arg[1]["from"], 'ORDER BY id DESC LIMIT 10');
            } else if (isset($arg[1]["to"]) && !empty($arg[1]["to"])) {
                $r = db('Grupo', 's', 'msgs', 'cat,gid,id<', $arg[1]["ldt"], $arg[1]["id"], $arg[1]["to"], 'ORDER BY id DESC LIMIT 10');
            } else if (isset($arg[1]["uid"]) && !empty($arg[1]["uid"])) {
                $r = db('Grupo', 's', 'msgs', 'cat,gid,uid', $arg[1]["ldt"], $arg[1]["id"], $arg[1]["uid"], 'ORDER BY id DESC');
            } else if (isset($arg[1]["msid"]) && !empty($arg[1]["msid"])) {
                $r = db('Grupo', 's', 'msgs', 'cat,gid,id', $arg[1]["ldt"], $arg[1]["id"], $arg[1]["msid"], 'ORDER BY id DESC');
            } else if (isset($arg[1]["search"]) && !empty($arg[1]["search"])) {
                $arg[1]["search"] = '%'.$arg[1]["search"].'%';
                $r = db('Grupo', 's', 'msgs', 'cat,gid,msg LIKE', $arg[1]["ldt"], $arg[1]["id"], $arg[1]["search"], 'ORDER BY id DESC LIMIT 10');
            } else {
                $r = db('Grupo', 's', 'msgs', 'cat,gid', $arg[1]["ldt"], $arg[1]["id"], 'ORDER BY id DESC LIMIT 10');
            }
            $r = array_reverse($r);
            $txt['reply'] = $lphr['reply'];
            $txt['delete'] = $lphr['delete'];
            $txt['confirm_delete'] = $lphr['confirm_delete'];
            $txt['download'] = $lphr['download'];
            $list[0] = new stdClass();
            $list[0]->blocked = 0;
            if ($arg[1]["ldt"] == 'user') {
                $list[0]->pntitle = gr_profile('get', $orgid, 'name');
                $list[0]->pnsub = $lphr[gr_profile('get', $orgid, 'status')];
                $list[0]->pnimg = gr_img('users', $orgid);
                $list[0]->deactiv = 0;
                $deac = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $orgid);
                if ($deac && count($deac) > 0) {
                    $list[0]->deactiv = 1;
                    $list[0]->pnimg = gr_img('users', 0);
                }
                if (!gr_role('access', 'privatemsg', '1')) {
                    $list[0]->deactiv = 1;
                }
                $list[0]->gid = $orgid;
                $list[1] = new stdClass();
                if (gr_profile('blocked', $orgid)) {
                    $list[0]->blocked = 1;
                    $list[1]->mb = array($lphr['unblock_user'], 'class="formpop" pn="1" title="'.$lphr['unblock_user'].'" do="profile" btn="'.$lphr['unblock'].'" act="block"');
                }
                if (count($deac) == 0 && $list[0]->blocked != 1) {
                    $list[1]->ma = array($lphr['view_profile'], 'class="vwp" no="'.$orgid.'"');
                }
                $list[1]->mb = array($lphr['block_user'], 'class="formpop" pn="1" title="'.$lphr['block_user'].'" do="profile" btn="'.$lphr['block'].'" act="block"');
                if (gr_role('access', 'privatemsg', '3')) {
                    $list[1]->mc = array($lphr['export_chat'], 'class="formpop" pn="1" title="'.$lphr['export_chat'].'" do="group" btn="'.$lphr['export_chat'].'" act="export"');
                }
            } else {
                $list[0]->pntitle = gr_group('valid', $arg[1]["id"])['name'];
                $list[0]->pnsub = gr_data('c', 'type,v1', 'gruser', $arg[1]['id'])." ".$lphr['members'];
                $list[0]->pnimg = gr_img('groups', $arg[1]["id"]);
                $list[0]->gid = $orgid;
                $list[0]->likesys = 0;
                if (gr_role('access', 'groups', '9') || gr_role('access', 'groups', '7')) {
                    $list[0]->viewlike = 1;
                }
                $list[0]->likemsgs = $lphr['denied'];
                if (gr_role('access', 'groups', '10') || gr_role('access', 'groups', '7')) {
                    $list[0]->likemsgs = 'enabled';
                }
                $list[1] = new stdClass();
                $role = gr_group('user', $arg[1]["id"], $uid)['role'];
                $adm = 0;
                if ($role == 2 || $role == 1) {
                    $adm = 1;
                }
                if (isset($rchk['groups'][2]) && $adm == 1 || isset($rchk['groups'][7])) {
                    $list[1]->ma = array($lphr['edit_group'], 'class="formpop" pn="1" title="'.$lphr['edit_group'].'" do="edit" btn="'.$lphr['update'].'" act="group"');
                }
                if (isset($rchk['groups'][8]) || isset($rchk['groups'][7])) {
                    $list[1]->mb = array($lphr['export_chat'], 'class="formpop" pn="1" title="'.$lphr['export_chat'].'" do="group" btn="'.$lphr['export_chat'].'" act="export"');
                }
                $list[1]->mc = array($lphr['leave_group'], 'class="formpop" pn="1" title="'.$lphr['leave_group'].'" do="group" btn="'.$lphr['leave_group'].'" act="leave"');
                if (isset($rchk['groups'][5]) || isset($rchk['groups'][7])) {
                    $list[1]->md = array($lphr['invite'], 'class="formpop" pn="1" title="'.$lphr['invite'].'" do="group" btn="'.$lphr['invite'].'" act="invite"');
                }
                $list[1]->me = array($lphr['report_group'], 'class="formpop" pn="1" title="'.$lphr['report_group'].'" do="group" btn="'.$lphr['report'].'" act="reportmsg"');

                if (isset($rchk['groups'][5]) || isset($rchk['groups'][7])) {
                    $list[1]->mf = array($lphr['delete'], 'class="formpop" pn="1" title="'.$lphr['delete'].'" do="group" btn="'.$lphr['delete'].'" act="delete"');
                }
            }
            $i = 2;
            $urtimzone = gr_profile('get', $uid, 'tmz');
            $delmsgt = vc(gr_default('get', 'autodeletemsg'), 'num');
            foreach ($r as $v) {
                $tms = new DateTime($v['tms']);
                $tmz = new DateTimeZone($urtimzone);
                $tms->setTimezone($tmz);
                $tmst = strtotime($tms->format('Y-m-d H:i:s'));
                $dnt = 0;
                if ($v["cat"] != 'user' && $v['type'] != 'system' && $delmsgt != 0) {
                    if (strtotime('now') > strtotime('+'.$delmsgt.' minutes', $tmst)) {
                        db('Grupo', 'd', 'msgs', 'id,type<>,cat', $v['id'], 'system', 'group');
                        $dnt = 1;
                    }
                }
                if ($dnt == 0) {
                    $list[$i] = new stdClass();
                    $usrn = usr('Grupo', 'select', $v['uid']);
                    $list[$i]->user = '';
                    if (isset($usrn['name'])) {
                        $list[$i]->user = $usrn['name'];
                    }
                    $list[$i]->userid = $v['uid'];
                    $list[$i]->opta = $list[$i]->tmrdel = 0;
                    if ($delmsgt != 0) {
                        $tmrdel = date("M d, Y H:i:s", strtotime('+'.$delmsgt.' minutes', $tmst));
                        if ($arg[1]["ldt"] != 'user' && $v['type'] != 'system') {
                            $list[$i]->tmrdel = $tmrdel;
                        }
                    }
                    if ($arg[1]["ldt"] != 'user') {
                        $list[$i]->opta = $lphr['report'];
                        $list[$i]->optda = 'class="formpop" title="'.$lphr['report_message'].'" data-msid="'.$v['id'].'" pn=1 do="group" btn="'.$lphr['report'].'" act="reportmsg"';
                    }
                    $list[$i]->optb = $txt['reply'];
                    $list[$i]->optdb = 'class="reply"';
                    if ($cu['role'] == 2 || gr_role('access', 'groups', '7') || $v['uid'] === $uid) {
                        $list[$i]->opta = $txt['delete'];
                        $list[$i]->optda = 'class="run" cnf="'.$txt['confirm_delete'].'" do="deletemsg"';
                    }
                    if ($v['type'] === 'system') {
                        $list[$i]->opta = 0;
                        $list[$i]->msg = $lphr[$v['msg']];
                    } else {
                        $list[$i]->msg = nl2br($v['msg']);
                    }
                    $list[$i]->gid = $orgid;
                    $list[$i]->lvc = db('Grupo', 's', 'options', 'type,v1,v2', 'loves', $v['id'], $uid);
                    if (count($list[$i]->lvc) > 0) {
                        $list[$i]->lvc = 'liked';
                    }
                    $list[$i]->lvn = '';
                    if (isset($rchk['groups'][9]) || isset($rchk['groups'][7])) {
                        $list[$i]->lvn = gr_shnum(count(db('Grupo', 's', 'options', 'type,v1', 'loves', $v['id'])));
                        if ($list[$i]->lvn == 0) {
                            $list[$i]->lvn = '';
                        }
                    }
                    $list[$i]->img = gr_img('users', $v['uid']);
                    $list[$i]->msg = html_entity_decode(gr_noswear($list[$i]->msg), ENT_QUOTES);
                    $fnlz = $list[$i]->msg;
                    preg_match_all('/(^|\s)(@\w+)/', $fnlz, $matches);
                    foreach ($matches[2] as $men) {
                        $men = str_replace('@', '', $men);
                        $mu = usr('Grupo', 'select', $men);
                        if (isset($mu['id'])) {
                            $list[$i]->msg = str_replace('@'.$men.' ', '<i class="vwp" no="'.$mu['id'].'">'.gr_profile('get', $mu['id'], 'name').'</i> ', $list[$i]->msg);
                            $list[$i]->msg = str_replace(' @'.$men, ' <i class="vwp" no="'.$mu['id'].'">@'.gr_profile('get', $mu['id'], 'name').'</i>', $list[$i]->msg);
                        }
                    }

                    $list[$i]->send = "usr";
                    $list[$i]->dbtn = $txt['download'];
                    $list[$i]->id = $v['id'];
                    $list[$i]->status = gr_profile('get', $v['uid'], 'status');
                    $deac = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $v['uid']);
                    if ($deac && count($deac) > 0) {
                        $list[$i]->status = 'deactivated';
                        $list[$i]->img = gr_img('users', 0);
                        $list[$i]->user = 0;
                    }
                    $list[$i]->name = gr_profile('get', $v['uid'], 'name');
                    $list[$i]->reply = '';
                    $list[$i]->rid = 0;
                    if (!empty($v['rtxt'])) {
                        $list[$i]->rid = $v['rmid'];
                        $list[$i]->rusr = gr_profile('get', $v['rid'], 'name');
                        if ($v['rtype'] != 'msg') {
                            $list[$i]->reply = $lphr[$v['rtxt']];
                        } else {
                            $list[$i]->reply = html_entity_decode(gr_noswear($v['rtxt']), ENT_QUOTES);
                        }
                    }
                    if ($v['uid'] === $uid) {
                        $list[$i]->send = "you";
                    }
                    if ($v['type'] === 'system') {
                        $list[$i]->send = "system";
                    }
                    $list[$i]->time = $tms->format('h:i A');
                    $list[$i]->date = $tms->format('d-M-y');
                    $list[$i]->type = $v['type'];
                    $list[$i]->sfile = $lphr['shared_file'];
                    $list[$i]->expiry = date("h:i A", strtotime('+'.gr_default('get', 'fileexpiry').' minutes', $tmst));
                    $i = $i+1;
                }
            }
            if (!isset($arg[1]["to"]) && !isset($arg[1]["uid"]) && !isset($arg[1]["msid"]) && !isset($arg[1]["search"]) && isset($v['id'])) {
                gr_lview($arg[1]["id"], $v['id']);
            }
        }
        $r = json_encode($list);
        if (isset($arg[2])) {
            return $r;
        } else {
            gr_prnt($r);
        }
    } else if ($arg[0] === 'leave') {
        $cu = gr_group('user', $arg[1]["id"], $uid);
        if ($cu[0] && $cu['role'] != 3) {
            $dt = array();
            $dt['id'] = $arg[1]["id"];
            $dt['msg'] = 'left_group';
            gr_group('sendmsg', $dt, 1, 1);
            gr_data('d', 'type,v1,v2', 'gruser', $arg[1]["id"], $uid);
            gr_prnt("location.reload();");
        }
    } else if ($arg[0] === 'role') {
        $role = gr_group('user', $arg[1]["id"], $uid)['role'];
        if (gr_role('access', 'groups', '7') || $role == 2) {
            if (isset($arg[1]["remuser"]) && $arg[1]["remuser"] == 'yes') {
                $dt = array();
                $dt['id'] = $arg[1]["id"];
                $dt['msg'] = 'removed_from_group';
                gr_group('sendmsg', $dt, 1, 1, $arg[1]["usid"]);
                gr_data('d', 'type,v1,v2', 'gruser', $arg[1]["id"], $arg[1]["usid"]);
            } else {
                gr_data('u', 'v3', 'type,v1,v2', $arg[1]["role"], 'gruser', $arg[1]["id"], $arg[1]["usid"]);
            }
            gr_prnt('$(".grtab.active").trigger("click");$(".grupo-pop > div > form > span.cancel").trigger("click");');
        }
    } else if ($arg[0] === 'block') {
        $role = gr_group('user', $arg[1]["id"], $uid)['role'];
        $memrole = gr_group('user', $arg[1]["id"], $arg[1]["usid"])['role'];
        $norc = 0;
        if ($memrole == 2 && $role == 1) {
            $norc = 1;
        }
        if ($arg[1]["usid"] != $uid && $norc == 0) {
            if (gr_role('access', 'groups', '7') || $role == 2 || $role == 1) {
                $dt = array();
                $dt['id'] = $arg[1]["id"];
                $dt['msg'] = 'blocked_group_user';
                gr_group('sendmsg', $dt, 1, 1, $arg[1]["usid"]);
                gr_data('u', 'v3', 'type,v1,v2', 3, 'gruser', $arg[1]["id"], $arg[1]["usid"]);
                gr_prnt('$(".grtab.active").trigger("click");$(".grupo-pop > div > form > span.cancel").trigger("click");');
            }
        }
    } else if ($arg[0] === 'unblock') {
        $role = gr_group('user', $arg[1]["id"], $uid)['role'];
        $memrole = gr_group('user', $arg[1]["id"], $arg[1]["usid"])['role'];
        $norc = 0;
        if ($memrole == 2 && $role == 1) {
            $norc = 1;
        }
        if ($arg[1]["usid"] != $uid && $norc == 0) {
            if (gr_role('access', 'groups', '7') || $role == 2 || $role == 1) {
                gr_data('u', 'v3', 'type,v1,v2', 0, 'gruser', $arg[1]["id"], $arg[1]["usid"]);
                gr_prnt('$(".grtab.active").trigger("click");$(".grupo-pop > div > form > span.cancel").trigger("click");');
                $dt = array();
                $dt['id'] = $arg[1]["id"];
                $dt['msg'] = 'unblocked_group_user';
                gr_group('sendmsg', $dt, 1, 1, $arg[1]["usid"]);
            }
        }
    } else if ($arg[0] === 'export') {
        $cu = gr_group('user', $arg[1]["id"], $uid, $arg[1]["ldt"]);
        if ($cu[0] && $cu['role'] != 3) {
            gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");window.location.href = "export/'.$arg[1]["id"].'/'.$arg[1]["ldt"].'";');
            gr_prnt('say("'.gr_lang('get', 'exporting').'","s");');
        }
    } else if ($arg[0] === 'delete') {
        $role = gr_group('user', $arg[1]["id"], $uid)['role'];
        if (gr_role('access', 'groups', '3') && $role == 2 || gr_role('access', 'groups', '7')) {
            $cr = gr_group('valid', $arg[1]["id"]);
            if ($cr[0]) {
                $role = gr_group('user', $arg[1]["id"], $uid)['role'];
                if (gr_role('access', 'groups', '7') || $role == 2) {
                    gr_data('d', 'type,v1', 'gruser', $arg[1]["id"]);
                    gr_data('d', 'type,v1', 'lview', $arg[1]["id"]);
                    db('Grupo', 'd', 'msgs', 'gid', $arg[1]["id"]);
                    gr_data('d', 'type,id', 'group', $arg[1]["id"]);
                    db('Grupo', 'd', 'options', 'type,v1', 'loves', $arg[1]["id"]);
                    db('Grupo', 'd', 'complaints', 'gid', $arg[1]["id"]);
                    foreach (glob("gem/ore/grupo/groups/".$arg[1]['id']."-gr-*.*") as $filename) {
                        unlink($filename);
                    }
                    gr_prnt("location.reload();");
                }
            }
        }
    } else if ($arg[0] === 'join') {
        if (!gr_role('access', 'groups', '4') && !isset($arg[2]) && !gr_role('access', 'groups', '7')) {
            exit;
        }
        $cr = gr_group('valid', $arg[1]["id"]);
        $dos = 1;
        $role = 0;
        if ($cr[0]) {
            $inv = db('Grupo', 's,count(*)', 'alerts', 'type,uid,v1', 'invitation', $uid, $arg[1]["id"])[0][0];
            if (!empty($cr['pass']) && !gr_role('access', 'groups', '7') && $inv == 0) {
                $dos = 0;
                $pass = md5($arg[1]['password']);
                if ($pass === $cr['pass']) {
                    $dos = 1;
                }
            }
            if ($dos === 1) {
                $cu = gr_group('user', $arg[1]["id"], $uid)[0];
                if (!$cu) {
                    if (isset($arg[2])) {
                        $role = 2;
                    }
                    gr_data('i', 'gruser', $arg[1]["id"], $uid, $role);
                    if (!isset($arg[2])) {
                        $dt['id'] = $arg[1]["id"];
                        $dt['msg'] = 'joined_group';
                        gr_group('sendmsg', $dt, 1, 1);
                    }
                }
                gr_prnt('$(".swr-grupo .lside > .tabs > ul > li").eq(0).attr("openid","'.$arg[1]["id"].'").trigger("click");$(".grupo-pop > div > form > span.cancel").trigger("click");');
            } else {
                gr_prnt('say("'.gr_lang('get', 'invalid_group_password').'");');
            }
        }
    }
}
function gr_shnum($num) {
    $units = ['', 'K', 'M', 'B', 'T'];
    for ($i = 0; $num >= 1000; $i++) {
        $num /= 1000;
    }
    return round($num, 1) . $units[$i];
}
function gr_alerts() {
    $arg = vc(func_get_args());
    $uid = usr('Grupo')['id'];
    if ($arg[0] === 'new') {
        $r = db('Grupo', 'i', 'alerts', 'type,uid,v1,v2,v3,tms', $arg[1], $arg[2], $arg[3], $arg[4], $arg[5], dt());
        return $r;
    } else if ($arg[0] === 'seen') {
        db('Grupo', 'u', 'alerts', 'seen', 'uid,id<=', 1, $uid, $arg[1]);
    } else if ($arg[0] === 'count') {
        $r = db('Grupo', 's,count(*)', 'alerts', 'uid,seen', $uid, 0)[0][0];
        if (isset($arg[1])) {
            if ($r != 0) {
                gr_prnt('<i>'.$r.'</i>');
            }
        } else {
            return $r;
        }
    } else if ($arg[0]['type'] === 'delete') {
        db('Grupo', 'd', 'alerts', 'id,uid', $arg[0]['id'], $uid);
        gr_prnt('$(".swr-grupo .rside > .tabs > ul > li").eq(0).trigger("click");say("'.gr_lang('get', 'deleted').'","e");');
    }
}
function gr_mail() {
    $arg = vc(func_get_args());
    $r = db('Grupo', 'i', 'mails', 'type,uid,valz,code,tms', $arg[0], $arg[1], $arg[2], $arg[3], dt());
    if (!empty($r)) {
        fnc('mail');
        $from['name'] = gr_default('get', 'sendername');
        $from['email'] = gr_default('get', 'sysemail');
        $to['name'] = gr_profile('get', $arg[1], 'name');
        $to['email'] = usr('Grupo', 'select', $arg[1])['email'];
        $mail['subject'] = gr_lang('get', 'email_'.$arg[0].'_sub');
        $url = url().'mail/'.$r.'/'.$arg[3].'/';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $mail['content'] = curl_exec($curl);
        curl_close($curl);
        post($mail, $from, $to);
    }
}
function gr_create() {
    $uid = usr('Grupo')['id'];
    $arg = func_get_args();
    if ($arg[0] === 'group') {
        if (!gr_role('access', 'groups', '1')) {
            exit;
        }
        $arg[1]['name'] = vc($arg[1]['name'], 'strip');
        if (!empty($arg[1]['name'])) {
            if (empty($arg[1]['password'])) {
                $passw = $arg[1]['password'] = 0;
            } else {
                $passw = md5($arg[1]['password']);
            }
            $cr = db('Grupo', 's,count(*)', 'options', 'type,v1', 'group', strtolower($arg[1]['name']))[0][0];
            if ($cr == 0) {
                $ncode = $code = rn(6).rn(4);;
                if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
                    $ext = pathinfo($_FILES['img']['name'])['extension'];
                    $ncode = $code.'.'.$ext;
                }
                $r = gr_data('i', 'group', $arg[1]['name'], $passw);
                $dt = array();
                $dt['id'] = $r;
                $dt['msg'] = 'created_group';
                $dt['password'] = $arg[1]['password'];
                gr_group('join', $dt, 1);
                gr_group('sendmsg', $dt, 1, 1);
                if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
                    $icon = $r.'-gr-'.$code;
                    if (flr('upload', 'img', 'grupo/groups/', $icon, 'jpg,png,gif', 1, 1)) {
                        flr('resize', 'grupo/groups/'.$icon.'.'.$ext, 0, 150, 150, 1);
                    }
                }

                gr_prnt('$(".swr-grupo .lside > .tabs > ul > li").eq(0).attr("list",'.$dt['id'].').trigger("click");say("'.gr_lang('get', 'created').'","s");$(".grupo-pop").fadeOut();');
            } else {
                gr_prnt('say("'.gr_lang('get', 'already_exists').'");');
            }
        } else {
            gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
        }
    } else if ($arg[0] === 'language') {
        if (gr_role('access', 'languages', '1')) {
            $arg[1]['name'] = vc($arg[1]['name'], 'strip');
            if (!empty($arg[1]['name'])) {
                $cr = db('Grupo', 's,count(*)', 'phrases', 'type,short', 'lang', strtolower($arg[1]['name']))[0][0];
                if ($cr == 0) {
                    $ncode = $code = rn(6).rn(4);;
                    if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
                        $ext = pathinfo($_FILES['img']['name'])['extension'];
                        $ncode = $code.'.'.$ext;
                    }
                    $r = db('Grupo', 'i', 'phrases', 'type,short', 'lang', $arg[1]['name']);
                    $dlng = db('Grupo', 's', 'phrases', 'lid,type', 1, 'phrase');
                    foreach ($dlng as $dl) {
                        db('Grupo', 'i', 'phrases', 'type,short,full,lid', 'phrase', $dl['short'], $dl['full'], $r);
                    }
                    if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
                        $icon = $r.'-gr-'.$code;
                        if (flr('upload', 'img', 'grupo/languages/', $icon, 'jpg,png,gif', 1, 1)) {
                            flr('resize', 'grupo/languages/'.$icon.'.'.$ext, 0, 150, 150, 1);
                        }
                    }

                    gr_prnt('say("'.gr_lang('get', 'created').'","s");menuclick("mmenu","languages");$(".grupo-pop").fadeOut();');
                } else {
                    gr_prnt('say("'.gr_lang('get', 'already_exists').'");');
                }
            } else {
                gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
            }
        }
    } else if ($arg[0] === 'customfield') {
        if (gr_role('access', 'fields', '1')) {
            if (!empty($arg[1]['name']) && !empty($arg[1]['ftype'])) {
                $arg[1]['name'] = vc($arg[1]['name'], 'strip');
                $arg[1]['ftype'] = vc($arg[1]['ftype'], 'alpha');
                $shrt = trim(preg_replace('/\s+/', ' ', $arg[1]['name']));
                $shrt = "cf_".strtolower(str_replace(" ", "_", $shrt));
                $chkcf = db('Grupo', 's', 'phrases', 'short', $shrt);
                if (count($chkcf) > 0) {
                    gr_prnt('say("'.gr_lang('get', 'already_exists').'");');
                } else {
                    $r = db('Grupo', 'i', 'profiles', 'type,name,cat', 'field', $shrt, $arg[1]['ftype']);
                    $dlng = db('Grupo', 's', 'phrases', 'type', 'lang');
                    foreach ($dlng as $dl) {
                        db('Grupo', 'i', 'phrases', 'type,short,full,lid', 'phrase', $shrt, $arg[1]['name'], $dl['id']);
                    }
                    gr_prnt('say("'.gr_lang('get', 'created').'","s");menuclick("mmenu","ufields");$(".grupo-pop").fadeOut();');
                }
            } else {
                gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
            }
        }
    } else if ($arg[0] === 'role') {
        if (!gr_role('access', 'roles', '1')) {
            exit;
        }
        $arg[1]['name'] = vc($arg[1]['name'], 'strip');
        if (isset($arg[1]["name"]) && !empty($arg[1]["name"])) {
            if (!isset($arg[1]['group'])) {
                $arg[1]['group'] = null;
            } else {
                $arg[1]['group'] = implode(',', $arg[1]['group']);
            }
            if (!isset($arg[1]['files'])) {
                $arg[1]['files'] = null;
            } else {
                $arg[1]['files'] = implode(',', $arg[1]['files']);
            }
            if (!isset($arg[1]['users'])) {
                $arg[1]['users'] = null;
            } else {
                $arg[1]['users'] = implode(',', $arg[1]['users']);
            }
            if (!isset($arg[1]['languages'])) {
                $arg[1]['languages'] = null;
            } else {
                $arg[1]['languages'] = implode(',', $arg[1]['languages']);
            }
            if (!isset($arg[1]['sys'])) {
                $arg[1]['sys'] = null;
            } else {
                $arg[1]['sys'] = implode(',', $arg[1]['sys']);
            }
            if (!isset($arg[1]['roles'])) {
                $arg[1]['roles'] = null;
            } else {
                $arg[1]['roles'] = implode(',', $arg[1]['roles']);
            }

            if (!isset($arg[1]['fields'])) {
                $arg[1]['fields'] = null;
            } else {
                $arg[1]['fields'] = implode(',', $arg[1]['fields']);
            }

            if (!isset($arg[1]['privatemsg'])) {
                $arg[1]['privatemsg'] = null;
            } else {
                $arg[1]['privatemsg'] = implode(',', $arg[1]['privatemsg']);
            }
            $r = db('Grupo', 'i', 'permissions', 'name,groups,files,users,languages,sys,roles,fields,privatemsg', $arg[1]["name"], $arg[1]['group'], $arg[1]['files'], $arg[1]['users'], $arg[1]['languages'], $arg[1]['sys'], $arg[1]['roles'], $arg[1]['fields'], $arg[1]['privatemsg']);
            if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
                $code = rn(6).rn(4);;
                $ext = pathinfo($_FILES['img']['name'])['extension'];
                $icon = $r.'-gr-'.$code;
                if (flr('upload', 'img', 'grupo/roles/', $icon, 'jpg,png,gif', 1, 1)) {
                    flr('resize', 'grupo/roles/'.$icon.'.'.$ext, 0, 150, 150, 1);
                }
            }
            gr_prnt('say("'.gr_lang('get', 'created').'","s");menuclick("mmenu","roles");$(".grupo-pop").fadeOut();');
        } else {
            gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
        }
    } else if ($arg[0] === 'user') {
        if (!gr_role('access', 'users', '1')) {
            exit;
        }
        $arg[1]['name'] = vc($arg[1]['name'], 'strip');
        if (empty($arg[1]["fname"])) {
            $arg[1]["name"] = '';
        }
        $reg = usr('Grupo', 'register', $arg[1]["name"], $arg[1]["email"], $arg[1]["pass"], 3);
        if ($reg[0]) {
            $id = $reg[1];
            gr_data('i', 'profile', 'name', $arg[1]["fname"], $id);
            gr_prnt('say("'.gr_lang('get', 'created').'","s");menuclick("mmenu","users");$(".grupo-pop").fadeOut();');
            $grjoin = gr_default('get', 'autogroupjoin');
            if (!empty($grjoin)) {
                $cr = gr_group('valid', $grjoin);
                if ($cr[0]) {
                    gr_data('i', 'gruser', $grjoin, $id, 0);
                    $dt = array();
                    $dt['id'] = $grjoin;
                    $dt['msg'] = 'joined_group';
                    gr_group('sendmsg', $dt, 1, 1, $id);
                }
            }
            if ($arg[1]["sent"] == 1) {
                gr_mail('signup', $id, 0, rn(5));
            }
        } else {
            if ($reg[1] === 'invalid') {
                $reg[1] = gr_lang('get', 'invalid_value');
            } else if ($reg[1] === 'exist') {
                $reg[1] = gr_lang('get', 'already_exists');
            }
            gr_prnt('say("'.$reg[1].'");');
        }
    }
}
function gr_lview($gid, $mid) {
    $uid = usr('Grupo')['id'];
    $lview = db('Grupo', 's', 'options', 'type,v1,v2', 'lview', $gid, $uid, 'ORDER BY id DESC LIMIT 1');
    if (count($lview) != 0) {
        gr_data('u', 'v3', 'type,v1,v2', $mid, 'lview', $gid, $uid);
    } else {
        gr_data('i', 'lview', $gid, $uid, $mid);
    }
}
function gr_edit() {
    $arg = func_get_args();
    $uid = usr('Grupo')['id'];
    if ($arg[0] === 'group') {
        $role = gr_group('user', $arg[1]["id"], $uid)['role'];
        $adm = 0;
        if ($role == 2 || $role == 1) {
            $adm = 1;
        }
        if (gr_role('access', 'groups', '2') && $adm == 1 || gr_role('access', 'groups', '7')) {
            $arg[1]['name'] = vc($arg[1]['name'], 'strip');
            if (!empty($arg[1]['name'])) {
                $cr = db('Grupo', 's,count(*)', 'options', 'type,v1,id<>', 'group', strtolower($arg[1]['name']), $arg[1]['id'])[0][0];
                if ($cr == 0) {
                    $ncode = $code = rn(6).rn(4);;
                    if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
                        $ext = pathinfo($_FILES['img']['name'])['extension'];
                        $ncode = $code.'.'.$ext;
                    }
                    $nmchk = db('Grupo', 's', 'options', 'id', $arg[1]['id']);
                    if ($nmchk[0]['v1'] != $arg[1]['name']) {
                        gr_data('u', 'v1', 'type,id', $arg[1]['name'], 'group', $arg[1]['id']);
                        $dt = array();
                        $dt['id'] = $arg[1]["id"];
                        $dt['msg'] = 'renamed_group';
                        gr_group('sendmsg', $dt, 1, 1);
                    }
                    $pch = 1;
                    if (isset($arg[1]['delpass'])) {
                        if ($arg[1]['delpass'] == 1) {
                            $pch = 0;
                        }
                    }
                    if (!empty($arg[1]['password']) && $pch == 1) {
                        $arg[1]['password'] = md5($arg[1]['password']);
                        gr_data('u', 'v2', 'type,id', $arg[1]['password'], 'group', $arg[1]['id']);
                        $dt = array();
                        $dt['id'] = $arg[1]["id"];
                        $dt['msg'] = 'changed_group_pass';
                        gr_group('sendmsg', $dt, 1, 1);
                    }
                    if (isset($arg[1]['delpass']) && $arg[1]['delpass'] == 1) {
                        gr_data('u', 'v2', 'type,id', '', 'group', $arg[1]['id']);
                        $dt = array();
                        $dt['id'] = $arg[1]["id"];
                        $dt['msg'] = 'removed_group_pass';
                        gr_group('sendmsg', $dt, 1, 1);
                    }
                    if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
                        $icon = $arg[1]['id'].'-gr-'.$code;
                        foreach (glob("gem/ore/grupo/groups/".$arg[1]['id']."-gr-*.*") as $filename) {
                            unlink($filename);
                        }
                        if (flr('upload', 'img', 'grupo/groups/', $icon, 'jpg,png,gif', 0, 1)) {
                            flr('resize', 'grupo/groups/'.$icon.'.'.$ext, 0, 150, 150, 1);
                        }
                        $dt = array();
                        $dt['id'] = $arg[1]["id"];
                        $dt['msg'] = 'changed_group_icon';
                        gr_group('sendmsg', $dt, 1, 1);
                    }
                    gr_prnt('$(".swr-grupo .lside > .tabs > ul > li").eq(0).attr("list",'.$arg[1]['id'].').trigger("click");say("'.gr_lang('get', 'updated').'","s");$(".grupo-pop").fadeOut();');
                } else {
                    gr_prnt('say("'.gr_lang('get', 'already_exists').'");');
                }
            } else {
                gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
            }
        }
    } else if ($arg[0] === 'customfield') {
        if (gr_role('access', 'fields', '2')) {
            $oldfield = db('Grupo', 's', 'profiles', 'type,id', 'field', $arg[1]['id']);
            if (!empty($arg[1]['name']) && !empty($arg[1]['ftype']) && count($oldfield) > 0) {
                $arg[1]['name'] = vc($arg[1]['name'], 'strip');
                $arg[1]['ftype'] = vc($arg[1]['ftype'], 'alpha');
                $shrt = trim(preg_replace('/\s+/', ' ', $arg[1]['name']));
                $shrt = "cf_".strtolower(str_replace(" ", "_", $shrt));
                $chkcf = db('Grupo', 's', 'phrases', 'short', $shrt);
                if (count($chkcf) > 0 && $shrt != $oldfield[0]['name']) {
                    gr_prnt('say("'.gr_lang('get', 'already_exists').'");');
                } else {
                    $r = db('Grupo', 'u', 'profiles', 'name,cat', 'type,id', $shrt, $arg[1]['ftype'], 'field', $arg[1]['id']);
                    $dlng = db('Grupo', 's', 'phrases', 'type', 'lang');
                    foreach ($dlng as $dl) {
                        db('Grupo', 'u', 'phrases', 'full,short', 'type,short', $arg[1]['name'], $shrt, 'phrase', $oldfield[0]['name']);
                    }
                    gr_prnt('say("'.gr_lang('get', 'updated').'","s");menuclick("mmenu","ufields");$(".grupo-pop").fadeOut();');
                }
            } else {
                gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
            }
        }
    } else if ($arg[0] === 'language') {
        if (!gr_role('access', 'languages', '2')) {
            exit;
        }
        if ($arg[1]['id'] == '0') {
            gr_prnt('say("'.gr_lang('get', 'denied').'","e");');
            gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
            exit;
        }
        $r = db('Grupo', 's', 'phrases', 'type,id', 'lang', $arg[1]['id']);
        $arg[1]['name'] = vc($arg[1]['name'], 'strip');
        if (isset($r[0]) && !empty($arg[1]['name'])) {
            db('Grupo', 'u', 'phrases', 'short', 'id', $arg[1]['name'], $arg[1]['id']);
            $ph = db('Grupo', 's', 'phrases', 'type,lid', 'phrase', $arg[1]['id']);
            foreach ($ph as $p) {
                $key = 'z'.$p['id'];
                if (!empty($arg[1][$key]) && $arg[1][$key] != $p['full']) {
                    db('Grupo', 'u', 'phrases', 'full', 'lid,type,id', $arg[1][$key], $arg[1]['id'], 'phrase', $p['id']);
                }
            }
        }
        if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
            $code = rn(6).rn(4);;
            $ext = pathinfo($_FILES['img']['name'])['extension'];
            $icon = $arg[1]['id'].'-gr-'.$code;
            foreach (glob("gem/ore/grupo/languages/".$arg[1]['id']."-gr-*.*") as $filename) {
                unlink($filename);
            }
            if (flr('upload', 'img', 'grupo/languages/', $icon, 'jpg,png,gif', 1, 1)) {
                flr('resize', 'grupo/languages/'.$icon.'.'.$ext, 0, 150, 150, 1);
            }
        }
        gr_prnt('say("'.gr_lang('get', 'updated').'","s");menuclick("mmenu","languages");');
        gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
    } else if ($arg[0] === 'role') {
        if (!gr_role('access', 'roles', '2')) {
            exit;
        }
        $arg[1]['name'] = vc($arg[1]['name'], 'strip');
        if (empty($arg[1]['name'])) {
            gr_prnt('say("'.gr_lang('get', 'invalid_value').'");');
            exit;
        }
        if (!isset($arg[1]['group'])) {
            $arg[1]['group'] = null;
        } else {
            $arg[1]['group'] = implode(',', $arg[1]['group']);
        }
        if (!isset($arg[1]['files'])) {
            $arg[1]['files'] = null;
        } else {
            $arg[1]['files'] = implode(',', $arg[1]['files']);
        }
        if (!isset($arg[1]['users'])) {
            $arg[1]['users'] = null;
        } else {
            $arg[1]['users'] = implode(',', $arg[1]['users']);
        }
        if (!isset($arg[1]['languages'])) {
            $arg[1]['languages'] = null;
        } else {
            $arg[1]['languages'] = implode(',', $arg[1]['languages']);
        }
        if (!isset($arg[1]['sys'])) {
            $arg[1]['sys'] = null;
        } else {
            $arg[1]['sys'] = implode(',', $arg[1]['sys']);
        }
        if (!isset($arg[1]['roles'])) {
            $arg[1]['roles'] = null;
        } else {
            $arg[1]['roles'] = implode(',', $arg[1]['roles']);
        }
        if (!isset($arg[1]['fields'])) {
            $arg[1]['fields'] = null;
        } else {
            $arg[1]['fields'] = implode(',', $arg[1]['fields']);
        }
        if (!isset($arg[1]['privatemsg'])) {
            $arg[1]['privatemsg'] = null;
        } else {
            $arg[1]['privatemsg'] = implode(',', $arg[1]['privatemsg']);
        }
        if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
            $code = rn(6).rn(4);;
            $ext = pathinfo($_FILES['img']['name'])['extension'];
            $icon = $arg[1]['rid'].'-gr-'.$code;
            foreach (glob("gem/ore/grupo/roles/".$arg[1]['rid']."-gr-*.*") as $filename) {
                unlink($filename);
            }
            if (flr('upload', 'img', 'grupo/roles/', $icon, 'jpg,png,gif', 1, 1)) {
                flr('resize', 'grupo/roles/'.$icon.'.'.$ext, 0, 150, 150, 1);
            }
        }
        db('Grupo', 'u', 'permissions', 'name,groups,files,users,languages,sys,roles,fields,privatemsg', 'id', $arg[1]['name'], $arg[1]['group'], $arg[1]['files'], $arg[1]['users'], $arg[1]['languages'], $arg[1]['sys'], $arg[1]['roles'], $arg[1]['fields'], $arg[1]['privatemsg'], $arg[1]['rid']);
        gr_prnt('say("'.gr_lang('get', 'updated').'","s");menuclick("mmenu","roles");$(".grupo-pop").fadeOut();');
    } else if ($arg[0] === 'avatar') {
        if (!empty($_FILES['cavatar']['name'])) {
            $icon = $uid.'-gr-'.rn(10);
            $ext = pathinfo($_FILES['cavatar']['name'])['extension'];
            foreach (glob("gem/ore/grupo/users/".$uid."-gr-*.*") as $filename) {
                unlink($filename);
            }
            if (flr('upload', 'cavatar', 'grupo/users/', $icon, 'jpg,png,gif', 0, 1)) {
                flr('resize', 'grupo/users/'.$icon.'.'.$ext, 0, 150, 150, 1);
            }
        } else if (isset($arg[1]['avatar'])) {
            if (file_exists('gem/ore/grupo/avatars/'.$arg[1]['avatar'])) {
                $icon = $uid.'-gr-'.rn(10);
                foreach (glob("gem/ore/grupo/users/".$uid."-gr-*.*") as $filename) {
                    unlink($filename);
                }
                flr('copy', 'grupo/avatars/'.$arg[1]['avatar'], 'grupo/users/'.$icon.'.png');
            }
        }
        gr_prnt("location.reload();");
    } else if ($arg[0] === 'profile') {
        if (!gr_role('access', 'users', '2')) {
            $arg[1]['id'] = $uid;
        }
        if (usr('Grupo', 'alter', 'email', $arg[1]['email'], $arg[1]['id']) || usr('Grupo', 'select', $arg[1]['id'])['email'] == $arg[1]['email']) {
            if (usr('Grupo', 'alter', 'name', $arg[1]['user'], $arg[1]['id']) || usr('Grupo', 'select', $arg[1]['id'])['name'] == $arg[1]['user']) {
                if (!empty($arg[1]['password'])) {
                    usr('Grupo', 'alter', 'pass', $arg[1]['password'], $arg[1]['id']);
                }
                $arg[1]['name'] = vc($arg[1]['name'], 'strip');
                if (!empty($arg[1]['name'])) {
                    gr_data('u', 'v2', 'type,v1,v3', $arg[1]['name'], 'profile', 'name', $arg[1]['id']);
                }
                if (gr_role('access', 'roles', '2')) {
                    if (!empty($arg[1]['role'])) {
                        usr('Grupo', 'alter', 'role', $arg[1]['role'], $arg[1]['id']);
                    }
                }
                $lists = db('Grupo', 's', 'profiles', 'type', 'field');
                foreach ($lists as $f) {
                    $pf = $f['name'];
                    if ($f['cat'] == 'datefield') {
                        $arg[1][$pf] = vc($arg[1][$pf], 'date', 'Y-m-d');
                    } else if ($f['cat'] == 'numfield') {
                        $arg[1][$pf] = vc($arg[1][$pf], 'num');
                    } else {
                        $arg[1][$pf] = vc($arg[1][$pf]);
                    }
                    if (empty($arg[1][$pf])) {
                        db('Grupo', 'd', 'profiles', 'type,name,uid', 'profile', $f['id'], $arg[1]['id']);
                    } else {
                        $ct = db('Grupo', 's,count(*)', 'profiles', 'type,name,uid', 'profile', $f['id'], $arg[1]['id'])[0][0];
                        if ($ct == 0) {
                            db('Grupo', 'i', 'profiles', 'type,name,uid,v1', 'profile', $f['id'], $arg[1]['id'], $arg[1][$pf]);
                        } else {
                            db('Grupo', 'u', 'profiles', 'v1', 'type,name,uid', $arg[1][$pf], 'profile', $f['id'], $arg[1]['id']);
                        }
                    }
                }
                if (!empty($arg[1]['tmz'])) {
                    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                    if (in_array($arg[1]['tmz'], $tzlist)) {
                        $ct = db('Grupo', 's,count(*)', 'options', 'type,v1,v3', 'profile', 'tmz', $arg[1]['id'])[0][0];
                        if ($ct == 0) {
                            gr_data('i', 'profile', 'tmz', $arg[1]['tmz'], $arg[1]['id']);
                        } else {
                            gr_data('u', 'v2', 'type,v1,v3', $arg[1]['tmz'], 'profile', 'tmz', $arg[1]['id']);
                        }
                    }
                }
                if (!empty($arg[1]['delacc']) && $arg[1]['delacc'] == 'yes') {
                    if (gr_role('access', 'users', '7')) {
                        $ct = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $arg[1]['id']);
                        if ($ct && count($ct) > 0) {
                            gr_prnt('say("'.gr_lang('get', 'already_deactivated').'","e");');
                        } else {
                            $ct = db('Grupo', 'i', 'options', 'type,v1,v3', 'deaccount', 'yes', $arg[1]['id']);
                            gr_prnt('say("'.gr_lang('get', 'deactivated').'","s");');
                            usr('Grupo', 'forcelogout', $arg[1]['id']);
                        }
                    }
                }
                if (!empty($_FILES['cbg']['name'])) {
                    $bg = $arg[1]['id'].'-gr-'.rn(10);
                    $ext = pathinfo($_FILES['cbg']['name'])['extension'];
                    foreach (glob("gem/ore/grupo/userbg/".$arg[1]['id']."-gr-*.*") as $filename) {
                        unlink($filename);
                    }
                    if (flr('upload', 'cbg', 'grupo/userbg/', $bg, 'jpg,png,gif', 0, 1)) {
                        if (@is_array(getimagesize('gem/ore/grupo/userbg/'.$bg.'.'.$ext))) {
                            flr('compress', 'grupo/userbg/'.$bg.'.'.$ext, 50);
                        } else {
                            flr('delete', 'grupo/userbg/'.$bg.'.'.$ext);
                        }
                    }
                }
                if ($arg[1]['id'] != $uid) {
                    if ($arg[1]['aside'] == 'profile') {
                        gr_prnt('$(".swr-grupo .aside > .content .profile > .top > span.refresh").trigger("click");');
                    } else if ($arg[1]['aside'] != 'right') {
                        gr_prnt('menuclick("mmenu","users");');
                    } else {
                        gr_prnt('$(".rside .xtra").trigger("click");');
                    }
                } else {
                    gr_prnt("location.reload();");
                }
                if (empty($arg[1]['delacc']) || $arg[1]['delacc'] != 'yes') {
                    gr_prnt('say("'.gr_lang('get', 'updated').'","s");');
                }
                gr_prnt('$(".grupo-pop").fadeOut();');
            } else {
                gr_prnt('say("'.gr_lang('get', 'username_exists').'");');
            }
        } else {
            gr_prnt('say("'.gr_lang('get', 'email_exists').'");');
        }
    }
}
function gr_iplook() {
    if (pg() != 'banned/') {
        $blist = db('Grupo', 's', 'options', 'type', 'blacklist')[0]['v2'];
        $blist = preg_split('/\s+/', $blist);
        if (in_array(ip(), $blist)) {
            rt('banned');
            exit;
        }
    }
}
function gr_lang() {
    $uid = usr('Grupo')['id'];
    $arg = func_get_args();
    $prlang = gr_default('get', 'language');
    $cr = db('Grupo', 's', 'options', 'type,v1,v3', 'profile', 'language', $uid);
    if ($cr && count($cr) > 0) {
        $prlang = $cr[0]['v2'];
    }
    if ($arg[0] === 'get') {
        if (isset($arg[2])) {
            $prlang = vc($arg[2]);
        } else if (isset($_SESSION["grupolang"])) {
            $prlang = $_SESSION["grupolang"];
        }
        $r = db('Grupo', 's', 'phrases', 'type,short,lid', 'phrase', $arg[1], $prlang);
        if (isset($r[0])) {
            $r = htmlspecialchars_decode($r[0]['full']);
        } else {
            $r = $arg[1];
        }
        return $r;
    } else if ($arg[0] === 'var') {
        if (isset($arg[1])) {
            $prlang = vc($arg[1]);
        } else if (isset($_SESSION["grupolang"])) {
            $prlang = $_SESSION["grupolang"];
        }
        $ra = db('Grupo', 's', 'phrases', 'type,lid', 'phrase', $prlang);
        $r = array();
        foreach ($ra as $a) {
            $r[$a['short']] = htmlspecialchars_decode($a['full']);
        }
        return $r;
    } else if ($arg[0] === 'list') {
        if (isset($arg[1])) {
            gr_prnt('<div class="langswitch"><ul>');
            $lng = db('Grupo', 's', 'phrases', 'type', 'lang');
            foreach ($lng as $r) {
                gr_prnt('<li class="ajx" data-do="language" data-type="switch" data-act=1 data-id="'.$r['id'].'">');
                gr_prnt('<img src="'.url().gr_img('languages', $r['id']).'">');
                gr_prnt('</li>');
            }
            gr_prnt('</ul></div>');
        } else {
            gr_prnt('<i class="langswitch subnav">'."\n");
            gr_prnt('<img src="'.gr_img('languages', $prlang).'">'."\n");
            gr_prnt('<div class="swr-menu r-end"><ul>'."\n");
            $lng = db('Grupo', 's', 'phrases', 'type', 'lang');
            foreach ($lng as $r) {
                gr_prnt('<li class="ajx" data-do="language" data-type="switch" data-act=1 data-id="'.$r['id'].'">'.$r['short'].'</li>'."\n");
            }
            gr_prnt('</ul> </div></i>');
        }
    } else if ($arg[0]['type'] === 'delete') {
        if (!gr_role('access', 'languages', '3')) {
            exit;
        }
        if ($arg[0]['id'] == '1') {
            gr_prnt('say("'.gr_lang('get', 'denied').'","e");');
            gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
            exit;
        }
        if (gr_default('get', 'language') == $arg[0]['id']) {
            db('Grupo', 'u', 'options', 'v2', 'type,v1,v2', 1, 'profile', 'language', $arg[0]['id']);
            db('Grupo', 'u', 'options', 'v2', 'id', 1, 289);
        }
        $r = db('Grupo', 'd', 'phrases', 'id,type', $arg[0]['id'], 'lang');
        $r = db('Grupo', 'd', 'phrases', 'lid,type', $arg[0]['id'], 'phrase');
        foreach (glob("gem/ore/grupo/languages/".$arg[0]['id']."-gr-*.*") as $filename) {
            unlink($filename);
        }
        gr_prnt('say("'.gr_lang('get', 'deleted').'","s");menuclick("mmenu","languages");');
        gr_prnt('$(".grupo-pop > div > form > span.cancel").trigger("click");');
    } else if ($arg[0]['type'] === 'switch') {
        $le = db('Grupo', 's,count(*)', 'phrases', 'type,id', 'lang', $arg[0]['id']);
        if ($le != 0) {
            if (!usr('Grupo')['active']) {
                $_SESSION["grupolang"] = $arg[0]['id'];
            } else {
                unset($_SESSION["grupolang"]);
                $ct = db('Grupo', 's,count(*)', 'options', 'type,v1,v3', 'profile', 'language', $uid)[0][0];
                if ($ct == 0) {
                    gr_data('i', 'profile', 'language', $arg[0]['id'], $uid);
                } else {
                    gr_data('u', 'v2', 'type,v1,v3', $arg[0]['id'], 'profile', 'language', $uid);
                }
            }
        }
        gr_prnt('location.reload();');
    }
}


function callAPI($method, $url, $data){
    $curl = curl_init();
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
 }


function gr_data() {
    $arg = vc(func_get_args());
    if ($arg[0] === 'i') {
        if (!isset($arg[2])) {
            $arg[2] = 0;
        }
        if (!isset($arg[3])) {
            $arg[3] = 0;
        }
        if (!isset($arg[4])) {
            $arg[4] = 0;
        }
        return db('Grupo', 'i', 'options', 'type,v1,v2,v3,tms', $arg[1], $arg[2], $arg[3], $arg[4], dt());
    } else if ($arg[0] === 'd') {
        if (isset($arg[4])) {
            db('Grupo', 'd', 'options', $arg[1], $arg[2], $arg[3], $arg[4]);
        } else if (isset($arg[3])) {
            db('Grupo', 'd', 'options', $arg[1], $arg[2], $arg[3]);
        } else if (isset($arg[2])) {
            db('Grupo', 'd', 'options', $arg[1], $arg[2]);
        }

    } else if ($arg[0] === 'c') {
        if (isset($arg[4])) {
            $r = db('Grupo', 's,count(*)', 'options', $arg[1], $arg[2], $arg[3], $arg[4])[0][0];
        } else if (isset($arg[3])) {
            $r = db('Grupo', 's,count(*)', 'options', $arg[1], $arg[2], $arg[3])[0][0];
        } else if (isset($arg[2])) {
            $r = db('Grupo', 's,count(*)', 'options', $arg[1], $arg[2])[0][0];
        }
        return $r;
    } else if ($arg[0] === 'u') {
        if (isset($arg[7])) {
            db('Grupo', 'u', 'options', $arg[1].",tms", $arg[2], $arg[3], dt(), $arg[4], $arg[5], $arg[6], $arg[7]);
        } else if (isset($arg[6])) {
            db('Grupo', 'u', 'options', $arg[1].",tms", $arg[2], $arg[3], dt(), $arg[4], $arg[5], $arg[6]);
        } else if (isset($arg[5])) {
            db('Grupo', 'u', 'options', $arg[1].",tms", $arg[2], $arg[3], dt(), $arg[4], $arg[5]);
        } else {
            db('Grupo', 'u', 'options', $arg[1].",tms", $arg[2], $arg[3], dt(), $arg[4], dt());
        }

    }

}


?>