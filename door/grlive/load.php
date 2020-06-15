<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_live() {
    $uid = usr('Grupo')['id'];
    $arg = vc(func_get_args());
    if (!empty($arg[0]['gid']) && isset($arg[0]['lastid']) && $arg[0]['chat'] == 'on') {
        $gr = array();
        $gr['id'] = $arg[0]['gid'];
        $gr['from'] = $arg[0]['lastid'];
        $gr['ldt'] = $arg[0]['ldt'];
        $msgs = gr_group('msgs', $gr, 1);
        $data = json_decode($msgs, true);
        if (!empty($data) && count($data) > 2) {
            gr_prnt('grliveupdates("msgs",'.$msgs.','.$gr['from'].');');
        }
    }
    if (!isset($_SESSION["ltmz"])) {
        $_SESSION["ltmz"] = 0;
    } else {
        $_SESSION["ltmz"] = $_SESSION["ltmz"]+1;
        $unseen = gr_group('unseen');
        $unread = gr_group('unseen', 'pm');
        if ($_SESSION["ltmz"] == 2) {
            if ($unread != $arg[0]['unread']) {
                gr_prnt('grliveupdates("pm",'.$unread.');');
            }
            if ($unseen != $arg[0]['unseen']) {
                gr_prnt('grliveupdates("groups",'.$unseen.');');
            }
        } else if ($_SESSION["ltmz"] == 3) {
            $acount = gr_alerts('count');
            if ($acount != 0) {
                gr_prnt('grliveupdates("alerts",'.$acount.');');
            }
        } else if ($_SESSION["ltmz"] >= 4) {
            $_SESSION["ltmz"] = 0;
            if (!empty($arg[0]['gid']) && $arg[0]['ldt'] != 'user') {
                $complaints = gr_group('complaints', $arg[0]['gid']);
                gr_prnt('grliveupdates("complaints",'.$complaints.','.$arg[0]['gid'].');');
            }
        }
    }
    gr_prnt('grliveupdates();');
}
?>