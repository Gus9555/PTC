<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>LifeLine</title>
    <link rel="icon" href="../../assets/boss/images/favicon.png">
</head>

<body>

</body>

</html>
<?php
 session_start();

 if (!isset($_SESSION['id'])) {
     echo '<p><script>Swal.fire({
         title: "Warning",
         text: "Inicia sesion de nuevo"
         }).then(function() {
         window.location = "../../views/login.php";
         });</script></p>';
     exit; // Salir del script si no hay sesión iniciada
 }
 
 $nombre = $_SESSION['nombre'];
 $tipo_usuario = $_SESSION['tipo_usuario'];
  
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
    <title>LifeLine</title>

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
            <a class="navbar-brand logo-image" href="view_user.php"><img src="../../assets/boss/images/logo.png" alt="alternative"></a>

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
                        <a class="nav-link page-scroll" href="../user/view_user.php">ENGLISH <span class="sr-only">(current)</span></a>
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
   
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="logout.php">SALIR</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="text-container">
                            <h1>Su compañía de seguros de confianza</h1>
                            <p class="p-large">En LifeLine sabemos lo valiosa que es su vida, por eso trabajamos para
                            su comodidad.</p>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6 col-xl-7">
                        <div class="image-container">
                            <div class="img-wrapper">
                                <img class="img-fluid" src="../../assets/boss/images/header-software-app.png" alt="alternative">
                            </div> <!-- end of img-wrapper -->
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
        viewBox="0 0 1920 310">
        <defs>
            <style>
                .cls-1 {
                    fill: #3b5d50;
                }
            </style>
        </defs>
        <title>header-frame</title>
        <path class="cls-1"
            d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z" />
    </svg>
    <!-- end of header -->


    <!-- Customers -->
    <div class="slider-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Image Slider -->
                    <div class="slider-container">
                        <div class="swiper-container image-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/boss/images/customer-logo-1.png" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/boss/images/customer-logo-2.png" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/boss/images/customer-logo-3.png" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/boss/images/customer-logo-4.png" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/boss/images/customer-logo-5.png" alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="../../assets/boss/images/customer-logo-6.png" alt="alternative">
                                </div>
                            </div> <!-- end of swiper-wrapper -->
                        </div> <!-- end of swiper container -->
                    </div> <!-- end of slider-container -->
                    <!-- end of image slider -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of slider-1 -->
    <!-- end of customers -->


    <!-- Description -->
    <div class="cards-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">ASEGURE SU FUTURO</div>
                    <h2 class="h2-heading">Lo que necesites para sentirte protegido, ¡lo tenemos!</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="../../assets/boss/images/carros.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title" style="color:#3b5d50">Vehiculo</h4>
                            <p>Proteja tanto su vehículo como a sus pasajeros con una protección integral, garantizando su seguridad y proporcionándole tranquilidad.
                            su seguridad y su tranquilidad.</p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="../../assets/boss/images/favicon.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title" style="color:#3b5d50">Medico</h4>
                            <p>Priorice su bienestar y el de sus seres queridos, garantizando su cuidado y seguridad
                            en todo momento.</p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="../../assets/boss/images/casa.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title" style="color:#3b5d50">Inmobiliaria</h4>
                            <p>Asegure una protección integral para su hogar y sus valiosos muebles, garantizando su
                            su seguridad y su tranquilidad.</p>
                        </div>
                    </div>
                    <!-- end of card -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of description -->


    <!-- Features -->
    <div id="features" class="tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">CARACTERÍSTICAS</div>
                    <h2 class="h2-heading">Seguros</h2>
                    <p class="p-heading">Descubra la solución de seguros definitiva adaptada a sus necesidades específicas,
                    proporcionándole una cobertura y una tranquilidad inigualables.</p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Tabs Links -->
                    <ul class="nav nav-tabs" id="argoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab"
                                aria-controls="tab-1" aria-selected="true"><i class="fas fa-car-crash"></i>Vehiculos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab"
                                aria-controls="tab-2" aria-selected="false"><i class="fas fa-heartbeat"></i>Medico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab"
                                aria-controls="tab-3" aria-selected="false"><i class="fas fa-house-damage"></i>Inmobiliaria</a>
                        </li>
                    </ul>
                    <!-- end of tabs links -->

                    <!-- Tabs Content -->
                    <div class="tab-content" id="argoTabsContent">

                        <!-- Tab -->
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="image-container">
                                        <img class="img-fluid" src="../../assets/boss/images/33.png" alt="alternative">
                                    </div> <!-- end of image-container -->
                                </div> <!-- end of col -->
                                <div class="col-lg-6">
                                    <div class="text-container">
                                        <h3>Asegure su coche más fácil que nunca</h3>
                                        <p>Proteja su movilidad mientras se desplaza con planes versátiles que se adaptan perfectamente a sus necesidades.
                                        a sus necesidades, garantizándole una seguridad y una tranquilidad inigualables.</p>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Choques y colisiones</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Daños materiales a terceros</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Añadir y eliminar abonados mediante el panel de control</div>
                                            </li>
                                        </ul>
                                        <a class="btn-solid-reg popup-with-move-anim"
                                            href="#details-lightbox-1">ACERCA DE</a>
                                    </div> <!-- end of text-container -->
                                </div> <!-- end of col -->
                            </div> <!-- end of row -->
                        </div> <!-- end of tab-pane -->
                        <!-- end of tab -->

                        <!-- Tab -->
                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="image-container">
                                        <img class="img-fluid" src="../../assets/boss/images/44.png" alt="alternative">
                                    </div> <!-- end of image-container -->
                                </div> <!-- end of col -->
                                <div class="col-lg-6">
                                    <div class="text-container">
                                        <h3>Un seguro a su medida</h3>
                                        <p>En LifeLine ofrecemos una gran variedad de coberturas en función de su presupuesto. Tanto si
                                        usted está buscando un seguro de auto básico o una cobertura a todo riesgo.</p>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Enfermedades graves</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Muerte por cualquier causa</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Gastos funerarios</div>
                                            </li>
                                        </ul>
                                        <a class="btn-solid-reg popup-with-move-anim"
                                            href="#details-lightbox-2">ACERCA DE</a>
                                    </div> <!-- end of text-container -->
                                </div> <!-- end of col -->
                            </div> <!-- end of row -->
                        </div> <!-- end of tab-pane -->
                        <!-- end of tab -->

                        <!-- Tab -->
                        <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="image-container">
                                        <img class="img-fluid" src="../../assets/boss/images/333.png" alt="alternative">
                                    </div> <!-- end of image-container -->
                                </div> <!-- end of col -->
                                <div class="col-lg-6">
                                    <div class="text-container">
                                        <h3>Proteger su vida nunca ha sido tan fácil</h3>
                                        <p>Este seguro ha sido diseñado para cubrir los daños a su vivienda y a los
                                            bienes que contiene, así como los daños causados a terceros de los que usted
                                            usted sea responsable.</p>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Explosion</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Daños causados por corrimientos de tierra y aludes de lodo y
                                                corrimientos de tierras</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Terremoto o erupción volcánica</div>
                                            </li>
                                        </ul>
                                        <a class="btn-solid-reg popup-with-move-anim"
                                            href="#details-lightbox-3">ACERCA DE</a>
                                    </div> <!-- end of text-container -->
                                </div> <!-- end of col -->
                            </div> <!-- end of row -->
                        </div> <!-- end of tab-pane -->
                        <!-- end of tab -->

                    </div> <!-- end of tab content -->
                    <!-- end of tabs content -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of tabs -->
    <!-- end of features -->


    <!-- Details Lightboxes -->
    <!-- Details Lightbox 1 -->
    <div id="details-lightbox-1" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="container">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/boss/images/33.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Vehiculos</h3>
                    <hr>
                    <h5>Seguros a medida</h5>
                    <p>Con LifeLine le ofrecemos una variedad de coberturas que se ajustan a su presupuesto. Tanto si busca un seguro de automóvil básico como una cobertura a todo riesgo.</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Daños al vehículo asegurado</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Responsabilidad civil por lesiones o muerte de terceros</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Robo total o parcial</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Responsabilidad civil por daños materiales a bienes de terceros</div>
                        </li>

                    </ul>
                    <a class="btn-solid-reg mfp-close" href="../spanish/vehicles.php">SEGURO</a> <a
                        class="btn-outline-reg mfp-close as-button" href="#screenshots">VOLVER</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of lightbox-basic -->
    <!-- end of details lightbox 1 -->

    <!-- Details Lightbox 2 -->
    <div id="details-lightbox-2" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="container">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/boss/images/44.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Medical</h3>
                    <hr>
                    <h5>Pensando en su familia</h5>
                    <p>Es un seguro médico para proteger la salud y el bienestar de usted y su familia. Cubre
                        los gastos médicos y hospitalarios en caso de enfermedad o accidente, así como los de embarazo y
                        maternidad.</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Muerte por cualquier causa</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Muerte natural, muerte accidental y/o suicidio</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Gastos funerarios</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Acidentes Personales</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Invalidez absoluta y permanente</div>
                        </li>
                    </ul>
                    <a class="btn-solid-reg mfp-close" href="../spanish/Medical.php">SEGURO</a> <a
                        class="btn-outline-reg mfp-close as-button" href="#screenshots">VOLVER</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of lightbox-basic -->
    <!-- end of details lightbox 2 -->

    <!-- Details Lightbox 3 -->
    <div id="details-lightbox-3" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="container">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/boss/images/333.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Inmobiliaria<h3>
                    <hr>
                    <h5>Protección a prueba de daños</h5>
                    <p>Este seguro protege contra todos los riesgos de pérdida o daños a su vivienda y efectos personales causados por cualquier suceso accidental, repentino o imprevisto.</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Incendio o rayo</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Terremoto, temblor o erupción volcánica</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Fugas de gas</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Rotura de tuberías</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Traslados temporales</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Robo</div>
                        </li>
                    </ul>
                    <a class="btn-solid-reg mfp-close" href="../spanish/Home.php">SEGURO</a> <a
                        class="btn-outline-reg mfp-close as-button" href="#screenshots">VOLVER</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of lightbox-basic -->
    <!-- end of details lightbox 3 -->
    <!-- end of details lightboxes -->


    <!-- Details -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>¿Qué hacer en caso de emergencia?</h2>
                        <p>Conozca el proceso de tramitación de los siniestros que afectan a coches, personas o su hogar. Estar informado sobre cómo proceder es esencial para una respuesta eficaz y una rápida recuperación. Desde la notificación del siniestro hasta la gestión de los trámites y las reparaciones, cada paso es crucial para proteger sus intereses y facilitar la resolución del problema.
                        </p>
                        
                        <a class="btn-solid-reg page-scroll" href="../views/registro.php">BLOG</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/boss/images/Diseño_sin_título__7_-removebg-preview.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-1 -->
    <!-- end of details -->


    <!-- Video -->
    <div id="video" class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Video Preview -->
                    <div class="image-container">
                        <div class="video-wrapper">
                            <a class="popup-youtube" href="https://www.youtube.com/watch?v=wd7oDCb3gUY"
                                data-effect="fadeIn">
                                <img class="img-fluid" src="../../assets/boss/images/video-image.png" alt="alternative">
                                <span class="video-play-button">
                                    <span></span>
                                </span>
                            </a>
                        </div> <!-- end of video-wrapper -->
                    </div> <!-- end of image-container -->
                    <!-- end of video preview -->

                    <div class="p-heading">Qué mejor manera de mostrar nuestro sitio web de seguros de vida LifeLine que presentando en un vídeo grandes situaciones de cada módulo y herramienta a disposición de los usuarios.</div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-2 -->
    <!-- end of video -->

        
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
                        <h4>Acerca de LifeLine</h4>
                        <p class="p-small">Somos una de sus mejores opciones en el mercado para adquirir una póliza de seguros. </p>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Nuestros colaboradores <a class="white"
                                        href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Lea nuestro <a class="white" href="views/terms-conditions.html">Terminos y codiciones</a>, <a class="white" href="privacy-policy.html">Política de privacidad</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="media-body"> Calle Don Bosco y Av. Manuel Gallardo, 1-1, Santa Tecla</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-envelope"></i>
                                <div class="media-body">
                                <a class="white" href="mailto:lifeline.ptc.2024@gmail.com">lifeline.ptc.2024@gmail.com</a>
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
                    <p class="p-small">Copyright © 2024 Template by LifeLine</p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->
    <script src="../../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../../assets/boss/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <!--<script src="js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
    <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>