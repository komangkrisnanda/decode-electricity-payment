<?php
    require_once "../config/connection.php";
    require_once "../helper/isAdmin.php";
    $code = $conn->real_escape_string($_GET['code']);
    $queryCheck = $conn->query("SELECT * FROM tblogin WHERE KodeLogin=$code");

    if($queryCheck->num_rows == 0){
        header('location: ./index.php');
    }

    $data = $queryCheck->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>

    <form action="./process/edit-process.php" method="POST">
        <input type="hidden" name="code" value="<?= $code ?>">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?= $data['Username'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Fullname</td>
                <td><input type="text" name="fullname" value="<?= $data['NamaLengkap'] ?>"></td>
            </tr>
            <tr>
                <td>Level</td>
                <td>
                    <select name="level">
                        <option value="Admin" <?= ($data['Level'] == "Admin") ? "selected" : "" ?>>Administrator</option>
                        <option value="Operator" <?= ($data['Level'] == "Operator") ? "selected" : "" ?>>Operator</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Update User"></td>
            </tr>
        </table>
    </form>
</body>
</html>