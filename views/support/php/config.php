<?php
  $hostname = "localhost";
  $username = "root";
  $password = "Info2024/*-";
  $dbname = "lifeline";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
