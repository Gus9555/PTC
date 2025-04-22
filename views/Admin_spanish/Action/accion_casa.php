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

if (isset($_POST['id']) && isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    try {
        $pdo = getConnection();
        
        // Retrieve the email and name of the user
        $sql = "SELECT email FROM datos_propiedad WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $email = $user['email'];
            $nombre = $user['nombre'];

            if ($action === 'accept') {
                // Cambiar el estado de "activation" a 1 (acceptado)
                $sql = "UPDATE datos_propiedad SET activation = 1 WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Send acceptance email
                $asunto = "Bienvenido a LifeLine";
                $cuerpo = "Estimado $nombre,\n\nNos complace informarle que su solicitud ha sido aceptada. Ahora su vida y bienestar están asegurados con nosotros, gracias";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "¡Buen trabajo!",
                    text: "Solicitud aceptada",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_datosVehi.php";
                });</script></p>';
                
            } elseif ($action === 'denied') {
                // Cambiar el estado de "activation" a 3 (denegado)
                $sql = "UPDATE datos_propiedad SET activation = 2 WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Send denial email
                $asunto = "Solicitud Denegada";
                $cuerpo = "Estimado $nombre,\n\nSu solicitud para vincular su vehículo a nuestra plataforma ha sido denegada. Debe revisar la información enviada y realizar otra solicitud,\nEquipo LIFELINE";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "¡Buen trabajo!",
                    text: "Solicitud denegada",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_datosCasa.php";
                });</script></p>';
            } elseif ($action === 'deleted') {
                $sql = "DELETE from datos_propiedad WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Send denial email
                $asunto = "Solicitud Eliminada";
                $cuerpo = "Estimado $nombre,\n\nSu solicitud para vincular su vehículo a nuestra plataforma ha sido eliminada. Debe revisar la información enviada y realizar otra solicitud,\nEquipo LIFELINE";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "¡Buen trabajo!",
                    text: "Solicitud eliminada",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_datosCasa.php";
                });</script></p>';
            } else {
                echo "Acción no válida";
                echo '<p><script>Swal.fire({
                    title: "ERROR",
                    text: "Acción no válida",
                    icon: "error"
                }).then(function() {
                    window.location = "../Tabla_datosCasa.php";
                });</script></p>';
            }
        } else {
            echo "Usuario no encontrado";
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "Usuario no encontrado",
                icon: "error"
            }).then(function() {
                window.location = "../Tabla_datosCasa.php";
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
        window.location = "../Tabla_datosCasa.php";
    });</script></p>';
}
?>
