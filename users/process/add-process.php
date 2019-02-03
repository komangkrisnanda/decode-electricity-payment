<?php
    require_once "../../config/connection.php";
    require_once "../../helper/alert.php";

    if(isset($_POST['submit'])){
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $level = $conn->real_escape_string($_POST['level']);

        if(!empty($username) && !empty($password) && !empty($fullname) && !empty($level)){
            $queryCheck = $conn->query("SELECT * FROM tblogin WHERE Username='$username'");
            if($queryCheck->num_rows == 0){
                $encrypted_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $queryInsert = $conn->query("INSERT INTO tblogin VALUES (NULL, '$username', '$encrypted_password', '$fullname', '$level')");

                if($queryInsert){
                    alert("Insert Successfull!", "../index.php");
                }
                else{
                    alert("Insert Error!", "../add.php");
                }

            }
            else{
                alert("Please use another username!", "../add.php");
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