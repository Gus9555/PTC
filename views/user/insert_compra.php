<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $order_id = $data['orderID'] ?? null;
    $seguro_id = $data['seguroID'] ?? null;
    $id_comprador = $_SESSION['id'] ?? null;

    if (!$order_id || !filter_var($seguro_id, FILTER_VALIDATE_INT) || !filter_var($id_comprador, FILTER_VALIDATE_INT)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        exit;
    }

    try {
        $pdo = getConnection();
        $stmt = $pdo->prepare("INSERT INTO compras (order_id, seguro_id, id_comprador) VALUES (:order_id, :seguro_id, :id_comprador)");
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_STR);
        $stmt->bindParam(':seguro_id', $seguro_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_comprador', $id_comprador, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Purchase registered successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to register the purchase']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
