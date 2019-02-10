<?php
    require_once "../../config/connection.php";
    require_once "../../helper/alert.php";
    require_once "../../helper/isAdmin.php";

    if(isset($_POST['submit'])){
        $code = $conn->real_escape_string($_POST['code']);
        $password = $conn->real_escape_string($_POST['password']);
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $level = $conn->real_escape_string($_POST['level']);

        if(!empty($fullname) && !empty($level)){
            if(!empty($password)){
                $encrypted_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $queryUpdate = $conn->query("UPDATE tblogin SET  Password='$encrypted_password', NamaLengkap='$fullname', Level='$level' WHERE KodeLogin=$code");
            }
            else{
                $queryUpdate = $conn->query("UPDATE tblogin SET NamaLengkap='$fullname', Level='$level' WHERE KodeLogin=$code");
            }

            if($queryUpdate){
                alert("Update successfull!", "../index.php");
            }
            else{
                alert("Update failed!", "../index.php");
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