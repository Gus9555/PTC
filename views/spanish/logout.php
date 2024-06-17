<?php
    session_start();
    session_destroy();
    header("Location: ../../views/spanish/login.php");    
?>