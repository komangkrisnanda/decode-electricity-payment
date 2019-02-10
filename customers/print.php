<?php
    require_once "../config/connection.php";
    require_once "../helper/isAdmin.php";
    if(!isset($_SESSION['customer_username'])){
        header('location: ./index.php');
    }
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
        button{
            cursor: pointer;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1 align="center">Decode Electricity Payment</h1>
    <hr>
    <table border="1" style="margin:auto;border-collapse: collapse" cellpadding="5">
        <tr>
            <td>Fullname</td>
            <td><?= $_SESSION['customer_fullname'] ?></td>
        </tr>
        <tr>
            <td>Electricity Number</td>
            <td><?= $_SESSION['customer_electricity_number'] ?></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><?= $_SESSION['customer_username'] ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><?= $_SESSION['customer_password'] ?></td>
        </tr>
    </table>
    <hr>
    <div style="width:100%; text-align: center">
        <a href="./index.php">
            <button>Back</button>
        </a>
        <button onclick="print()">Print</button>
    </div>
</body>
</html>