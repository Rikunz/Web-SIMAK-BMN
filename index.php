<?php
include_once("config.php"); // Create database connection using config file

$result = mysqli_query($mysqli, "SELECT * FROM fakultas ORDER BY id ASC"); // Fetch all users data from database
?>

<html>
<head>
    <title>Homepage</title>
</head>

<body>
<a href="add.php">Add New</a><br/><br/>
    <table width='80%' border=1>
    <tr>
        <th>No</th> <th>nama</th> 
    </tr>
    <?php
    while($user_data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$user_data['no']."</td>";
        echo "<td>".$user_data['nama']."</td>";
        echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td></tr>";
    }
    ?>
    </table>
</body>
</html>