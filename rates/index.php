<?php
    require_once "../config/connection.php";
    require_once "../helper/isAdmin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rates</title>
</head>
<body>
    <h1>Rates</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>
    <a href="./add.php">Add Rate</a>
    <br><br>
    <table border="1" style="border-collapse: collapse" cellpadding="10">
        <tr>
            <td>Code</td>
            <td>Power</td>
            <td>Rate / KwH</td>
            <td>Load</td>
            <td>Action</td>
        </tr>
        <?php
            $query = $conn->query("SELECT * FROM tbtarif ORDER BY Daya DESC");
            while($data = $query->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $data['KodeTarif'] ?></td>
                        <td><?= number_format($data['Daya']) ?> VA</td>
                        <td>Rp. <?= number_format($data['TarifPerKwh']) ?></td>
                        <td>Rp. <?= number_format($data['Beban']) ?></td>
                        <td><a href="./edit.php?code=<?= $data['KodeTarif'] ?>">Edit</a> | <a href="./delete.php?code=<?= $data['KodeTarif'] ?>">Delete</a></td>
                    </tr>
                <?php
            }

        ?>
    </table>
</body>
</html>