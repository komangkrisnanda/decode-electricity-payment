<?php
    require_once "../config/connection.php";
    require_once "../helper/isAdmin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customers</title>
</head>
<body>
    <h1>Customers</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>
    <a href="./add.php">Add Customer</a>
    <br><br>
    <table border="1" style="border-collapse: collapse" cellpadding="10">
        <tr>
            <td>Code</td>
            <td>Cust. Number</td>
            <td>Electricity Number</td>
            <td>Power & Rate</td>
            <td>Fullname</td>
            <td>Phone</td>
            <td>Address</td>
            <td>Action</td>
        </tr>
        <?php
            $query = $conn->query("SELECT tbtarif.*, tbpelanggan.* FROM tbtarif INNER JOIN tbpelanggan ON tbpelanggan.KodeTarif = tbtarif.KodeTarif");
            while($data = $query->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $data['KodePelanggan'] ?></td>
                        <td><?= $data['NoPelanggan'] ?></td>
                        <td><?= $data['NoMeter'] ?></td>
                        <td><?= number_format($data['Daya']) ?> VA / Rp. <?= number_format($data['TarifPerKwh']) ?></td>
                        <td><?= $data['NamaLengkap'] ?></td>
                        <td><?= $data['Telp'] ?></td>
                        <td><?= $data['Alamat'] ?></td>
                        <td><a href="./edit.php?code=<?= $data['NoPelanggan'] ?>">Edit</a> | <a href="./delete.php?code=<?= $data['NoPelanggan'] ?>">Delete</a></td>
                    </tr>
                <?php
            }

        ?>
    </table>
</body>
</html>