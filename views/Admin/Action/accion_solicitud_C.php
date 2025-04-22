<!DOCTYPE html>
<html lang="en">

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
        $sql = "SELECT email, nombre_constructora FROM constructuras WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $email = $user['email'];
            $nombre = $user['nombre_constructora'];

            if ($action === 'accept') {
                // Cambiar el estado de "activation" a 1 (acceptado)
                $sql = "UPDATE constructuras SET activation = 1 WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $url = 'http://' . $_SERVER["SERVER_NAME"] . '/PTC2/views/Admin/register_partner/registro.php';

                // Send acceptance email
                $asunto = "Welcome to LIFELINE!";
                $cuerpo = "Dear $nombre,\n\nWe are pleased to inform you that your request has been accepted. Welcome to LIFELINE.\n\nBest regards,\nLIFELINE Team. \n\n\n Edit your profile whenever you want--> <a href='$url'>Register your account here</a>";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "Good job!",
                    text: "Request accepted",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_contructora.php";
                });</script></p>';
                
            } elseif ($action === 'denied') {
                // Cambiar el estado de "activation" a 3 (denied)
                $sql = "UPDATE constructuras SET activation = 3 WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Send denial email
                $asunto = "Request Denied";
                $cuerpo = "Dear $nombre,\n\nWe regret to inform you that your request has been denied. Unfortunately, you do not meet the requirements to join LIFELINE.\n\nBest regards,\nLIFELINE Team";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "Good job!",
                    text: "Request denied",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_contructora.php";
                });</script></p>';
            } else {
                echo "Invalid action";
                echo '<p><script>Swal.fire({
                    title: "ERROR",
                    text: "Invalid action",
                    icon: "error"
                }).then(function() {
                    window.location = "../Tabla_contructora.php";
                });</script></p>';
            }
        } else {
            echo "User not found";
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "User not found",
                icon: "error"
            }).then(function() {
                window.location = "../Tabla_constructora.php";
            });</script></p>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Invalid parameters";
    echo '<p><script>Swal.fire({
        title: "ERROR",
        text: "Invalid parameters",
        icon: "error"
    }).then(function() {
        window.location = "../Tabla_contructora.php";
    });</script></p>';
}
?>