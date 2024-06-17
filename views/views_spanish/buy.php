<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>LifeLine</title>
</head>
<body>
    
</body>
</html>
<?php
require '../funcs/conexion.php';
require '../funcs/funcs.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
          title: "OPS",
          text: "Logueate otra vez"
          }).then(function() {
          window.location = "../views/login.php";
          });</script></p>';
    exit; // Salir del script si no hay sesión iniciada
}


$id = $_SESSION['id'];
$stmt = $mysqli->prepare("SELECT nombre, correo FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
$rows = $stmt->num_rows;

if ($rows > 0) {
    $stmt->bind_result($nombre, $email);
    $stmt->fetch();
}
$url = 'http://' . $_SERVER["SERVER_NAME"] . ':81/PTC/views/cotizacion.php';
//el asuto y cuerpo es lo que ira en el mesaje del correo$file = $pdf;
$asunto = 'PRICE QUOTE - LIFELINE';
$cuerpo = "Dear $nombre: <br /><br />Price Quote <br /><br /> Start buying insurance <a href='$url'>Price Quote</a>";
if (enviarPDF($email, $nombre, $asunto, $cuerpo)) {
    
}
?>