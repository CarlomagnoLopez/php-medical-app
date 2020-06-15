<?php if(!defined('s7V9pz')) {die();}?><?php
fnc('grupo');
$gid = $tusid = vc(pg('export'), 'num', 1);
$ldt = explode('/', pg('export'))[1];
$uid = usr('Grupo')['id'];
$cu = gr_group('user', $gid, $uid, $ldt);
if (!$cu[0] || $cu['role'] == '3') {
    rt('404');
}
if ($ldt == 'user') {
    if (!gr_role('access', 'privatemsg', '3')) {
        rt('404');
        exit;
    }
    $tmpido = $gid.'-'.$uid;
    if ($gid > $uid) {
        $tmpido = $uid.'-'.$gid;
    }
    $gid = $tmpido;
} else {
    if (!gr_role('access', 'groups', '8') & !gr_role('access', 'groups', '7')) {
        rt('404');
        exit;
    }
}
$r = db('Grupo', 's', 'msgs', 'gid', $gid);
if ($ldt == 'user') {
    $n = gr_lang('get', 'conversation_with').' '.gr_profile('get', $tusid, 'name');
} else {
    $n = db('Grupo', 's', 'options', 'type,id', 'group', $gid)[0]['v1'];
}
$filename = $n.' - backup.html';
header('Content-disposition: attachment; filename=' . $filename);
header('Content-type: text/html');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php pr(gr_default('get', 'sitedesc')); ?>">
    <meta name="author" content="Silwr">
    <meta name="generator" content="Grupo">
    <title><?php pr($n.' - '.gr_default('get', 'sitename')); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700,700i,800" rel="stylesheet">
    <?php
    css("gr-backup");
    css("custom");
    ?>
</head>
<body>
    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">
                    <table>
                        <thead>
                            <tr class="table100-head">
                                <th class="column1"><?php pr(gr_lang('get', 'date-time')) ?>
                                </th>
                                <th class="column2"><?php pr(gr_lang('get', 'sender')) ?>
                                </th>
                                <th class="column3"><?php pr(gr_lang('get', 'message')) ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($r as $v) {
                                if ($v['type'] === 'system') {
                                    $v['msg'] = gr_lang('get', $v['msg']);
                                } else if ($v['type'] === 'file') {
                                    $v['msg'] = gr_lang('get', 'shared_file');
                                }
                                if ($v['uid'] == $uid) {
                                    $name = gr_lang('get', 'you');
                                } else {

                                    $name = gr_profile('get', $v['uid'], 'name');
                                }
                                $tms = new DateTime($v['tms']);
                                $tmz = new DateTimeZone(gr_profile('get', $uid, 'tmz'));
                                $tms->setTimezone($tmz);
                                $tmst = strtotime($tms->format('Y-m-d H:i:s'));
                                ?>
                                <tr><td class="column1" data-title="<?php pr(gr_lang('get', 'date-time')) ?>"><?php pr($tms->format('d-M-y').' '.$tms->format('h:i A')); ?></td>
                                    <td class="column2" data-title="<?php pr(gr_lang('get', 'sender')) ?>"><?php pr($name) ?></td>
                                    <td class="column3" data-title=<?php pr(gr_lang('get', 'message')) ?>"><?php pr($v['msg']); ?></td>
                                        </tr>

                                        <?php
                                    } ?>
                                    </tbody>
                                    </table>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </body>
                                    </html>