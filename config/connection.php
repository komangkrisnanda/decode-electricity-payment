<?php
    session_start();
    
    $host   = "localhost";
    $user   = "root";
    $pass   = "";
    $db     = "decode_electricity";

    @$conn   = new Mysqli($host, $user, $pass, $db);
    if($conn->connect_error){
        die("Something Error ! " . $conn->connect_error);
    }
?>