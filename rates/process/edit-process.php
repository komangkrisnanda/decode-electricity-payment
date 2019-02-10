<?php
    require_once "../../config/connection.php";
    require_once "../../helper/alert.php";
    require_once "../../helper/isAdmin.php";

    if(isset($_POST['submit'])){
        $code = $conn->real_escape_string($_POST['code']);
        $power = $conn->real_escape_string($_POST['power']);
        $rate = $conn->real_escape_string($_POST['rate']);
        $load = $conn->real_escape_string($_POST['load']);

        if(is_numeric($power) && is_numeric($rate) && is_numeric($load)){
            if($power >= 1 && $rate >= 0 && $load >= 0){
                $queryUpdate = $conn->query("UPDATE tbtarif SET Daya=$power, TarifPerKwh=$rate, Beban=$load WHERE KodeTarif=$code");

                if($queryUpdate){
                    alert("Update Successfull!", "../index.php");
                }
                else{
                    alert("Update Error!", "../index.php");
                }
            }
            else{
                alert("Enter a valid values!" , "../index.php");
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