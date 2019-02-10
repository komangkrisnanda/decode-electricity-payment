<?php
    require_once "../config/connection.php";
    require_once "../helper/alert.php";
    require_once "../helper/month.php";
    require_once "../helper/isOperator.php";

    if(!empty($_GET['bill_number'])){
        $bill_number = $conn->real_escape_string($_GET['bill_number']);
        $checkBill = $conn->query("SELECT tbtagihan.*, tbpelanggan.* FROM tbpelanggan INNER JOIN tbtagihan ON tbtagihan.NoPelanggan = tbpelanggan.NoPelanggan WHERE tbtagihan.NoTagihan = '$bill_number'");

        if($checkBill->num_rows == 0){
            alert("Unknown Bill Number!", './check.php');
        }

        $data = $checkBill->fetch_assoc();

    }
    else{
        alert("Bill number is empty!", './check.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Payment</title>
</head>
<body>
    <h1>Add Payment</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <a href="./check.php">Check another bill</a>
    <hr>

    <form action="./process/add-process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="bill_number" value="<?= $data['NoTagihan'] ?>">
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
            <?php
                if(@$_SESSION['Level'] == "Admin"){
                    ?>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select name="status">
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
                                </select>
                            </td>
                        </tr>
                    <?php
                }
            ?>
            <tr>
                <td><input type="submit" name="submit" value="Add Bill"></td>
            </tr>
        </table>
    </form>
</body>
</html>