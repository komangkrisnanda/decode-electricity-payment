<?php
    require_once "../config/connection.php";
    require_once "../helper/isAdmin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title>
</head>
<body>
    <h1>Users</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>
    <a href="./add.php">Add User</a>
    <br><br>
    <table border="1" style="border-collapse: collapse" cellpadding="10">
        <tr>
            <td>Code</td>
            <td>Username</td>
            <td>Fullname</td>
            <td>Level</td>
            <td>Action</td>
        </tr>
        <?php
            $query = $conn->query("SELECT * FROM tblogin ORDER BY KodeLogin DESC");
            while($data = $query->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $data['KodeLogin'] ?></td>
                        <td><?= $data['Username'] ?></td>
                        <td><?= $data['NamaLengkap'] ?></td>
                        <td><?= $data['Level'] ?></td>
                        <td><a href="./edit.php?code=<?= $data['KodeLogin'] ?>">Edit</a> | <a href="./delete.php?code=<?= $data['KodeLogin'] ?>">Delete</a></td>
                    </tr>
                <?php
            }

        ?>
    </table>
</body>
</html>