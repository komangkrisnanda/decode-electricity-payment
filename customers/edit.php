<?php
    require_once "../config/connection.php";
    require_once "../helper/isAdmin.php";
    $code = $conn->real_escape_string($_GET['code']);
    $queryCheck = $conn->query("SELECT tblogin.*, tbpelanggan.* FROM tblogin INNER JOIN tbpelanggan ON tbpelanggan.NoPelanggan = tblogin.Username WHERE tblogin.Username =$code");

    if($queryCheck->num_rows == 0){
        header('location: ./index.php');
    }

    $data = $queryCheck->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>

    <form action="./process/edit-process.php" method="POST">
        <input type="hidden" name="code" value="<?= $code ?>">
        <table>
            <tr>
                <td>Electricity Number</td>
                <td><input type="number" min="0" name="electricity_number" value="<?= $data['NoMeter'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Rate Type</td>
                <td>
                    <select name="rate">
                        <?php
                            $query = $conn->query("SELECT * FROM tbtarif ORDER BY Daya DESC");
                            while($dataRate = $query->fetch_assoc()){
                                ?>
                                    <option value="<?= $dataRate['KodeTarif'] ?>"
                                    
                                    <?= ($dataRate['KodeTarif'] == $data['KodeTarif']) ? "selected" : "" ?>
                                    
                                    ><?= number_format($dataRate['Daya']) ?> VA - Rp. <?= number_format($dataRate['TarifPerKwh']) ?> / KwH</option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Fullname</td>
                <td><input type="text" name="fullname" value="<?= $data['NamaLengkap'] ?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><input type="text" name="phone" value="<?= $data['Telp'] ?>"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><textarea name="address" rows="5" style="resize:none"><?= $data['Alamat'] ?></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Update Customer"></td>
            </tr>
        </table>
    </form>
</body>
</html>