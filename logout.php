<?php
    require_once "./helper/alert.php";

    session_start();
    session_destroy();
    alert("Logout successfull!", "./login.php");
?>