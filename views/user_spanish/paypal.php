<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
          title: "Advertencia",
          text: "Inicia sesión nuevamente"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script></p>';
    exit;
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
$id_comprador = $_SESSION['id']; // Suponiendo que este es el id del comprador

$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buy'])) 
    $seguro_id = $_POST['buy'];
    
    if (!filter_var($seguro_id, FILTER_VALIDATE_INT)) {
        echo "ID de seguro no válido.";
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM seguros WHERE id = :id");
        $stmt->bindParam(':id', $seguro_id, PDO::PARAM_INT);
        $stmt->execute();
        $seguro = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Consulta fallida: ' . $e->getMessage();
        exit;
    }

    if (!$seguro) {
        echo "Seguro no encontrado.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' https://code.jquery.com https://cdnjs.cloudflare.com;">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">
    <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
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
            <a class="navbar-brand logo-image" href="index.html"><img src="../../assets/boss/images/logo.png" alt="alternativo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="view_user.php">INICIO <span class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../spanish/buy.php">ESPAÑOL <span class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../support/users.php">SOPORTE POR CHAT <span class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../profile/profile.php">MI PERFIL <span class="sr-only">(actual)</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.html#pricing">PRECIOS</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="log-in.html">INICIAR SESIÓN</a>
                </span>
            </div>
        </div>
    </nav>

    <!-- Encabezado -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Términos y Condiciones</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido de Términos -->
    <div class="ex-basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h3>Introducción</h3>
                        <p>Bienvenido a LifeLine. Al comprar o utilizar nuestros productos y servicios de seguros, aceptas cumplir con los siguientes términos y condiciones. Por favor, lee estos términos detenidamente. Si no estás de acuerdo con estos términos, no debes usar nuestros productos o servicios.</p>

                        <h3>Definiciones</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Tomador del seguro:</b> La persona o entidad que ha adquirido una póliza de seguro de LifeLine.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Asegurado:</b> La(s) persona(s) o entidad cubierta bajo la póliza de seguro.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Póliza:</b> El contrato de seguro entre el tomador del seguro y LifeLine.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Prima:</b> El monto pagado por el tomador del seguro a LifeLine por la cobertura del seguro.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Reclamación:</b> Una solicitud realizada por el asegurado o el tomador del seguro para el pago o los servicios bajo los términos de la póliza.</div></li>
                        </ul>
                    </div>

                    <div class="text-container">
                        <h3>Acuerdo de la Póliza</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Cobertura:</b> La cobertura proporcionada por la póliza de seguro está especificada en la documentación de la póliza, incluidos cualquier endoso, anexo o enmienda.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Período de la Póliza:</b> La duración de la póliza está indicada en la documentación de la póliza. La cobertura comienza y termina a las 12:01 AM hora local en la dirección del asegurado en las fechas especificadas.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Pago de Primas:</b> Las primas deben pagarse a tiempo para mantener la cobertura. El incumplimiento en el pago de las primas puede resultar en la cancelación de la póliza.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Cancelación:</b> Cualquiera de las partes puede cancelar la póliza según lo establecido en la documentación de la póliza. Los reembolsos de primas no devengadas se manejarán según lo especificado en los términos de la póliza.</div></li>
                        </ul>
                    </div>

                    <div class="text-container">
                        <p>LifeLine se reserva el derecho de modificar estos Términos en cualquier momento. Cualquier enmienda se comunicará al tomador del seguro y entrará en vigencia según se especifique en la comunicación.</p>
                    </div>

                    <style>
        input[type="checkbox"] {
            transform: scale(1.5); /* Cambia el valor según el tamaño deseado */
            -webkit-transform: scale(1.5); /* Para compatibilidad con navegadores antiguos */
        }
    </style>
    <?php
    if ($seguro['seguro'] == "motorcycle") {
        $echoSeguro = "Motocicleta";
    } elseif ($seguro['seguro'] == "Vehicule") {
        $echoSeguro = "Vehículo";
    } else {
        $echoSeguro = $seguro['seguro'];
    }
    ?>

                    <div class="text-container last">
                        <h2>Seguro Seleccionado</h2>
                        <p><b>Tipo de seguro:</b> <?php echo htmlspecialchars($echoSeguro); ?></p>
                        <p><b>Calidad:</b> <?php echo htmlspecialchars($seguro['calidad']); ?></p>
                        <p><b>Precio de la Póliza:</b> $<?php echo htmlspecialchars($seguro['precio']); ?></p>

                        <div class="form-group">
                            <input type="checkbox" id="terms" name="terms" required onclick="togglePaymentButton()"> <b>He leído y acepto los Términos y Condiciones de LifeLine</b>
                        </div>

                        <div id="payment-button-container" style="display: none;">
                            <form action="datospago.php" method="post">
                                <input type="hidden" name="seguro" value="<?php echo htmlspecialchars($seguro['seguro']); ?>">
                                <input type="hidden" name="calidad" value="<?php echo htmlspecialchars($seguro['calidad']); ?>">
                                <input type="hidden" name="precio" value="<?php echo htmlspecialchars($seguro['precio']); ?>">
                                <button type="submit" class="btn-solid-reg page-scroll">Proceder al Pago</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79">
        <defs>
            <style>.cls-2 { fill: #3b5d50; }</style>
        </defs>
        <title>footer-frame</title>
        <path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)" />
    </svg>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>Sobre Tivo</h4>
                        <p class="p-small">Estamos apasionados por ofrecer algunos de los mejores servicios de crecimiento empresarial.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Enlaces Importantes</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Nuestros socios comerciales <a class="white" href="#your-link">startupguide.com</a></div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Lee nuestros <a class="white" href="terms-conditions.html">Términos & Condiciones</a>, <a class="white" href="privacy-policy.html">Política de Privacidad</a></div></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contacto</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-map-marker-alt"></i><div class="media-body">22 Innovative, San Francisco, CA 94043, EE.UU.</div></li>
                            <li class="media"><i class="fas fa-envelope"></i><div class="media-body"><a class="white" href="mailto:contact@Tivo.com">contact@Tivo.com</a> <i class="fas fa-globe"></i><a class="white" href="#your-link">www.Tivo.com</a></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Plantilla de Inovatik</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/boss/js/popper.min.js"></script>
    <script src="../../assets/boss/js/bootstrap.min.js"></script>
    <script src="../../assets/boss/js/jquery.easing.min.js"></script>
    <script src="../../assets/boss/js/swiper.min.js"></script>
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script>
    <script src="../../assets/boss/js/scripts.js"></script>

    <script>
    function togglePaymentButton() {
        var checkbox = document.getElementById("terms");
        var paymentButtonContainer = document.getElementById("payment-button-container");
        if (checkbox.checked) {
            paymentButtonContainer.style.display = "block";
        } else {
            paymentButtonContainer.style.display = "none";
        }
    }
    </script>
</body>
</html>
