<?php
$koneksi = mysqli_connect("localhost", "root", "", "inventaris");

if(!empty($_POST["location"])){
        $lokasi = $_POST["location"];
        $fakultas = $_POST["faculty"];
        $query = "SELECT * FROM room WHERE facultyId='$fakultas' AND name='$lokasi'";
        $result = mysqli_query($koneksi,$query);
        $count = mysqli_num_rows($result);
        if($count==0) {
            echo "<span style='color:red'> Maaf ruangan tidak tersedia pada fakultas tersebut.</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        }else{
            echo "<span style='color:green'> Ruangan tersedia.</span>";
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
    }
?>