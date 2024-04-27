<?php
session_start();
include ('config/config.php');

if (isset($_SESSION['correo']) && isset($_SESSION['id']) && isset($_SESSION['imagen']) && isset($_SESSION['nombre'])) {
    $idConectado = $_SESSION['id'];
    $userId = $_POST['userId'];

    // Verificar si el usuario en sesión tiene permiso para borrar la conversación
    $QueryTipoUsuario = "SELECT id_tipo FROM users WHERE id = '$idConectado'";
    $resultTipoUsuario = mysqli_query($con, $QueryTipoUsuario);
    $rowTipoUsuario = mysqli_fetch_assoc($resultTipoUsuario);
    $idTipoUsuario = $rowTipoUsuario['id_tipo'];

    if ($idTipoUsuario == 3) {
        // Si el usuario en sesión es tipo 3, permitir borrar la conversación
        $deleteQuery = "DELETE FROM msjs WHERE (user_id = '$idConectado' AND to_id = '$userId') OR (user_id = '$userId' AND to_id = '$idConectado')";
        $result = mysqli_query($con, $deleteQuery);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Error al borrar la conversación"]);
        }
    } else {
        // Si el usuario en sesión no es tipo 3, no permitir borrar la conversación
        echo json_encode(["success" => false, "error" => "Permiso denegado"]);
    }
} else {
    // Si la sesión no es válida, retornar un mensaje de error
    echo json_encode(["success" => false, "error" => "Sesión no válida"]);
}
?>