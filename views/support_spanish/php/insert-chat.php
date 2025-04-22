<?php 
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];
    $is_default = isset($_POST['is_default']) ? 'T' : 'F';

    if(!empty($message)){
        try {
            $pdo = getConnection();
            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, is_default) VALUES (:incoming_id, :outgoing_id, :message, :is_default)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
            $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->bindParam(':is_default', $is_default, PDO::PARAM_STR);

            if($stmt->execute()){
                echo "Mensaje insertado correctamente.";
            } else {
                echo "Error al insertar el mensaje.";
            }
        } catch (PDOException $e) {
            echo 'La consulta falló: ' . $e->getMessage();
            exit;
        }
    } else {
        echo "El mensaje está vacío.";
    }
} else {
    echo "El usuario no ha iniciado sesión.";
    header("location: ../login.php");
    exit;
}
?>
