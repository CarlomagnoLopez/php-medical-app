<?php if(!defined('s7V9pz')) {die();}?><?php
function gr_install($do) {
    if (pg() == 'install/') {
        ob_get_clean();
        if (!extension_loaded('fileinfo') OR !function_exists('mime_content_type')) {
            pr('Requires php fileinfo extension'); exit;
        } else if (isset($do["act"])) {
            if ($do["do"] == "install") {
                $bit = "key/bit.php";
                $do['email'] = vc($do['email'], 'email');
                $do['username'] = vc($do['username'], 'alphanum');
                if (empty($do['email']) && empty($do['url'])) {
                    if (!empty($do['db']) && !empty($do['site']) && dbc($do, 1)) {
                        $o = file_get_contents($bit);
                        $o = preg_replace("/'host' => '([^']+(?='))'/", "'host' => '".$do['host']."'", $o);   
                        $o = preg_replace("/'db' => '([^']+(?='))'/", "'db' => '".$do['db']."'", $o);
                        $o = preg_replace("/'user' => '([^']+(?='))'/", "'user' => '".$do['user']."'", $o);
                        $o = preg_replace("/'pass' => '([^']+(?='))'/", "'pass' => '".$do['pass']."'", $o);
                        file_put_contents($bit, $o);
                        $sql = file_get_contents('key/install.sql');
                        $db = new PDO("mysql:host=".$do['host']."; dbname=".$do['db'], $do['user'], $do['pass']);
                        $qr = $db->exec($sql);
                        pr('next');
                    }
                } else if (!empty($do['email']) && !empty($do['username']) && !empty($do['password']) && !empty($do['url'])) {
                    $o = file_get_contents($bit);
                    if (substr($do['url'], -1) != '/') {
                        $do['url'] = $do['url'].'/';
                    }
                    $o = preg_replace('/"url" => "([^"]+(?="))"/', '"url" => "'.$do['url'].'"', $o);
                    file_put_contents($bit, $o);
                    $db['host'] = $do['host'];
                    $db['db'] = $do['db'];
                    $db['user'] = $do['user'];
                    $db['pass'] = $do['pass'];
                    $db['prefix'] = 'gr_';
                    db($db, 'u', 'options', 'v2', 'type,v1|,v1', $do['site'], 'default', 'sitename', 'sendername');
                    db($db, 'u', 'options', 'v2', 'type,v1', $do['email'], 'default', 'sysemail');
                    db($db, 'u', 'users', 'email,name', 'name', $do['email'], $do['username'], 'admin');
                    usr($db, 'alter', 'pass', $do['password'], 28);
                    rename('knob/install.php', 'knob/install'.rn(7).'.php');
                    rename('requirements.php', 'requirements'.rn(7).'.php');
                    echo('done');
                }
            }
            exit;
        }
    } else {
        rt('requirements.php');
    }
}
?>