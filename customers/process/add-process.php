<?php
    require_once "../../config/connection.php";
    require_once "../../helper/alert.php";
    require_once "../../helper/random.php";
    require_once "../../helper/isAdmin.php";

    if(isset($_POST['submit'])){
        $electricity_number = $conn->real_escape_string($_POST['electricity_number']);
        $rate = $conn->real_escape_string($_POST['rate']);
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $address = $conn->real_escape_string($_POST['address']);
        $phone = $conn->real_escape_string($_POST['phone']);

        $cust_number = randomNumber(8);
        $cust_password = randomString(8);

        if(is_numeric($electricity_number) && is_numeric($rate) && !empty($fullname) && !empty($address) && !empty($phone)){
            $queryCheck = $conn->query("SELECT * FROM tbpelanggan WHERE NoMeter=$electricity_number");
            if($queryCheck->num_rows == 0){
                $encrypted_password = password_hash($cust_password, PASSWORD_BCRYPT, ['cost' => 12]);
                $queryInsert = $conn->query("INSERT INTO tbpelanggan VALUES (NULL, '$cust_number', '$electricity_number', '$rate', '$fullname', '$phone', '$address')");

                if($queryInsert){
                    $queryInsert2 = $conn->query("INSERT INTO tblogin VALUES (NULL, '$cust_number', '$encrypted_password', '$fullname', 'Customer')");

                    if($queryInsert2){
                        $_SESSION['customer_fullname'] = $fullname;
                        $_SESSION['customer_electricity_number'] = $electricity_number;
                        $_SESSION['customer_username'] = $cust_number;
                        $_SESSION['customer_password'] = $cust_password;
                        
                        alert("Insert Successfull!" , "../print.php");
                    }
                    else{
                        alert("Insert Error!", "../add.php");
                    }
                }
                else{
                    alert("Insert Error!", "../add.php");
                }

            }
            else{
                alert("Please use another electricity number!", "../add.php");
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