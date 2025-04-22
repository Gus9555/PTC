<?php
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$pdo = getConnection(); // Asegúrate de que esta función esté definida en conexion.php y retorne una conexión PDO

if (isset($_GET["id"]) && isset($_GET['val'])) {
    $idUsuario = $_GET['id'];
    $token = $_GET['val'];

    $mensaje = validaIdToken($idUsuario, $token, $pdo);
    echo $mensaje; // Mostrar el mensaje devuelto por la función
} else {
    echo '<p><script>Swal.fire({
            title: "Advertencia",
            text: "Faltan parámetros en la URL.",
            icon: "error"
            });</script></p>';
}
?>
