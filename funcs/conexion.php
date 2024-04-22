<?php

    $mysqli = new mysqli("localhost","root","","login");
    if(mysqli_connect_error()){
        echo 'pendejo', mysqli_connect_error();
        exit();
    }
?>