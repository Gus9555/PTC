<?php
//parte de yoha 2
require '../funcs/conexion.php';
require '../funcs/funcs.php';

if (isset($_GET["id"]) and isset($_GET['val'])) {
    $idUsuario = $_GET['id'];
    $token = $_GET['val'];

    $mensaje = validaIdToken($idUsuario, $token);
}

?>