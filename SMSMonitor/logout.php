<?php 

include 'config/config.inc.php';

session_start();

logout();

session_destroy();

session_unset();

header("location:https://demolink.co.in/smsmonitor/");

exit;

?>

