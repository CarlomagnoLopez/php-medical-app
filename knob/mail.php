<?php if(!defined('s7V9pz')) {die();}?><?php
fnc('grupo');
$m = explode('/', pg('mail'));
if (isset($m[2])) {
    if ($m[0] === 'do') {
        $m[0] = $m[1];
        $m[1] = $m[2];
        $m[2] = 'do';
    }
    $r = db('Grupo', 's', 'mails', 'id,code', $m[0], $m[1]);
    if (isset($r[0]['id'])) {
        if ($m[2] === 'do') {
            $mtime = new DateTime($r[0]['tms']);
            $ntime = new DateTime(dt());
            $interval = $mtime->diff($ntime);
            if ($interval->format('%H') < 24) {
                if ($r[0]['type'] === 'reset' || $r[0]['type'] === 'verify' || $r[0]['type'] === 'signup') {
                    if ($r[0]['type'] === 'verify') {
                        usr('Grupo', 'alter', 'role', 3, $r[0]['uid']);
                        $grjoin = gr_default('get', 'autogroupjoin');
                        if (!empty($grjoin)) {
                            $cr = gr_group('valid', $grjoin);
                            if ($cr[0]) {
                                gr_data('i', 'gruser', $grjoin, $r[0]['uid'], 0);
                                $dt = array();
                                $dt['id'] = $grjoin;
                                $dt['msg'] = 'joined_group';
                                gr_group('sendmsg', $dt, 1, 1, $r[0]['uid']);
                            }
                        }
                    }
                    usr('Grupo', 'forcelogin', $r[0]['uid']);
                }
            }
            rt('index');
            exit;
        }
        $mail['title'] = gr_lang('get', 'email_'.$r[0]['type'].'_title');
        $mail['desc'] = gr_lang('get', 'email_'.$r[0]['type'].'_desc');
        $mail['btn'] = gr_lang('get', 'email_'.$r[0]['type'].'_btn');
        $mail['link'] = url().'mail/do/'.$m[0].'/'. $m[1].'/';
        $mail['sitename'] = gr_default('get', 'sendername');
        $mail['footer'] = gr_lang('get', 'email_footer');
        $mail['complimentary'] = gr_lang('get', 'email_complimentary_close');
        $mail['copylink'] = gr_lang('get', 'email_copy_link');
    } else {
        rt('404');
    }
} else {
    rt('404');
}
?>
<div>
    <div id=":nr" class="ii gt">
        <div id=":ns" class="a3s aXjCH adM">
            <div class="HOEnZb">
                <div class="im">
                    <div bgcolor="#fafbfc" style="Margin:0;padding:0">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td style="background-color:#fafbfc">
                                        <center bgcolor="#fafbfc" style="width:100%;background-color:#fafbfc">
                                            <div style="max-width:620px;font-size:0;margin:0 auto">
                                                <div style="font-size:1px;line-height:1px;display:none!important">
                                                </div>


                                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" style="padding-bottom:20px">
                                                                                <table border="0" cellpadding="0" cellspacing="0" style="font-family:'Open+Sans','Open Sans',Helvetica,Arial,sans-serif;font-size:13px;line-height:18px;color:#00c0ea;text-align:center;width:152px">

                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding:20px 0 10px 0">
                                                                                                <a href="#" style="text-decoration:none"><img alt="<?php pr($mail['sitename']) ?>" border="0" height="auto" src="<?php pr(mf("grupo/global/emaillogo.png")); ?>" style="display:block;width:100px!important;font-family:'Open+Sans','Open Sans',Helvetica,Arial,sans-serif;font-size:22px;line-height:26px;color:#000000;text-transform:uppercase;text-align:center;letter-spacing:1px" width="152" class="CToWUd"></a>
                                                                                            </td>
                                                                                        </tr>

                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td bgcolor="#fafbfc" style="width:7px;font-size:1px">&nbsp;</td>
                                                                            <td bgcolor="#f5f6f7" style="width:1px;font-size:1px">&nbsp;</td>
                                                                            <td bgcolor="#f0f2f3" style="width:1px;font-size:1px">&nbsp;</td>
                                                                            <td bgcolor="#edeef1" style="width:1px;font-size:1px">&nbsp;</td>
                                                                            <td bgcolor="#ffffff">
                                                                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="text-align:center;padding:40px 40px 40px 40px;border-top:3px solid #02b3e4">

                                                                                                <div style="display:inline-block;width:100%;max-width:520px">
                                                                                                    <table border="0" cellpadding="0" cellspacing="0" style="font-family:'Open+Sans','Open Sans',Helvetica,Arial,sans-serif;font-size:14px;line-height:24px;color:#525c65;text-align:left;width:100%">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <p style="Margin:0;font-size:18px;line-height:23px;color:#102231;font-weight:bold">
                                                                                                                        <strong>
                                                                                                                            <?php gr_prnt($mail['title']) ?></strong><br><br>
                                                                                                                    </p>




                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <?php gr_prnt($mail['desc']) ?><br><br>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td align="center" style="padding:15px 0 40px 0;border-bottom:1px solid #f3f6f9">
                                                                                                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate!important;border-radius:15px;width:230px">
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td align="center" valign="top">

                                                                                                                                    <a href="<?php pr($mail['link']) ?>" style="background-color:#01b3e3;border-collapse:separate!important;border-top:10px solid #01b3e3;border-bottom:10px solid #01b3e3;border-right:45px solid #01b3e3;border-left:45px solid #01b3e3;border-radius:4px;color:#ffffff;display:inline-block;font-family:'Open+Sans','Open Sans',Helvetica,Arial,sans-serif;font-size:13px;font-weight:bold;text-align:center;text-decoration:none;letter-spacing:2px;text-transform:uppercase" target="_blank"><?php pr($mail['btn']) ?></a>

                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td style="padding-top:30px">
                                                                                                                    <p style="margin:20px 0 20px 0;">
                                                                                                                        <?php pr($mail['copylink']) ?>
                                                                                                                    </p>
                                                                                                                    <p style="Margin:20px 0;font-size:12px;line-height:17px;word-wrap:break-word;word-break:break-all">
                                                                                                                        <a href="<?php pr($mail['link']) ?>" style="color:#5885ff;text-decoration:underline" target="_blank"><?php pr($mail['link']) ?></a>
                                                                                                                    </p>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="font:14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 14px">
                                                                                                                    <?php pr($mail['complimentary']) ?>                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td style="font:bold 14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 7px">
                                                                                                                    <?php pr($mail['sitename']) ?>                                                                                        </td>
                                                                                                            </tr>

                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td bgcolor="#e0e2e5" style="height:1px;width:100%;line-height:1px;font-size:0">&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td bgcolor="#e0e2e4" style="height:1px;width:100%;line-height:1px;font-size:0">&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td bgcolor="#e8ebed" style="height:1px;width:100%;line-height:1px;font-size:0">&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td bgcolor="#f1f3f6" style="height:1px;width:100%;line-height:1px;font-size:0">&nbsp;</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            <td bgcolor="#edeef1" style="width:1px;font-size:1px">&nbsp;</td>
                                                                            <td bgcolor="#f0f2f3" style="width:1px;font-size:1px">&nbsp;</td>
                                                                            <td bgcolor="#f5f6f7" style="width:1px;font-size:1px">&nbsp;</td>
                                                                            <td bgcolor="#fafbfc" style="width:7px;font-size:1px">&nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td align="center" style="padding-top:30px;padding-bottom:40px">
                                                                <table border="0" cellpadding="0" cellspacing="0" style="font-family:'Open+Sans','Open Sans',Helvetica,Arial,sans-serif;font-size:12px;line-height:18px;text-align:center;width:auto">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="color:#b7bdc1">

                                                                                <p style="Margin:0">
                                                                                    <?php pr($mail['footer']) ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <div style="width:100%">
                                                <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" bgcolor="#7d97ad" style="padding:10px 0">
                                                                <table border="0" cellpadding="0" cellspacing="0" style="font-family:'Open+Sans','Open Sans',Helvetica,Arial,sans-serif;font-size:14px;line-height:19px;text-align:center;width:auto">
                                                                    <tbody>
                                                                        <tr>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>