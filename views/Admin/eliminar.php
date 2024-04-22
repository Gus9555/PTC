<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>LifeLine</title>
    <link rel="icon" href="../assets/boss/images/favicon.png">
</head>

</html>
<?php
require '../../funcs/conexion.php';
if (!isset($_GET["id"])) {
    exit("No hay id");
}

// Incluir el archivo de conexión y asignar el objeto de conexión a la variable $mysqli

$id = $_GET["id"];
$id_tipo = $_GET["id_tipo"];

// Verificar si la conexión es válida
if ($mysqli instanceof mysqli) {

   
        $sentencia = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?");
        if (!$sentencia) {
            exit("Error en la preparación de la consulta: " . $mysqli->error);
        }
        $sentencia->bind_param("i", $id);
        if($id_tipo == 2)
        {
            if($sentencia->execute()) 
            {
             echo '<p><script>swal({
                 title: "Good job!",
                 text: "Succesfully deleted",
                 icon: "success",
                  }).then(function() {
                 window.location = "TablaU.php";
                 });</script></p>';
            }
        }
        else
        {
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "An andmin can not be deleted",
                icon: "error"
                }).then(function() {
                    window.location = "TablaU.php";
                    });</script></p>';
                 
            
        }
    

    
} else {
    exit("Error de conexión");
}

?>