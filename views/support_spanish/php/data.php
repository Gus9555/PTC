<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sql2 = "SELECT * FROM messages 
             WHERE (incoming_msg_id = :unique_id OR outgoing_msg_id = :unique_id)
             AND (outgoing_msg_id = :outgoing_id OR incoming_msg_id = :outgoing_id)
             ORDER BY msg_id DESC LIMIT 1";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(':unique_id', $row['unique_id'], PDO::PARAM_INT);
    $stmt2->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    $result = $stmt2->rowCount() > 0 ? $row2['msg'] : "No hay mensajes disponibles";
    $msg = strlen($result) > 28 ? substr($result, 0, 28) . '...' : $result;
    $you = isset($row2['outgoing_msg_id']) ? ($outgoing_id == $row2['outgoing_msg_id'] ? "Tú: " : "") : "";
    $offline = $row['estatus'] == "Offline now" ? "desconectado" : "";
    $hid_me = $outgoing_id == $row['unique_id'] ? "ocultar" : "";
    $userTypeImage = $row['id_tipo'] == 2 ? "php/images/OIP_2.jpeg" : "php/images/support.png";

    $decryptedName = decryptPayload($row['nombre']); // Desencriptar el nombre

    $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                <div class="content">
                <img src="' . $userTypeImage . '" alt="">
                <div class="details">
                    <span>'. htmlspecialchars($decryptedName) . " " .'</span>
                    <p>'. htmlspecialchars($you . $msg) .'</p>
                </div>
                </div>
                <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
            </a>';
}
?>
