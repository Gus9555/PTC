<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'php/config.php'; // Aquí incluye el archivo que contiene la conexión a la base de datos

if (!isset($_SESSION['unique_id'])) {
  echo '<p><script>Swal.fire({
        title: "Warning",
        text: "LogIn again"
        }).then(function() {
        window.location = "../../views/user/login.php";
        });</script></p>';
  exit; // Salir del script si no hay sesión iniciada
}
$nombre = decryptPayload($_SESSION['nombre']) ?? null;
$tipo_usuario = $_SESSION['tipo_usuario'];
include_once "header.php";

try {
  $pdo = getConnection();
  $sql = "SELECT * FROM users WHERE unique_id = :unique_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':unique_id', $_SESSION['unique_id'], PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $imagen_predeterminada = ($row['id_tipo'] == 2) ? "php/images/OIP_2.jpeg" : "php/images/support.png";
  } else {
    header("location: users.php");
    exit;
  }

  // Ver usuarios según el tipo de usuario
  if ($tipo_usuario == 2) {
    // id_tipo=2 solo puede ver usuarios id_tipo=3
    $sql_users = "SELECT * FROM users WHERE id_tipo = 3";
  } else if ($tipo_usuario == 3) {
    // id_tipo=3 solo puede ver usuarios id_tipo=2 que le han enviado un mensaje
    $sql_users = "SELECT DISTINCT u.* FROM users u
                      JOIN messages m ON m.outgoing_msg_id = u.unique_id
                      WHERE m.incoming_msg_id = :unique_id AND u.id_tipo = 2";
  } else {
    // Otros tipos de usuarios no tienen acceso
    echo '<p><script>Swal.fire({
            title: "Warning",
            text: "Unauthorized access"
            }).then(function() {
            window.location = "../../views/user/login.php";
            });</script></p>';
    exit;
  }
  $stmt_users = $pdo->prepare($sql_users);
  if ($tipo_usuario == 3) {
    $stmt_users->bindParam(':unique_id', $_SESSION['unique_id'], PDO::PARAM_INT);
  }
  $stmt_users->execute();
  $users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo 'Query failed: ' . $e->getMessage();
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
 
  <title>LifeLine</title>
  <link rel="icon" href="../assets/boss/images/favicon.png">

  <!-- SEO Meta Tags -->
  <meta name="description"
    content="Tivo is a HTML landing page template built with Bootstrap to help you crate engaging presentations for SaaS apps and convert visitors into users.">
  <meta name="author" content="Inovatik">

  <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
  <meta property="og:site_name" content="" /> <!-- website name -->
  <meta property="og:site" content="" /> <!-- website link -->
  <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
  <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
  <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
  <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
  <meta property="og:type" content="article" />

  <!-- Website Title -->
  <title>LifeLine</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
    rel="stylesheet">
  <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
  <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
  <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
  <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
  <link href="../../assets/boss/css/styles.css" rel="stylesheet">
  <link href="../../assets/boss/css/styles3.css" rel="stylesheet">

  <!-- Favicon  -->
  <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">

  <style>
    body {
      background-color: #3b5d50; /* Change background color here */
    }
    .wrapper {
      margin-top: 70px;
      /* Ajusta este valor según el margen que desees */
    }
    .navbar-custom {
      background-color: #3b5d50;
    }
  </style>

</head>

<body>

  <!-- Preloader -->
  <div class="spinner-wrapper">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
  </div>
  <!-- end of preloader -->

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
    <?php if ($tipo_usuario == 2): ?>
      <a class="navbar-brand logo-image" href="../user/view_user.php"><img src="../../assets/boss/images/logo.png"
          alt="alternative"></a> <?php endif; ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-awesome fas fa-bars"></span>
        <span class="navbar-toggler-awesome fas fa-times"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <?php if ($tipo_usuario == 3): ?>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="finance.php">FINANCE USERS<span class="sr-only">(current)</span></a>
          </li>
          <?php endif; ?>
          <?php if ($tipo_usuario == 2): ?>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="../user/view_user.php">HOME <span class="sr-only">(current)</span></a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="../support_spanish/users.php">ESPAÑOL <span
                class="sr-only">(current)</span></a>
          </li>
        </ul>
        <span class="nav-item">
          <a class="btn-outline-sm" href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>">LOG OUT</a>
        </span>
      </div>
    </div>
  </nav>

  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <img src="<?php echo $imagen_predeterminada; ?>" alt="">
          <div class="details">
            <span><?php $nombre = decryptPayload($row['nombre']);
            echo htmlspecialchars($nombre) . " "; ?></span>
            <p><?php echo htmlspecialchars($row['estatus']); ?></p>
          </div>
        </div>
        
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
        <?php foreach ($users as $user) { ?>
          <div class="user">
            <img src="<?php echo ($user['id_tipo'] == 2) ? "php/images/OIP_2.jpeg" : "php/images/support.png"; ?>" alt="">
            <div class="details">
              <span><?php echo htmlspecialchars($user['nombre']); ?></span>
              <p><?php echo htmlspecialchars($user['estatus']); ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
  <!-- Scripts -->
  <script src="../../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
  <script src="../../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
  <script src="../../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
  <script src="../../assets/boss/js/jquery.easing.min.js"></script>
  <!-- jQuery Easing for smooth scrolling between anchors -->
  <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
  <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
  <!--<script src="js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
  <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>
