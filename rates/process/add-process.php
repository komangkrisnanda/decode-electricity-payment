<?php
    require_once "../../config/connection.php";
    require_once "../../helper/alert.php";
    require_once "../../helper/isAdmin.php";

    if(isset($_POST['submit'])){
        $power = $conn->real_escape_string($_POST['power']);
        $rate = $conn->real_escape_string($_POST['rate']);
        $load = $conn->real_escape_string($_POST['load']);

        if(is_numeric($power) && is_numeric($rate) && is_numeric($load)){
            if($power >= 1 && $rate >= 0 && $load >= 0){
                $queryInsert = $conn->query("INSERT INTO tbtarif VALUES (NULL, $power, $rate, $load)");

                if($queryInsert){
                    alert("Insert Successfull!", "../index.php");
                }
                else{
                    alert("Insert Error!", "../add.php");
                }
            }
            else{
                alert("Enter a valid values!" , "../add.php");
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