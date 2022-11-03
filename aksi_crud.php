<?php
    //panggil koneksi database
    include "php/function.php";

    //uji jika tombol simpan di klik
    if(isset($_POST['btambah'])) {
        //persiapan simpan data baru
        $tambah = mysqli_query($koneksi, "INSERT INTO inventory (`code`, `name`, `amount`, `facultyId`,
        `room`, `user`, `price`, `condition`, `note`) VALUES ('$_POST[tkode]','$_POST[tnama]','$_POST[tjumlah]',
        '$_POST[tunitfak]','$_POST[tlokasi]','$_POST[tpemakai]','$_POST[tharga]','$_POST[tkondisi]','$_POST[tnote]')");

        //uji jika simpan data sukses
        if($tambah){
            echo"<script>
                alert('Simpan data Sukses!');
                document.location='dataBarang.php';
                </script>";
        } else {
            echo"<script>
            alert('Simpan data Gagal!');
            document.location='dataBarang.php';
            </script>";
        } 
    }

    //uji jika tombol edit di klik
    if(isset($_POST['bedit'])) {
        //confirm ruangan
        $lokasi = $_POST["tlokasi"];
        $fakultas = $_POST["tunitfak"];
        $query = "SELECT * FROM room WHERE facultyId='$fakultas' AND name='$lokasi'";
        $cekruang = mysqli_query($koneksi,$query);
        $count = mysqli_num_rows($cekruang);
        if($count==0) {
            echo"<script>
            alert('Ruangan tidak tersedia di fakultas tersebut!');
            document.location='dataBarang.php';
            </script>";
        } else{
            //persiapan edit data 
            $edit = mysqli_query($koneksi, "UPDATE inventory SET `code`='$_POST[tkode]',`name`='$_POST[tnama]',
            `amount`='$_POST[tjumlah]',`facultyId`='$_POST[tunitfak]',`room`='$_POST[tlokasi]',`user`='$_POST[tpemakai]',
            `price`='$_POST[tharga]',`condition`='$_POST[tkondisi]',`note`='$_POST[tnote]'
            WHERE `id` = '$_POST[id]'
            ");

            //uji jika edit data sukses
            if($edit){
                echo"<script>
                    alert('Edit data Sukses!');
                    document.location='dataBarang.php';
                    </script>";
            } else {
                echo"<script>
                alert('Edit data Gagal!');
                document.location='dataBarang.php';
                </script>";
            }      
        }    
    }

    //uji jika tombol delete di klik
    if(isset($_POST['bdelete'])) {
        //persiapan delete data 
        $delete = mysqli_query($koneksi, "DELETE FROM inventory WHERE `id` = '$_POST[id_barang]'");

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Delete data Sukses!');
                document.location='dataBarang.php';
                </script>";
        } else {
            echo"<script>
            alert('Delete data Gagal!');
            document.location='dataBarang.php';
            </script>";
        }          
    }

    if(isset($_POST['btambahU'])) {
        //persiapan simpan data baru
        $pass = md5($_POST['tpassword']);
        $tambah = mysqli_query($koneksi, "INSERT INTO user (`name`, `password`, `facultyId`, `role`) VALUES ('$_POST[tnama]','$pass',
        '$_POST[tunitfak]','$_POST[trole]')");
    
        //uji jika simpan data sukses
        if($tambah){
            echo"<script>
                alert('Simpan data Sukses!');
                document.location='user.php';
                </script>";
        } else {
            echo"<script>
            alert('Simpan data Gagal!');
            document.location='user.php';
            </script>";
        }
    }

    if(isset($_POST['beditU'])) {
        //persiapan edit data 
        $pass = md5($_POST['tpassword']);
        $edit = mysqli_query($koneksi, "UPDATE user SET `name`='$_POST[tnama]',`password`='$pass',
        `facultyId`='$_POST[tunitfak]',`role`='$_POST[trole]'
        WHERE `id` = '$_POST[id]'
        ");

        if($edit){
            echo"<script>
                alert('Edit data Sukses!');
                document.location='user.php';
                </script>";
        } else {
            echo"<script>
            alert('Edit data Gagal!');
            document.location='user.php';
            </script>";
        }          
        
    }

    if(isset($_POST['bdeleteU'])) {
        //persiapan delete data 
        $delete = mysqli_query($koneksi, "DELETE FROM user WHERE `id` = '$_POST[id]'");

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Delete data Sukses!');
                document.location='user.php';
                </script>";
        } else {
            echo"<script>
            alert('Delete data Gagal!');
            document.location='user.php';
            </script>";
        }          
    }


    if(isset($_POST['btambahR'])) {
        //persiapan simpan data baru
        $tambah = mysqli_query($koneksi, "INSERT INTO room (`name`, `facultyId`) VALUES ('$_POST[tnama]','$_POST[tunitfak]')");

        //uji jika simpan data sukses
        if($tambah){
            echo"<script>
                alert('Simpan data ruang Sukses!');
                document.location='room.php';
                </script>";
        } else {
            echo"<script>
            alert('Simpan data ruang Gagal!');
            document.location='room.php';
            </script>";
        } 
    }

    if(isset($_POST['beditR'])) {
        //persiapan edit data 
        $edit = mysqli_query($koneksi, "UPDATE room SET `name`='$_POST[tnama]',
        `facultyId`='$_POST[tunitfak]'
        WHERE `id` = '$_POST[id]'
        ");

        if($edit){
            echo"<script>
                alert('Edit data ruang Sukses!');
                document.location='room.php';
                </script>";
        } else {
            echo"<script>
            alert('Edit data ruang Gagal!');
            document.location='room.php';
            </script>";
        }          
        
    }

    if(isset($_POST['bdeleteR'])) {
        //persiapan delete data 
        mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS=0");
        mysqli_query($koneksi, "DELETE FROM inventory WHERE `roomId` = '$_POST[id]'");
        $delete = mysqli_query($koneksi, "DELETE FROM room WHERE `id` = '$_POST[id]'");
        mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS=1");

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Delete data ruang Sukses!');
                document.location='room.php';
                </script>";
        } else {
            echo"<script>
            alert('Delete data ruang Gagal!');
            document.location='room.php';
            </script>";
        }          
    }

    if(isset($_POST['btambahF'])) {
        //persiapan simpan data baru
        $tambah = mysqli_query($koneksi, "INSERT INTO faculty (`name`) VALUES ('$_POST[tnama]')");

        //uji jika simpan data sukses
        if($tambah){
            echo"<script>
                alert('Simpan data Unit/Fakultas Sukses!');
                document.location='unitfakultas.php';
                </script>";
        } else {
            echo"<script>
            alert('Simpan data Unit/Fakultas Gagal!');
            document.location='unitfakultas.php';
            </script>";
        } 
    }

    if(isset($_POST['beditF'])) {
        //persiapan edit data 
        $edit = mysqli_query($koneksi, "UPDATE faculty SET `name`='$_POST[tnama]',
        WHERE `id` = '$_POST[id]'
        ");

        if($edit){
            echo"<script>
                alert('Edit data Unit/Fakultas Sukses!');
                document.location='unitfakultas.php';
                </script>";
        } else {
            echo"<script>
            alert('Edit data Unit/Fakultas Gagal!');
            document.location='unitfakultas.php';
            </script>";
        }          
        
    }

     if(isset($_POST['bdeleteF'])) {
        //persiapan delete data 
        mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS=0");
        mysqli_query($koneksi, "DELETE FROM user WHERE `id` = '$_POST[id]' AND `role`='OP'");
        mysqli_query($koneksi, "DELETE FROM room WHERE `facultyId` = '$_POST[id]'");
        mysqli_query($koneksi, "DELETE FROM inventory WHERE `facultyId` = '$_POST[id]'");
        $delete = mysqli_query($koneksi, "DELETE FROM faculty WHERE `id` = '$_POST[id]'");
        mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS=1");
        

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Delete data Unit/Fakultas Sukses!');
                document.location='unitfakultas.php';
                </script>";
        } else {
            echo"<script>
            alert('Delete data Unit/Fakultas Gagal!');
            document.location='unitfakultas.php';
            </script>";
        }          
    }
error_reporting(0);
mysqli_query($koneksi,"UPDATE inventory SET facultyId=(SELECT room.facultyID FROM room WHERE room.id=inventory.roomId)");
mysqli_query($koneksi,"UPDATE inventory SET faculty=(SELECT name from faculty WHERE inventory.facultyId=faculty.id)");
mysqli_query($koneksi,"UPDATE user SET faculty=(SELECT name from faculty WHERE user.facultyId=faculty.id)");


?>