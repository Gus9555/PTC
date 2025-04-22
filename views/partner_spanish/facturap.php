<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if (!isset($_SESSION['id'])) {
    echo '<script>Swal.fire({
          title: "Advertencia",
          text: "Inicia sesión nuevamente",
          icon: "warning",
          confirmButtonText: "Aceptar"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script>';
    exit;
}

// Configuración de la conexión a la base de datos
$pdo = getConnection();

// Verificar la conexión a la base de datos
if (!$pdo) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Fallo en la conexión a la base de datos.",
          icon: "error",
          confirmButtonText: "Aceptar"
          }).then(function() {
          window.location = "../../views/user/purchases.php";
          });</script>';
    exit;
}

// Obtener id_compra (puede provenir de un formulario o URL)
$id_compra = filter_input(INPUT_GET, 'id_compra', FILTER_VALIDATE_INT);

if (!$id_compra) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "ID de compra inválido o ausente.",
          icon: "error",
          confirmButtonText: "Aceptar"
          }).then(function() {
          window.location = "../../views/user/purchases.php";
          });</script>';
    exit;
}

// Consulta para obtener los datos de la compra
$sql = "SELECT nombre, correo, plan, precio, fecha_compra FROM compra_plan WHERE id = :id_compra";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró un resultado
if ($result) {
    $nombre = decryptPayload($result['nombre']);
    $correo = decryptPayload($result['correo']);

    $plan = htmlspecialchars($result['plan']);
    $precio = htmlspecialchars($result['precio']);
    
    // Calcular la fecha del próximo pago
    $fecha_compra = new DateTime($result['fecha_compra']);
    $fecha_proxima = $fecha_compra->modify('+30 days')->format('Y-m-d');

    $subject = "Factura";
    $body = '
    <div style="font-family: Arial, sans-serif; color: #333;">
        <div style="background-color: #f7f7f7; padding: 20px;">
            <h2 style="color: #333;">Recibo de Compra</h2>
            <p>Estimado ' . $nombre . ',</p>
            <p>Gracias por tu compra. A continuación, los detalles de tu compra:</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="background-color: #eee;">
                    <th style="padding: 10px; border: 1px solid #ccc; text-align: left;">Descripción</th>
                    <th style="padding: 10px; border: 1px solid #ccc; text-align: left;">Detalles</th>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Nombre</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $nombre . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Correo Electrónico</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $correo . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Plan</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $plan . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Precio</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">$' . $precio . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">Fecha del Próximo Pago</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">' . $fecha_proxima . '</td>
                </tr>
            </table>
            <p style="margin-top: 20px;">Si tienes alguna pregunta, no dudes en contactarnos.</p>
            <p>Atentamente,<br>El equipo de la empresa</p>
        </div>
    </div>';

    if (enviarEmail($correo, $nombre, $subject, $body)) {
        echo '<script>Swal.fire({
              title: "Éxito",
              text: "Correo enviado exitosamente.",
              icon: "success",
              confirmButtonText: "Aceptar"
              }).then(function() {
              window.location = "index.php";
              });</script>';
    } else {
        echo '<script>Swal.fire({
              title: "Error",
              text: "No se pudo enviar el correo.",
              icon: "error",
              confirmButtonText: "Aceptar"
              }).then(function() {
              window.location = "../../views/user/purchases.php";
              });</script>';
    }
} else {
    echo '<script>Swal.fire({
          title: "Error",
          text: "No se encontró ninguna compra con el ID proporcionado.",
          icon: "error",
          confirmButtonText: "Aceptar"
          }).then(function() {
          window.location = "../../views/user/purchases.php";
          });</script>';
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Etiquetas Meta de SEO -->
    <meta name="description" content="Tivo es una plantilla de página de destino en HTML construida con Bootstrap para ayudarlo a crear presentaciones atractivas para aplicaciones SaaS y convertir visitantes en usuarios.">
    <meta name="author" content="Inovatik">

    <!-- Etiquetas Meta OG -->
    <meta property="og:site_name" content="" />
    <meta property="og:site" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="article" />

    <!-- Título de la Página -->
    <title>LifeLine</title>

    <!-- Estilos -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">

    <!-- Favicon -->
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
            <a class="navbar-brand logo-image" href="index.php"><img src="../../assets/boss/images/logo.png" alt="alternativa"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Navegación de palanca">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                
                <span class="nav-item">
                    <a class="btn-outline-sm" href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>">CERRAR SESIÓN</a>
                </span>
            </div>
        </div>
    </nav>

    <!-- Encabezado -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>¡La factura ha sido enviada con éxito a tu Gmail!</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido ---->
    <!-- Detalles -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Gracias por elegirnos</h2>
                        <p>Gracias por confiar en nosotros con tu vida y la de tus seres queridos, así como por confiar en nosotros para proteger tus pertenencias. En LifeLine, trabajamos por un futuro más seguro para ti. Esperamos verte pronto.</p>

                        <a class="btn-solid-reg page-scroll" href="index.php">Inicio</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/boss/images/gud.png" alt="alternativa">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de detalles -->

    <!-- Pie de página -->
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
                        <h4>Acerca de LifeLine</h4>
                        <p class="p-small">Nos apasiona ofrecer algunos de los mejores servicios de crecimiento empresarial para startups.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Enlaces Importantes</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-square"></i>
                                <div class="media-body">Nuestros socios comerciales <a class="white" href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media"><i class="fas fa-square"></i>
                                <div class="media-body">Lee nuestros <a class="white" href="terms-conditions.html">Términos y Condiciones</a>, <a class="white" href="privacy-policy.html">Política de Privacidad</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contacto</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">22 Innovative, San Francisco, CA 94043, US</div>
                            </li>
                            <li class="media"><i class="fas fa-envelope"></i>
                                <div class="media-body"><a class="white" href="mailto:contact@LifeLine.com">contact@LifeLine.com</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Template by Inovatik</a></p>
                </div>
            </div>
        </div>
    </div>

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
