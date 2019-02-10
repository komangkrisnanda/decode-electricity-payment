<?php
    require_once "../config/connection.php";
    require_once "../helper/month.php";
    require_once "../helper/isOperator.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Bill</title>
</head>
<body>
    <h1>Add Bill</h1>
    <a href="../dashboard/index.php">Dashboard</a>
    <hr>

    <form action="./process/add-process.php" method="POST">
        <table>
            <tr>
                <td>Cust. Name</td>
                <td>
                    <select name="cust_number">
                        <?php
                            $query = $conn->query("SELECT * FROM tbpelanggan");
                            while($data = $query->fetch_assoc()){
                                ?>
                                    <option value="<?= $data['NoPelanggan'] ?>"><?= $data['NamaLengkap'] ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Bill Year</td>
                <td>
                    <select name="bill_year" >
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Bill Month</td>
                <td>
                    <select name="bill_month">
                        <?php
                            for($i=1; $i <= 12; $i++){
                                ?>
                                    <option value="<?= $i ?>"><?= getMonthName($i) ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Total KwH Usage</td>
                <td><input type="number" name="total_kwh" min="0" value="0"></td>
            </tr>
            <tr>
                <td>Info</td>
                <td>
                    <textarea name="info" rows="5" style="resize: none"></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Add Bill"></td>
            </tr>
        </table>
    </form>
</body>
</html>