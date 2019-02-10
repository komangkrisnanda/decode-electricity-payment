<?php
    @session_start();

    if(@$_SESSION['Level'] != "Admin"){
        header('location: http://localhost:8087/ukk-repalti/decode-electricity-payment/login.php');
        die();
    }
?>