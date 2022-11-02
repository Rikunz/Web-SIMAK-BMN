<?php
session_start();
$_SESSION['session_username'] = '';
$_SESSION['session_password'] = '';
$_SESSION['session_roles'] = '';
session_destroy();

$cookie_name = "cookie_username";
$cookie_value = '';
$cookie_time = time() - (60 * 60);
setcookie($cookie_name,$cookie_value,$cookie_time,"/");

$cookie_name = "cookie_password";
$cookie_value = '';
$cookie_time = time() - (60 * 60);
setcookie($cookie_name,$cookie_value,$cookie_time,"/");

$cookie_name = "cookie_roles";
$cookie_value = '';
$cookie_time = time() - (60 * 60);
setcookie($cookie_name,$cookie_value,$cookie_time,"/");

header("location:index.php");