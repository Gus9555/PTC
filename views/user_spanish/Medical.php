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

    // Obtener datos de seguros médicos
    $segurosMedical = getSegurosByTipo($pdo, 'Medical');

    function compararPrecios($a, $b) {
        return $a['precio'] - $b['precio'];
    }

    usort($segurosMedical, 'compararPrecios');

} catch (PDOException $e) {
    echo 'Error en la consulta: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
   
    <title>LifeLine</title>
    <link rel="icon" href="../../assets/boss/images/favicon.png">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">
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
            <a class="navbar-brand logo-image" href="view_user.php"><img src="../../assets/boss/images/logo.png" alt="alternativo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Navegación de palanca">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="view_user.php">INICIO <span class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../spanish/Medical.php">ESPAÑOL <span class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../../views/support/users.php">CHAT-SOPORTE <span class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../profile/profile.php">PERFIL <span class="sr-only">(actual)</span></a>
                    </li>
                    
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="logout.php">CERRAR SESIÓN</a>
                </span>
            </div>
        </div> <!-- fin del container -->
    </nav> <!-- fin del navbar -->
    <!-- fin de la navegación -->

    <!-- Encabezado -->
    <header id="header" class="header">
        <div class="header-content"></div>
    </header>
    <!-- fin del encabezado -->

    <!-- Detalles -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Ahora es el momento de mejorar tu cobertura de salud</h2>
                        <p>Aquí en LifeLine nos enfocamos en la salud de nuestros clientes, por eso ofrecemos los mejores planes de seguros de salud. Haz clic abajo para ingresar una solicitud de cotización de precios.</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Muerte por cualquier causa</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Muerte natural, muerte accidental y/o suicidio</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Gastos funerarios</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Accidentes personales</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Incapacidad total y permanente</div></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../../assets/images/44.png" alt="alternativo">
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
                    <ul class="nav nav-tabs" id="argoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true"><i class="fas fa-heartbeat"></i>Salud</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="argoTabsContent">
                        <!-- Pestaña de salud -->
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                            <div class="row">
                                <?php foreach ($segurosMedical as $seguro) { ?>
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
                                        <form method="POST" action="paypal.php">
    <button type="submit" class="btn-solid-reg page-scroll" name="buy" value="<?php echo htmlspecialchars($seguro['id']); ?>">Comprar</button>
</form>

                                            <form method="POST" action="../actions/Create_medical.php">
                                                <button type="submit" class="btn-solid-reg page-scroll" name="pdf" value="medical">Cotización</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>Sobre LifeLine</h4>
                        <p class="p-small">Somos una de tus mejores opciones en el mercado para adquirir una póliza de seguros.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Enlaces Importantes</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Nuestros socios comerciales <a class="white" href="#your-link">startupguide.com</a></div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Lee nuestros <a class="white" href="terms-conditions.html">Términos y Condiciones</a>, <a class="white" href="privacy-policy.html">Política de Privacidad</a></div></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contacto</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-map-marker-alt"></i><div class="media-body"> Calle Don Bosco y Av. Manuel Gallardo, 1-1, Santa Tecla</div></li>
                            <li class="media"><i class="fas fa-envelope"></i><div class="media-body"><a class="white" href="mailto:lifeline.ptc.2024@gmail.com">lifeline.ptc.2024@gmail.com</a><i class="fas fa-globe"></i><a class="white" href="#your-link">www.LifeLine.com</a></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin del pie de página -->

    <!-- Derechos de autor -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 Plantilla por LifeLine</p>
                </div>
            </div>
        </div>
    </div>
    <!-- fin de los derechos de autor -->

    <!-- Scripts -->
    <script src="../../assets/boss/js/jquery.min.js"></script> <!-- jQuery para los plugins de JavaScript de Bootstrap -->
    <script src="../../assets/boss/js/popper.min.js"></script> <!-- Biblioteca Popper para las herramientas de Bootstrap -->
    <script src="../../assets/boss/js/bootstrap.min.js"></script> <!-- Framework Bootstrap -->
    <script src="../../assets/boss/js/jquery.easing.min.js"></script> <!-- jQuery Easing para un desplazamiento suave entre anclas -->
    <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper para deslizadores de imágenes y texto -->
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup para lightboxes -->
    <!--<script src="js/validator.min.js"></script>  Validator.js - Bootstrap plugin que valida formularios -->
    <script src="../../assets/boss/js/scripts.js"></script> <!-- Scripts personalizados -->
</body>
</html>
