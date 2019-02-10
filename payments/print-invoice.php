<?php
    require_once "../config/connection.php";
    require_once "../helper/month.php";

    $code = $conn->real_escape_string($_GET['code']);
    $queryCheck = $conn->query("SELECT tbpelanggan.*, tbtagihan.*, tbtarif.* FROM tbtagihan INNER JOIN tbpelanggan ON tbtagihan.NoPelanggan = tbpelanggan.NoPelanggan INNER JOIN tbtarif ON tbtarif.KodeTarif = tbpelanggan.KodeTarif WHERE tbtagihan.KodeTagihan = $code AND tbtagihan.Status = 'Lunas'");

    if($queryCheck->num_rows == 0){
        header('location: ./index.php');
    }

    $data = $queryCheck->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        @media print{
            button{
                display: none;
            }
        }
    </style>
</head>
<body style="text-align: center">
    <h1>Decode Electricity Payment</h1>
    <h4>Invoice Bill #<?= $data['NoTagihan'] ?></h4>
    <hr>
    <table style="margin:auto; text-align: left" cellpadding="10">
        <tr>
            <td><b>Cust. Name</b></td>
            <td><?= $data['NamaLengkap'] ?></td>
        </tr>
        <tr>
            <td><b>Address</b></td>
            <td><?= $data['Alamat'] ?></td>
        </tr>
        <tr>
            <td><b>Electricity Number</b></td>
            <td><?= $data['NoMeter'] ?></td>
        </tr>
        <tr>
            <td><b>Power</b></td>
            <td><?= $data['Daya'] ?> VA</td>
        </tr>
        <tr>
            <td><b>Rate / KwH</b></td>
            <td>Rp. <?= number_format($data['TarifPerKwh']) ?></td>
        </tr>
        <tr>
            <td><b>Load Fee</b></td>
            <td>Rp. <?= number_format($data['Beban']) ?></td>
        </tr>
        <tr>
            <td><b>Bill For</b></td>
            <td><?= getMonthName($data['BulanTagihan']) ?>, <?= $data['TahunTagihan'] ?></td>
        </tr>
        <tr>
            <td><b>Total KwH</b></td>
            <td><?= number_format($data['JumlahPemakaian']) ?></td>
        </tr>
        <tr>
            <td><b>Grand Total</b></td>
            <td>Rp. <?= number_format($data['TotalBayar']) ?></td>
        </tr>
    </table>
    <hr>
    <button onclick="print()">Print Invoice</button>
    
</body>
</html>