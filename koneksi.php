<?php
    //koneksi database

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "crudmodal";

    //buat koneksi
    $mysql = mysqli_connect($server,$username,$password,$database) or die(mysqli_error($koneksi));
?>