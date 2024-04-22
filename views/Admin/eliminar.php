<?php
if (!isset($_GET["id"])) {
exit("No hay id");
}
$mysqli = include_once "../../funcs/conexion.php";
$id = $_GET["id"];
$sentencia = $mysqli->prepare("DELETE FROM usuarios  WHERE id = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
header("Location: TablaU.php");