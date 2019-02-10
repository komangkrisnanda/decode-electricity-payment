<?php
    require_once "../helper/isAdmin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Rate</title>
</head>
<body>
    <h1>Add Rate</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>

    <form action="./process/add-process.php" method="POST">
        <table>
            <tr>
                <td>Power</td>
                <td><input type="number" name="power" value="1" min="1" required></td>
            </tr>
            <tr>
                <td>Rate / KwH</td>
                <td><input type="number" name="rate" value="0" min="0" required></td>
            </tr>
            <tr>
                <td>Load</td>
                <td><input type="number" name="load" value="0" min="0" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Add Rate"></td>
            </tr>
        </table>
    </form>
</body>
</html>