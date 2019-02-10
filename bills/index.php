<?php
    require_once "../config/connection.php";
    require_once '../helper/month.php';
    require_once "../helper/isOperator.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bills</title>
</head>
<body>
    <h1>Bills</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>
    <a href="./add.php">Add Bill</a>
    <br><br>
    <table border="1" style="border-collapse: collapse" cellpadding="10">
        <tr>
            <td>Code</td>
            <td>Bill Number</td>
            <td>Cust. Name</td>
            <td>Bill Date For</td>
            <td>Due Range</td>
            <td>Total KwH Usage</td>
            <td>Grand Total</td>
            <td>Status</td>
            <td>Info</td>
            <?php
                if(@$_SESSION['Level'] == "Admin"){
                    ?>
                        <td>Action</td>
                    <?php
                }
            ?>
        </tr>
        <?php
            $query = $conn->query("SELECT tbpelanggan.*, tbtagihan.* FROM tbtagihan INNER JOIN tbpelanggan ON tbpelanggan.NoPelanggan = tbtagihan.NoPelanggan ORDER BY tbtagihan.TglPencatatan DESC");
            while($data = $query->fetch_assoc()){
                $start_date = date("Y-m-d", strtotime($data['TglPencatatan'] . "+1 day"));
                $end_date = date("Y-m-d", strtotime($data['TglPencatatan'] . "+5 day"));
                ?>
                    <tr>
                        <td><?= $data['KodeTagihan'] ?></td>
                        <td><?= $data['NoTagihan'] ?></td>
                        <td><?= $data['NamaLengkap'] ?></td>
                        <td><?= $data['TahunTagihan'] ?> - <?= getMonthName($data['BulanTagihan']) ?></td>
                        <td><?= $start_date ?> s/d <?= $end_date ?></td>
                        <td><?= number_format($data['JumlahPemakaian']) ?></td>
                        <td>Rp. <?= number_format($data['TotalBayar']) ?></td>
                        <td><?= $data['Status'] ?></td>
                        <td><?= $data['Keterangan'] ?></td>
                        <?php
                            if(@$_SESSION['Level'] == "Admin" && $data['Status'] == "Belum"){
                                ?>
                                    <td><a href="./delete.php?code=<?= $data['KodeTagihan'] ?>">Delete</a></td>
                                <?php
                            }
                            else if(@$_SESSION['Level'] == "Admin" && $data['Status'] != "Belum"){
                                ?>
                                    <td>-</td>
                                <?php
                            }
                        ?>
                    </tr>
                <?php
            }

        ?>
    </table>
</body>
</html>