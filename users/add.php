<?php
    require_once "../helper/isAdmin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add User</title>
</head>
<body>
    <h1>Add User</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>

    <form action="./process/add-process.php" method="POST">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Fullname</td>
                <td><input type="text" name="fullname"></td>
            </tr>
            <tr>
                <td>Level</td>
                <td>
                    <select name="level">
                        <option value="Admin">Administrator</option>
                        <option value="Operator">Operator</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Add User"></td>
            </tr>
        </table>
    </form>
</body>
</html>