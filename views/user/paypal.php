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
    exit;
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
$id_comprador = $_SESSION['id']; // Suponiendo que este es el id del comprador

$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buy'])) 
    $seguro_id = $_POST['buy'];
    

    if (!filter_var($seguro_id, FILTER_VALIDATE_INT)) {
        echo "Invalid insurance ID.";
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM seguros WHERE id = :id");
        $stmt->bindParam(':id', $seguro_id, PDO::PARAM_INT);
        $stmt->execute();
        $seguro = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        exit;
    }

    if (!$seguro) {
        echo "Insurance not found.";
        exit;
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' https://code.jquery.com https://cdnjs.cloudflare.com;">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions</title>
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
    <!-- end of preloader -->

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand logo-image" href="index.html"><img src="../../assets/boss/images/logo.png" alt="alternative"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="view_user.php">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../spanish/buy.php">ESPAÑOL <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../support/users.php">CHAT-SUPPORT <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../profile/profile.php">MY PROFILE <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.html#pricing">PRICING</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="log-in.html">LOG IN</a>
                </span>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Terms & Conditions</h1>
                </div>
            </div>
        </div>
    </header>

    

    <!-- Terms Content -->
    <div class="ex-basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h3>Introduction</h3>
                        <p>Welcome to LifeLine. By purchasing or using our insurance products and services, you agree to comply with and be bound by the following terms and conditions. Please read these Terms carefully. If you do not agree with these Terms, you should not use our products or services.</p>

                        <h3>Definitions</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Policyholder:</b> The individual or entity that has purchased an insurance policy from LifeLine.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Insured:</b> The individual(s) or entity covered under the insurance policy.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Policy:</b> The insurance contract between the policyholder and LifeLine.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Premium:</b> The amount paid by the policyholder to LifeLine's for insurance coverage.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Claim:</b> A request by the insured or policyholder for payment or services under the terms of the policy.</div></li>
                        </ul>
                    </div>

                    <div class="text-container">
                        <h3>Policy Agreement</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Coverage:</b> The coverage provided by the insurance policy is specified in the policy documentation, including any endorsements, riders, or amendments.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Policy Period:</b> The duration of the policy is stated in the policy documentation. Coverage begins and ends at 12:01 AM local time at the insured's address on the dates specified.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Premium Payments:</b> Premiums must be paid on time to maintain coverage. Failure to pay premiums may result in cancellation of the policy.</div></li>
                            <li class="media"><i class="fas fa-square"></i><div class="media-body"><b>Cancellation:</b> Either party may cancel the policy as outlined in the policy documentation. Refunds of unearned premiums will be handled as specified in the policy terms.</div></li>
                        </ul>
                    </div>

                    <div class="text-container">
                        <p>LifeLine reserves the right to amend these Terms at any time. Any amendments will be communicated to the policyholder and will become effective as specified in the communication.</p>
                    </div>

                    <style>
        input[type="checkbox"] {
            transform: scale(1.5); /* Cambia el valor según el tamaño deseado */
            -webkit-transform: scale(1.5); /* Para compatibilidad con navegadores antiguos */
        }
    </style>
    <?php
    if ($seguro['seguro'] == "motorcycle") {
        $echoSeguro = "Motorcycle";
    } elseif ($seguro['seguro'] == "Vehicule") {
        $echoSeguro = "Vehicle";
    } else {
        $echoSeguro = $seguro['seguro'];
    }
    ?>

                    <div class="text-container last">
                        <h2>Selected Insurance</h2>
                        <p><b>Type of insurance:</b> <?php echo htmlspecialchars($echoSeguro); ?></p>
                        <p><b>Quality:</b> <?php echo htmlspecialchars($seguro['calidad']); ?></p>
                        <p><b>Policy Price:</b> $<?php echo htmlspecialchars($seguro['precio']); ?></p>

                        <div class="form-group">
                            <input type="checkbox" id="terms" name="terms" required onclick="togglePaymentButton()"> <b>I have read and I agree to LifeLine's Terms Conditions</b>
                        </div>

                        <div id="payment-button-container" style="display: none;">
                            <form action="datospago.php" method="post">
                                <input type="hidden" name="seguro" value="<?php echo htmlspecialchars($seguro['seguro']); ?>">
                                <input type="hidden" name="calidad" value="<?php echo htmlspecialchars($seguro['calidad']); ?>">
                                <input type="hidden" name="precio" value="<?php echo htmlspecialchars($seguro['precio']); ?>">
                                <button type="submit" class="btn-solid-reg page-scroll">Proceed to Payment</button>
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
                        <h4>About Tivo</h4>
                        <p class="p-small">We're passionate about offering some of the best business growth services for start more words</p>
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
                            <li class="media"><i class="fas fa-map-marker-alt"></i><div class="media-body">22 Innovative, San Francisco, CA 94043, US</div></li>
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
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Template by Inovatik</a></p>
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
