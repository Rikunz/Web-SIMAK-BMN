<?php
    //panggil koneksi database
    include "koneksi.php";

    //uji jika tombol simpan di klik
    if(isset($_POST['bsimpan'])) {
        //persiapan simpan data baru
        $simpan = mysqli_query($mysql, "INSERT INTO tdata(kode,nama,jumlah,unit_fakultas,
        lokasi,pemakai,harga,kondisi,note) VALUE ('$_POST[tkode]','$_POST[tnama]','$_POST[tjumlah]',
        '$_POST[tunitfak]','$_POST[tlokasi]','$_POST[tpemakai]','$_POST[tharga]','$_POST[tkondisi]','$_POST[tnote]')");
    
        //uji jika simpan data sukses
        if($simpan){
            echo"<script>
                alert('Simpan data Sukses!');
                document.location='index.php';
                </script>";
        } else {
            echo"<script>
            alert('Simpan data Gagal!');
            document.location='index.php';
            </script>";
        }          
}

    //uji jika tombol edit di klik
    if(isset($_POST['bedit'])) {
        //persiapan edit data 
        $edit = mysqli_query($mysql, "UPDATE tdata SET kode='$_POST[tkode]',nama='$_POST[tnama]',
        jumlah='$_POST[tjumlah]',unit_fakultas='$_POST[tunitfak]',lokasi='$_POST[tlokasi]',pemakai='$_POST[tpemakai]',
        harga='$_POST[tharga]',kondisi='$_POST[tkondisi]',note='$_POST[tnote]'
        WHERE id_barang = '$_POST[id_barang]'
        ");


    
        //uji jika edit data sukses
        if($edit){
            echo"<script>
                alert('Edit data Sukses!');
                document.location='index.php';
                </script>";
        } else {
            echo"<script>
            alert('Edit data Gagal!');
            document.location='index.php';
            </script>";
        }          
}

    //uji jika tombol delete di klik
    if(isset($_POST['bdelete'])) {
        //persiapan delete data 
        $delete = mysqli_query($mysql, "DELETE FROM tdata WHERE id_barang = '$_POST[id_barang]'");

        //uji jika delete data sukses
        if($delete){
            echo"<script>
                alert('Delete data Sukses!');
                document.location='index.php';
                </script>";
        } else {
            echo"<script>
            alert('Delete data Gagal!');
            document.location='index.php';
            </script>";
        }          
}


?>