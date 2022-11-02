<?php   
session_start();
//cek session
if (isset($_SESSION['session_username'])) {
    header('location:dataBarang.php');
    exit;
}

$path = "php/loginf.php";
require($path);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
</head>
<body>
    <div class="logo">
        <img src="background/logouin.png" alt="">
    </div>
    <div class="center">
        <h1>Welcome</h1>
        <form action="" method="POST">
            <div class="txt_field">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot?</div>
            <input type="submit" value="Login" name="Login" class="submit">
        </form>
    </div>
    <?php
    if(!empty($err)){
        phpAlert($err);
    }
    ?>
</body>
</html>
