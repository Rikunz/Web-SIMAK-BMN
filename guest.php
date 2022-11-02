<?php
session_start();
$_SESSION['session_username'] = 'tamu';
$_SESSION['session_password'] = md5('tamu');
$_SESSION['session_roles'] = 'tamu';

$cookie_name = "cookie_username";
$cookie_value = 'tamu';
$cookie_time = time() + (60 * 60);
setcookie($cookie_name,$cookie_value,$cookie_time,"/");

$cookie_name = "cookie_password";
$cookie_value = md5('tamu');
$cookie_time = time() + (60 * 60);
setcookie($cookie_name,$cookie_value,$cookie_time,"/");

$cookie_name = "cookie_roles";
$cookie_value = 'tamu';
$cookie_time = time() + (60 * 60);
setcookie($cookie_name,$cookie_value,$cookie_time,"/");

header("location:dataBarang.php");