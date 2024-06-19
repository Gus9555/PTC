<?php
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
          title: "Warning",
          text: "LogIn again"
          }).then(function() {
          window.location = "../views/login.php";
          });</script></p>';
    exit; // Salir del script si no hay sesión iniciada
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <title>Terms Conditions - LifeLine</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">
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
    <!-- end of preloader -->


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="index.html"><img src="../../assets/boss/images/logo.png"
                    alt="alternative"></a>

            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- end of mobile menu toggle button -->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a class="nav-link page-scroll" href="view_user.php">INICIO <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../user/buy.php">ENGLISH <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../support_spanish/users.php">CHAT DE SOPORTE <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle page-scroll" href="#video" id="navbarDropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">VIDEO</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="article-details.html"><span class="item-text">ARTÍCULO Y
                            DETALLES</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="terms-conditions.html"><span class="item-text">TERMINOS Y CONDICIONES</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="privacy-policy.html"><span class="item-text">PRIVACIDAD
                            POLÍTICA</span></a>
                        </div>
                    </li>
                    <!-- end of dropdown menu -->

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.html#pricing">PRICING</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="log-in.html">LOG IN</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Terminos y Condiciones</h1>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->


    <!-- Breadcrumbs -->
    <div class="ex-basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <a href="../spanish/view_user.php">Inicio</a><i class="fa fa-angle-double-right"></i><span>Terminos y Condiciones</span>
                    </div> <!-- end of breadcrumbs -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic-1 -->
    <!-- end of breadcrumbs -->


    <!-- Terms Content -->
    <div class="ex-basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h3>Introducción</h3>
                        <p>Bienvenido a LifeLine. Al adquirir o utilizar nuestros productos y servicios de seguros, 
                            acepta cumplir y quedar vinculado por los siguientes términos y condiciones. Lea atentamente estas Condiciones. 
                            Si no está de acuerdo con ellas, no utilice nuestros productos o servicios.</p>

                        <h3>Definiciones</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Cliente/Usuario:</b> La persona física o jurídica que ha contratado una póliza de seguro con LifeLine.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Asegurado:</b> La(s) persona(s) o entidad(es) cubierta(s) por la póliza de seguro.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Política:</b> El contrato de seguro entre el cliente y LifeLine.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Prima:</b> El monto cancelado por el cliente o usuario para la cobertura de LifeLine</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Solicitud:</b> El asegurado esta habilitado a solicitar la cantidad de dinero necesaria para cubrir gastos del accidente ocurrido(Todo depende del tipo de cobertura que tengan)</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->

                    <div class="text-container">
                        <h3>Acuerdo de Poliza</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Cobertura:</b> La cobertura proporcionada por LifeLine es segun los requerimientos previamente establecidos 
                                en el contrato del plan adquirido</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Periodo de Poliza:</b> La duracion de la poliza debe estar definida en el contrato correspondiente, 
                                manejamos un ciclo u horario de cobertura en el cual inicia a las 12:01 am</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Pagos:</b> Los pagos o mesualidades deben de ser pagadas dentro del periodo establecido, ya que si no, 
                                se podria cancelar la cobertura de manera automatica hasta la recepcion de la mesualidad.
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Cancelación:</b> En el acuerdo previo a la adquisición de un plan de seguros, se debera establecer quien es el responsable de pagar 
                                las mensualidades establecidas</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->

                    <div class="text-container">
                        <p>LifeLine se guarda el derecho como corporación, de utilizar estos lineamientos en un futuro con posibles malentendidos.
                        </p>
                    </div> <!-- end of text-container -->

                    <div class="text-container last">
                    
                        <form method="POST" action="confirmarCompra.php">
                        <div class="form-group checkbox">
                                <input type="checkbox" id="terms" name="terms" required>Estoy de acuerdo con los terminos y condiciones.
                                <div class="help-block with-errors"></div>
                            </div>
                            <button type="submit" class="btn-solid-reg page-scroll">COMPRAR</button>
                        </form>
                    </div> <!-- end of text-container -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic -->
    <!-- end of terms content -->


    <!-- Footer -->
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
                    
                </div> <!-- end of col -->
                <div class="col-md-4">
                    
                </div> <!-- end of col -->
                <div class="col-md-4">
                    
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


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
    <script>
    function verificarCheckbox() {
            var checkbox = document.getElementById("terms");
            if (checkbox.disabled) {
                alert("El checkbox está deshabilitado.");
                return false; // Evita el envío del formulario
            }
            return true; // Permite el envío del formulario
        }
        </script>
</body>

</html>
<?php
$accion = $_POST['buy'];
if ($accion == "S_moto") {
    $seguro = '1';
} elseif ($accion == "G_moto") {
    $seguro = '2';
} elseif ($accion == "D_moto") {
    $seguro = '3';
} elseif ($accion == "S_auto") {
    $seguro = '4';
} elseif ($accion == "G_auto") {
    $seguro = '5';
} elseif ($accion == "D_auto") {
    $seguro = '6';
} elseif ($accion == "S_util") {
    $seguro = '7';
} elseif ($accion == "G_util") {
    $seguro = '8';
} elseif ($accion == "D_util") {
    $seguro = '9';
} elseif ($accion == "S_casa") {
    $seguro = '10';
} elseif ($accion == "G_casa") {
    $seguro = '11';
} elseif ($accion == "D_casa") {
    $seguro = '12';
} elseif ($accion == "S_vida") {
    $seguro = '13';
} elseif ($accion == "G_vida") {
    $seguro = '14';
} elseif ($accion == "D_vida") {
    $seguro = '15';
} else {
    echo "ERROR";
}

$_SESSION['seguro'] = $seguro;
?>