<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if (!isset($_SESSION['id'])) {
    echo '<script>Swal.fire({
          title: "Warning",
          text: "Login again",
          icon: "warning",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script>';
    exit;
}

// Database connection configuration
$pdo = getConnection();

// Verify the database connection
if (!$pdo) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Database connection failed.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/purchases.php";
          });</script>';
    exit;
}

// Get id_c (it may come from a form or URL)
$id_c = filter_input(INPUT_GET, 'id_c', FILTER_VALIDATE_INT);

if (!$id_c) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Invalid or missing purchase ID.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/purchases.php";
          });</script>';
    exit;
}

// Query to get the purchase data
$sql = "SELECT nombre, correo, numero_telefonico, estado, seguro, calidad, precio, fecha_compra, user_id FROM compras WHERE id_c = :id_c";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_c', $id_c, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Verify if a result was found
if ($result) {
    $user_id = $result['user_id'];
    $nombre = htmlspecialchars($result['nombre']);
    $correo = htmlspecialchars($result['correo']);
    $numero_telefonico = htmlspecialchars($result['numero_telefonico']);
    $estado = htmlspecialchars($result['estado']);
    $seguro = htmlspecialchars($result['seguro']);
    $calidad = htmlspecialchars($result['calidad']);
    $precio = htmlspecialchars($result['precio']);
    
    // Calculate the next payment date
    $fecha_compra = new DateTime($result['fecha_compra']);
    $fecha_proxima = $fecha_compra->modify('+30 days')->format('Y-m-d');

    $subject = "Invoice";
    $body = '
    <div style="font-family: Arial, sans-serif; color: #333;">
        <div style="background-color: #f7f7f7; padding: 20px;">
            <h2 style="color: #333;">Purchase Receipt</h2>
            <p>Dear ' . $nombre . ',</p>
            <p>Thank you for your purchase. Below are the details of your purchase:</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="background-color: #eee;">
                    <th style="padding: 10px; border: 1px solid #ccc; text-align: left;">Description</th>
                    <th style="padding: 10px; border: 1px solid #ccc; text-align: left;">Details</th>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Name</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $nombre . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Email</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $correo . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Phone Number</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $numero_telefonico . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Status</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $estado . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Insurance</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $seguro . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Quality</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $calidad . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Price</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">$' . $precio . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Next Payment Date</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $fecha_proxima . '</td>
                </tr>
            </table>
            <p style="margin-top: 20px;">If you have any questions, please do not hesitate to contact us.</p>
            <p>Sincerely,<br>The company team</p>
        </div>
    </div>';

    if (enviarEmail($correo, $nombre, $subject, $body)) {
        echo '<script>Swal.fire({
              title: "Success",
              text: "Email sent successfully.",
              icon: "success",
              confirmButtonText: "OK"
              }).then(function() {
              window.location = "../../views/user/purchases.php";
              });</script>';
    } else {
        echo '<script>Swal.fire({
              title: "Error",
              text: "Email could not be sent.",
              icon: "error",
              confirmButtonText: "OK"
              }).then(function() {
              window.location = "../../views/user/purchases.php";
              });</script>';
    }
} else {
    echo '<script>Swal.fire({
          title: "Error",
          text: "No purchase found with the provided ID.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/purchases.php";
          });</script>';
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Tivo is a HTML landing page template built with Bootstrap to help you create engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags -->
    <meta property="og:site_name" content="" />
    <meta property="og:site" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>LifeLine</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand logo-image" href="index.php"><img src="../../assets/boss/images/logo.png" alt="alternative"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="users.php">CHAT<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="finance.php">FINANCE <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../support_spanish/users.php">ESPAÑOL <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>">LOG OUT</a>
                </span>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>The invoice has been successfully sent to your Gmail!</h1>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->

    <!-- Content ---->
         <!-- Details -->
         <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Thank you for choosing us</h2>
                        <p>thank you for trusting us, your life and your loved ones, for trusting us to protect your belongings, at lifeline we work for a safer future for you, we hope to see you soon
                        </p>

                        <a class="btn-solid-reg page-scroll"
                            href="view_user.php">home</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/boss/images/gud.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-1 -->
    <!-- end of details -->
    <!-- Content ---->

    <!-- Footer -->
    <svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79">
        <defs>
            <style>.cls-2 { fill: #3b5d50; }</style>
        </defs>
        <path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)" />
    </svg>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>About Tivo</h4>
                        <p class="p-small">We're passionate about offering some of the best business growth services for startups.</p>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-square"></i>
                                <div class="media-body">Our business partners <a class="white" href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media"><i class="fas fa-square"></i>
                                <div class="media-body">Read our <a class="white" href="terms-conditions.html">Terms & Conditions</a>, <a class="white" href="privacy-policy.html">Privacy Policy</a></div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">22 Innovative, San Francisco, CA 94043, US</div>
                            </li>
                            <li class="media"><i class="fas fa-envelope"></i>
                                <div class="media-body"><a class="white" href="mailto:contact@Tivo.com">contact@Tivo.com</a></div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Template by Inovatik</a></p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->

    <!-- Scripts -->
    <script src="../../assets/boss/js/jquery.min.js"></script>
    <script src="../../assets/boss/js/popper.min.js"></script>
    <script src="../../assets/boss/js/bootstrap.min.js"></script>
    <script src="../../assets/boss/js/jquery.easing.min.js"></script>
    <script src="../../assets/boss/js/swiper.min.js"></script>
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script>
    <script src="../../assets/boss/js/scripts.js"></script>

</body>

</html>
