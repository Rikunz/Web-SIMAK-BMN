<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header('location:index.php');
    exit;
}
$func = "php/function.php";
require $func;

if($_SESSION['session_roles'] == 'OP'){
    $sesifakultas = $_SESSION["session_faculty"];
    $barang = query("SELECT * FROM inventory WHERE faculty='$sesifakultas' ORDER BY id DESC");
    mysqli_query($koneksi,"UPDATE inventory SET faculty=(SELECT name from faculty WHERE inventory.facultyId=faculty.id)");
    $faculty = query("SELECT * FROM faculty WHERE `name`='$sesifakultas' ORDER BY id DESC");
    mysqli_query($koneksi,"UPDATE inventory SET roomId=(SELECT id FROM room WHERE inventory.room=room.name)");
    mysqli_query($koneksi,"UPDATE inventory SET facultyId=(SELECT room.facultyID FROM room WHERE room.id=inventory.roomId)");
} else{
    $barang = query("SELECT * FROM inventory ORDER BY id DESC");
    mysqli_query($koneksi,"UPDATE inventory SET faculty=(SELECT name from faculty WHERE inventory.facultyId=faculty.id)");
    $faculty = query("SELECT * FROM faculty ORDER BY id DESC");
    mysqli_query($koneksi,"UPDATE inventory SET roomId=(SELECT id FROM room WHERE inventory.room=room.name)");
    mysqli_query($koneksi,"UPDATE inventory SET facultyId=(SELECT room.facultyID FROM room WHERE room.id=inventory.roomId)");
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" type="text/css" href="css/style-sidebar.css">
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
                    <a href="dashboard.php">
                        <img src="icon/dashboard.svg" alt="" class="icon">
                        <span class="description">Dashboard</span>
                    </a>
                </div>
                <?php } ?>
                <div class="list-item">
                    <a href="#">
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
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="text-center fw-bold text-uppercase">Data Barang</h3>
                        <hr>
                    </div>
                </div>
                <?php
                if ($_SESSION['session_roles'] == 'Admin' or $_SESSION['session_roles'] == 'OP'){ ?>
                    <div class="row my-2">
                        <div class="col-md">
                            <a data-bs-toggle="modal" href="#modalTambah" role="button" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Data</a>
                        </div>
                    </div>
                <?php  }?>
                <div class="row my-3">
                    <div class="col-md">
                        <table id="data" class="table table-striped table-responsive table-hover text-center" style="width:100%">
                            <thead class="table-dark">
                                <tr>
                                    <th>Code</th>
                                    <th>Nama Barang</th>
                                    <th>Fakultas/Unit</th>
                                    <th>Jumlah</th>
                                    <th>Nilai Perolehan</th>
                                    <th>Lokasi Barang</th>
                                    <th>Pemakai</th>
                                    <th>Kondisi</th>
                                    <th>Catatan Lain</th>
                                    <?php
                                    if ($_SESSION['session_roles'] == 'Admin' or $_SESSION['session_roles'] == 'OP'){ ?>
                                    <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $row) : ?>
                                <tr>
                                    <td><?= $row['code']; ?>        </td>
                                    <td><?= $row['name']; ?>        </td>
                                    <td><?= $row['faculty']; ?>     </td>
                                    <td><?= $row['amount']; ?>     </td>
                                    <td>Rp.<?=$row['price']; ?>     </td>
                                    <td><?= $row['room']; ?>        </td>
                                    <td><?= $row['user'];?>         </td>
                                    <td> <?= $row['condition'];?>   </td>
                                    <td> <?= $row['note']; ?>       </td>
                                    <?php
                                    if ($_SESSION['session_roles'] == 'Admin' or $_SESSION['session_roles'] == 'OP'){ ?>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ;?>" style="font-weight: 450;"><i class="bi bi-pencil-square"></i>&nbsp;Ubah</a> |

                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $row['id'] ;?>" style="font-weight: 450;"><i class="bi bi-trash-fill"></i>&nbsp;Hapus</a>
                                    </td>
                                        <?php } ?>
                                </tr>
                                <!--Awal Modal -->
                                <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Form Data Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form method="POST" enctype="multipart/form-data" action="aksi_crud.php">
                                                
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                    <label class="form-label">Kode Barang</label>
                                                    <input type="text" name="tkode" class="form-control" placeholder="Masukkan Kode Barang" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nama Barang</label>
                                                    <input type="text" name="tnama" class="form-control" placeholder="Masukkan Nama Barang" required>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Jumlah Barang</label>
                                                            <input type="number" name="tjumlah" class="form-control" placeholder="Masukkan Jumlah Barang" required>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Unit/Fakultas</label>
                                                                <select class="form-select" id="tunitfak" onInput="checkRuangan()" name="tunitfak" required>
                                                                    <option value="" selected="selected" hidden="hidden">Pilih</option>
                                                                <?php foreach($faculty as $f) : ?>
                                                                    <option value="<?=$f['id']; ?>"><?php echo $f['name']; ?></option>
                                                                <?php endforeach ?>
                                                                </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div style="display:flex; flex-direction:column;" class="mb-3">                                                   
                                                    <label class="form-label">Lokasi Barang</label>
                                                    <span id="check-ruangan"></span>
                                                    <input type="text" name="tlokasi" id="tlokasi" onInput="checkRuangan()" class="form-control" placeholder="Masukkan Lokasi Barang" required>
                                                </div>

                                                <div class="row">
                                                    
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Pemakai</label>
                                                            <select class="form-select" name="tpemakai" required>
                                                                <option value="" selected="selected" hidden="hidden">Pilih</option>
                                                                <option value="Dosen">Dosen</option>
                                                                <option value="Mahasiswa">Mahasiswa</option>
                                                                <option value="Karyawan">Karyawan</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Harga</label>
                                                            <input type="number" name="tharga" class="form-control" placeholder="Masukkan Harga Barang" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Kondisi</label>
                                                            <select class="form-select" name="tkondisi" required>
                                                                <option value="" selected="selected" hidden="hidden">Pilih</option>
                                                                <option value="Baik">Baik</option>
                                                                <option value="Rusak Ringan">Rusak Ringan</option>
                                                                <option value="Rusak Berat">Rusak Berat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Note</label>
                                                    <input type="text" name="tnote" class="form-control" placeholder="Masukkan Note Barang">
                                                </div>
                                                    

                                                </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="submit" name="btambah">Tambah</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                        </form> 
                                        </div>
                                    </div>
                                </div>
                                <!--Akhir Modal -->

                                <!--Awal Modal Edit -->
                                <div class="modal fade" id="modalEdit<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Form Data Barang</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                        <form method="POST" enctype="multipart/form-data" action="aksi_crud.php">
                                                            <input type="hidden" name="id" value="<?= $row['id']?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                            <label class="form-label">Kode Barang</label>
                                                            <input type="text" name="tkode" value="<?=$row['code']?>" class="form-control" placeholder="Masukkan Kode Barang" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Barang</label>
                                                            <input type="text" name="tnama" value="<?=$row['name']?>" class="form-control" placeholder="Masukkan Nama Barang" required>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Jumlah Barang</label>
                                                                    <input type="number" name="tjumlah" value="<?=$row['amount']?>" class="form-control" placeholder="Masukkan Jumlah Barang" required>
                                                                </div>
                                                            </div>

                                                            <div class="col">
                                                                <div class="mb-3">                                                        
                                                                    <label class="form-label">Unit/Fakultas</label>
                                                                        <select class="form-select" id="tunitfak" onInput="checkRuangan()" name="tunitfak" required>
                                                                            <option value="<?=$row['facultyId']?>" selected="selected" hidden="hidden"><?=$row['faculty']?></option>
                                                                            <?php foreach($faculty as $f) : ?>
                                                                            <option value="<?=$f['id'];?>"><?php echo $f['name'] ?></option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div style="display:flex; flex-direction:column;"class="mb-3">
                                                            <label class="form-label" >Lokasi Barang</label>
                                                            <span id="check-ruangan"></span>
                                                            <input type="text" name="tlokasi" id="tlokasi"value="<?=$row['room']?>" onInput="checkRuangan()" class="form-control" placeholder="Masukkan Lokasi Barang" required>
                                                        </div>

                                                        <div class="row">
                                                            
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Pemakai</label>
                                                                    <select class="form-select" name="tpemakai" required>
                                                                        <option value="<?=$row['user']?>" selected="selected" hidden="hidden"><?=$row['user']?></option>
                                                                        <option value="Dosen">Dosen</option>
                                                                        <option value="Mahasiswa">Mahasiswa</option>
                                                                        <option value="Karyawan">Karyawan</option>
                                                                        <option value="Lainnya">Lainnya</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Harga</label>
                                                                    <input type="number" name="tharga" value="<?=$row['price']?>" class="form-control" placeholder="Masukkan Harga Barang" required>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Kondisi</label>
                                                                    <select class="form-select" name="tkondisi" required>
                                                                        <option value="<?=$row['condition']?>"selected="selected" hidden="hidden"><?=$row['condition']?></option>
                                                                            <option value="Baik">Baik</option>
                                                                            <option value="Rusak Ringan">Rusak Ringan</option>
                                                                            <option value="Rusak Berat">Rusak Berat</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Note</label>
                                                            <input type="text" name="tnote" value="<?=$row['note']?>" class="form-control" placeholder="Masukkan Note Barang">
                                                        </div>
                                                        </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="submit" class="btn btn-primary" name="bedit">Edit</button>
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
                                                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Delete Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                        <form method="POST" action="aksi_crud.php">
                                                            <input type="hidden" name="id_barang" value="<?= $row['id']?>">
                                                        <div class="modal-body">
                                                            
                                                            <h5 class="text-center">Apakah anda yakin akan menghapus data ini?<br>
                                                            <span class="text-danger"><?=$row['code']?> - <?=$row['name']?></span>
                                                            </h5>
                                                        </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="bdelete">Ya,Hapus saja</button>
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
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Data Tables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fungsi Table
            $('#data').DataTable();
            // Fungsi Table
        });
    </script>
    <script>
        function checkRuangan(){
            $.ajax({
                url:"ajax.php",
                data:'location='+$("#tlokasi").val()+'&faculty='+$("#tunitfak").val(),
                type:"POST",
                ifModified:"True",
                success:function(data){
                    $("#check-ruangan").html(data);
                },
                error:function (){}
            });
        }
    </script>
</body>
</html>