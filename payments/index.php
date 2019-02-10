<?php
    require_once "../config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payments</title>
</head>
<body>
    <h1>Payments</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>
    <a href="./check.php">Add Payment</a>
    <br><br>
    <table border="1" style="border-collapse: collapse" cellpadding="10">
        <tr>
            <td>Code</td>
            <td>Cust. Number & Name</td>
            <td>Bill Number</td>
            <td>Payment Date</td>
            <td>Total Bill Amount</td>
            <td>Invoice</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        <?php
            $query = $conn->query("SELECT tbpelanggan.*, tbtagihan.*, tbpembayaran.* FROM tbpembayaran INNER JOIN tbtagihan ON tbpembayaran.KodeTagihan = tbtagihan.KodeTagihan INNER JOIN tbpelanggan ON tbpelanggan.NoPelanggan = tbtagihan.NoPelanggan");
            while($data = $query->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $data['KodePembayaran'] ?></td>
                        <td><?= $data['NoPelanggan'] ?> / <?= $data['NamaLengkap'] ?></td>
                        <td><?= $data['NoTagihan'] ?></td>
                        <td><?= $data['TglBayar'] ?></td>
                        <td>Rp. <?= number_format($data['JumlahTagihan']) ?></td>
                        <td>
                            <a href="../uploads/invoices/<?= $data['BuktiPembayaran'] ?>">
                                <img src="../uploads/invoices/<?= $data['BuktiPembayaran'] ?>" width="100px"/>
                            </a>
                        </td>
                        <td><?= $data['Status'] ?></td>
                        <td>
                        
                        <?php
                            if($data['Status'] == "Belum Dikonfirmasi" && @$_SESSION['Level'] == "Admin"){
                                ?>
                                    <a href="./confirm.php?code=<?= $data['KodeTagihan'] ?>">Confirm</a>
                                <?php
                            }
                            else{
                                ?>
                                    <a href="./print-invoice.php?code=<?= $data['KodeTagihan'] ?>">Print</a>
                                <?php
                            }
                        ?>

                        </td>
                    </tr>
                <?php
            }

        ?>
    </table>
</body>
</html>