<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
          title: "Warning",
          text: "Login again"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script></p>';
    exit; // Salir del script si no hay sesión iniciada
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];

try {
    $pdo = getConnection();

    // Función para obtener datos de seguros por tipo
    function getSegurosByTipo($pdo, $tipo) {
        $sql = "SELECT * FROM seguros WHERE seguro = :tipo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener datos de seguros de hogar
    $segurosMoto = getSegurosByTipo($pdo, 'motorcycle');
    $segurosVehi = getSegurosByTipo($pdo, 'Vehicule');
    $segurosUtil = getSegurosByTipo($pdo, 'Utility');

    function compararPrecios($a, $b) {
        return $a['precio'] - $b['precio'];
    }

    usort($segurosMoto, 'compararPrecios');
    usort($segurosUtil, 'compararPrecios');
    usort($segurosVehi, 'compararPrecios');

} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
    <title>LifeLine</title>
    <link rel="icon" href="../../assets/boss/images/favicon.png">
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
            <a class="navbar-brand logo-image" href="view_user.php"><img src="../../assets/boss/images/logo.png"
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
                        <a class="nav-link page-scroll" href="../user/Vehicles.php">ENGLISH <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../../views/support_spanish/users.php">CHAT-SOPORTE <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../profile/profile_spanish.php">PERFIL <span class="sr-only">(current)</span></a>
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
    <header id="header" class="header">
        <div class="header-content">

        </div> <!-- end of header-content -->
    </header> <!-- end of header -->

    <!-- end of header -->


    <!-- Customers -->

    <!-- end of customers -->


    <!-- Details -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Ahora es tiempo de mejorar la seguridad de tu vehiculo</h2>
                        <p>Aquí en LifeLine nos centramos en la seguridad de nuestros clientes, es por eso que ofrecemos la mejor
                        planes de seguro. Haga clic abajo para ingresar una solicitud de cotización.
                        </p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Daños al vehiculo asegurado</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Responsabilidad civil ante daños a terceros</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Robo total o parcial</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Servicio de grua 24/7</div>
                            </li>
                            
                           
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/images/33.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-1 -->
    <!-- end of details -->


    <!-- Pricing -->
    <div id="pricing" class="cards-2 tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">PRECIOS</div>
                    <h2 class="h2-heading">Opciones segun precios</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tabs Links -->
                    <ul class="nav nav-tabs" id="argoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab"
                                aria-controls="tab-1" aria-selected="true"><i
                                    class="fas fa-motorcycle"></i>Motocicleta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab"
                                aria-controls="tab-2" aria-selected="false"><i class="fas fa-car"></i>Particular</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab"
                                aria-controls="tab-3" aria-selected="false"><i class="fas fa-tractor"></i>Industriales</a>
                        </li>
                    </ul>
                    <!-- end of tabs links -->

                    <!-- Tabs Content -->
                    <div class="tab-content" id="argoTabsContent">
                        <!-- Tab -->
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                            
                        <div class="row">
                            <?php foreach ($segurosMoto as $seguro) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title"><?php echo htmlspecialchars($seguro['calidad']); ?></div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value"><?php echo htmlspecialchars($seguro['precio']); ?></span></div>
                                        <div class="frequency">Mensualmente</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media"><i class="fas fa-check"></i>
                                                <div class="media-body"><?php echo htmlspecialchars($seguro['descripcion']); ?></div>
                                            </li>
                                            <li class="media"><i class="fas fa-check"></i>
                                                <div class="media-body"><?php echo htmlspecialchars($seguro['descripcion2']); ?></div>
                                            </li>
                                            <li class="media"><i class="fas fa-check"></i>
                                                <div class="media-body"><?php echo htmlspecialchars($seguro['descripcion3']); ?></div>
                                            </li>
                                            <li class="media"><i class="fas fa-check"></i>
                                                <div class="media-body"><?php echo htmlspecialchars($seguro['descripcion4']); ?></div>
                                            </li>
                                            <li class="media"><i class="fas fa-check"></i>
                                                <div class="media-body"><?php echo htmlspecialchars($seguro['descripcion5']); ?></div>
                                            </li>
                                            <li class="media"><i class="fas fa-check"></i>
                                                <div class="media-body"><?php echo htmlspecialchars($seguro['descripcion6']); ?></div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                            <form method="POST" action="paypal.php">
                                                <button type="submit" class="btn-solid-reg page-scroll" name="buy"
                                                    value="<?php echo htmlspecialchars($seguro['id']); ?>">Comprar</button>
                                            </form>
                                            <br>
                                            <form method="POST" action="cotizar.php">
                                                <button type="submit" class="btn-solid-reg page-scroll" name="pdf"
                                                    value="moto">Cotizacion</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        </div> <!-- end of tab-pane -->
                        <!-- end of tab -->

                        <!-- Tab -->

                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
                            <div class="row">
                                
                            <?php foreach ($segurosVehi as $seguro) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title"><?php echo htmlspecialchars($seguro['calidad']); ?></div>
                                        <div class="price"><span class="currency">$</span><span class="value"><?php echo htmlspecialchars($seguro['precio']); ?></span></div>
                                        <div class="frequency">Mensualmente</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                        <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion2']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion3']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion4']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion5']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion6']); ?></div></li>
                                        </ul>
                                        <div class="button-wrapper">
                                            <form method="POST" action="paypal.php">
                                                <button type="submit" class="btn-solid-reg page-scroll" name="buy" value="<?php echo htmlspecialchars($seguro['id']); ?>">Comprar</button>
                                            </form>
                                            <br>
                                            <form method="POST" action="cotizar.php">
                                                <button type="submit" class="btn-solid-reg page-scroll" name="pdf" value="vehi">Cotizacion</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                            </div> <!-- end of col -->
                        </div> <!-- end of col -->


                        <!-- end of tab -->

                        <!-- Tab -->

                        <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                            <div class="row">
                                
                            <?php foreach ($segurosUtil as $seguro) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title"><?php echo htmlspecialchars($seguro['calidad']); ?></div>
                                        <div class="price"><span class="currency">$</span><span class="value"><?php echo htmlspecialchars($seguro['precio']); ?></span></div>
                                        <div class="frequency">Mensualmente</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                        <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion2']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion3']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion4']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion5']); ?></div></li>
                                            <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion6']); ?></div></li>
                                        </ul>
                                        <div class="button-wrapper">
                                            <form method="POST" action="paypal.php">
                                                <button type="submit" class="btn-solid-reg page-scroll" name="buy" value="<?php echo htmlspecialchars($seguro['id']); ?>">Comprar</button>
                                            </form>
                                            <br>
                                            <form method="POST" action="cotizar.php">
                                                <button type="submit" class="btn-solid-reg page-scroll" name="pdf" value="util">Cotizacion</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                            </div> <!-- end of col -->
                        </div> <!-- end of col -->

                    </div> <!-- end of tab-pane -->
                </div> <!-- end of row -->
            </div> <!-- end of tab-pane -->
            <!-- end of tab -->

        </div> <!-- end of tab content -->


    </div> <!-- end of col -->
    </div> <!-- end of row -->
    </div> <!-- end of container -->
    </div> <!-- end of cards-2 -->
    <!-- end of pricing -->


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