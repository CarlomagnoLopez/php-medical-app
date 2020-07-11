<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_form($do) {
    $uid = usr('Grupo')['id'];
    $fields = new stdClass();
    if ($do["type"] == "creategroup") {
        if (!gr_role('access', 'groups', '1')) {
            exit;
        }
        $fields->name = array(gr_lang('get', 'group_name'), 'input', 'text');
        $fields->password = array(gr_lang('get', 'password'), 'input', 'text');
        $fields->img = array(gr_lang('get', 'icon'), 'input', 'file');

    } else if ($do["type"] == "createlanguage") {
        if (gr_role('access', 'languages', '1')) {
            $fields->name = array(gr_lang('get', 'language'), 'input', 'text');
            $fields->img = array(gr_lang('get', 'icon'), 'input', 'file');
        }

    } else if ($do["type"] == "createcustomfield") {
        if (gr_role('access', 'fields', '1')) {
            $fields->name = array(gr_lang('get', 'fieldname'), 'input', 'text');
            $fls = gr_lang('get', 'shorttext').','.gr_lang('get', 'longtext').','.gr_lang('get', 'datefield').','.gr_lang('get', 'numfield');
            $fields->ftype = array(gr_lang('get', 'fieldtype'), 'radio', $fls, 'shorttext,longtext,datefield,numfield');
        }
    } else if ($do["type"] == "groupreportmsg") {
        $cu = gr_group('user', $do["id"], $uid);
        if ($cu[0] || $cu['role'] != 3) {
            if (!isset($do["msid"]) || empty($do["msid"])) {
                $do["msid"] = 0;
            }
            $reasons = gr_lang('get', 'spam').','.gr_lang('get', 'abuse').','.gr_lang('get', 'inappropriate').','.gr_lang('get', 'other');
            $fields->reason = array(gr_lang('get', 'reason'), 'radio', $reasons, 'spam,abuse,inappropriate,other');
            $fields->comment = array(gr_lang('get', 'comments'), 'textarea', 'text');
            $fields->id = array('hidden', 'input', 'hidden', $do["id"]);
            $fields->msid = array('hidden', 'input', 'hidden', $do["msid"]);
        }
    } else if ($do["type"] == "grouptakeaction") {
        $cm = db('Grupo', 's', 'complaints', 'id', $do["no"]);
        if (count($cm) != 0) {
            $cu = gr_group('user', $cm[0]['gid'], $uid);
            if (!$cu[0] || $cu['role'] == 3 || $cm[0]['msid'] == 0 && !gr_role('access', 'groups', '7')) {
                exit;
            }
            $fields->name = array(gr_lang('get', 'full_name'), 'input', 'disabled', '"'.gr_profile('get', $cm[0]['uid'], 'name').'"');
            if ($cm[0]['msid'] == 0) {
                $fields->type = array(gr_lang('get', 'category'), 'input', 'disabled', gr_lang('get', 'group'));
            } else {
                $fields->type = array(gr_lang('get', 'category'), 'input', 'disabled', gr_lang('get', 'message'));
            }
            $fields->reason = array(gr_lang('get', 'reason'), 'input', 'disabled', '"'.gr_lang('get', $cm[0]['type']).'"');
            $tms = new DateTime($cm[0]['tms']);
            $tmz = new DateTimeZone(gr_profile('get', $uid, 'tmz'));
            $tms->setTimezone($tmz);
            $tmst = strtotime($tms->format('Y-m-d H:i:s'));
            $fields->tms = array(gr_lang('get', 'timestamp'), 'input', 'disabled', '"'.$tms->format('d-M-y h:i A').'"');
            $fields->comment = array(gr_lang('get', 'comments'), 'span', 'text', $cm[0]['comment']);
            if ($cu['role'] == 2 || $cu['role'] == 1 || gr_role('access', 'groups', '7')) {
                $fields->status = array('Status', 'select', '0', '-----', '2', gr_lang('get', 'action_taken'), '3', gr_lang('get', 'rejected'), '1', gr_lang('get', 'under_investigation'));
            }
            $fields->id = array('hidden', 'input', 'hidden', $do["no"]);
        }
    } else if ($do["type"] == "createrole") {
        if (!gr_role('access', 'roles', '1')) {
            exit;
        }
        $fields->name = array(gr_lang('get', 'role_name'), 'input', 'text');
        $fields->img = array(gr_lang('get', 'icon'), 'input', 'file');

        $rl[1] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'delete').','.gr_lang('get', 'join');
        $rl[1] = $rl[1].','.gr_lang('get', 'invite').','.gr_lang('get', 'view_all').','.gr_lang('get', 'export_chat').','.gr_lang('get', 'view_likes').','.gr_lang('get', 'like_msgs').','.gr_lang('get', 'admin_controls');
        $fields->group = array(gr_lang('get', 'group'), 'checkbox', $rl[1], '1,2,3,4,5,6,8,9,10,7');

        $rl[2] = gr_lang('get', 'upload').','.gr_lang('get', 'download').','.gr_lang('get', 'delete');
        $rl[2] = $rl[2].','.gr_lang('get', 'attach').','.gr_lang('get', 'view');
        $fields->files = array(gr_lang('get', 'files'), 'checkbox', $rl[2], '1,2,3,4,5');

        $rl[3] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'delete').','.gr_lang('get', 'view');
        $rl[3] = $rl[3].','.gr_lang('get', 'deactivate_account');
        $rl[3] = $rl[3].','.gr_lang('get', 'online').','.gr_lang('get', 'login_as_user').','.gr_lang('get', 'ban_user');
        $fields->users = array(gr_lang('get', 'users'), 'checkbox', $rl[3], '1,2,3,4,7,5,6,8');

        $rl[4] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'delete').','.gr_lang('get', 'view');
        $fields->languages = array(gr_lang('get', 'languages'), 'checkbox', $rl[4], '1,2,3,4');

        $rl[5] = gr_lang('get', 'settings').','.gr_lang('get', 'appearance');
        $rl[5] = $rl[5].','.gr_lang('get', 'banip').','.gr_lang('get', 'filterwords');
        $rl[5] = $rl[5].','.gr_lang('get', 'header_footer');
        $fields->sys = array(gr_lang('get', 'system_variables'), 'checkbox', $rl[5], '1,2,3,4,5');

        $rl[6] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'view');
        $fields->roles = array(gr_lang('get', 'roles'), 'checkbox', $rl[6], '1,2,3');

        $rl[7] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'delete').','.gr_lang('get', 'view');
        $fields->fields = array(gr_lang('get', 'fields'), 'checkbox', $rl[7], '1,2,3,4');

        $rl[8] = gr_lang('get', 'converse').','.gr_lang('get', 'view').','.gr_lang('get', 'export_chat');
        $fields->privatemsg = array(gr_lang('get', 'privatemsg'), 'checkbox', $rl[8], '1,2,3');


    } else if ($do["type"] == "editrole") {
        if (!gr_role('access', 'roles', '2')) {
            exit;
        }
        $cr = db('Grupo', 's', 'permissions', 'id', $do["no"], 'ORDER BY id DESC');
        if ($cr && count($cr) > 0) {
            $fields->name = array(gr_lang('get', 'role_name'), 'input', 'text', $do["name"]);
            $fields->img = array(gr_lang('get', 'icon'), 'input', 'file');
            $fields->rid = array('Role id', 'input', 'hidden', $do["no"]);

            $rl[1] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'delete').','.gr_lang('get', 'join');
            $rl[1] = $rl[1].','.gr_lang('get', 'invite').','.gr_lang('get', 'view_all').','.gr_lang('get', 'export_chat').','.gr_lang('get', 'view_likes').','.gr_lang('get', 'like_msgs').','.gr_lang('get', 'admin_controls');
            $fields->group = array(gr_lang('get', 'group'), 'checkbox', $rl[1], '1,2,3,4,5,6,8,9,10,7', $cr[0]['groups']);

            $rl[2] = gr_lang('get', 'upload').','.gr_lang('get', 'download').','.gr_lang('get', 'delete');
            $rl[2] = $rl[2].','.gr_lang('get', 'attach').','.gr_lang('get', 'view');
            $fields->files = array(gr_lang('get', 'files'), 'checkbox', $rl[2], '1,2,3,4,5', $cr[0]['files']);

            $rl[3] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'delete').','.gr_lang('get', 'view');
            $rl[3] = $rl[3].','.gr_lang('get', 'deactivate_account');
            $rl[3] = $rl[3].','.gr_lang('get', 'online').','.gr_lang('get', 'login_as_user').','.gr_lang('get', 'ban_user');
            $fields->users = array(gr_lang('get', 'users'), 'checkbox', $rl[3], '1,2,3,4,7,5,6,8', $cr[0]['users']);

            $rl[4] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'delete').','.gr_lang('get', 'view');
            $fields->languages = array(gr_lang('get', 'languages'), 'checkbox', $rl[4], '1,2,3,4', $cr[0]['languages']);

            $rl[5] = gr_lang('get', 'settings').','.gr_lang('get', 'appearance');
            $rl[5] = $rl[5].','.gr_lang('get', 'banip').','.gr_lang('get', 'filterwords');
            $rl[5] = $rl[5].','.gr_lang('get', 'header_footer');
            $fields->sys = array(gr_lang('get', 'system_variables'), 'checkbox', $rl[5], '1,2,3,4,5', $cr[0]['sys']);

            $rl[6] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'view');
            $fields->roles = array(gr_lang('get', 'roles'), 'checkbox', $rl[6], '1,2,3', $cr[0]['roles']);

            $rl[7] = gr_lang('get', 'create').','.gr_lang('get', 'edit').','.gr_lang('get', 'delete').','.gr_lang('get', 'view');
            $fields->fields = array(gr_lang('get', 'fields'), 'checkbox', $rl[7], '1,2,3,4', $cr[0]['fields']);

            $rl[8] = gr_lang('get', 'converse').','.gr_lang('get', 'view').','.gr_lang('get', 'export_chat');
            $fields->privatemsg = array(gr_lang('get', 'privatemsg'), 'checkbox', $rl[8], '1,2,3', $cr[0]['privatemsg']);
        }

    } else if ($do["type"] == "customfielddelete") {
        if (gr_role('access', 'fields', '3')) {
            $fields->name = array(gr_lang('get', 'confirm_delete'), 'input', 'disabled', '"'.gr_lang('get', $do['name'], 1).'"');
            $fields->id = array('hidden', 'input', 'hidden', $do["no"]);
        }
    } else if ($do["type"] == "roledelete") {
        if (!gr_role('access', 'roles', '3')) {
            exit;
        }
        $fields->name = array(gr_lang('get', 'confirm_delete'), 'input', 'disabled', '"'.$do['name'].'"');
        $fields->id = array('hidden', 'input', 'hidden', $do["no"]);
    } else if ($do["type"] == "languagedelete") {
        if (!gr_role('access', 'languages', '3')) {
            exit;
        }
        $fields->name = array(gr_lang('get', 'confirm_delete'), 'input', 'disabled', '"'.$do['name'].'"');
        $fields->id = array('hidden', 'input', 'hidden', $do["no"]);
    } else if ($do["type"] == "createuser") {
        if (!gr_role('access', 'users', '1')) {
            exit;
        }
        $fields->fname = array(gr_lang('get', 'full_name'), 'input', 'text');
        $fields->email = array(gr_lang('get', 'email_address'), 'input', 'text');
        $fields->name = array(gr_lang('get', 'username'), 'input', 'text');
        $fields->pass = array(gr_lang('get', 'password'), 'input', 'text', '"'.rn('7').'"');
        $fields->sent = array(gr_lang('get', 'mail_login_info'), 'select', '0', '-----', '1', gr_lang('get', 'yes'), '0', gr_lang('get', 'no'));

    } else if ($do["type"] == "profileact") {
        $stms = db('Grupo', 'q', 'SELECT * FROM gr_users WHERE id='.$do['id']);
        $dataUsr = $stms[0];
        $status = $dataUsr['status'];
        if (gr_role('access', 'users', '3')) {
            $fields->opted = array(gr_lang('get', 'select_option'), 'select', '0', '-----', 'delete', gr_lang('get', 'delete'), ($status=="0")?'Enable':'Disable', ($status==0)?'Enable':'Disable' );
        }
        if (gr_role('access', 'users', '8')) {
            $fields->opted = array(gr_lang('get', 'select_option'), 'select', '0', '-----', 'ban', gr_lang('get', 'ban'), ($status=="0")?'Enable':'Disable', ($status==0)?'Enable':'Disable');
        }
        if (gr_role('access', 'users', '8') && gr_role('access', 'users', '3')) {
            $fields->opted = array(gr_lang('get', 'select_option'), 'select', '0', '-----', 'delete', gr_lang('get', 'delete'), ($status=="0")?'Enable':'Disable', ($status==0)?'Enable':'Disable' , 'ban', gr_lang('get', 'ban'));
        }
       

        $fields->id = array('hidden', 'input', 'hidden', '"'.$do["id"].'"');

        
    } else if ($do["type"] == "editlanguage") {
        if (!gr_role('access', 'languages', '2')) {
            exit;
        }
        $r = db('Grupo', 's', 'phrases', 'type,id', 'lang', $do['no']);
        if (isset($r[0])) {
            $fields->name = array(gr_lang('get', 'language'), 'input', 'text', '"'.$r[0]['short'].'"');
            $fields->img = array(gr_lang('get', 'icon'), 'input', 'file');
            $fields->id = array('hidden', 'input', 'hidden', '"'.$do["no"].'"');
            $ph = db('Grupo', 's', 'phrases', 'type,lid', 'phrase', $do['no']);
            foreach ($ph as $p) {
                $key = 'z'.$p['id'];
                if ($p['short'] == 'terms') {
                    $fields->$key = array(ucwords($p['short']), 'textarea', 'text', $p['full']);
                } else {
                    $fields->$key = array(ucwords($p['short']), 'input', 'text', '"'.$p['full'].'"');
                }
            }
        }

    } else if ($do["type"] == "editavatar") {
        $avatars = array();
        $directory = cnf()['gem'].'/ore/grupo/avatars';
        $images = glob($directory . "/*.png");

        foreach ($images as $image) {
            $key = basename($image);
            $avatars[$key] = '"'.$image.'"';
        }
        $fields->avatar = array(gr_lang('get', 'choose_avatar'), 'imglist', $avatars);
        $fields->cavatar = array(gr_lang('get', 'custom_avatar'), 'input', 'file');

    } else if ($do["type"] == "editcustomfield") {
        if (gr_role('access', 'fields', '2')) {
            $cr = db('Grupo', 's', 'profiles', 'type,id', 'field', $do["no"]);
            if ($cr && count($cr) > 0) {
                $fields->name = array(gr_lang('get', 'fieldname'), 'input', 'text', '"'.gr_lang('get', $cr['0']['name'], 1).'"');
                $fls = gr_lang('get', 'shorttext').','.gr_lang('get', 'longtext').','.gr_lang('get', 'datefield').','.gr_lang('get', 'numfield');
                $fields->ftype = array(gr_lang('get', 'fieldtype'), 'radio', $fls, 'shorttext,longtext,datefield,numfield');
                $fields->id = array('hidden', 'input', 'hidden', $do["no"]);
            }
        }
    } else if ($do["type"] == "editgroup") {
        $role = gr_group('user', $do["id"], $uid)['role'];
        $adm = 0;
        if ($role == 2 || $role == 1) {
            $adm = 1;
        }
        if (gr_role('access', 'groups', '2') && $adm == 1 || gr_role('access', 'groups', '7')) {
            $cr = db('Grupo', 's', 'options', 'type,id', 'group', $do["id"]);
            if ($cr && count($cr) > 0) {
                $fields->name = array(gr_lang('get', 'group_name'), 'input', 'text', '"'.$cr['0']['v1'].'"');
                $fields->password = array(gr_lang('get', 'password'), 'input', 'text');
                $fields->img = array(gr_lang('get', 'icon'), 'input', 'file');
                $fields->id = array('hidden', 'input', 'hidden', $cr['0']['id']);
                if (!empty($cr['0']['v2'])) {
                    $fields->delpass = array(gr_lang('get', 'remove_password'), 'select', '0', '-----', '1', gr_lang('get', 'yes'), '0', gr_lang('get', 'no'));
                }
            }
        }
    } else if ($do["type"] == "groupjoin") {
        if (!gr_role('access', 'groups', '4') && !gr_role('access', 'groups', '7')) {
            exit;
        }
        $cr = db('Grupo', 's', 'options', 'type,id', 'group', $do["id"]);
        if ($cr && count($cr) > 0) {
            $cu = gr_group('user', $do["id"], $uid)[0];
            if (!$cu) {
                $fields->name = array(gr_lang('get', 'confirm_join'), 'input', 'disabled', '"'.$cr['0']['v1'].'"');
                $inv = db('Grupo', 's,count(*)', 'alerts', 'type,uid,v1', 'invitation', $uid, $do["id"])[0][0];
                if (!empty($cr['0']['v2']) && !gr_role('access', 'groups', '7') && $inv == 0) {
                    $fields->password = array(gr_lang('get', 'password'), 'input', 'text');
                }
                $fields->id = array('hidden', 'input', 'hidden', $cr['0']['id']);
            } else {
                pr(0);
            }
        }

    } else if ($do["type"] == "groupleave") {
        $cr = gr_group('valid', $do["id"]);
        if ($cr[0]) {
            $cu = gr_group('user', $do["id"], $uid)[0];
            if ($cu) {
                $fields->name = array(gr_lang('get', 'confirm_leave'), 'input', 'disabled', '"'.$cr['name'].'"');
                $fields->id = array('hidden', 'input', 'hidden', '"'.$do["id"].'"');
            }
        }

    } else if ($do["type"] == "groupmention") {
        $gr = db('Grupo', 's', 'alerts', 'type|,type,id,uid', 'mentioned', 'replied', $do["id"], $uid)[0];
        $cu = gr_group('user', $gr['v1'], $uid)[0];
        if ($cu) {
            $cr = gr_group('valid', $gr['v1']);
            $fields->group = array(gr_lang('get', 'group_name'), 'input', 'disabled', '"'.$cr['name'].'"');
            $fields->user = array(gr_lang('get', 'full_name'), 'input', 'disabled', '"'.gr_profile('get', $gr['v3'], 'name').'"');
            $msg = db('Grupo', 's', 'msgs', 'id', $gr['v2'])[0];
            $fields->msg = array(gr_lang('get', 'message'), 'textarea', 'disabled', $msg['msg']);
            $fields->id = array('hidden', 'input', 'hidden', '"'.$gr['v1'].'"');
        }

    } else if ($do["type"] == "grouprole") {
        $role = gr_group('user', $do["id"], $uid)['role'];
        if (!gr_role('access', 'groups', '7') && $role != 2) {
            exit;
        }
        $cr = gr_group('valid', $do["id"]);
        if ($cr[0]) {
            $fields->group = array(gr_lang('get', 'group_name'), 'input', 'disabled', '"'.$cr['name'].'"');
            $fields->pname = array(gr_lang('get', 'full_name'), 'input', 'disabled', '"'.$do["pname"].'"');
            $fields->usid = array('hidden', 'input', 'hidden', '"'.$do["usr"].'"');
            $fields->id = array('hidden', 'input', 'hidden', '"'.$do["id"].'"');
            $fields->role = array(gr_lang('get', 'role'), 'select', '0', '-----', '2', gr_lang('get', 'admin'), '1', gr_lang('get', 'moderator'), '0', gr_lang('get', 'member'));
            $fields->remuser = array(gr_lang('get', 'remove_user'), 'select', '0', '-----', 'yes', gr_lang('get', 'yes'), 'no', gr_lang('get', 'no'));

        }

    } else if ($do["type"] == "filesdelete") {
        if (!gr_role('access', 'files', '3')) {
            exit;
        }
        $fields->name = array(gr_lang('get', 'confirm_delete'), 'input', 'disabled', '"'.explode('-gr-', $do["id"], 2)[1].'"');
        $fields->id = array('hidden', 'input', 'hidden', '"'.$do["id"].'"');

    } else if ($do["type"] == "groupexport") {
        if (gr_role('access', 'groups', '8') || gr_role('access', 'groups', '7') || gr_role('access', 'privatemsg', '3')) {
            $cr = gr_group('valid', $do["id"], $do["ldt"]);
            if ($cr[0]) {
                $cu = gr_group('user', $do["id"], $uid, $do["ldt"])[0];
                if ($cu) {
                    $fields->name = array(gr_lang('get', 'confirm_export'), 'input', 'disabled', '"'.$cr['name'].'"');
                    $fields->id = array('hidden', 'input', 'hidden', '"'.$do["id"].'"');
                    $fields->ldt = array('hidden', 'input', 'hidden', '"'.$do["ldt"].'"');
                }
            }
        }
    } else if ($do["type"] == "groupdelete") {
        $role = gr_group('user', $do["id"], $uid)['role'];
        if (gr_role('access', 'groups', '3') && $role == 2 || gr_role('access', 'groups', '7')) {
            $cr = gr_group('valid', $do["id"]);
            if ($cr[0]) {
                $fields->name = array(gr_lang('get', 'confirm_delete'), 'input', 'disabled', '"'.$cr['name'].'"');
                $fields->id = array('hidden', 'input', 'hidden', $do["id"]);
            }
        }

    } else if ($do["type"] == "groupinvite") {
        if (gr_role('access', 'groups', '5') || gr_role('access', 'groups', '7')) {
            $cr = gr_group('valid', $do["id"]);
            if ($cr[0]) {
                $fields->users = array(gr_lang('get', 'email_username'), 'input', 'text', '', '"'.gr_lang('get', 'separate_commas').'"');
                $fields->id = array('hidden', 'input', 'hidden', $do["id"]);
            }
        }

    } else if ($do["type"] == "profileblock") {
        $vusr = db('Grupo', 's,count(*)', 'users', 'id', $do["id"])[0][0];
        if ($vusr > 0) {
            if (gr_profile('blocked', $do["id"])) {
                $fields->name = array(gr_lang('get', 'confirm_unblock'), 'input', 'disabled', '"'.gr_profile('get', $do["id"], 'name').'"');
            } else {
                $fields->name = array(gr_lang('get', 'confirm_block'), 'input', 'disabled', '"'.gr_profile('get', $do["id"], 'name').'"');
            }
            $fields->id = array('hidden', 'input', 'hidden', $do["id"]);
        }

    } else if ($do["type"] == "editprofile") {
        if (isset($do['no']) && gr_role('access', 'users', '2')) {
            $uid = $do['no'];
            if (isset($do['xtid']) && !empty($do['xtid'])) {
                $uid = $do['xtid'];
            }
        }
        $usr = usr('Grupo', 'select', $uid);
        $fields->name = array(gr_lang('get', 'full_name'), 'input', 'text', '"'.gr_profile('get', $uid, 'name').'"');
        $fields->user = array(gr_lang('get', 'username'), 'input', 'text', '"'.$usr['name'].'"');
        $fields->email = array(gr_lang('get', 'email_address'), 'input', 'text', '"'.$usr['email'].'"');
        $fields->password = array(gr_lang('get', 'password'), 'input', 'password');
        if (isset($do['no']) && gr_role('access', 'users', '2')) {
            $role = db('Grupo', 's', 'permissions');
            $roles = array();
            foreach ($role as $r) {
                $roles[$r['id']] = $r['name'];
            }
            $fields->role = array(gr_lang('get', 'role'), 'select', $roles, $usr['role']);
        }
        $fields->tmz = array(gr_lang('get', 'timezone'), 'tmz', gr_tmz(), gr_profile('get', $uid, 'tmz'));
        $fields->cbg = array(gr_lang('get', 'custom_bg'), 'input', 'file');
        $fields->id = array('hidden', 'input', 'hidden', '"'.$uid.'"');
        $lists = db('Grupo', 's', 'profiles', 'type', 'field');
        foreach ($lists as $f) {
            $pf = $f['name'];
            $vpf = null;
            $ct = db('Grupo', 's', 'profiles', 'type,name,uid', 'profile', $f['id'], $uid);
            if (count($ct) > 0) {
                $vpf = html_entity_decode($ct[0]['v1']);
            }
            if ($vpf == null) {
                $vpf = '';
            }
            if ($f['cat'] == 'shorttext') {
                $fields-> $pf = array(gr_lang('get', $pf), 'input', 'text', '"'.$vpf.'"');
            } else if ($f['cat'] == 'longtext') {
                $fields-> $pf = array(gr_lang('get', $pf), 'textarea', 'text', $vpf);
            } else if ($f['cat'] == 'datefield') {
                $fields-> $pf = array(gr_lang('get', $pf), 'input', 'date', '"'.$vpf.'"');
            } else if ($f['cat'] == 'numfield') {
                $fields-> $pf = array(gr_lang('get', $pf), 'input', 'number', '"'.$vpf.'"');
            }
        }
        if (!isset($do['side'])) {
            $do['side'] = 'left';
        }
        if (gr_role('access', 'users', '7')) {
            $fields->delacc = array(gr_lang('get', 'deactivate_account'), 'select', '0', '-----', 'yes', gr_lang('get', 'yes'), 'no', gr_lang('get', 'no'));
        }
        $fields->aside = array('hidden', 'input', 'hidden', '"'.$do['side'].'"');
    } else if ($do["type"] == "systemhf") {
        if (!gr_role('access', 'sys', '5')) {
            exit;
        }
        $css = db('Grupo', 's', 'customize', 'type', 'hf');
        foreach ($css as $c) {
            $key = $c['id'];
            $c['attr'] = str_replace('_', ' ', $c['attr']);
            $c['attr'] = ucwords($c['attr']);
            $fields->$key = array($c['attr'], 'textarea', 'text', $c['v1']);

        }
    } else if ($do["type"] == "systembanip") {
        if (!gr_role('access', 'sys', '3')) {
            exit;
        } $blist = db('Grupo', 's', 'options', 'type', 'blacklist')[0]['v2'];
        $fields->blist = array(gr_lang('get', 'blacklist'), 'textarea', 'text', $blist);

    } else if ($do["type"] == "systemfilterwords") {
        if (!gr_role('access', 'sys', '4')) {
            exit;
        } $blist = db('Grupo', 's', 'options', 'type', 'filterwords')[0]['v2'];
        $fields->blist = array(gr_lang('get', 'filterwords'), 'textarea', 'text', $blist);

    } else if ($do["type"] == "systemappearance") {
        if (gr_role('access', 'sys', '2')) {
            $css = db('Grupo', 's', 'customize', 'type|,type|,type', 'style', 'customcss', 'mstyle');
            foreach ($css as $c) {
                $key = $c['id'];
                $c['attr'] = ucwords(str_replace('_', ' ', $c['attr']));
                if ($c['v2'] == 'background' && !empty($c['v4']) || $c['v2'] == 'text-color') {
                    $a = $key.'a';
                    $b = $key.'b';
                    $fields->$a = array($c['attr'].' - Start Color', 'input', 'colorpick', '"'.$c['v3'].'"');
                    $fields->$b = array($c['attr'].' - End Color', 'input', 'colorpick', '"'.$c['v4'].'"');
                } else {
                    $fields->$key = array($c['attr'], 'input', 'colorpick', '"'.$c['v3'].'"');
                }

            }
            foreach ($css as $c) {
                $c['attr'] = ucwords(str_replace('_', ' ', $c['attr']));
                if ($c['type'] == 'customcss') {
                    $key = $c['id'].'custom';
                    $fields->$key = array($c['attr'], 'textarea', 'colorpick', $c['v1']);
                }
            }
        }
    } else if ($do["type"] == "systemsettings") {
        if (!gr_role('access', 'sys', '1')) {
            exit;
        }
        $sys = db('Grupo', 's', 'options', 'type', 'default');
        foreach ($sys as $s) {
            $key = $s['id'];
            $inp = 'input';
            $type = 'text';
            $val = '"'.$s['v2'].'"';
            if ($s['v1'] === 'timezone') {
                $inp = 'tmz';
                $type = gr_tmz();
                $val = $s['v2'];
            }
            if ($s['v1'] === 'userreg' || $s['v1'] === 'recaptcha' || $s['v1'] === 'boxed' || $s['v1'] === 'guest_login') {
                $fields->$key = array(gr_lang('get', $s['v1']), 'select', $s['v2'], gr_lang('get', $s['v2']), 'enable', gr_lang('get', 'enable'), 'disable', gr_lang('get', 'disable'));
            } else if ($s['v1'] === 'autogroupjoin') {
                $group = db('Grupo', 's', 'options', 'type', 'group');
                $groups = array();
                foreach ($group as $r) {
                    $groups[$r['id']] = $r['v1'];
                }
                $fields->$key = array(gr_lang('get', $s['v1']), 'select', $groups, $s['v2']);
            } else if ($s['v1'] === 'language') {
                $lang = db('Grupo', 's', 'phrases', 'type', 'lang');
                $langs = array();
                foreach ($lang as $r) {
                    $langs[$r['id']] = $r['short'];
                }
                $fields->$key = array(gr_lang('get', $s['v1']), 'select', $langs, $s['v2']);
            } else {
                $fields->$key = array(gr_lang('get', $s['v1']), $inp, $type, $val);
            }
            $fields->logo = array(gr_lang('get', 'logo'), 'input', 'file');
            $fields->favicon = array(gr_lang('get', 'favicon'), 'input', 'file');
            $fields->emaillogo = array(gr_lang('get', 'emaillogo'), 'input', 'file');
            $fields->defaultbg = array(gr_lang('get', 'defaultbg'), 'input', 'file');
            $fields->loginbg = array(gr_lang('get', 'loginbg'), 'input', 'file');
        }

    }
    $fields->choosefiletxt = array(gr_lang('get', 'choosefiletxt'));
    $r = json_encode($fields);
    gr_prnt($r);
}
?>