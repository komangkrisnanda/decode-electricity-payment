<?php
    require_once "../config/connection.php";
    require_once "../helper/alert.php";
    require_once "../helper/isOperator.php";

    if(isset($_GET['code'])){
        $code = $conn->real_escape_string($_GET['code']);
        $queryCheckCode = $conn->query("SELECT * FROM tbpembayaran WHERE KodeTagihan=$code");
        if($queryCheckCode->num_rows == 1){
            $queryUpdate = $conn->query("UPDATE tbpembayaran SET Status='Lunas' WHERE KodeTagihan=$code");
            
            if($queryUpdate){
                $queryUpdateBill = $conn->query("UPDATE tbtagihan SET Status='Lunas' WHERE KodeTagihan=$code");

                if($queryUpdateBill){
                    alert("Payment confirmed!", "./index.php");
                }
            }
            else{
                alert("Failed to confirm!", "./index.php");
            }
        }
        else{
            alert("Invalid Code!", "./index.php");
        }
    }
    else{
        header('location: ./index.php');
    }
?>