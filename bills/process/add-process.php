<?php
    require_once "../../config/connection.php";
    require_once "../../helper/alert.php";
    require_once "../../helper/random.php";
    require_once "../../helper/isOperator.php";

    if(isset($_POST['submit'])){
        $cust_number = $conn->real_escape_string($_POST['cust_number']);
        $bill_year = $conn->real_escape_string($_POST['bill_year']);
        $bill_month = $conn->real_escape_string($_POST['bill_month']);
        $total_kwh = $conn->real_escape_string($_POST['total_kwh']);
        $info = $conn->real_escape_string($_POST['info']);
        
        $created_bill = date("Y-m-d");
        $bill_number = "DCD" . randomString(15);

        if(is_numeric($cust_number) && is_numeric($bill_year) && is_numeric($bill_month) && is_numeric($total_kwh)){
            $queryCheck = $conn->query("SELECT * FROM tbtagihan WHERE NoPelanggan=$cust_number AND TahunTagihan=$bill_year AND BulanTagihan=$bill_month");
            if($queryCheck->num_rows == 0){
                
                $checkRate = $conn->query("SELECT tbpelanggan.*, tbtarif.* FROM tbpelanggan INNER JOIN tbtarif ON tbtarif.KodeTarif = tbpelanggan.KodeTarif WHERE tbpelanggan.NoPelanggan = $cust_number");

                $dataRate = $checkRate->fetch_assoc();

                $grandTotal = ($total_kwh * $dataRate['TarifPerKwh']) + $dataRate['Beban'];

                $queryInsert = $conn->query("INSERT INTO tbtagihan VALUES (NULL, '$bill_number', $cust_number, $bill_year, $bill_month, $total_kwh, '$created_bill', $grandTotal, 'Belum', '$info')");

                if($queryInsert){
                    alert("Insert Successfull!", "../index.php");
                }
                else{
                    alert("Insert Error!", "../add.php");
                }

            }
            else{
                alert("Bill Already Exist !", "../add.php");
            }
        }
        else{
            alert("Please fill all form!", "../add.php");
        }
    }
    else{
        header('location: ../add.php');
    }
?>