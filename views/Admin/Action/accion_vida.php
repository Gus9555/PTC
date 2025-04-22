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

if (isset($_POST['id']) && isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    try {
        $pdo = getConnection();
        
        // Retrieve the email and name of the user
        $sql = "SELECT email FROM datos_medicos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $email = $user['email'];
            $nombre = $user['nombre'];

            if ($action === 'accept') {
                // Cambiar el estado de "activation" a 1 (acceptado)
                $sql = "UPDATE datos_medicos SET activation = 1 WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Send acceptance email
                $asunto = "Welcome to LIFELINE!";
                $cuerpo = "Dear $nombre,\n\nWe are pleased to inform you that your request has been accepted. Now your life and well-being has been insured with us, thank you";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "Good job!",
                    text: "Request accepted",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_datosVida.php";
                });</script></p>';
                
            } elseif ($action === 'denied') {
                // Cambiar el estado de "activation" a 3 (denied)
                $sql = "UPDATE datos_medicos SET activation = 2 WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Send denial email
                $asunto = "Request Denied";
                $cuerpo = "Dear $nombre,\n\nYour request for linking your vehicle to our platform has been denied. You should check the sent information and make another request,\nLIFELINE Team";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "Good job!",
                    text: "Request denied",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_datosVida.php";
                });</script></p>';
            } elseif ($action === 'deleted') {
                $sql = "DELETE from datos_medicos WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Send denial email
                $asunto = "Request Denied";
                $cuerpo = "Dear $nombre,\n\nYour request for linking your vehicle to our platform has been deleted. You should check the sent information and make another request,\nLIFELINE Team";
                enviarEmail($email, $nombre, $asunto, $cuerpo);

                echo '<p><script>Swal.fire({
                    title: "Good job!",
                    text: "Request deleted",
                    icon: "success"
                }).then(function() {
                    window.location = "../Tabla_datosVida.php";
                });</script></p>';
            } else {
                echo "Invalid action";
                echo '<p><script>Swal.fire({
                    title: "ERROR",
                    text: "Invalid action",
                    icon: "error"
                }).then(function() {
                    window.location = "../Tabla_datosVida.php";
                });</script></p>';
            }
        } else {
            echo "User not found";
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "User not found",
                icon: "error"
            }).then(function() {
                window.location = "../Tabla_datosVida.php";
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
        window.location = "../Tabla_datosVida.php";
    });</script></p>';
}
?>
