<?php
    require_once "../config/connection.php";
    require_once "../helper/isOperator.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Payment</title>
</head>
<body>
    <h1>Add Payment</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>

    <form action="./add.php" method="GET">
        <table>
            <tr>
                <td>Bill Number & Name</td>
                <td>
                    <select name="bill_number">
                        <?php
                            $query = $conn->query("SELECT tbpelanggan.*, tbtagihan.* FROM tbtagihan INNER JOIN tbpelanggan ON tbpelanggan.NoPelanggan = tbtagihan.NoPelanggan WHERE tbtagihan.Status = 'Belum'");
                            while($data = $query->fetch_assoc()){
                                ?>
                                    <option value="<?= $data['NoTagihan'] ?>"><?= $data['NoTagihan'] ?> - <?= $data['NamaLengkap'] ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Check Bill"></td>
            </tr>
        </table>
    </form>
</body>
</html>