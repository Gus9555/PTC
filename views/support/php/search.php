<?php
session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = $_POST['searchTerm'];
$tipo_usuario = $_SESSION['tipo_usuario'];

try {
    $pdo = getConnection();

    if ($tipo_usuario == 2) {
        // id_tipo=2 solo puede buscar usuarios id_tipo=3
        $sql = "SELECT * FROM users WHERE NOT unique_id = :outgoing_id AND id_tipo = 3 AND nombre LIKE :searchTerm";
    } else if ($tipo_usuario == 3) {
        // id_tipo=3 solo puede buscar usuarios id_tipo=2 que le han enviado un mensaje
        $sql = "SELECT DISTINCT u.* FROM users u
                JOIN messages m ON m.outgoing_msg_id = u.unique_id
                WHERE m.incoming_msg_id = :unique_id AND u.id_tipo = 2 AND u.nombre LIKE :searchTerm";
    } else {
        echo 'Unauthorized access';
        exit;
    }

    $stmt = $pdo->prepare($sql);
    $searchTermWildcard = "%{$searchTerm}%";
    if ($tipo_usuario == 3) {
        $stmt->bindParam(':unique_id', $outgoing_id, PDO::PARAM_INT);
    }
    $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt->bindParam(':searchTerm', $searchTermWildcard, PDO::PARAM_STR);
    $stmt->execute();

    $output = "";
    if ($stmt->rowCount() > 0) {
        include_once "data.php";
    } else {
        $output .= 'No user found related to your search term';
    }
    echo $output;
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    exit;
}
?>
