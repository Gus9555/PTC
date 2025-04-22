<?php
require '../../funcs/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = htmlspecialchars($_POST['user_id']);
    $seguro = htmlspecialchars($_POST['seguro']);
    $calidad = htmlspecialchars($_POST['calidad']);
    $precio = htmlspecialchars($_POST['precio']);

    // Obtener la compra más reciente basada en user_id y id_c
    $pdo = getConnection();
    $stmt = $pdo->prepare("
        SELECT id_c 
        FROM compras 
        WHERE user_id = :user_id 
        AND seguro = :seguro 
        AND calidad = :calidad 
        AND precio = :precio
        ORDER BY fecha_compra DESC 
        LIMIT 1
    ");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':seguro', $seguro, PDO::PARAM_STR);
    $stmt->bindParam(':calidad', $calidad, PDO::PARAM_STR);
    $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && isset($row['id_c'])) {
        $id_c = $row['id_c'];

        // Actualizar el estado de la compra más reciente
        $stmt = $pdo->prepare("UPDATE compras SET estado = 'activo', fecha_compra = CURRENT_DATE WHERE id_c = :id_c");
        $stmt->bindParam(':id_c', $id_c, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    } else {
        echo json_encode(['status' => 'error']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
?>
