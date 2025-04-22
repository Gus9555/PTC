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
require '../../funcs/conexion.php';

if (!isset($_POST["id"])) {
    exit("No hay id");
}

$id = $_POST["id"];
$id_tipo = $_POST["id_tipo"];

// Obtener la conexión PDO
$pdo = getConnection();

try {
    // Verificar si el usuario es Admin o Support
    $sentenciaVerificar = $pdo->prepare("SELECT id_tipo FROM users WHERE id = :id");
    $sentenciaVerificar->bindParam(':id', $id, PDO::PARAM_INT);
    $sentenciaVerificar->execute();
    $resultadoVerificar = $sentenciaVerificar->fetch(PDO::FETCH_ASSOC);

    if ($resultadoVerificar['id_tipo'] == 1 || $resultadoVerificar['id_tipo'] == 3) {
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Un usuario administrador o de soporte no puede ser desactivado",
            icon: "error",
            confirmButtonText: "OK",
            confirmButtonClass: "center-button"
        }).then(function() {
            window.location = "TablaU.php";
        });</script></p>';
        exit;
    }

    // Cambiar el estado del usuario según el valor de id_tipo
    $sentencia = $pdo->prepare("UPDATE users SET id_tipo = :id_tipo WHERE id = :id");
    if (!$sentencia) {
        exit("Error en la preparación de la consulta.");
    }
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
    $sentencia->bindParam(':id_tipo', $id_tipo, PDO::PARAM_INT);
    
    if ($id_tipo == 2 || $id_tipo == 4) {
        if ($sentencia->execute()) {
            $message = $id_tipo == 2 ? "Activado con éxito" : "Desactivado con éxito";
            echo '<p><script>Swal.fire({
                title: "¡Buen trabajo!",
                text: "' . $message . '",
                icon: "success",
                confirmButtonText: "OK",
                confirmButtonClass: "center-button"
            }).then(function() {
                window.location = "TablaU.php";
            });</script></p>';
        }
    } else {
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Un usuario administrador o de soporte no puede ser desactivado",
            icon: "error",
            confirmButtonText: "OK",
            confirmButtonClass: "center-button"
        }).then(function() {
            window.location = "TablaU.php";
        });</script></p>';
    }
} catch (PDOException $e) {
    exit("Error en la ejecución de la consulta: " . $e->getMessage());
}
?>

<style>
    .swal2-container .swal2-confirm {
        margin: 0 auto;
    }
</style>
