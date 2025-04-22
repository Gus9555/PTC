<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
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
         title: "Advertencia",
         text: "Inicia Sesion de nuevo"
         }).then(function() {
         window.location = "../user_spanish/login.php";
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
    <meta name="description" content="Tivo is a HTML landing page template built with Bootstrap to help you crate engaging presentations for SaaS apps and convert visitors into users.">
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
        .wrapper {
            margin-top: 70px;
            /* Ajusta este valor según el margen que desees */
        }
    </style>


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
            <a class="navbar-brand logo-image" href="../view_user.php"><img src="../../assets/boss/images/logo.png"
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


    <div class="wrapper">
        <!-- Header -->
        <header id="header" class="header">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-xl-5">
                            <div class="text-container">
                                <h1>Tu aseguradora de confianza</h1>
                                <p class="p-large">En Lifeline conocemos lo mucho que importa tu bienestar, por eso es que trabajamos segun tu conveniencia</p>
                            </div> <!-- end of text-container -->
                        </div> <!-- end of col -->
                        <div class="col-lg-6 col-xl-7">
                            <div class="image-container">
                                <div class="img-wrapper">
                                    <img class="img-fluid" src="../../assets/boss/images/header-software-app.png"
                                        alt="alternative">
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
    </div>





    <!-- Description -->
    <div class="cards-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">ASEGURA TU FUTURO</div>
                    <h2 class="h2-heading">Lo que sea que necesites para sentirte seguro, dejaselo a Lifeline</h2>
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
                            <h4 class="card-title" style="color:#3b5d50">Vehiculos</h4>
                            <p>Asegura tanto tu vehiculo como los pasajeros que se movilizan en el, asegura tu bienestar y tu tranquilidad</p>
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
                            <p>Prioriza el bienestar de tu persona y tus seres queridos, garantizando su seguridad a todo momento</p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="../../assets/boss/images/casa.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title" style="color:#3b5d50">Propiedades</h4>
                            <p>Proteccion comprensiva segun tu casa y/o propiedades y muebles dentro de ella, aseguralas y mantente mas tranquilo ante cualquier accidente</p>
                        </div>
                    </div>
                    <!-- end of card -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of description -->


    <!-- Features -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Conoce nuestra red de servicio de seguros</h2>
                    <p class="mb-4">En Lifeline nos asociamos con los mejores en sus apartados, aqui puedes contactar a nuestros asociados especialistas segun lu rama de seguros</p>
                    <p></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="S_Mechanic.php">
                        <img src="../../assets/boss/images/mecanico.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Seguro de vehiculo</h3>
                        <strong class="product-price"></strong>
                    </a>
                </div>
                <!-- End Column 2 -->

                <!-- Start Column 3 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="S_Architect.php">
                        <img src="../../assets/boss/images/arqui.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Seguro de propiedades inmuebles</h3>
                        <strong class="product-price"></strong>

                    </a>
                </div>
                <!-- End Column 3 -->

                <!-- Start Column 4 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="S_Doctor.php">
                        <img src="../../assets/boss/images/doctor.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Seguro de vida</h3>
                        <strong class="product-price"></strong>


                    </a>
                </div>
                <!-- End Column 4 -->

            </div>
        </div>
    </div>


    <!-- Features -->
    <div id="features" class="tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">CARACTERISTICAS </div>
                    <h2 class="h2-heading">Seguros</h2>
                    <p class="p-heading">Descubre la solucion definitiva de seguros hecha a medida segun tus necesidades</p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Tabs Links -->
                    <ul class="nav nav-tabs" id="argoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab"
                                aria-controls="tab-1" aria-selected="true"><i class="fas fa-car-crash"></i>Vehiculo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab"
                                aria-controls="tab-2" aria-selected="false"><i class="fas fa-heartbeat"></i>Medico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab"
                                aria-controls="tab-3" aria-selected="false"><i class="fas fa-house-damage"></i>Propiedades</a>
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
                                        <h3>Asegurar tus vehiculos es mas facil que nunca</h3>
                                        <p>Asegura y protege el desplazartecon planes versatiles segun tus necesidades y requerimientos</p>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Choques</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Daños a propiedad de terceros</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Añadir el vehiculo a asegurar</div>
                                            </li>
                                        </ul>
                                        <a class="btn-solid-reg popup-with-move-anim"
                                            href="#details-lightbox-1">MAS INFORMACION</a>
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
                                        <h3>Un plan de seguros hecho a medida para ti</h3>
                                        <p>En Lifeline ofrecemos variedad de coberturas dependiendo de tu presupuesto</p>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Enfermedades o condiciones graves</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Muerte por cualquier causa</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Gastos de funeral</div>
                                            </li>
                                        </ul>
                                        <a class="btn-solid-reg popup-with-move-anim"
                                            href="#details-lightbox-2">MAS INFORMACION</a>
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
                                        <h3>Proteger el bienestar en tu casa nunca fue mas facil</h3>
                                        <p>Este apartado de seguros ha sido diseñado para cubrir daños en tu casa o propiedades y lo que se encuentra en ellas, tambien cubre daños hacia propiedades de terceros</p>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Explosiones</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Daños causados por deslaves de tierra</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-square"></i>
                                                <div class="media-body">Sismos o erupciones volcanicas</div>
                                            </li>
                                        </ul>
                                        <a class="btn-solid-reg popup-with-move-anim"
                                            href="#details-lightbox-3">MAS INFORMACION</a>
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
                    <h3>Vehiculo</h3>
                    <hr>
                    <h5>Seguro hecho a medida</h5>
                    <p>Con Lifeline ofrecemos coberturas que se adaptan a su presupuesto. Ya sea un seguro básico o uno más completo. Con LifeLine ofrecemos una variedad de coberturas que se adaptan a su presupuesto. Ya sea un seguro básico o uno más completo.</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Daños al vehiculo asegurado</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Responsabilidad civil frente a daños a terceros</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Hurto total o parcial</div>
                        </li>

                    </ul>
                    <a class="btn-solid-reg mfp-close" href="Vehicles.php">POLIZAS DE SEGURO</a> <a
                        class="btn-outline-reg mfp-close as-button" href="#screenshots">ATRAS</a>
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
                    <h3>Medico</h3>
                    <hr>
                    <h5>Pensamos en tu familia</h5>
                    <p>Es un seguro médico para proteger la salud y el bienestar de usted y su familia. Cubre los gastos médicos y hospitalarios en caso de enfermedad o accidente, así como el embarazo y la maternidad..</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Muerte por cualquier causa</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Muerte natural</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Gastos funerarios</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Accidentes personales</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Discapacidades temporales o permanentes</div>
                        </li>
                    </ul>
                    <a class="btn-solid-reg mfp-close" href="Medical.php">POLIZAS DE SEGURO</a> <a
                        class="btn-outline-reg mfp-close as-button" href="#screenshots">ATRAS</a>
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
                    <h3>Propiedades<h3>
                            <hr>
                            <h5>Proteccion contra daños</h5>
                            <p>Este seguro protege contra todos los riesgos de pérdida o daños a su vivienda y efectos personales causados por cualquier suceso accidental, repentino o imprevisto</p>
                            <ul class="list-unstyled li-space-lg">
                                <li class="media">
                                    <i class="fas fa-square"></i>
                                    <div class="media-body">Fuego o rayos</div>
                                </li>
                                <li class="media">
                                    <i class="fas fa-square"></i>
                                    <div class="media-body">Sismos</div>
                                </li>
                                <li class="media">
                                    <i class="fas fa-square"></i>
                                    <div class="media-body">Fugas de gas</div>
                                </li>
                                <li class="media">
                                    <i class="fas fa-square"></i>
                                    <div class="media-body">Rotura de tuberias</div>
                                </li>
                                <li class="media">
                                    <i class="fas fa-square"></i>
                                    <div class="media-body">Transferencias temporales</div>
                                </li>
                                <li class="media">
                                    <i class="fas fa-square"></i>
                                    <div class="media-body">Hurto en la propiedad</div>
                                </li>
                            </ul>
                            <a class="btn-solid-reg mfp-close" href="Home.php">POLIZAS DE SEGURO</a> <a
                                class="btn-outline-reg mfp-close as-button" href="#screenshots">ATRAS</a>
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
                        <h2>Que hacer en caso de emergencia?</h2>
                        <p>Conozca el proceso de tramitación de siniestros relacionados con automóviles, personas o su vivienda. Estar informado
                            sobre cómo proceder es esencial para una respuesta eficaz y una rápida recuperación. Desde
                            desde la comunicación del siniestro hasta la gestión de los trámites y reparaciones, cada paso es crucial para proteger
                            sus intereses y facilitar la resolución del problema.
                        </p>

                        <a class="btn-solid-reg page-scroll"
                            href="guide.php">BLOG</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/boss/images/quehacer.png" alt="alternative">
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
                            <a class="popup-youtube" href="../../assets/images/lifeline.mp4"
                                data-effect="fadeIn">
                                <img class="img-fluid" src="../../assets/images/video-image.png" alt="alternative">
                                <span class="video-play-button">
                                    <span></span>
                                </span>
                            </a>
                        </div> <!-- end of video-wrapper -->
                    </div> <!-- end of image-container -->
                    <!-- end of video preview -->

                    <div class="p-heading"></div>
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
                                <div class="media-body">Associados <a class="white"
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
                    <p class="p-small">Copyright © 2020 Template by LifeLine</p>
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
</body>

</html>