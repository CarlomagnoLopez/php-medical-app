<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_love() {
    $uid = usr('Grupo')['id'];
    $arg = vc(func_get_args());
    if ($arg[0]["type"] == "lovedit") {
        if (gr_role('access', 'groups', '10') || gr_role('access', 'groups', '7')) {
            $r = db('Grupo', 's', 'msgs', 'id,cat', $arg[0]["id"], 'group');
            if (count($r) > 0) {
                $cu = gr_group('user', $r[0]['gid'], $uid);
                if ($cu[0] && $cu['role'] != 3) {
                    $lv = db('Grupo', 's', 'options', 'type,v1,v2', 'loves', $arg[0]["id"], $uid);
                    $list[0] = new stdClass();
                    if (count($lv) > 0) {
                        $list[0]->do = 'unlike';
                        db('Grupo', 'd', 'options', 'type,v1,v2', 'loves', $arg[0]["id"], $uid);
                    } else {
                        $list[0]->do = 'like';
                        db('Grupo', 'i', 'options', 'type,v1,v2,v3', 'loves', $arg[0]["id"], $uid, $r[0]['uid']);
                    }
                    $list[0]->id = $arg[0]["id"];
                    $list[0]->count = gr_shnum(count(db('Grupo', 's', 'options', 'type,v1', 'loves', $arg[0]["id"])));
                    $r = json_encode($list);
                    gr_prnt($r);
                }
            }
        }
    }
}
?>