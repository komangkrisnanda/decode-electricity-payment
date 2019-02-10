<?php
    require_once "../config/connection.php";
    require_once "../helper/isAdmin.php";
    $code = $conn->real_escape_string($_GET['code']);
    $queryCheck = $conn->query("SELECT * FROM tbtarif WHERE KodeTarif=$code");

    if($queryCheck->num_rows == 0){
        header('location: ./index.php');
    }

    $data = $queryCheck->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Rate</title>
</head>
<body>
    <h1>Edit Rate</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>

    <form action="./process/edit-process.php" method="POST">
        <input type="hidden" name="code" value="<?= $code ?>">
        <table>
            <tr>
                <td>Power</td>
                <td><input type="number" name="power" value="<?= $data['Daya'] ?>" min="1" required></td>
            </tr>
            <tr>
                <td>Rate / KwH</td>
                <td><input type="number" name="rate" value="<?= $data['TarifPerKwh'] ?>" min="0" required></td>
            </tr>
            <tr>
                <td>Load</td>
                <td><input type="number" name="load" value="<?= $data['Beban'] ?>" min="0" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Update Rate"></td>
            </tr>
        </table>
    </form>
</body>
</html>