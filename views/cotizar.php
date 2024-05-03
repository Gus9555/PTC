<?php
require '../funcs/conexion.php';
require '../funcs/funcs.php';
session_start();

  if (!isset($_SESSION['id'])) {
      echo '<p><script>Swal.fire({
          title: "Warning",
          text: "LogIn again"
          }).then(function() {
          window.location = "../views/index.php";
          });</script></p>';
      exit; // Salir del script si no hay sesión iniciada
  }
  $id = $_SESSION['id'];
  $stmt = $mysqli->prepare("SELECT correo FROM users WHERE id = ? LIMIT 1");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->store_result();
  $rows = $stmt->num_rows;

    if ($rows > 0) {
        $stmt->bind_result($correo);
        $stmt->fetch();}
 if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {
        
    echo '<p><script>swal({
        title: "Good job!",
        text: "Succesfully, Confirm your identity in your email ",
        icon: "success",
         }).then(function() {
        window.location = "../views/index.php";
        });</script></p>';
}
?>