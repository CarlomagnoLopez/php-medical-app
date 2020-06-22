<?php
if (!ini_get('output_buffering')) {
header('Location: requirements.php');
exit;
}
else{
require "key/open.php";
}
?>
