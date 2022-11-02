<?php
// Koneksi dengan DB
$koneksi = mysqli_connect("localhost", "root", "", "inventaris");
$err        ="";
$username   ="";
$role       ="";


    if(isset($_POST["Login"])){
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if($username== '' or $password== ''){
    
        }
        else{
            $sql1   = "select * from user where name ='$username'";
            $q1     = mysqli_query($koneksi,$sql1);
            $r1     = mysqli_fetch_array($q1);
            $user   = isset($r1['name']);
    
            if($user == ''){
                $err = "Username tidak tersedia.";
            }
            elseif($r1['password'] != md5($password)){
                $err = "Password Salah";
            }
    
            if(empty($err)){
                $_SESSION['session_username'] = $username;
                $_SESSION['session_password'] = md5($password);
                $_SESSION['session_roles'] = $r1['role'];
                if($_SESSION['session_roles'] == 'OP'){
                    $_SESSION['session_faculty'] = $r1['faculty'];
                    $_SESSION['session_facultyId'] = $r1['facultyId'];
                }
    
                $cookie_name = "cookie_username";
                $cookie_value = $username;
                $cookie_time = time() + (60 * 60);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");
    
                $cookie_name = "cookie_password";
                $cookie_value = md5($password);
                $cookie_time = time() + (60 * 60);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                $cookie_name = "cookie_roles";
                $cookie_value = $r1['role'];
                $cookie_time = time() + (60 * 60);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                if($_SESSION['session_roles'] == 'OP'){
                    $cookie_name = "cookie_faculty";
                    $cookie_value = $r1['faculty'];
                    $cookie_time = time() + (60 * 60);
                    setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                    $cookie_name = "cookie_facultyId";
                    $cookie_value = $r1['facultyId'];
                    $cookie_time = time() + (60 * 60);
                    setcookie($cookie_name,$cookie_value,$cookie_time,"/");
                }
    
                header("location:dataBarang.php");
            }
        }
    }

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

