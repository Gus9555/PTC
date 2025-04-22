<?php
require '../../funcs/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = htmlspecialchars($_POST['user_id']);
    $seguro = htmlspecialchars($_POST['seguro']);
    $calidad = htmlspecialchars($_POST['calidad']);
    $precio = htmlspecialchars($_POST['precio']);

    // Actualizar el estado de la compra en la base de datos
    $pdo = getConnection();
    $stmt = $pdo->prepare("UPDATE compras SET estado = 'activo', fecha_compra = CURRENT_DATE WHERE user_id = :user_id AND seguro = :seguro AND calidad = :calidad AND precio = :precio");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':seguro', $seguro, PDO::PARAM_STR);
    $stmt->bindParam(':calidad', $calidad, PDO::PARAM_STR);
    $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
?>
