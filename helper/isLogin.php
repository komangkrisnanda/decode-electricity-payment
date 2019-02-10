<?php
    @session_start();

    if(@$_SESSION['Level'] == "Admin" || @$_SESSION['Level'] == "Operator"){
        header('location: http://localhost:8087/ukk-repalti/decode-electricity-payment/dashboard/index.php');
        die();
    }
?>