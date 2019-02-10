<?php
    require_once "../config/connection.php";
    require_once "../helper/alert.php";
    require_once "../helper/isAdmin.php";

    if(isset($_GET['code'])){
        $code = $conn->real_escape_string($_GET['code']);
        $queryCheckCode = $conn->query("SELECT * FROM tbtagihan WHERE KodeTagihan=$code");
        if($queryCheckCode->num_rows == 1){
            $queryDelete = $conn->query("DELETE FROM tbtagihan WHERE KodeTagihan=$code");

            if($queryDelete){
                alert("Delete Successfull!", "./index.php");
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