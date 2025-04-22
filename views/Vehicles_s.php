<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../funcs/conexion.php';
require '../funcs/funcs.php';

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

    // Obtener datos de seguros
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
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
    <title>LifeLine</title>
    <link rel="icon" href="../assets/boss/images/favicon.png">
    <link href="../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../assets/boss/css/styles.css" rel="stylesheet">
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

        <!-- Navegación -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Logo de imagen -->
            <a class="navbar-brand logo-image" href="index.php"><img src="../assets/boss/images/logo.png"
                    alt="alternativo"></a>

            <!-- Botón de alternancia del menú móvil -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Alternar navegación">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- end of mobile menu toggle button -->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index_spanish.php">INICIO <span class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="Vehicles.php">ENGLISH <span
                                class="sr-only">(actual)</span></a>
                    </li>

                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="user_spanish/login.php">INICIAR SESIÓN</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Encabezado -->
    <header id="header" class="header">
        <div class="header-content"></div>
    </header>

    <!-- Detalles -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Ahora es el momento de mejorar tu seguro de auto</h2>
                        <p>En LifeLine nos enfocamos en la seguridad de nuestros clientes, por eso ofrecemos los mejores planes de seguro de auto. Haz clic abajo para solicitar una cotización de precios.</p>
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
                                <div class="media-body">Responsabilidad civil por daños a bienes de terceros</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Servicio de grúa 24/7 en todo el país</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../assets/images/33.png" alt="alternativo">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Precios -->
    <div id="pricing" class="cards-2 tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">PRECIOS</div>
                    <h2 class="h2-heading">Tabla de Opciones de Precios</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tabs Links -->
                    <ul class="nav nav-tabs" id="argoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true"><i class="fas fa-motorcycle"></i>Motocicleta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false"><i class="fas fa-car"></i>Civil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false"><i class="fas fa-tractor"></i>Utilitario</a>
                        </li>
                    </ul>
                    <!-- end of tabs links -->

                    <!-- Tabs Content -->
                    <div class="tab-content" id="argoTabsContent">
                        <!-- Tab Motocicleta -->
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                            <div class="row">
                                <?php foreach ($segurosMoto as $seguro) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title"><?php echo htmlspecialchars($seguro['calidad']); ?></div>
                                        <div class="price"><span class="currency">$</span><span class="value"><?php echo htmlspecialchars($seguro['precio']); ?></span></div>
                                        <div class="frequency">Mensual</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <?php if(trim($seguro['descripcion']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion2']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion2']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion3']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion3']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion4']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion4']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion5']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion5']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion6']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion6']); ?></div></li>
                                            <?php } ?>
                                        </ul>
                                        <div class="button-wrapper">
                                            <button type="button" class="btn-solid-reg page-scroll" onclick="mostrarAlertaRegistro();">Comprar</button>
                                            <br>
                                            <form method="POST" action="cotizar.php">
                                                <br>
                                                <button type="submit" class="btn-solid-reg page-scroll" name="pdf" value="moto">Más Información</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- end of tab Motocicleta -->

                        <!-- Tab Civil -->
                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
                            <div class="row">
                                <?php foreach ($segurosVehi as $seguro) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title"><?php echo htmlspecialchars($seguro['calidad']); ?></div>
                                        <div class="price"><span class="currency">$</span><span class="value"><?php echo htmlspecialchars($seguro['precio']); ?></span></div>
                                        <div class="frequency">Mensual</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <?php if(trim($seguro['descripcion']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion2']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion2']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion3']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion3']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion4']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion4']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion5']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion5']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion6']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion6']); ?></div></li>
                                            <?php } ?>
                                        </ul>
                                        <div class="button-wrapper">
                                            <button type="button" class="btn-solid-reg page-scroll" onclick="mostrarAlertaRegistro();">Comprar</button>
                                            <br>
                                            <form method="POST" action="cotizar.php">
                                                <br>
                                                <button type="submit" class="btn-solid-reg page-scroll" name="pdf" value="vehi">Cotización</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- end of tab Civil -->

                        <!-- Tab Utilitario -->
                        <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                            <div class="row">
                                <?php foreach ($segurosUtil as $seguro) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title"><?php echo htmlspecialchars($seguro['calidad']); ?></div>
                                        <div class="price"><span class="currency">$</span><span class="value"><?php echo htmlspecialchars($seguro['precio']); ?></span></div>
                                        <div class="frequency">Mensual</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <?php if(trim($seguro['descripcion']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion2']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion2']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion3']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion3']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion4']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion4']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion5']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion5']); ?></div></li>
                                            <?php } ?>
                                            <?php if(trim($seguro['descripcion6']) !== '') { ?>
                                                <li class="media"><i class="fas fa-check"></i><div class="media-body"><?php echo htmlspecialchars($seguro['descripcion6']); ?></div></li>
                                            <?php } ?>
                                        </ul>
                                        <div class="button-wrapper">
                                            <button type="button" class="btn-solid-reg page-scroll" onclick="mostrarAlertaRegistro();">Comprar</button>
                                            <br>
                                            <form method="POST" action="cotizar.php">
                                                <br>
                                                <button type="submit" class="btn-solid-reg page-scroll" name="pdf" value="util">Cotización</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- end of tab Utilitario -->

                    </div> <!-- end of tab-content -->
                </div> <!-- end of row -->
            </div> <!-- end of col -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-2 -->
    <!-- end of pricing -->

    <!-- Pie de página -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>Acerca de LifeLine</h4>
                        <p class="p-small">Somos una de tus mejores opciones en el mercado para adquirir una póliza de seguros.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Enlaces Importantes</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Nuestros socios comerciales <a class="white" href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Lee nuestros <a class="white" href="../../views/terms-conditions.html">Términos & Condiciones</a>, <a class="white" href="../../privacy-policy.html">Política de Privacidad</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contacto</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-map-marker-alt"></i><div class="media-body">Calle Don Bosco y Av. Manuel Gallardo, 1-1, Santa Tecla</div></li>
                            <li class="media"><i class="fas fa-envelope"></i><div class="media-body"><a class="white" href="mailto:lifeline.ptc.2024@gmail.com">lifeline.ptc.2024@gmail.com</a><i class="fas fa-globe"></i><a class="white" href="#your-link">www.LifeLine.com</a></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of footer -->

    <!-- Derechos de autor -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 Plantilla de LifeLine</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end of copyright -->

    <!-- Scripts -->
    <script src="../assets/boss/js/jquery.min.js"></script> <!-- jQuery para los plugins de JavaScript de Bootstrap -->
    <script src="../assets/boss/js/popper.min.js"></script> <!-- Biblioteca Popper tooltip para Bootstrap -->
    <script src="../assets/boss/js/bootstrap.min.js"></script> <!-- Framework Bootstrap -->
    <script src="../assets/boss/js/jquery.easing.min.js"></script>
    <script src="../assets/boss/js/swiper.min.js"></script> <!-- Swiper para deslizadores de imágenes y texto -->
    <script src="../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup para cuadros de luz -->
    <script src="../assets/boss/js/scripts.js"></script> <!-- Scripts personalizados -->
    <script>
function mostrarAlertaRegistro() {
    Swal.fire({
        icon: 'warning',
        title: '¡Necesitas registrarte primero!',
        text: 'Por favor, regístrate o inicia sesión para continuar.',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'user_spanish/login.php';
        }
    });
}
</script>

</body>

</html>
