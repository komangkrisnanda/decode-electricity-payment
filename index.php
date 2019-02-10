<?php
    require_once "./config/connection.php";
    require_once "./helper/isCustomer.php";
    require_once "./helper/month.php";
    

    $username = $_SESSION['Username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <h1 align="center">Decode Electricity </h1>
    <span>Hello, <?= $_SESSION['NamaLengkap'] ?></span> ||
    <a href="./logout.php">Logout</a>
    <hr>
    <h3 align="center">Your Bill : </h3>
    <table border="1" cellpadding="10" style="margin:auto">
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
            <td>Action</td>
        </tr>
        <?php
            $query = $conn->query("SELECT tbpelanggan.*, tbtagihan.* FROM tbtagihan INNER JOIN tbpelanggan ON tbpelanggan.NoPelanggan = tbtagihan.NoPelanggan WHERE tbpelanggan.NoPelanggan = $username ORDER BY tbtagihan.TglPencatatan DESC");
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
                            if($data['Status'] == "Belum"){
                                ?>
                                    <td>
                                        <a href="./print.php?code=<?= $data['KodeTagihan'] ?>">Print</a> | 
                                        <a href="./pay.php?code=<?= $data['NoTagihan'] ?>">Bayar</a>
                                    </td>
                                <?php
                            }
                            else if($data['Status'] == "Lunas"){
                                ?>
                                    <td>
                                    <a href="./print.php?code=<?= $data['KodeTagihan'] ?>">Print</a>
                                    </td>
                                <?php
                            }
                            else{
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