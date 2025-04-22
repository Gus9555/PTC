<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';

if (!isset($_SESSION['id'])) {
    echo json_encode([]);
    exit;
}

$pdo = getConnection();

// Obtener usuarios pendientes de pago
$query = "SELECT nombre, correo, numero_telefonico, seguro, calidad, precio, fecha_compra 
          FROM compras 
          WHERE (fecha_compra::date + interval '30 days') <= CURRENT_DATE AND estado != 'pendiente'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$usuariosPendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($usuariosPendientes);
?>
