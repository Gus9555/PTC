<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
   
    <title>LifeLine</title>
    <link rel="icon" href="../assets/boss/images/favicon.png">
</head>

</html>
<?php
require_once '../../../funcs/conexion.php';
require_once '../../../funcs/funcs.php';
 // Include the email function

if (isset($_POST['id']) && isset($_POST['id_tipo']) && isset($_POST['action'])) {
    $id = $_POST['id'];
    $id_tipo = $_POST['id_tipo'];
    $action = $_POST['action'];

    try {
        $pdo = getConnection();
        
        // Retrieve the email and name of the user
        $sql = "SELECT email, nombre_taller FROM talleres WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $email = $user['email'];
            $nombre = $user['nombre_taller'];

            if ($action === 'accept') {
                // Cambiar el estado de "activation" a 1 (aceptado)
                $sql = "UPDATE talleres SET activation = 1 WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $url = 'http://' . $_SERVER["SERVER_NAME"] . '/PTC2/views/Admin_spanish/register_partner/registro.php';

                // Enviar email de aceptación
                $asunto = "¡Bienvenido a LIFELINE!";
                $cuerpo = "Estimado $nombre,\n\nNos complace informarle que su solicitud ha sido aceptada. Bienvenido a LIFELINE.\n\nSaludos cordiales,\nEquipo de LIFELINE. \n\n\n Edite su perfil cuando lo desee--> <a href='$url'>Registre su cuenta aquí</a>";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "¡Buen trabajo!",
                    text: "Solicitud aceptada",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_taller.php";
                });</script></p>';
                
            } elseif ($action === 'denied') {
                // Cambiar el estado de "activation" a 3 (denegado)
                $sql = "UPDATE talleres SET activation = 3 WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Enviar email de rechazo
                $asunto = "Solicitud Denegada";
                $cuerpo = "Estimado $nombre,\n\nLamentamos informarle que su solicitud ha sido denegada. Desafortunadamente, no cumple con los requisitos para unirse a LIFELINE.\n\nSaludos cordiales,\nEquipo de LIFELINE";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "¡Buen trabajo!",
                    text: "Solicitud denegada",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_taller.php";
                });</script></p>';
            } else {
                echo "Acción no válida";
                echo '<p><script>Swal.fire({
                    title: "ERROR",
                    text: "Acción no válida",
                    icon: "error"
                }).then(function() {
                    window.location = "../Tabla_taller.php";
                });</script></p>';
            }
        } else {
            echo "Usuario no encontrado";
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "Usuario no encontrado",
                icon: "error"
            }).then(function() {
                window.location = "../Tabla_taller.php";
            });</script></p>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Parámetros no válidos";
    echo '<p><script>Swal.fire({
        title: "ERROR",
        text: "Parámetros no válidos",
        icon: "error"
    }).then(function() {
        window.location = "../Tabla_taller.php";
    });</script></p>';
}
?>
