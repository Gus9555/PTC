<?php
<<<<<<< Updated upstream
    $mysqli = new mysqli("localhost","root","","lifeline");
=======

    $mysqli = new mysqli("localhost","root","Info2024/*-","login");
>>>>>>> Stashed changes
    if(mysqli_connect_error()){
        echo 'ERROR', mysqli_connect_error();
        exit();
    }
?>