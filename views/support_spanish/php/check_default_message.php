<?php
session_start();
include_once "config.php";

if(isset($_SESSION['unique_id'])){
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = $_POST['incoming_id'];

    try {
        $pdo = getConnection();

        // Verificar si ya se ha enviado el mensaje predeterminado
        $sql = "SELECT COUNT(*) as count FROM messages WHERE incoming_msg_id = :incoming_id AND outgoing_msg_id = :outgoing_id AND is_default = TRUE";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':incoming_id', $outgoing_id, PDO::PARAM_INT);
        $stmt->bindParam(':outgoing_id', $incoming_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 0) {
            // Enviar mensaje predeterminado
            $default_message = "Por favor, espere un momento y uno de nuestros consultores le asistirá.

Mientras tanto, puede darnos los detalles de su consulta, sus datos para comenzar su gestión.
->Nombre completo
->Correo electrónico
->Número de teléfono
->PIN único de su cuenta
(Si no recuerda su PIN, revise el correo que le enviamos cuando se registró con nosotros).";
            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, is_default) VALUES (:incoming_id, :outgoing_id, :message, TRUE)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':incoming_id', $outgoing_id, PDO::PARAM_INT);
            $stmt->bindParam(':outgoing_id', $incoming_id, PDO::PARAM_INT);
            $stmt->bindParam(':message', $default_message, PDO::PARAM_STR);
            $stmt->execute();

            echo "Mensaje predeterminado enviado.";
        } else {
            echo "Mensaje predeterminado ya enviado.";
        }
    } catch (PDOException $e) {
        echo 'La consulta falló: ' . $e->getMessage();
        exit;
    }
} else {
    echo "El usuario no ha iniciado sesión.";
    header("location: ../login.php");
    exit;
}
?>
