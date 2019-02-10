<?php
    require_once "./helper/isLogin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form action="./login-process.php" method="POST">
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
                <td><input type="submit" name="submit" value="Login"></td>
            </tr>
        </table>
    </form>
</body>
</html>