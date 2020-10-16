<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_list($do) {
    // list of users 
    $uid             = usr('Grupo')['id'];
    $master_id_user  = $uid;
    $id_organization = usr('Grupo')['id_organization'];
    $master_role     = usr('Grupo')['role'];
    $list = null;
    $arg = vc(func_get_args());
    gr_profile('ustatus', 'online');
    if (!isset($do["type"])) {
        $do["type"] = null;
    }
    if ($do["type"] === "groups") {
      //  $r = db('Grupo', 's', 'options', 'type', 'group');
        $r = db('Grupo', 'q', 'SELECT * FROM gr_options WHERE id_organization='.$id_organization);

        
        // $r = db('Grupo', 'q', 'SELECT * FROM gr_options as opt INNER JOIN gr_users usr on opt.v2 = usr.id WHERE opt.type="gruser" and usr.deleted=0 and usr.id_organization = '.$id_organization);
        
        
        $i = 0;
        foreach ($r as $v) {
                $count = db('Grupo', 'q', 'SELECT COUNT(*) as count FROM chat.gr_options as opt INNER JOIN gr_users as usr on opt.v2 = usr.id where opt.type = "gruser" and usr.deleted != 1 and opt.v1 = '.$v['id'] )[0];
                $cu = gr_group('user', $v['id'], $uid);
                if ($cu[0] || !$cu[0] && gr_role('access', 'groups', '6')) {
                    $list[$i] = new stdClass();
                    $list[$i]->img = gr_img('groups', $v['id']);
                    $list[$i]->name = $v['v1'];
                    $list[$i]->countag = $list[$i]->count = 0;
                   // $list[$i]->sub = gr_data('c', 'type,v1', 'gruser', $v['id'])." ".gr_lang('get', 'members');
                    $list[$i]->sub = $count['count']." ".gr_lang('get', 'members');
                    $lview = db('Grupo', 's', 'options', 'type,v1,v2', 'lview', $v['id'], $uid, 'ORDER BY id DESC LIMIT 1');
                    $msg = db('Grupo', 's', 'msgs', 'gid', $v['id'], 'ORDER BY id DESC');
                    
                    if ($cu[0]) {
                        if (count($lview) != 0) {
                            $list[$i]->count = db('Grupo', 's,count(*)', 'msgs', 'gid,id>', $v['id'], $lview[0]['v3'])[0][0];
                            if ($list[$i]->count != 0) {
                                $list[$i]->count = $list[$i]->count;
                                $list[$i]->countag = gr_lang('get', 'new');
                            }
                        } else {
                            $list[$i]->count = count($msg)." ".gr_lang('get', 'new');
                        }
                    }
                    $list[$i]->right = gr_lang('get', 'options');
                    $list[$i]->rtag = '';
                    $list[$i]->oa = gr_lang('get', 'view');
                    $list[$i]->oat = 'class="paj"';
                    $list[$i]->ob = 0;
                    $list[$i]->obt = '';
                    $list[$i]->oc = 0;
                    $list[$i]->oct = '';
                    $list[$i]->icon = "";
                    $list[$i]->id = 'class="loadgroup" ldt="group" no="'.$v['id'].'" data-sort="100'.strtotime($msg[0]['tms']).'"';
                    if ($cu && $cu['role'] == 3 && !gr_role('access', 'groups', '7')) {
                        $list[$i]->id = 'class="say" say="'.gr_lang('get', 'banned').'" type="e" no="'.$v['id'].'" ldt="group" data-sort="000'.strtotime($msg[0]['tms']).'"';
                    }
                    if (!$cu[0]) {
                        if (!gr_role('access', 'groups', '4') && !gr_role('access', 'groups', '7')) {
                            $list[$i]->oa = gr_lang('get', 'join');
                            $list[$i]->id = 'class="say" say="'.gr_lang('get', 'denied').'" type="e" no="'.$v['id'].'" ldt="group" data-sort="000'.strtotime($msg[0]['tms']).'"';
                        } else {
                            $list[$i]->oa = gr_lang('get', 'join');
                            $list[$i]->id = 'class="formpop" title="'.gr_lang('get', 'join_group').'" do="group" ldt="group" btn="'.gr_lang('get', 'join').'" act="join" no="'.$v['id'].'" data-sort="000'.strtotime($msg[0]['tms']).'"';
                        }
                    }
                    if (!empty($v['v2'])) {
                        $list[$i]->icon = "ti-lock";
                    }
                }
                $i = $i+1;
                
        }
    } else if ($do["type"] === "pm") {
        if (gr_role('access', 'privatemsg', '2')) {
            $r = db('Grupo', 'q', 'SELECT max(id) as id,gid FROM gr_msgs WHERE cat="user" GROUP by gid ORDER by id DESC');
            $i = 0;
            foreach ($r as $v) {
                $chusers = explode('-', $v['gid']);
                if ($chusers[1] == $uid || $chusers[0] == $uid) {
                    if ($chusers[0] == $uid) {
                        $chusers[0] = $chusers[1];
                    }
                    $chmsg = db('Grupo', 's', 'msgs', 'id', $v['id'])[0];
                    $list[$i] = new stdClass();
                    $list[$i]->img = gr_img('users', $chusers[0]);
                    $list[$i]->name = gr_profile('get', $chusers[0], 'name');
                    $rSelectUSer = db('Grupo', 'q', 'SELECT * FROM gr_users WHERE id="'.$chusers[0].'"');
                    $list[$i]->name  = $rSelectUSer[0]['username'];
                    if( $rSelectUSer[0]['username'] === "") {
                        $list[$i]->name  = 'Never&nbsp;logged. (' .$rSelectUSer[0]['name'] . ')';
                    }
                  
                    $list[$i]->count = 0;

                    $deac = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $chusers[0]);
                    if (count($deac) > 0 || gr_profile('blocked', $chusers[0])) {
                        $list[$i]->img = gr_img('users', 0);
                    }
                    $lview = db('Grupo', 's', 'options', 'type,v1,v2', 'lview', $v['gid'], $uid, 'ORDER BY id DESC LIMIT 1');
                    $msg = db('Grupo', 's', 'msgs', 'gid,cat', $v['gid'], 'user', 'ORDER BY id DESC');
                    if (count($lview) != 0) {
                        $list[$i]->count = db('Grupo', 's,count(*)', 'msgs', 'gid,id>', $v['gid'], $lview[0]['v3'])[0][0];
                        if ($list[$i]->count != 0) {
                            $list[$i]->count = $list[$i]->count;
                            $list[$i]->countag = gr_lang('get', 'new');
                        }
                    } else {
                        $list[$i]->count = count($msg);
                        $list[$i]->countag = gr_lang('get', 'new');
                    }

                    if ($chmsg['type'] === 'system') {
                        $chmsg['msg'] = gr_lang('get', $chmsg['msg']);
                    } else if ($chmsg['type'] === 'file') {
                        $chmsg['msg'] = gr_lang('get', 'shared_file');
                    }
                    $tms = new DateTime($chmsg['tms']);
                    $tmz = new DateTimeZone(gr_profile('get', $uid, 'tmz'));
                    $tms->setTimezone($tmz);
                    $tmst = strtotime($tms->format('Y-m-d H:i:s'));
                    $list[$i]->sub = $tms->format('d-M-y h:i A');
                    $list[$i]->right = gr_lang('get', 'options');
                    $list[$i]->rtag = '';
                    $list[$i]->oa = gr_lang('get', 'view');
                    $list[$i]->oat = 'class="paj"';
                    $list[$i]->ob = 0;
                    $list[$i]->obt = '';
                    $list[$i]->oc = 0;
                    $list[$i]->oct = '';
                    $list[$i]->icon = "'status ".gr_profile('get', $chusers[0], 'status')."'";
                    $list[$i]->id = 'class="loadgroup" ldt="user" no="'.$chusers[0].'" data-sort="100'.strtotime($chmsg['tms']).'"';
                }
                $i = $i+1;
            }
        }

    } else if ($do["type"] === "crew") {
        $i = 0;
        $cu = gr_group('user', $do["gid"], $uid);
        if (!$cu[0] || $cu['role'] == 3 && !gr_role('access', 'groups', '7')) {
            exit;
        }
       // $list = db('Grupo', 's', 'options', 'type,v1', 'gruser', $do["gid"]);
        $list = db('Grupo', 'q', 'SELECT * FROM gr_options as opt INNER JOIN gr_users usr on opt.v2 = usr.id WHERE opt.type="gruser" and usr.deleted=0 and opt.v2 != '.$uid.' and opt.v1 ='.$do["gid"]);
        foreach ($list as $key => $f) {
                $dect = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $f['v2']);
                if ($dect && count($dect) > 0) {
                    unset($list[$key]);
                }
        }
        foreach ($list as $f) {
                $name = explode("@", $f['email'])[0];
                $list[$i] = new stdClass();
                $list[$i]->img = gr_img('users', $f['v2']);
                //$list[$i]->name = gr_profile('get', $f['v2'], 'name');
                $list[$i]->name =  $name ;
                $list[$i]->count = 0;
                switch($f['role']){
                    case '3':
                        $list[$i]->sub = 'Org admin';
                        $sort = 3;
                    break;
                    case '5':
                        $list[$i]->sub = 'Appover';
                        $sort = 2;
                    break;
                    case '6':
                        $list[$i]->sub = 'User';
                        $sort = 0;
                    break;
                    default:
                        $list[$i]->sub = 'Guest';
                        $sort = 0;
                    break;
                }
                // $list[$i]->sub = gr_lang('get', 'member');
                // $sort = 1;
                // if ($f['v3'] == 2) {
                //     $list[$i]->sub = gr_lang('get', 'admin');
                //     $sort = 3;
                // } else if ($f['v3'] == 1) {
                //     $list[$i]->sub = gr_lang('get', 'moderator');
                //     $sort = 2;
                // } else if ($f['v3'] == 3) {
                //     $list[$i]->sub = gr_lang('get', 'blocked');
                //     $sort = 0;
                // }
                $list[$i]->right = gr_lang('get', 'options');
                $list[$i]->rtag = 'type="group" no="'.$f['v1'].'"';
                $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
                if (gr_role('access', 'groups', '7') || $cu['role'] == 2) {
                    $list[$i]->oa = gr_lang('get', 'edit');
                    $list[$i]->oat = 'class="formpop" title="'.gr_lang('get', 'roles').'" data-pname="'.$list[$i]->name.'" pn=1 do="group" btn="'.gr_lang('get', 'update').'" act="role" data-usr="'.$f['v2'].'"';
                }
                $list[$i]->ob = gr_lang('get', 'msgs');
                $list[$i]->obt = 'class="turnchat goback" data-block="crew" data-uid="'.$f['v2'].'" act="msgs"';
                $norc = 0;
                if ($f['v3'] == 2 && $cu['role'] == 1) {
                    $norc = 1;
                }
                if ($f['v2'] != $uid && $norc == 0) {
                    if (gr_role('access', 'groups', '7') || $cu['role'] == 2 || $cu['role'] == 1) {
                        if ($f['v3'] == 3) {
                            $list[$i]->oc = gr_lang('get', 'unban');
                            $list[$i]->oct = 'act="unblock" data-usid="'.$f['v2'].'"';
                        } else {
                            $list[$i]->oc = gr_lang('get', 'ban');
                            $list[$i]->oct = 'act="block" data-usid="'.$f['v2'].'"';
                        }
                    }
                }
                $list[$i]->icon = "'status ".gr_profile('get', $f['v2'], 'status')."'";
                $list[$i]->id = 'data-sort="'.$sort.'" class="crew"';
                $i = $i+1;

        }

    } else if ($do["type"] === "alerts") {
        $id = $i = 0;
        $list = db('Grupo', 's', 'alerts', 'uid', $uid, 'ORDER BY id DESC');
        if (isset($list[0])) {
            $id = $list[0]['id'];
        }
        foreach ($list as $f) {
            $list[$i] = new stdClass();
            $list[$i]->img = gr_img('users', $f['v3']);
            $list[$i]->name = gr_profile('get', $f['v3'], 'name');
            $list[$i]->countag = $list[$i]->count = 0;
            $list[$i]->sub = gr_lang('get', 'alert_'.$f['type']);
            $tms = new DateTime($f['tms']);
            $tmz = new DateTimeZone(gr_profile('get', $uid, 'tmz'));
            $tms->setTimezone($tmz);
            $list[$i]->right = $tms->format('h:i A');
            $list[$i]->rtag = 'type="alert" no="'.$f['id'].'"';
            $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
            if ($f['type'] == 'invitation') {
                $list[$i]->oa = gr_lang('get', 'join');
                $list[$i]->oat = 'class="formpop" title="'.gr_lang('get', 'join_group').'" do="group" btn="'.gr_lang('get', 'join').'" act="join" no="'.$f['v1'].'"';
            } else if ($f['type'] == 'mentioned' || $f['type'] == 'replied') {
                $list[$i]->oa = gr_lang('get', 'view');
                $list[$i]->oat = 'class="formpop" title="'.gr_lang('get', 'view_message').'" do="group" btn="'.gr_lang('get', 'open').'" act="mention" no="'.$f['id'].'"';
            } else if ($f['type'] == 'newmsg') {
                $list[$i]->oa = gr_lang('get', 'view');
                $list[$i]->oat = 'class="loadgroup" ldt="user" no="'.$f['v3'].'"';
            }
            $list[$i]->ob = gr_lang('get', 'delete');
            $list[$i]->obt = 'act="delete"';
            $list[$i]->icon = '';
            $list[$i]->id = '';
            if ($f['seen'] == 0) {
                $list[$i]->count = 1;
                $list[$i]->id = 'class="active"';
            }
            $i = $i+1;
        }
        gr_alerts('seen', $id);
    } else if ($do["type"] === "users") {
        if (!gr_role('access', 'users', '4')) {
            exit;
        }
        $i = 0;
        $lists = db('Grupo', 'q', 'SELECT * FROM gr_users WHERE deleted = 0 and id_organization='.$id_organization);
       // $lists = db('Grupo', 's', 'users', 'id<>', 0, 'ORDER BY id DESC');
        foreach ($lists as $f) {
            if ($f['id'] !== $uid) {
                $list[$i] = new stdClass();
                $list[$i]->img = gr_img('users', $f['id']);
                //$list[$i]->name = gr_profile('get', $f['id'], 'name');
                $list[$i]->name = explode("@", $f['email'])[0];

                
                $list[$i]->count = 0;
                $role = db('Grupo', 's', 'permissions', 'id', $f['role']);
                if (isset($role[0])) {
                    $list[$i]->sub = $role[0]['name'];
                } else {
                    $list[$i]->sub = gr_lang('get', 'unknown');
                }
                $deac = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $f['id']);
                if (count($deac) > 0) {
                    $list[$i]->sub = gr_lang('get', 'deactivated');
                }
                $list[$i]->right = gr_lang('get', 'options');
                $list[$i]->rtag = 'type="profile" no="'.$f['id'].'"';

                $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
                $list[$i]->oa = gr_lang('get', 'view');
                $list[$i]->oat = 'class="vwp" no="'.$f['id'].'"';
                if (gr_role('access', 'users', '6')) {
                    $list[$i]->ob = gr_lang('get', 'login');
                    $list[$i]->obt = 'act="login"';
                }

                //if (gr_role('access', 'users', '3') || gr_role('access', 'users', '8')) {
                    if($master_role==3){
                        $list[$i]->oc = gr_lang('get', 'act');
                        $list[$i]->oct = 'class="formpop" role="'.$master_role.'"  uid="'.$f['id'].'" pn=2 title="'.gr_lang('get', 'take_action').'" do="profile" btn="'.gr_lang('get', 'confirm').'" act="act"';
                    }
                //}
                $osort = 1;
                if (gr_profile('get', $f['id'], 'status') == 'online') {
                    $osort = 3;
                } else if (gr_profile('get', $f['id'], 'status') == 'idle') {
                    $osort = 2;
                }
                // if($f['status']==1){
                //     $list[$i]->status = "enabled";
                //     $list[$i]->icon = "'status online'";
                // }else{
                //     $list[$i]->status = "disabled";
                //     $list[$i]->icon = "'status offline'";
                // }
               $list[$i]->icon = "'status ".gr_profile('get', $f['id'], 'status')."'";
                $list[$i]->id = 'class="user" data-sort="'.$osort.'"';
            }
            $i = $i+1;
        }
    } else if ($do["type"] === "languages") {
        if (!gr_role('access', 'languages', '4')) {
            exit;
        }
        $i = 0;
        $lists = db('Grupo', 's', 'phrases', 'type', 'lang');
        foreach ($lists as $f) {
            if ($f['id'] !== $uid) {
                $list[$i] = new stdClass();
                $list[$i]->img = gr_img('languages', $f['id']);
                $list[$i]->name = $f['short'];
                $list[$i]->count = 0;
                $list[$i]->sub = gr_lang('get', 'language');
                $list[$i]->right = gr_lang('get', 'options');
                $list[$i]->rtag = 'type="language" no="'.$f['id'].'"';
                $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
                if (gr_role('access', 'languages', '2')) {
                    $list[$i]->oa = gr_lang('get', 'edit');
                    $list[$i]->oat = 'class="formpop" title="'.gr_lang('get', 'edit_language').'" do="edit" btn="'.gr_lang('get', 'update').'" act="language" data-no="'.$f['id'].'"';
                }
                if (gr_role('access', 'languages', '3')) {
                    $list[$i]->oc = gr_lang('get', 'delete');
                    $list[$i]->oct = 'class="formpop" pn=2 title="'.gr_lang('get', 'confirm').'" data-name="'.$f['short'].'" data-no="'.$f['id'].'" do="language" btn="'.gr_lang('get', 'delete').'" act="delete"';
                }
                $list[$i]->icon = "";
                $list[$i]->id = 'class="language"';
            }
            $i = $i+1;
        }
    } else if ($do["type"] === "complaints") {
        $cu = gr_group('user', $do["gid"], $uid);
        if (!$cu[0] || $cu['role'] == 3 && !gr_role('access', 'groups', '7')) {
            exit;
        }
        $i = 0;
        $lists = db('Grupo', 's', 'complaints', 'uid,gid', $uid, $do["gid"], 'ORDER BY id DESC');
        if ($cu['role'] == 2 || $cu['role'] == 1) {
            $lists = db('Grupo', 's', 'complaints', 'gid,msid<>', $do["gid"], 0, 'ORDER BY status ASC');
        }
        if (gr_role('access', 'groups', '7')) {
            $lists = db('Grupo', 's', 'complaints', 'gid', $do["gid"], 'ORDER BY status ASC');
        }
        foreach ($lists as $f) {
            if ($f['id'] !== $uid) {
                $list[$i] = new stdClass();
                $list[$i]->img = gr_img('users', $f['uid']);
                $list[$i]->name = "COMP#".$f['id'];
                $list[$i]->count = $list[$i]->countag = 0;
                $list[$i]->sub = gr_lang('get', 'under_investigation');
                $list[$i]->count = 1;
                if ($f['status'] == 2) {
                    $list[$i]->sub = gr_lang('get', 'action_taken');
                    $list[$i]->count = 0;
                } else if ($f['status'] == 3) {
                    $list[$i]->sub = gr_lang('get', 'rejected');
                    $list[$i]->count = 0;
                }
                $list[$i]->right = gr_lang('get', 'options');
                $list[$i]->rtag = 'type="group" no="'.$f['gid'].'"';
                $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;

                $list[$i]->ob = gr_lang('get', 'view');
                $list[$i]->obt = 'class="formpop" title="'.gr_lang('get', 'view_complaint').'" do="group" btn="'.gr_lang('get', 'update').'" act="takeaction" data-no="'.$f['id'].'"';
                if (!empty($f['msid'])) {
                    $list[$i]->oa = gr_lang('get', 'proof');
                    $list[$i]->oat = 'class="turnchat goback" data-block="crew" act="msgs" data-msid="'.$f['msid'].'"';
                }
                $list[$i]->icon = "";
                $list[$i]->id = '';
            }
            $i = $i+1;
        }
    } else if ($do["type"] === "rusers") {
        if (!gr_role('access', 'roles', '3')) {
            exit;
        }
        $i = 0;
        $lists = db('Grupo', 's', 'users', 'role', $do["hid"]);
        foreach ($lists as $f) {
            $list[$i] = new stdClass();
            $list[$i]->img = gr_img('users', $f['id']);
            $list[$i]->name = gr_profile('get', $f['id'], 'name');
            $list[$i]->count = 0;
            $list[$i]->sub = $f['email'];
            $list[$i]->right = gr_lang('get', 'options');
            $list[$i]->rtag = 'type="profile" no="'.$f['id'].'"';
            $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
            $list[$i]->oa = gr_lang('get', 'view');
            $list[$i]->oat = 'class="vwp" no="'.$f['id'].'"';
            if (gr_role('access', 'users', '6')) {
                $list[$i]->ob = gr_lang('get', 'login');
                $list[$i]->obt = 'act="login"';
            }
            if (gr_role('access', 'users', '3') || gr_role('access', 'users', '8')) {
                $list[$i]->oc = gr_lang('get', 'act');
                $list[$i]->oct = 'class="formpop" pn=2 title="'.gr_lang('get', 'take_action').'" do="profile" btn="'.gr_lang('get', 'confirm').'" act="act"';
            }
            $list[$i]->icon = "'status ".gr_profile('get', $f['id'], 'status')."'";
            $list[$i]->id = 'class="user"';
            $i = $i+1;
        }
    } else if ($do["type"] === "online") {
        if (!gr_role('access', 'users', '5')) {
            exit;
        }
        $i = 0;
        // online
     //   $lists = db('Grupo', 's', 'options', 'type,v1,v2|,v2', 'profile', 'status', 'online', 'idle');
        $lists = db('Grupo', 'q', 'SELECT opt.id,opt.type,opt.v1,opt.v2,opt.v3,opt.v4,opt.v5,opt.tms,usr.id_organization FROM gr_options as opt INNER JOIN gr_users as usr on opt.v3 = usr.id WHERE opt.type="profile" AND opt.v1="status" AND opt.v2="online" and usr.id_organization="'.$id_organization.'" ');
        foreach ($lists as $f) {
         //   if ($f['v3'] !== $uid) {
                $list[$i] = new stdClass();
                $list[$i]->img = gr_img('users', $f['v3']);
                $list[$i]->name = gr_profile('get', $f['v3'], 'name');
                $list[$i]->count = 0;
                $list[$i]->sub = '';
                $usrn = usr('Grupo', 'select', $f['v3']);
                $list[$i]->user = '';
                if (isset($usrn['name'])) {
                    $list[$i]->sub = '@'.$usrn['name'];
                }
                $list[$i]->right = gr_lang('get', 'options');
                $list[$i]->rtag = 'type="profile" no="'.$f['v3'].'"';
                $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
                $list[$i]->oa = gr_lang('get', 'view');
                $list[$i]->oat = 'class="vwp" no="'.$f['v3'].'"';
                if (gr_role('access', 'users', '6')) {
                    $list[$i]->ob = gr_lang('get', 'login');
                    $list[$i]->obt = 'act="login"';
                }
                if (gr_role('access', 'users', '3') || gr_role('access', 'users', '8')) {
                    $list[$i]->oc = gr_lang('get', 'act');
                    $list[$i]->oct = 'class="formpop" pn=2 title="'.gr_lang('get', 'take_action').'" do="profile" btn="'.gr_lang('get', 'confirm').'" act="act"';
                }
                $list[$i]->icon = "'status ".$f['v2']."'";
                $list[$i]->id = 'data-sort="'.strtotime($f['tms']).'"';
        //    }
            $i = $i+1;
        }
    } else if ($do["type"] === "roles") {
        if (!gr_role('access', 'roles', '3')) {
            exit;
        }
        $i = 0;
        $lists = db('Grupo', 's', 'permissions');
        foreach ($lists as $f) {

            $list[$i] = new stdClass();
            $list[$i]->img = gr_img('roles', $f['id']);
            $list[$i]->name = $f['name'];
            $list[$i]->count = 0;
            $list[$i]->sub = db('Grupo', 's,count(*)', 'users', 'role', $f['id'])[0][0].' '.gr_lang('get', 'users');
            $list[$i]->right = gr_lang('get', 'options');;
            $list[$i]->rtag = 'type="role" no="'.$f['id'].'"';
            $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
            if (gr_role('access', 'roles', '3')) {
                $list[$i]->oa = gr_lang('get', 'view');
                $list[$i]->oat = 'class="mbopen" data-block="rside" act="view"';
            }
            if (gr_role('access', 'roles', '2')) {
                $list[$i]->ob = gr_lang('get', 'edit');
                $list[$i]->obt = 'class="formpop" title="'.gr_lang('get', 'edit_role').'" do="edit" btn="'.gr_lang('get', 'update').'" act="role" data-name="'.$f['name'].'" data-no="'.$f['id'].'"';
            }
            if (gr_role('access', 'roles', '2')) {
                $list[$i]->oc = gr_lang('get', 'delete');
                $list[$i]->oct = 'class="formpop" data-name="'.$f['name'].'" data-no="'.$f['id'].'" title="'.gr_lang('get', 'confirm').'" do="role" btn="'.gr_lang('get', 'delete').'" act="delete"';
            }
            $list[$i]->icon = '';
            $list[$i]->id = '';
            $i = $i+1;
        }
    } else if ($do["type"] === "files") {
        if (!gr_role('access', 'files', '5')) {
            exit;
        }

        $stms = db('Grupo', 'q', 'SELECT * FROM gr_msgs where uid = "'.$uid.'" and filename <>"" ');
        $i = 0;
        $dir = 'grupo/files/'.$uid.'/';
        $list = flr('list', $dir);
        $list = [];
        foreach ($stms as $f) {
            $list[$i] = new stdClass();
            $list[$i]->img = "gem/ore/grupo/ext/default.png";
            $im = "gem/ore/grupo/ext/".pathinfo($f['filename'], PATHINFO_EXTENSION).".png";
        //    $im = "gem/ore/grupo/ext/".pathinfo($f, PATHINFO_EXTENSION).".png";
        //    $n = basename($f);
            $n = basename($f['filename']);
            if (file_exists($im)) {
                $list[$i]->img = $im;
            }
            $list[$i]->name = explode('-gr-', $n, 2)[1];
            $list[$i]->sub = flr('size', $dir.$n);
            $list[$i]->count = '0';
            //$list[$i]->right = "";
            $list[$i]->right = gr_lang('get', 'options');
            $list[$i]->rtag = 'type="files" no="'.$n.'"';
            $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
            $list[$i]->filename = $dir.''.$n;
            $list[$i]->typefile = $f['typefile'];

            $list[$i]->oa = "view";
            $list[$i]->oat = 'class="mbopen" data-block="panel" act="view"';
            // if (gr_role('access', 'files', '4')) {
            //     $list[$i]->oa = gr_lang('get', 'share');
            //     $list[$i]->oat = 'class="mbopen" data-block="panel" act="share"';
            // }
            // if (gr_role('access', 'files', '2')) {
            //     $list[$i]->ob = gr_lang('get', 'zip');
            //     $list[$i]->obt = 'act="zip"';
            // }
            // if (gr_role('access', 'files', '3')) {
            //     $list[$i]->oc = gr_lang('get', 'delete');
            //     $list[$i]->oct = 'class="formpop" pn=2 title="'.gr_lang('get', 'confirm').'" do="files"  btn="'.gr_lang('get', 'delete').'" act="delete"';
            // }
            $list[$i]->icon = "";
            $list[$i]->id = 'class="file"';
            $i = $i+1;
        }
      //  echo $list;
    } else if ($do["type"] === "ufields") {
        if (gr_role('access', 'fields', '4')) {
            $i = 0;
            $lists = db('Grupo', 's', 'profiles', 'type', 'field');
            foreach ($lists as $f) {

                $list[$i] = new stdClass();
                $list[$i]->img = gr_img('fields', $f['cat']);
                $list[$i]->name = gr_lang('get', $f['name']);
                $list[$i]->count = 0;
                $list[$i]->sub = gr_lang('get', $f['cat']);
                $list[$i]->right = gr_lang('get', 'options');;
                $list[$i]->rtag = 'type="role" no="'.$f['id'].'"';
                $list[$i]->oa = $list[$i]->ob = $list[$i]->oc = 0;
                if (gr_role('access', 'fields', '2')) {
                    $list[$i]->ob = gr_lang('get', 'edit');
                    $list[$i]->obt = 'class="formpop" title="'.gr_lang('get', 'edit_custom_field').'" do="edit" btn="'.gr_lang('get', 'update').'" act="customfield" data-name="'.$f['name'].'" data-no="'.$f['id'].'"';
                }
                if (gr_role('access', 'fields', '3')) {
                    $list[$i]->oc = gr_lang('get', 'delete');
                    $list[$i]->oct = 'class="formpop" data-name="'.$f['name'].'" data-no="'.$f['id'].'" title="'.gr_lang('get', 'confirm').'" do="customfield" btn="'.gr_lang('get', 'delete').'" act="delete"';
                }
                $list[$i]->icon = '';
                $list[$i]->id = '';
                $i = $i+1;
            }
        }
    } else if ($do["type"] === "getuserinfo") {
        $i = 0;
        $lists = db('Grupo', 's', 'phrases', 'type', 'lang');
        $list[$i] = new stdClass();
        $list[$i]->id = $do['id'];
        $list[$i]->img = gr_img('users', $do['id']);
        $list[$i]->edit = 0;
        $list[$i]->btn = gr_lang('get', 'message');
        if (gr_role('access', 'users', '2') && $do['id'] != $uid) {
            $list[$i]->edit = 1;
        }
        $list[$i]->msgoff = 0;
        if (!gr_role('access', 'privatemsg', '1')) {
            $list[$i]->msgoff = 1;
            $list[$i]->msgoffmsg = gr_lang('get', 'denied');
        }
        if ($do['id'] == $uid) {
            $list[$i]->edit = 2;
            $list[$i]->btn = gr_lang('get', 'edit_profile');
        }
        $list[$i]->name = gr_profile('get', $do['id'], 'name');
        $usrn = usr('Grupo', 'select', $do['id']);
        // $list[$i]->uname = '@'.$usrn['name'];
        $list[$i]->uname = '@'.$usrn['username'];
        if($usrn['username'] === ""){
            $list[$i]->uname = "Never logged.";
        }
       

        $list[$i]->nameuser = $usrn['name'];
        $shr = db('Grupo', 's,count(*)', 'msgs', 'type,uid', 'file', $do['id'])[0][0];
        $list[$i]->shares = gr_shnum($shr);
        $list[$i]->loves = gr_shnum(db('Grupo', 's,count(*)', 'options', 'type,v3', 'loves', $do['id'])[0][0]);
        $lastlg = db('Grupo', 's', 'utrack', 'uid', $do['id'], 'ORDER BY id DESC LIMIT 1');
        if (count($lastlg) > 0) {
            $tms = new DateTime($lastlg[0]['tms']);
        } else {
            $tms = new DateTime(usr('Grupo', 'select', $do['id'])['altered']);
        }
        $tmz = new DateTimeZone(gr_profile('get', $uid, 'tmz'));
        $tms->setTimezone($tmz);
        $tmst = strtotime($tms->format('Y-m-d H:i:s'));
        $list[$i]->lastlg = $tms->format('d-m-y');
        $lists = db('Grupo', 's', 'profiles', 'type', 'field');
        foreach ($lists as $f) {
            $pf = $f['name'];
            $ct = db('Grupo', 's', 'profiles', 'type,name,uid', 'profile', $f['id'], $do['id']);
            if (count($ct) > 0) {
                $vpf = html_entity_decode($ct[0]['v1']);
                $list[$pf] = new stdClass();
                $list[$pf]-> name = gr_lang('get', $f['name']);
                $list[$pf]-> cont = $vpf;
                if ($f['cat'] == 'datefield') {
                    $list[$pf]-> cont = date("d-M-Y", strtotime($list[$pf]-> cont));
                }
            }
        }

    } else if ($do["type"] === "memsearch") {
        $i = 0;
        $do['ser'] = vc($do['ser'], 'alphanum', 1);
        $lists = db('Grupo', 's', 'users', 'name LIKE', $do['ser'].'%');
        foreach ($lists as $key => $f) {
            $dect = db('Grupo', 's', 'options', 'type,v1,v3', 'deaccount', 'yes', $f['id']);
            if ($dect && count($dect) > 0) {
                unset($lists[$key]);
            }
        }
        foreach ($lists as $f) {
            if ($f['id'] !== $uid) {
                $cu = gr_group('user', $do["gid"], $f['id']);
                if ($cu[0]) {
                    $list[$i] = new stdClass();
                    $list[$i]->img = gr_img('users', $f['id']);
                    $list[$i]->name = gr_profile('get', $f['id'], 'name');
                    $list[$i]->uname = $f['name'];
                }
            }
            $i = $i+1;
        }
    }
    $r = json_encode($list);
    gr_prnt($r);
}
?>