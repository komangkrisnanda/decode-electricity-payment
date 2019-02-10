<?php
    require_once "../config/connection.php";
    require_once "../helper/alert.php";
    require_once "../helper/isAdmin.php";

    if(isset($_GET['code'])){
        $code = $conn->real_escape_string($_GET['code']);
        $queryCheckCode = $conn->query("SELECT tblogin.*, tbpelanggan.* FROM tblogin INNER JOIN tbpelanggan ON tbpelanggan.NoPelanggan = tblogin.Username WHERE tblogin.Username =$code");
        if($queryCheckCode->num_rows == 1){
            $queryDelete = $conn->query("DELETE FROM tblogin WHERE Username=$code");

            if($queryDelete){
                $queryDelete2 = $conn->query("DELETE FROM tbpelanggan WHERE NoPelanggan=$code");
                if($queryDelete2){
                    alert("Delete Successfull!", "./index.php");
                }
                else{
                    alert("Delete Failed! " . $conn->error, "./index.php");
                }
            }
            else{
                alert("Delete Failed!", "./index.php");
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