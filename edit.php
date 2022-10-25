<?php
include_once("config.php"); // include database connection file
if(isset($_POST['update'])) // Check if form is submitted for user update, then redirect to homepage after update
    { 
        $no = $_POST['no'];
        $nama=$_POST['nama'];
        // update user data
        $result = mysqli_query($mysqli, "UPDATE fakultas SET no='$no',nama='$nama'WHERE id=$id");
        // Redirect to homepage to display updated user in list
        header("Location: index.php");
    }
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM fakultas WHERE id=$id");
while($user_data = mysqli_fetch_array($result))
{
 $no = $user_data['no'];
 $nama = $user_data['nama'];
}
?>
<html>
<head> 
 <title>Edit User Data</title>
</head>
<body>
    <a href="index.php">Home</a>
        <br/><br/>
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>No</td>
                <td><input type="text" name="no" value=<?php echo $no;?>></td>
            </tr>
            <tr> 
                <td>nama</td>
                <td><input type="text" name="nama" value=<?php echo $nama;?>></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>
