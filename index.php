<?php
    //panggil koneksi database
    include "koneksi.php";

?>
 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>SIMAK BMN UIN SUKA</title>
  </head>
  <body>
    
    <div class="container">
        <div class="mt-4">
            <h3 class="text-center">INVENTARIS BMN UIN SUKA</h3>
        </div>
    </div>  

    <div class="card mt-4 ">
        <div class="card-header bg-primary text-white">
            Data Barang
        </div>
        <div class="card-body">

            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Data
            </button>

        <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Unit/Fakultas</th>
                    <th>Lokasi Barang</th>
                    <th>Pemakai</th>
                    <th>Harga</th>
                    <th>Kondisi</th>
                    <th>Note</th>
                    <th>Aksi</th>
                </tr>
                    
                <?php
                
                //persiapan menampilkan data
                $no= 1;
                $tampil= mysqli_query($mysql, "SELECT * FROM tdata ORDER BY id_barang DESC ");
                while($data=mysqli_fetch_array($tampil)) :

                ?>    

                <tr>
                    <td><?=$no++ ?></td>
                    <td><?=$data['kode'] ?></td>
                    <td><?=$data['nama'] ?></td>
                    <td><?=$data['jumlah']?></td>
                    <td><?=$data['unit_fakultas'] ?></td>
                    <td><?=$data['lokasi'] ?></td>
                    <td><?=$data['pemakai'] ?></td>
                    <td><?=$data['harga'] ?></td>
                    <td><?=$data['kondisi'] ?></td>
                    <td><?=$data['note'] ?></td>
                    <td>
                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $no ?>">Edit</a>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $no ?>">Delete</a>
                    </td>
                </tr>

                <!--Awal Modal Edit -->
                <div class="modal fade" id="modalEdit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Form Data Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                    <form method="POST" action="aksi_crud.php">
                                        <input type="hidden" name="id_barang" value="<?= $data['id_barang']?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                        <label class="form-label">Kode Barang</label>
                                        <input type="text" name="tkode" value="<?=$data['kode']?>" class="form-control" placeholder="Masukkan Kode Barang">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Barang</label>
                                        <input type="text" name="tnama" value="<?=$data['nama']?>" class="form-control" placeholder="Masukkan Nama Barang">
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Barang</label>
                                                <input type="number" name="tjumlah" value="<?=$data['jumlah']?>" class="form-control" placeholder="Masukkan Jumlah Barang">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Unit/Fakultas</label>
                                                    <select class="form-select" name="tunitfak">
                                                        <option value="<?=$data['unit_fakultas']?>">Pilih</option>
                                                        <option value="FAKULTAS SAINS DAN TEKNOLOGI">FAKULTAS SAINS DAN TEKNOLOGI</option>
                                                        <option value="FAKULTAS ILMU TARBIYAH DAN KEGURUAN">FAKULTAS ILMU TARBIYAH DAN KEGURUAN</option>
                                                        <option value="FAKULTAS ADAB DAN ILMU BUDAYA">FAKULTAS ADAB DAN ILMU BUDAYA</option>
                                                        <option value="FAKULTAS EKONOMI DAN BISNIS ISLAM">FAKULTAS EKONOMI DAN BISNIS ISLAM</option>
                                                        <option value="FAKULTAS FAKULTAS USHULUDDIN DAN PEMIKIRAN ISLAM">FAKULTAS FAKULTAS USHULUDDIN DAN PEMIKIRAN ISLAM</option>
                                                        <option value="FAKULTAS DAKWAH DAN KOMUNIKASI">FAKULTAS DAKWAH DAN KOMUNIKASI</option>
                                                        <option value="FAKULTAS ILMU SOSIAL DAN HUMANIORA">FAKULTAS ILMU SOSIAL DAN HUMANIORA</option>
                                                        <option value="FAKULTAS SYARIAH DAN HUKUM">FAKULTAS SYARIAH DAN HUKUM</option>
                                                        <option value="PASCASARJANA">PASCASARJANA</option>
                                                        <option value="UPT PUSAT PERPUSTAKAAN">UPT PUSAT PERPUSTAKAAN</option>
                                                        <option value="UPT PUSAT PENGEMBANGAN BAHASA">UPT PUSAT PENGEMBANGAN BAHASA</option>
                                                        <option value="LP2M">LP2M</option>
                                                        <option value="UPT PUSAT PENGEMBANGAN BISNIS">UPT PUSAT PENGEMBANGAN BISNIS</option>
                                                        <option value="PTIPD">PTIPD</option>
                                                        <option value="ADMISI">ADMISI</option>
                                                        <option value="LPM">LPM</option>
                                                        <option value="SPI">SPI</option>
                                                        <option value="REKTORAT">REKTORAT</option>
                                                    </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Lokasi Barang</label>
                                        <input type="text" name="tlokasi" value="<?=$data['lokasi']?>" class="form-control" placeholder="Masukkan Lokasi Barang">
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Pemakai</label>
                                                <select class="form-select" name="tpemakai">
                                                    <option value="<?=$data['pemakai']?>">Pilih</option>
                                                        <option value="DOSEN">DOSEN</option>
                                                        <option value="MAHASISWA">MAHASISWA</option>
                                                        <option value="KARYAWAN">KARYAWAN</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Harga</label>
                                                <input type="number" name="tharga" value="<?=$data['harga']?>" class="form-control" placeholder="Masukkan Harga Barang">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Kondisi</label>
                                                <select class="form-select" name="tkondisi">
                                                    <option value="<?=$data['kondisi']?>">Pilih</option>
                                                        <option value="Berfungsi baik">Berfungsi baik</option>
                                                        <option value="Rusak Ringan">Rusak Ringan</option>
                                                        <option value="Rusak Berat">Rusak Berat</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <input type="text" name="tnote" value="<?=$data['note']?>" class="form-control" placeholder="Masukkan Note Barang">
                                    </div>
                                    </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="bedit">Edit</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                            </div>
                            </form> 
                            </div>
                        </div>
                    </div>
                <!--Akhir Modal Edit -->
                    
                <!--Awal Modal Hapus -->
                <div class="modal fade" id="modalDelete<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Delete Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                    <form method="POST" action="aksi_crud.php">
                                        <input type="hidden" name="id_barang" value="<?= $data['id_barang']?>">
                                    <div class="modal-body">
                                        
                                        <h5 class="text-center">Apakah anda yakin akan menghapus data ini?<br>
                                        <span class="text-danger"><?=$data['kode']?>-<?=$data['nama']?></span>
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

                <?php endwhile; ?>
        </table>

        </div>
    </div>

            <!-- Button trigger modal -->
            

            <!--Awal Modal -->
                <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Form Data Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form method="POST" action="aksi_crud.php">
                               
                            <div class="modal-body">
                                <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="tkode" class="form-control" placeholder="Masukkan Kode Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="tnama" class="form-control" placeholder="Masukkan Nama Barang">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Barang</label>
                                        <input type="number" name="tjumlah" class="form-control" placeholder="Masukkan Jumlah Barang">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Unit/Fakultas</label>
                                            <select class="form-select" name="tunitfak">
                                                <option>Pilih</option>
                                                <option value="FAKULTAS SAINS DAN TEKNOLOGI">FAKULTAS SAINS DAN TEKNOLOGI</option>
                                                <option value="FAKULTAS ILMU TARBIYAH DAN KEGURUAN">FAKULTAS ILMU TARBIYAH DAN KEGURUAN</option>
                                                <option value="FAKULTAS ADAB DAN ILMU BUDAYA">FAKULTAS ADAB DAN ILMU BUDAYA</option>
                                                <option value="FAKULTAS EKONOMI DAN BISNIS ISLAM">FAKULTAS EKONOMI DAN BISNIS ISLAM</option>
                                                <option value="FAKULTAS FAKULTAS USHULUDDIN DAN PEMIKIRAN ISLAM">FAKULTAS FAKULTAS USHULUDDIN DAN PEMIKIRAN ISLAM</option>
                                                <option value="FAKULTAS DAKWAH DAN KOMUNIKASI">FAKULTAS DAKWAH DAN KOMUNIKASI</option>
                                                <option value="FAKULTAS ILMU SOSIAL DAN HUMANIORA">FAKULTAS ILMU SOSIAL DAN HUMANIORA</option>
                                                <option value="FAKULTAS SYARIAH DAN HUKUM">FAKULTAS SYARIAH DAN HUKUM</option>
                                                <option value="PASCASARJANA">PASCASARJANA</option>
                                                <option value="UPT PUSAT PERPUSTAKAAN">UPT PUSAT PERPUSTAKAAN</option>
                                                <option value="UPT PUSAT PENGEMBANGAN BAHASA">UPT PUSAT PENGEMBANGAN BAHASA</option>
                                                <option value="LP2M">LP2M</option>
                                                <option value="UPT PUSAT PENGEMBANGAN BISNIS">UPT PUSAT PENGEMBANGAN BISNIS</option>
                                                <option value="PTIPD">PTIPD</option>
                                                <option value="ADMISI">ADMISI</option>
                                                <option value="LPM">LPM</option>
                                                <option value="SPI">SPI</option>
                                                <option value="REKTORAT">REKTORAT</option>
                                            </select>
                                    </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi Barang</label>
                                <input type="text" name="tlokasi" class="form-control" placeholder="Masukkan Lokasi Barang">
                            </div>

                            <div class="row">
                                
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Pemakai</label>
                                        <select class="form-select" name="tpemakai">
                                            <option>Pilih</option>
                                                <option value="DOSEN">DOSEN</option>
                                                <option value="MAHASISWA">MAHASISWA</option>
                                                <option value="KARYAWAN">KARYAWAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Harga</label>
                                        <input type="number" name="tharga" class="form-control" placeholder="Masukkan Harga Barang">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Kondisi</label>
                                        <select class="form-select" name="tkondisi">
                                            <option>Pilih</option>
                                                <option value="Berfungsi baik">Berfungsi baik</option>
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
                        <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                    </div>
                    </form> 
                    </div>
                </div>
            </div>
            <!--Akhir Modal -->



        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>