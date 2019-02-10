<?php
    require_once "../../config/connection.php";
    require_once "../../helper/alert.php";
    require_once "../../helper/random.php";
    

    if(isset($_POST['submit'])){
        $code = $conn->real_escape_string($_POST['code']);
        $rate = $conn->real_escape_string($_POST['rate']);
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $address = $conn->real_escape_string($_POST['address']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $password = $conn->real_escape_string($_POST['password']);

        if(is_numeric($rate) && !empty($fullname) && !empty($address) && !empty($phone)){
            if(!empty($password)){
                $encrypted_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $queryUpdate = $conn->query("UPDATE tblogin SET Password='$encrypted_password', NamaLengkap='$fullname' WHERE Username=$code");
            }
            else{
               $queryUpdate = $conn->query("UPDATE tblogin SET NamaLengkap='$fullname' WHERE Username=$code");
            }

            if($queryUpdate){
                $queryUpdate2 = $conn->query("UPDATE tbpelanggan SET KodeTarif=$rate, NamaLengkap='$fullname', Telp=$phone, Alamat='$address' WHERE NoPelanggan=$code");
                
                if($queryUpdate2){
                    alert("Update Successfull!", "../index.php");
                }
                else{
                    alert("Update Error!", "../index.php");
                }
            }
            else{
                alert("Update Error!", "../index.php");
            }

        }
        else{
            alert("Please fill all form!", "../index.php");
        }
    }
    else{
        header('location: ../index.php');
    }
?>