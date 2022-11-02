<?php
session_start();
// cek session
if (isset($_SESSION['session_username'])) {
    header('location:dataBarang.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="stylesheet" href="css/style-landing.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="background/logouin.png" alt="">
        </div>
        <h1>Selamat Datang di Website <br> Inventaris UIN Sunan Kalijaga</h1>
        <div class="landing-button">
            <!-- <input type="submit" value="Login">
            <input type="submit" value="Guest"> -->
            <button class="login" onclick="location.href='login.php';"><p>Login</p></button>
            <button class="guest" onclick="location.href='guest.php';"><p>Guest</p></button>
        </div>
    </div>
    
</body>
</html>
