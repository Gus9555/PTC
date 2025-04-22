<?php
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
          title: "Advertencia",
          text: "Inicia sesion de nuevo"
          }).then(function() {
          window.location = "../user/login.php";
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
                        <a class="nav-link page-scroll" href="view_user.php">INICIO <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../user/view_user.php">ENGLISH <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../support_spanish/users.php">CHAT-SOPORTE <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../profile/profile_spanish.php">PERFIL <span
                                class="sr-only">(current)</span></a>
                    </li>
                   

                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="logout.php">CERRAR SESION</a>
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
                    <h1>Terminos y condiciones</h1>
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
                        <a href="index.html">Inicio</a><i class="fa fa-angle-double-right"></i><span>Terminos y condiciones</span>
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
                        <h3>Introduccion</h3>
                        <p>Bienvenido a LifeLine. Al adquirir o utilizar nuestros productos y servicios de seguros,
                            usted acepta cumplir y estar obligado por los siguientes términos y condiciones. Le rogamos que lea
                            atentamente estas Condiciones.
                            Si no está de acuerdo con ellas, no utilice nuestros productos o servicios.</p>

                        <h3>Definiciones</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Tomador del seguro:</b> La persona física o jurídica que ha adquirido
                                una póliza de seguro a LifeLine.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Asegurado:</b> La(s) persona(s) o entidad(es) cubierta(s) por la
                                póliza de seguro.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Póliza:</b> El contrato de seguro entre el asegurado
                                y LifeLine.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Prima:</b> El importe pagado por el tomador del seguro a
                                LifeLine por la cobertura del seguro.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Siniestro:</b> Solicitud del asegurado o tomador del seguro de
                                pago o servicios en virtud de los términos de la póliza.</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->

                    <div class="text-container">
                        <h3>Acuerdo de poliza</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Cobertura:</b> La cobertura proporcionada por la póliza de seguro
                                    se especifica en la documentación de la póliza, incluyendo cualquier endoso, cláusula adicional o
                                    enmiendas.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Duración de la póliza:</b> La duración de la póliza se indica en
                                    la documentación de la póliza. La cobertura comienza y termina a las 12:01 AM hora local en el
                                    domicilio del asegurado en las fechas especificadas.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Pago de primas:</b> Las primas deben pagarse puntualmente para
                                mantener la cobertura. El impago de las primas puede dar lugar a la cancelación de la póliza.
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Cancelación:</b> Cualquiera de las partes puede cancelar la póliza como
                                    en la documentación de la póliza. El reembolso de las primas no devengadas se tramitará
                                    como se especifica en las condiciones de la póliza.</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->

                    <div class="text-container">
                        <p>LifeLine se reserva el derecho a modificar estas Condiciones en cualquier momento. Cualquier modificación será
                        comunicada al tomador del seguro y entrará en vigor en la fecha especificada en la comunicación.
                        </p>
                    </div> <!-- end of text-container -->

                    <div class="text-container last">
                    
                        <form method="POST" action="confirmarCompra.php">
                        <div class="form-group checkbox">
                                <input type="checkbox" id="terms" name="terms" required>He leído y acepto las condiciones de LifeLine
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
                    <div class="footer-col first">
                        <h4>Sobre LifeLine</h4>
                        <p class="p-small">Somos una de las mejores opciones para que adquieras tu poliza de seguro
                        </p>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Asociados <a class="white"
                                        href="#your-link">startupguide.com</a></div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contacto</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="media-body"> Calle Don Bosco y Av. Manuel Gallardo, 1-1, Santa Tecla</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-envelope"></i>
                                <div class="media-body">
                                    <a class="white"
                                        href="mailto:lifeline.ptc.2024@gmail.com">lifeline.ptc.2024@gmail.com</a>
                                    <i class="fas fa-globe"></i>
                                    <a class="white" href="#your-link">www.LifeLine.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
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
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Template by lifeline</a></p>
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