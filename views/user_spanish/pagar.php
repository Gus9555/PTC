<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';

if (!isset($_SESSION['id'])) {
    echo '<script>Swal.fire({
          title: "Advertencia",
          text: "Inicia sesión nuevamente",
          icon: "warning",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script>';
    exit;
}

$user_id = $_SESSION['id']; // Aquí se obtiene el ID del comprador desde la sesión

$pdo = getConnection();

// Comprueba si la conexión es exitosa
if (!$pdo) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Falló la conexión a la base de datos.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "paypal.php";
          });</script>';
    exit;
}

// Realiza la consulta para obtener el id_c más alto basado en el user_id
$stmt = $pdo->prepare("SELECT MAX(id_c) as id_c FROM compras WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $id_c = $row['id_c'];
} else {
    echo '<script>Swal.fire({
          title: "Error",
          text: "No se encontró id_c para el usuario dado.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "paypal.php";
          });</script>';
    exit;
}

// Verificamos si se han recibido todos los parámetros necesarios
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['seguro'], $_GET['calidad'], $_GET['precio'])) {
    $seguro = htmlspecialchars($_GET['seguro']);
    $calidad = htmlspecialchars($_GET['calidad']);
    $precio = htmlspecialchars($_GET['precio']);
} else {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Datos no recibidos.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "paypal.php";
          });</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags SEO -->
    <meta name="description"
        content="Tivo es una plantilla HTML de página de destino construida con Bootstrap para ayudarte a crear presentaciones atractivas para aplicaciones SaaS y convertir visitantes en usuarios.">
    <meta name="author" content="Inovatik">

    <!-- Meta Tags OG para mejorar la apariencia cuando compartes la página en LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- nombre del sitio web -->
    <meta property="og:site" content="" /> <!-- enlace del sitio web -->
    <meta property="og:title" content="" /> <!-- título mostrado en la publicación compartida -->
    <meta property="og:description" content="" /> <!-- descripción mostrada en la publicación compartida -->
    <meta property="og:image" content="" /> <!-- enlace de la imagen, asegúrate de que sea jpg -->
    <meta property="og:url" content="" /> <!-- enlace al que quieres dirigir la publicación -->
    <meta property="og:type" content="article" />

    <!-- Título del sitio web -->
    <title>Términos y Condiciones - LifeLine</title>

    <!-- Estilos -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=Adr_ywjoTw8okgpD-dlDRDpaYbzlg3lh5L97nYjfvv3RFnbcCty-Z37ZH7SXoKR9eAQAye7J3P-vbRz_&currency=USD"></script>
</head>
<body data-spy="scroll" data-target=".fixed-top">
    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- fin del preloader -->
     <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Logotipo de texto - Usa esto si no tienes un logotipo gráfico -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

            <!-- Logotipo de imagen -->
            <a class="navbar-brand logo-image" href="view_user.php"><img src="../../assets/boss/images/logo.png"
                    alt="alternativo"></a>

            <!-- Botón de menú móvil -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Navegación de palanca">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- fin del botón de menú móvil -->
            </div>
        </div> <!-- fin del container -->
    </nav> <!-- fin del navbar -->
    <!-- fin de la navegación -->


    <!-- Encabezado -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Guía en caso de accidentes</h1>
                </div> <!-- fin de col -->
            </div> <!-- fin de row -->
        </div> <!-- fin de container -->
    </header> <!-- fin de ex-header -->
    <!-- fin del encabezado -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mt-5">Información de pago</h1>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Seguro</th>
                            <th>Calidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $seguro; ?></td>
                            <td><?php echo $calidad; ?></td>
                            <td>$<?php echo $precio; ?></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                <input type="hidden" id="id_c" value="<?php echo $id_c; ?>"> <!-- Agregar id_c aquí -->
                <div id="paypal-button-container" class="mt-3"></div>
            </div>
        </div>
    </div>


    <!-- Pie de página -->
    <svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
        viewBox="0 0 1920 79">
        <defs>
            <style>
                .cls-2 {
                    fill: #3b5d50;
                }
            </style>
        </defs>
        <title>footer-frame</title>
        <path class="cls-2"
            d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z"
            transform="translate(0 -0.188)" />
    </svg>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>Sobre Tivo</h4>
                        <p class="p-small">Estamos apasionados por ofrecer algunos de los mejores servicios de crecimiento empresarial.</p>
                    </div>
                </div> <!-- fin de col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Enlaces Importantes</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Nuestros socios comerciales <a class="white"
                                        href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Lee nuestros <a class="white" href="terms-conditions.html">Términos &
                                        Condiciones</a>, <a class="white" href="privacy-policy.html">Política de Privacidad</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- fin de col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contacto</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">22 Innovative, San Francisco, CA 94043, EE.UU.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-envelope"></i>
                                <div class="media-body"><a class="white"
                                        href="mailto:contact@Tivo.com">contact@Tivo.com</a> <i
                                        class="fas fa-globe"></i><a class="white" href="#your-link">www.Tivo.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- fin de col -->
            </div> <!-- fin de row -->
        </div> <!-- fin de container -->
    </div> <!-- fin de footer -->
    <!-- fin de footer -->


    <!-- Derechos de Autor -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Plantilla de Inovatik</a></p>
                </div> <!-- fin de col -->
            </div> <!-- fin de row -->
        </div> <!-- fin de container -->
    </div> <!-- fin de copyright -->
    <!-- fin de copyright -->





     <!-- Scripts -->
     <script src="../../assets/boss/js/jquery.min.js"></script> <!-- jQuery para los plugins de JavaScript de Bootstrap -->
    <script src="../../assets/boss/js/popper.min.js"></script> <!-- Biblioteca Popper para las herramientas de Bootstrap -->
    <script src="../../assets/boss/js/bootstrap.min.js"></script> <!-- Framework Bootstrap -->
    <script src="../../assets/boss/js/jquery.easing.min.js"></script> <!-- jQuery Easing para un desplazamiento suave entre anclas -->
    <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper para deslizadores de imágenes y texto -->
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup para lightboxes -->
    <!--<script src="js/validator.min.js"></script>  Validator.js - Bootstrap plugin que valida formularios -->
    <script src="../../assets/boss/js/scripts.js"></script> <!-- Scripts personalizados -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $precio; ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Realizar la llamada AJAX para actualizar el estado en la base de datos
                var user_id = document.getElementById('user_id').value;
                var id_c = document.getElementById('id_c').value; // Obtener id_c

                $.ajax({
                    url: 'update_status.php',
                    type: 'POST',
                    data: {
                        user_id: user_id,
                        id_c: id_c, // Pasar id_c
                        seguro: '<?php echo $seguro; ?>',
                        calidad: '<?php echo $calidad; ?>',
                        precio: '<?php echo $precio; ?>'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Proceso de pago completado',
                            icon: 'success'
                        }).then(function() {
                            window.location = 'success.php?id_c=' + id_c; // Pasar id_c a success.php
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'El pago falló',
                            icon: 'error'
                        });
                    }
                });
            });
        }
    }).render('#paypal-button-container');
    </script>
</body>
</html>
