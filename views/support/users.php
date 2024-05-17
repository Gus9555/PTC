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

<body>

</body>

</html>
<?php
session_start();
require 'php/config.php'; // Aquí incluye el archivo que contiene la conexión a la base de datos

if (!isset($_SESSION['unique_id'])) {
    echo '<p><script>Swal.fire({
        title: "Warning",
        text: "LogIn again"
        }).then(function() {
        window.location = "../../views/index.php";
        });</script></p>';
    exit; // Salir del script si no hay sesión iniciada
}
$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
include_once "header.php";
?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
              $imagen_predeterminada = ($row['id_tipo'] == 2) ? "php/images/OIP_2.jpeg" : "php/images/support.png";
            }
          ?>
          <img src="<?php echo $imagen_predeterminada; ?>" alt="">
          <div class="details">
            <span><?php echo $row['nombre']. " " ?></span>
            <p><?php echo $row['estatus']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
        <!-- Aquí se mostrarán los usuarios -->
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
</body>


</html>
