<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
    <title>LifeLine</title>
    <link rel="icon" href="../assets/boss/images/favicon.png">
</head>
<body>
    
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';
session_start();

$seguro = $_SESSION['seguro'];
$id = $_SESSION['id'];
$pdo = getConnection();

$stmt1 = 'SELECT "S_moto", "S_auto", "S_util", "S_casa", "S_vida" FROM users WHERE id = :id';
$query = $pdo->prepare($stmt1);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);


    if ($seguro >= 1 && $seguro <= 3 && $row['S_moto'] == null) {
        $stmt = $pdo->prepare('UPDATE users SET "S_moto" = :seguro WHERE id = :id');
        $stmt->bindParam(':seguro', $seguro, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $pago = $seguro == 1 ? 14.99 : ($seguro == 2 ? 24.99 : 49.99);
        $nombreSeguro = $seguro == 1 ? "Silver Motorcycle Insurance" : ($seguro == 2 ? "Golden Motorcycle Insurance" : "Diamond Motorcycle Insurance");
    } elseif ($seguro >= 4 && $seguro <= 6 && $row['S_auto'] == null) {
        $stmt = $pdo->prepare('UPDATE users SET "S_auto" = :seguro WHERE id = :id');
        $stmt->bindParam(':seguro', $seguro, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $pago = $seguro == 4 ? 24.99 : ($seguro == 5 ? 49.99 : 99.99);
        $nombreSeguro = $seguro == 4 ? "Silver Car Insurance" : ($seguro == 5 ? "Golden Car Insurance" : "Diamond Car Insurance");
    } elseif ($seguro >= 7 && $seguro <= 9 && $row['S_util'] == null) {
        $stmt = $pdo->prepare('UPDATE users SET "S_util" = :seguro WHERE id = :id');
        $stmt->bindParam(':seguro', $seguro, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $pago = $seguro == 7 ? 44.99 : ($seguro == 8 ? 84.99 : 149.99);
        $nombreSeguro = $seguro == 7 ? "Silver Industrial Vehicles Insurance" : ($seguro == 8 ? "Golden Industrial Vehicles Insurance" : "Diamond Industrial Vehicles Insurance");
    } elseif ($seguro >= 10 && $seguro <= 12 && $row['S_casa'] == null) {
        $stmt = $pdo->prepare('UPDATE users SET "S_casa" = :seguro WHERE id = :id');
        $stmt->bindParam(':seguro', $seguro, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $pago = $seguro == 10 ? 44.99 : ($seguro == 11 ? 84.99 : 199.99);
        $nombreSeguro = $seguro == 10 ? "Silver Home Insurance" : ($seguro == 11 ? "Golden Home Insurance" : "Diamond Home Insurance");
    } elseif ($seguro >= 13 && $seguro <= 15 && $row['S_vida'] == null) {
        $stmt = $pdo->prepare('UPDATE users SET "S_vida" = :seguro WHERE id = :id');
        $stmt->bindParam(':seguro', $seguro, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $pago = $seguro == 13 ? 24.99 : ($seguro == 14 ? 74.99 : 149.99);
        $nombreSeguro = $seguro == 13 ? "Silver Health Insurance" : ($seguro == 14 ? "Golden Health Insurance" : "Diamond Health Insurance");
    } else {
        echo '<p><script>swal({
            title: "ERROR!",
            text: "You already bought this type of insurance",
            icon: "error",
             }).then(function() {
            window.location = "../user/view_user.php";
            });</script></p>';
        exit;
    }

    if ($stmt->execute()) {
        echo '<p><script>swal({
            title: "SUCCESS!",
            text: "You bought one of our insurance plans",
            icon: "success",
             }).then(function() {
            window.location = "../user/view_user.php";
            });</script></p>';
    } else {
        echo '<p><script>swal({
            title: "ERROR!",
            text: "Failed to update insurance information",
            icon: "error",
             }).then(function() {
            window.location = "../user/view_user.php";
            });</script></p>';
    }
?>
