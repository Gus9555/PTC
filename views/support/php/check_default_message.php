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
            $default_message = "Please wait a moment and one of our consultants will assist you.

In the meantime, you can give us the details of your inquiry, your data to start your management.
->Full name
->Email
->Phone number
->Unique PIN of your account
(if you don't remember your PIN, check the email we sent you when you registered with us).";
            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, is_default) VALUES (:incoming_id, :outgoing_id, :message, TRUE)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':incoming_id', $outgoing_id, PDO::PARAM_INT);
            $stmt->bindParam(':outgoing_id', $incoming_id, PDO::PARAM_INT);
            $stmt->bindParam(':message', $default_message, PDO::PARAM_STR);
            $stmt->execute();

            echo "Default message sent.";
        } else {
            echo "Default message already sent.";
        }
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        exit;
    }
} else {
    echo "User is not logged in.";
    header("location: ../login.php");
    exit;
}
?>
