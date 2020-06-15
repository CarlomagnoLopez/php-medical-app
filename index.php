<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
if (!ini_get('output_buffering')) {
header('Location: requirements.php');
exit;
}
else{
require "key/open.php";
}
?>
