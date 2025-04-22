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

    // Obtener datos de seguros médicos
    $segurosMedical = getSegurosByTipo($pdo, 'Medical');

    function compararPrecios($a, $b) {
        return $a['precio'] - $b['precio'];
    }

    usort($segurosMedical, 'compararPrecios');

} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand logo-image" href="index.php"><img src="../assets/boss/images/logo.png" alt="alternative"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.php">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="Medical_s.php">ESPAÑOL <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="user/login.php">LOG IN</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content"></div>
    </header>
    <!-- end of header -->

    <!-- Details -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Now is the time to upgrade your healthcare coverage</h2>
                        <p>Here at LifeLine we focus on our customer's health, that's why we offer the best healthcare insurance plans. Click down below to enter a request for a price quote.</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Death from any cause</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Natural death, accidental death and/or suicide</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Funeral expenses</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Personal accidents</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Total and permanent disability</div></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../assets/images/44.png" alt="alternative">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing -->
    <div id="pricing" class="cards-2 tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">PRICING</div>
                    <h2 class="h2-heading">Pricing Options Table</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="argoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab"
                                aria-controls="tab-1" aria-selected="true"><i class="fas fa-heartbeat"></i>HealthCare</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="argoTabsContent">
                        <!-- Medical Tab -->
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                            <div class="row">
                                <?php foreach ($segurosMedical as $seguro) { ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title"><?php echo htmlspecialchars($seguro['calidad']); ?>
                                            </div>
                                            <div class="price"><span class="currency">$</span><span class="value"><?php echo htmlspecialchars($seguro['precio']); ?></span></div>
                                            <div class="frequency">Monthly</div>
                                            <div class="divider"></div>
                                            <ul class="list-unstyled li-space-lg">
                                                <?php for ($i = 2; $i <= 6; $i++) { 
                                                    $descripcion = "descripcion{$i}";
                                                    if (trim($seguro[$descripcion]) !== '') { ?>
                                                        <li class="media"><i class="fas fa-check"></i>
                                                            <div class="media-body">
                                                                <?php echo htmlspecialchars($seguro[$descripcion]); ?>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                            <div class="button-wrapper">
                                                <button type="button" class="btn-solid-reg page-scroll" onclick="showRegisterAlert();">Buy</button>
                                                <form method="POST" action="actions/Create_medical.php">
                                                    <br>
                                                    <input type="hidden" name="tipo_seguro" value="Medical">
                                                    <button type="submit" class="btn-solid-reg page-scroll" name="pdf" value="Medical">More Information</button>
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

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>About LifeLine</h4>
                        <p class="p-small">We are one of your best options in the market to acquire an insurance policy.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Our business partners <a class="white" href="#your-link">startupguide.com</a></div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body">Read our <a class="white" href="terms-conditions.html">Terms & Conditions</a>, <a class="white" href="privacy-policy.html">Privacy Policy</a></div></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-map-marker-alt"></i><div class="media-body"> Calle Don Bosco y Av. Manuel Gallardo, 1-1, Santa Tecla</div></li>
                            <li class="media"><i class="fas fa-envelope"></i><div class="media-body"><a class="white" href="mailto:lifeline.ptc.2024@gmail.com">lifeline.ptc.2024@gmail.com</a><i class="fas fa-globe"></i><a class="white" href="#your-link">www.LifeLine.com</a></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of footer -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 Template by LifeLine</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end of copyright -->

    <!-- Scripts -->
    <script src="../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../assets/boss/js/jquery.easing.min.js"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->

    <script>
        function showRegisterAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'You need to register first!',
                text: 'Please register or log in to continue.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'user/login.php';
                }
            });
        }
    </script>
</body>

</html>
