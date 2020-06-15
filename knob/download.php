<?php if(!defined('s7V9pz')) {die();}?><?php
fnc('grupo');
$file=explode('/', pg('download'))[0];
if(!isset($file) || empty($file)){
    rt('404');
}
if (gr_role('access', 'files', '2')) {
    $zn = "grupo/files/dumb/zip-".$file.".zip";
    flr('download', $zn);
} else {
    rt('404');
}
?>