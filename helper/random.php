<?php
    function randomNumber($length){
        $numbers = "0123456789" . time();
        $shuffle = str_shuffle($numbers);
        $random = substr($shuffle, 0, $length);
        return $random;
    }

    function randomString($length){
        $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shuffle = str_shuffle($string);
        $random = substr($shuffle, 0, $length);
        return $random;
    }
?>