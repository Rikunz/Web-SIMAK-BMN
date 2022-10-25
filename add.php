<html>
<head>
    <title>Add Users</title>
</head>
<body>
    <a href="index.php">Go to Home</a>
    <br/><br/>
    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>No</td>
                <td><input type="text" name="no"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
    <?php
    // Check if form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $no = $_POST['no'];
        $nama = $_POST['nama'];
        // include database connection file
        include_once("config.php");
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO fakultas (no,nama) VALUES('$no','$nama')");
        // Show message when user added
        echo "User added successfully. <a href='index.php'>View Users</a>";        
    }
    ?>
</body>
</html>