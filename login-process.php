<?php
    require_once "./config/connection.php";
    require_once "./helper/alert.php";

    if(isset($_POST['submit'])){
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);

        $queryCheck = $conn->query("SELECT * FROM tblogin WHERE Username='$username'");
        if($queryCheck->num_rows == 1){
            $data = $queryCheck->fetch_assoc();
            $encrypted_password = $data['Password'];
           
            if(password_verify($password, $encrypted_password)){
                $_SESSION['NamaLengkap'] = $data['NamaLengkap'];
                $_SESSION['Level'] = $data['Level'];
                alert("Login Successfull! Welcome $data[NamaLengkap] !", "./dashboard/index.php");
            }
            else{
                alert("Wrong username / password combination!", "./login.php");
            }
        }
        else{
            alert("Username not found", "./login.php");
        }
    }
    else{
        header('location: ./login.php');
    }
?>