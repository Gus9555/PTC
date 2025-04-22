<?php
session_start();
include_once "config.php";
 
if(isset($_SESSION['unique_id'])){
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = $_POST['incoming_id'];
 
    try {
        $pdo = getConnection();
 
        // Suponiendo que hay una columna 'is_active' para marcar el chat como inactivo
        $sql = "DELETE FROM messages WHERE (outgoing_msg_id = :outgoing_id AND incoming_msg_id = :incoming_id)
                OR (outgoing_msg_id = :incoming_id AND incoming_msg_id = :outgoing_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
        $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
 
        if ($stmt->execute()) {
            echo "Chat finalizado con exito.";
        } else {
            echo "finalizacion del chat no exitosa.";
        }
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        exit;
    }
} else {
    header("location: ../login.php");
    exit;
}
?>
