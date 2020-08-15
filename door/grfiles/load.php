<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_files($do) {
    $uid = usr('Grupo')['id'];
    if ($do['type'] === 'upload') {
        if (!gr_role('access', 'files', '1')) {
            gr_prnt('say("'.gr_lang('get', 'denied').'","e")'); exit;
        }
        $dir = 'grupo/files/'.$uid.'/';
        flr('new', $dir);
        if (flr('upload', 'ufiles', $dir, rn(6).rn(3).'-gr-')) {
            gr_prnt('$(".swr-grupo .lside > .tabs > ul > li[act=files]").trigger("click");say("'.gr_lang('get', 'files_uploaded').'","s");');
        } else {
            gr_prnt('say("'.gr_lang('get', 'error_uploading').'");');
        }
    } else if ($do['type'] === 'expired') {
        $dumb = glob('gem/ore/grupo/files/dumb/' . "*.zip");
        foreach ($dumb as $dm) {
            if (strtotime('now') > strtotime('+'.gr_default('get', 'fileexpiry').' minutes', filemtime($dm))) {
                unlink($dm);
            }
        }
    } else if ($do['type'] === 'download') {
        // if (!gr_role('access', 'files', '2')) {
        //     gr_prnt('say("'.gr_lang('get', 'denied').'","e")'); exit;
        // }
        // $cu = gr_group('user', $do["gid"], $uid, $do["ldt"])[0];
        // if ($cu) {
        //     if ($do["ldt"] == 'user') {
        //         $tmpido = $do["gid"].'-'.$uid;
        //         if ($do["gid"] > $uid) {
        //             $tmpido = $uid.'-'.$do["gid"];
        //         }
        //         $do["gid"] = $tmpido;
        //     }
        //     $ck = db('Grupo', 's,count(*)', 'msgs', 'gid,msg', $do["gid"], $do["id"])[0][0];
        //     if ($ck != 0) {
        //         $exp['type'] = 'expired';
        //         gr_files($exp);
        //         $zn = "gem/ore/grupo/files/dumb/zip-".$do["id"].".zip";
        //         if (file_exists($zn)) {
        //             gr_prnt('window.open("'.url().'download/'.$do["id"].'/","_blank");');
        //         } else {
        //             gr_prnt('say("'.gr_lang('get', 'file_expired').'");');
        //         }
        //     }
        // }
    } else if ($do['type'] === 'zip') {
        if (!empty($do['id'])) {
            if (gr_role('access', 'files', '2')) {
                $file = "gem/ore/grupo/files/".$uid.'/'.$do['id'];
                if (file_exists($file)) {
                    $file = "grupo/files/".$uid.'/'.$do['id'];
                    $fid = $uid.rn(10);
                    $zn = "grupo/files/dumb/zip-".$fid;
                    flr('delete', $zn.'.zip');
                    $rn = explode('-gr-', $do['id'], 2)[1];
                    if (flr('zip', $file, $zn, $rn)) {
                        if (isset($do['r'])) {
                            return $fid;
                        } else {
                            gr_prnt('window.open("'.url().'download/'.$fid.'/","_blank");');
                        }
                    }
                }
            } else {
                gr_prnt('say("'.gr_lang('get', 'denied').'","e")'); exit;
            }
        }
    } else if ($do['type'] === 'share') {
        if (!gr_role('access', 'files', '4')) {
            gr_prnt('say("'.gr_lang('get', 'denied').'","e")'); exit;
        }
if (!isset($do["ldt"]) || empty($do["ldt"])) {
            $do["ldt"] = 'group';
        }
        $cu = gr_group('user', $do["gid"], $uid,$do["ldt"])[0];
        if ($cu) {
            $do['type'] = 'zip';
            $do['r'] = 1;
            $dt['msg'] = gr_files($do);
            $dt['id'] = $do['gid'];
            $dt['ldt'] = $do['ldt'];
            gr_group('sendmsg', $dt, 2, 0);
            gr_prnt('loadgroup('.$do['gid'].',$(".dumb > .loadgroup"))');
        } else {
            gr_prnt("say('".gr_lang('get', 'select_group')."');");
        }
    } else if ($do['type'] === 'delete') {
        if (!gr_role('access', 'files', '3')) {
            gr_prnt('say("'.gr_lang('get', 'denied').'","e")'); exit;
        }
        $file = "gem/ore/grupo/files/".$uid.'/'.$do['id'];
        unlink($file);
        gr_prnt('$(".swr-grupo .lside > .tabs > ul > li[act=files]").trigger("click");say("'.gr_lang('get', 'deleted').'","s");$(".grupo-pop").fadeOut();');
    }
}
?>