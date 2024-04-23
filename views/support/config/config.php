<?php
    $usuario  = "root";
    $password = "Info2024/*-";
    $servidor = "localhost";
    $basededatos = "lifeline";
    $con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
    $db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");
