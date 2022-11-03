<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header('location:index.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'php/function.php';

$fakultas = query("SELECT faculty.id, faculty.name, SUM(inventory.amount) AS jumlah_barang, SUM(inventory.price) AS jumlah_harga, (SELECT COUNT(room.id) FROM room WHERE room.facultyId=faculty.id) AS jumlah_ruang FROM faculty LEFT JOIN inventory ON faculty.id = inventory.facultyId GROUP BY faculty.id;");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!--Data Table-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style-sidebar.css">

    <title>Unit/Fakultas</title>
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
                    <a href="dashboard.php">
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
                    <a href="#">
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
            <div class="container-right">
                <div class="container">
                    <div class="row my-2">
                        <div class="col-md">
                            <h3 class="text-center fw-bold text-uppercase">Data Unit/Fakultas</h3>
                            <hr>
                        </div>
                    </div>
                    <?php
                    if ($_SESSION['session_roles'] == 'Admin' or $_SESSION['session_roles'] == 'OP'){ ?>
                    <div class="row my-2">
                        <div class="col-md">
                            <a data-bs-toggle="modal" href="#modalTambah" role="button" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Unit/Fakultas</a>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row my-3">
                        <div class="col-md">
                            <table id="data" class="table table-striped table-responsive table-hover text-center" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Unit/Fakultas</th>
                                        <th>Jumlah Barang</th>
                                        <th>Jumlah Nilai Perolehan</th>
                                        <th>Jumlah Ruang</th>
                                        <?php
                                        if ($_SESSION['session_roles'] == 'Admin'){ ?>
                                        <th>Aksi</th>
                                        <?php };?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fakultas as $row) : ?>
                                    <tr>
                                        <td><?= $row['id']; ?>              </td>
                                        <td><?= $row['name']; ?>            </td>
                                        <td><?= $row['jumlah_barang']; ?>    </td>
                                        <td>Rp.<?= $row['jumlah_harga']; ?>    </td>
                                        <td><?= $row['jumlah_ruang']; ?>       </td>
                                        <?php
                                        if ($_SESSION['session_roles'] == 'Admin'){ ?>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>" style="font-weight: 600;"><i class="bi bi-pencil-square"></i>&nbsp;Ubah</a> |

                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $row['id'] ?>" style="font-weight: 600;"><i class="bi bi-trash-fill"></i>&nbsp;Hapus</a>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                    <!--Awal Modal Edit -->
                                   <div class="modal fade" id="modalEdit<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Form Data Unit/Fakultas</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                            <form method="POST" action="aksi_crud.php">
                                                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Nama Unit/Fakultas</label>
                                                                            <input type="text" name="tnama" class="form-control" value="<?=$row['name']?>" placeholder="Masukkan Nama Unit/Fakultas" required>
                                                                        </div>                                    
                                                                    </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary" name="beditF">Edit</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                                                </div>
                                                            </form> 
                                                    </div>
                                                </div>
                                            </div>
                                        <!--Akhir Modal Edit -->

                                        <!--Awal Modal Hapus -->
                                        <div class="modal fade" id="modalDelete<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Delete Fakultas</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                            <form method="POST" action="aksi_crud.php">
                                                                <input type="hidden" name="id" value="<?= $row['id']?>">
                                                            <div class="modal-body">
                                                                
                                                                <h5 class="text-center">Apakah anda yakin akan menghapus Fakultas ini?<br>
                                                                <span class="text-danger"><?=$row['name']?></span>
                                                                </h5>
                                                            </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="bdeleteF">Ya,Hapus saja</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                    </div>
                                                    </form> 
                                                    </div>
                                                </div>
                                        </div>
                                        <!--Akhir Modal Hapus -->

                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                     <!--Awal Modal -->
                    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Form Data Unit/Fakultas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="aksi_crud.php">
                                                    
                                <div class="modal-body">
                                    <div class="mb-3">
                                    <label class="form-label">Nama Unit/Fakultas</label>
                                    <input type="text" name="tnama" class="form-control" placeholder="Masukkan Nama Unit/Fakultas" required>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="btambahF">Tambah</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                </div>
                                </form> 
                                </div>
                            </div>
                        </div>
                        <!--Akhir Modal -->
                </div>
            </div>
        </div>
    </div>
    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fungsi Table
            $('#data').DataTable();
            // Fungsi Table
        });
    </script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>