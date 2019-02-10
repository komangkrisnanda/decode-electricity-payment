<?php
    require_once "../config/connection.php";
    require_once "../helper/alert.php";
    require_once "../helper/isOperator.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Hello, <?= $_SESSION['NamaLengkap'] ?></h1>
    <a href="../logout.php">Logout</a>
    <hr>

    <h3>Menu : </h3>
    <ul>
        
        <?php
            if(@$_SESSION['Level'] == "Admin"){
                ?>
                    <li><a href="../customers/index.php">Customers</a></li>
                    <li><a href="../rates/index.php">Rates</a></li>
                    <li><a href="../users/index.php">Users</a></li>
                <?php
            }
        ?>
        <li><a href="../bills/index.php">Bills</a></li>
        <li><a href="../payments/index.php">Payments</a></li>
    </ul>
</body>
</html>