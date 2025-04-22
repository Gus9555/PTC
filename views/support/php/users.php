<?php
session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];

try {
    $pdo = getConnection();

    // Obtener el rol del usuario actual
    $sql = "SELECT id_tipo FROM users WHERE unique_id = :outgoing_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_role = $user['id_tipo'];

    // Construir la consulta según el rol del usuario actual
    if ($user_role == 3) {
        // Si el usuario es soporte (id_tipo = 3), mostrar solo usuarios con rol de soporte (id_tipo = 2) que le han enviado un mensaje
        $sql = "SELECT DISTINCT users.*, 
                       (SELECT COUNT(*) 
                        FROM messages 
                        WHERE (outgoing_msg_id = users.unique_id AND incoming_msg_id = :outgoing_id)
                        OR (outgoing_msg_id = :outgoing_id AND incoming_msg_id = users.unique_id)) AS message_count
                FROM users 
                JOIN messages ON users.unique_id = messages.outgoing_msg_id
                WHERE users.id_tipo = 2 AND messages.incoming_msg_id = :outgoing_id
                ORDER BY message_count DESC, users.unique_id DESC";
    } else if ($user_role == 2) {
        // Si el usuario es normal (id_tipo = 2), mostrar solo usuarios de soporte (id_tipo = 3)
        $sql = "SELECT users.*, 
                       (SELECT COUNT(*) 
                        FROM messages 
                        WHERE (outgoing_msg_id = users.unique_id AND incoming_msg_id = :outgoing_id)
                        OR (outgoing_msg_id = :outgoing_id AND incoming_msg_id = users.unique_id)) AS message_count
                FROM users 
                WHERE users.id_tipo = 3 AND users.unique_id != :outgoing_id 
                ORDER BY message_count DESC, users.unique_id DESC";
    } else {
        // Si el usuario no es ni de soporte ni normal, no mostrar nada
        $output = "No users are available to chat";
        echo $output;
        exit;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt->execute();

    $output = "";
    if ($stmt->rowCount() == 0) {
        $output .= "No users are available to chat";
    } else {
        include_once "data.php";
    }
    echo $output;
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    exit;
}
?>
