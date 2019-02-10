<?php
    require_once "./config/connection.php";
    require_once "./helper/alert.php";
    require_once "./helper/month.php";
    require_once "./helper/isCustomer.php";

    $username = $_SESSION['Username'];

    if(!empty($_GET['code'])){
        $code = $conn->real_escape_string($_GET['code']);
        $checkBill = $conn->query("SELECT tbtagihan.*, tbpelanggan.* FROM tbpelanggan INNER JOIN tbtagihan ON tbtagihan.NoPelanggan = tbpelanggan.NoPelanggan WHERE tbtagihan.NoTagihan = '$code' AND tbpelanggan.NoPelanggan = $username ");

        if($checkBill->num_rows == 0){
            alert("Unknown Bill Number!", './index.php');
        }

        $data = $checkBill->fetch_assoc();

    }
    else{
        alert("Bill number is empty!", './index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Payment</title>
</head>
<body>
    <h1>Add Payment</h1>
    <hr>

    <form action="./pay-process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="code" value="<?= $data['NoTagihan'] ?>">
        <table>
            <tr>
                <td>Bill Number</td>
                <td><input type="text" value="<?= $data['NoTagihan'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Cust. Name</td>
                <td><input type="text" value="<?= $data['NamaLengkap'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Bill For</td>
                <td><input type="text" value="<?= getMonthName($data['BulanTagihan']) ?>, <?= $data['TahunTagihan'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Bill Amount</td>
                <td><input type="text" value="Rp. <?= number_format($data['TotalBayar']) ?>" disabled></td>
            </tr>
            <tr>
                <td>Invoice</td>
                <td><input type="file" name="invoice"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Pay"></td>
            </tr>
        </table>
    </form>
</body>
</html>