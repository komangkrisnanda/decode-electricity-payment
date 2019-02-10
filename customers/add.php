<?php
    require_once "../config/connection.php";
    require_once "../helper/isAdmin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Customer</title>
</head>
<body>
    <h1>Add Customer</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>

    <form action="./process/add-process.php" method="POST">
        <table>
            <tr>
                <td>Electricity Number</td>
                <td><input type="number" min="0" name="electricity_number"></td>
            </tr>
            <tr>
                <td>Rate Type</td>
                <td>
                    <select name="rate">
                        <?php
                            $query = $conn->query("SELECT * FROM tbtarif ORDER BY Daya DESC");
                            while($data = $query->fetch_assoc()){
                                ?>
                                    <option value="<?= $data['KodeTarif'] ?>"><?= number_format($data['Daya']) ?> VA - Rp. <?= number_format($data['TarifPerKwh']) ?> / KwH</option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Fullname</td>
                <td><input type="text" name="fullname"></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><input type="text" name="phone"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><textarea name="address" rows="5" style="resize:none"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Add Customer"></td>
            </tr>
        </table>
    </form>
</body>
</html>