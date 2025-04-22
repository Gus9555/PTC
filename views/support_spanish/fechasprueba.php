<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';

// Verificar si la sesión está activa
if (!isset($_SESSION['id'])) {
    echo '<script>Swal.fire({
          title: "Warning",
          text: "Login again",
          icon: "warning",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script>';
    exit;
}

$pdo = getConnection();

// Comprueba si la conexión es exitosa
if (!$pdo) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Database connection failed.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "paypal.php";
          });</script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];

    // Retrasar la fecha de compra 30 días en PostgreSQL
    $sql = "UPDATE compras SET fecha_compra = fecha_compra - INTERVAL '30 days' WHERE correo = :correo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correo', $correo);

    if ($stmt->execute()) {
        echo '<script>Swal.fire({
            title: "Success",
            text: "Fecha de compra modificada con éxito.",
            icon: "success",
            confirmButtonText: "OK"
        });</script>';
    } else {
        echo '<script>Swal.fire({
            title: "Error",
            text: "Error al modificar la fecha.",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Fecha de Compra</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h2>Modificar Fecha de Compra</h2>
    <form method="POST">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <button type="submit">Modificar Fecha</button>
    </form>
</body>
</html>
