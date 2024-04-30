<?php
    $mysqli = new mysqli("localhost","root","","lifeline");
    if(mysqli_connect_error()){
        echo 'ERROR', mysqli_connect_error();
        exit();
    }
?>