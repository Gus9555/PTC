<?php

    $mysqli = new mysqli("localhost","root","Info2024/*-","login");
    if(mysqli_connect_error()){
        echo 'Conexion Fallida: ', mysqli_connect_error();
        exit();
    }
?>