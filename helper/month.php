<?php
    function getMonthName($month){
        $months_name = ["January","February","March","April","May","June","July", "August", "September", "October", "November", "December"];

        return $months_name[$month - 1];
    }
?>