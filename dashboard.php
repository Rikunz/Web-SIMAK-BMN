<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header('location:index.php');
    exit;
}
if($_SESSION['session_roles'] == 'tamu'){
    header('location:dataBarang.php');
    exit;
}

$func = "php/function.php";
require $func;
$nama = $_SESSION['session_username'];

$q=mysqli_query($koneksi,"SELECT createdAt FROM user WHERE name='$nama'");
$tanggal=mysqli_fetch_array($q);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-utama">
        <div class="sidebar">
            <div class="header">
                <div class="list-item">
                    <img src="icon/box-putih.svg" alt="" class="icon">
                    <span class="description-header">Inventaris UIN Suka</span>
                </div>

                <div class="illustration">
                    <img src="icon/logouin2.png" alt="" class="logo">
                </div>
            </div>
            <div class="main">
                <?php
                if ($_SESSION['session_roles'] == 'Admin' or $_SESSION['session_roles'] == 'OP'){ ?>
                <div class="list-item">
                    <a href="#">
                        <img src="icon/dashboard.svg" alt="" class="icon">
                        <span class="description">Dashboard</span>
                    </a>
                </div>
                <?php } ?>
                <div class="list-item">
                    <a href="dataBarang.php">
                        <img src="icon/databarang.svg" alt="" class="icon">
                        <span class="description">Data Barang</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="unitfakultas.php">
                        <img src="icon/fakultas.svg" alt="" class="icon">
                        <span class="description">Fakultas/Unit</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="room.php">
                        <img src="icon/ruang.svg" alt="" class="icon">
                        <span class="description">Ruang</span>
                    </a>
                </div>
                <?php
                if ($_SESSION['session_roles'] == 'Admin'){ ?>
                <div class="list-item">
                    <a href="user.php">
                        <img src="icon/addperson.svg" alt="" class="icon">
                        <span class="description">Add User</span>
                    </a>
                </div>
                <?php } ?>
                <div class="list-item logout">
                    <a href="logout.php">
                        <img src="icon/logout.svg" alt="" class="icon">
                        <span class="description">Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="container-right">
           <div class="info-akun">
          <div class="info-title">
            <h1>Informasi Akun</h1>
          </div>

          <div class="list-info">
            <div class="left">
              <span>Nama</span>
            </div>
            <div class="right">
              <span><?=$nama;    ?></span>
            </div>
          </div>
          <div class="list-info">
            <div class="left">
              <span>Tanggal dibuat</span>
            </div>
            <div class="right">
              <span><?=$tanggal['createdAt']; ?></span>
            </div>
          </div>
          <div class="list-info">
            <div class="left">
              <span>Role</span>
            </div>
            <div class="right">
              <span><?=  $_SESSION['session_roles'];   ?></span>
            </div>
          </div>
        </div>
    </div>
</body>
</html>
