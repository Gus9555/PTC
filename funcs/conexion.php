<?php
    $mysqli = new mysqli("localhost","root","Info2024/*-","Lifeline");
    if(mysqli_connect_error()){
        echo 'ERROR', mysqli_connect_error();
        exit();
    }
?>