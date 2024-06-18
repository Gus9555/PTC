<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>LifeLine</title>
    <link rel="icon" href="../assets/boss/images/favicon.png">
</head>
<body>
    
</body>
</html>
<?php 
require '../funcs/conexion.php';
require '../funcs/funcs.php';
session_start();
$seguro = $_SESSION['seguro'];
$id = $_SESSION['id'];

$stmt1 = "SELECT S_moto, S_auto, S_util, S_casa, S_vida FROM users WHERE id =".$id; // ? indica que va un valor ahi
$result = $mysqli->query($stmt1);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
    

if ($seguro >= 1 && $seguro <= 3 && $row['S_moto'] == null) {
    $stmt = $mysqli->prepare("UPDATE users SET S_moto =".$seguro." WHERE id=".$id);
} elseif ($seguro >= 4 && $seguro <= 6 && $row['S_auto'] == null) {
    $stmt = $mysqli->prepare("UPDATE users SET S_auto =".$seguro." WHERE id=".$id);
} elseif ($seguro >= 7 && $seguro <= 9 && $row['S_util'] == null) {
    $stmt = $mysqli->prepare("UPDATE users SET S_util =".$seguro." WHERE id=".$id);
}elseif ($seguro >= 10 && $seguro <= 12 && $row['S_casa'] == null) {
    $stmt = $mysqli->prepare("UPDATE users SET S_casa =".$seguro." WHERE id=".$id);
}elseif ($seguro >= 13 && $seguro <= 15  && $row['S_vida'] == null) {
    $stmt = $mysqli->prepare("UPDATE users SET S_vida =".$seguro." WHERE id=".$id);
} else {
    $stmt = "100";
    echo '<p><script>swal({
        title: "ERROR!",
        text: "You already bought this type of insurance",
        icon: "error",
         }).then(function() {
        window.location = "../views/view_user.php";
        });</script></p>';
}
if($stmt != "100"){ 
if ($stmt->execute()) {
    return $mysqli;
} else {
    //y si no hara el return en falso 
    echo "ERROR";
    return 0;
}
}
?>