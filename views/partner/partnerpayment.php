<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';

if (!isset($_SESSION['id'])) {
    echo '<script>Swal.fire({
          title: "Warning",
          text: "Login again",
          icon: "warning",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script>';
    exit;
}

$user_id = $_SESSION['id'];
$nombre = $_SESSION['nombre']; // Asumiendo que 'nombre' está en la sesión como texto plano
$correo = $_SESSION['correo']; // Asumiendo que 'correo' está en la sesión como texto plano
$tipo_usuario = ''; // Aquí debes definir la lógica para obtener el tipo de usuario según tu aplicación.

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['plan'], $_POST['precio'])) {
    $plan = htmlspecialchars($_POST['plan']);
    $precio = htmlspecialchars($_POST['precio']);
} else {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Data not received.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "pagar.php";
          });</script>';
    exit;
}

$pdo = getConnection();

try {
    $stmt = $pdo->prepare("INSERT INTO compra_plan (user_id, nombre, correo, tipo_usuario, plan, precio, estado) 
                           VALUES (:user_id, :nombre, :correo, :tipo_usuario, :plan, :precio, 'pendiente')");
    $stmt->execute([
        'user_id' => $user_id,
        'nombre' => $nombre,
        'correo' => $correo,
        'tipo_usuario' => $tipo_usuario,
        'plan' => $plan,
        'precio' => $precio
    ]);

    $id_compra = $pdo->lastInsertId();

} catch (PDOException $e) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Database error: ' . $e->getMessage() . '",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "pagar.php";
          });</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payment - LifeLine</title>
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">
    <link rel="icon" href="../../assets/boss/images/favicon.png">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=Adr_ywjoTw8okgpD-dlDRDpaYbzlg3lh5L97nYjfvv3RFnbcCty-Z37ZH7SXoKR9eAQAye7J3P-vbRz_&currency=USD"></script>
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
            <a class="navbar-brand logo-image" href="view_user.php"><img src="../../assets/boss/images/logo.png"
                    alt="alternative"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
        </div>
    </nav>
    <!-- end of navigation -->

    <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Payment Information</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- end of header -->

    <!-- Payment Information -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mt-5">Payment Information</h1>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Plan</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $plan; ?></td>
                            <td>$<?php echo $precio; ?></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                <input type="hidden" id="id_compra" value="<?php echo $id_compra; ?>">
                <div id="paypal-button-container" class="mt-3"></div>
            </div>
        </div>
    </div>

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
                        <h4>About Tivo</h4>
                        <p class="p-small">We're passionate about offering some of the best business growth services for
                            start more words</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Our business partners <a class="white"
                                        href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Read our <a class="white" href="terms-conditions.html">Terms &
                                        Conditions</a>, <a class="white" href="privacy-policy.html">Privacy Policy</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">22 Innovative, San Francisco, CA 94043, US</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-envelope"></i>
                                <div class="media-body"><a class="white"
                                        href="mailto:contact@Tivo.com">contact@Tivo.com</a> <i
                                        class="fas fa-globe"></i><a class="white" href="#your-link">www.Tivo.com</a>
                                </div>
                            </li>
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
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Template by Inovatik</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- end of copyright -->

    <!-- Scripts -->
    <script src="../../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../../assets/boss/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->

    <script>
        $(document).ready(function () {
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '<?php echo $precio; ?>'
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        var user_id = document.getElementById('user_id').value;
                        var id_compra = document.getElementById('id_compra').value;

                        $.ajax({
                            url: 'status.php',
                            type: 'POST',
                            data: {
                                user_id: user_id,
                                id_compra: id_compra,
                                estado: 'completed'
                            },
                            success: function (response) {
                                console.log('ID de la compra:', id_compra);

                                Swal.fire({
                                    title: 'Success',
                                    text: 'Payment process completed',
                                    icon: 'success'
                                }).then(function () {
                                    window.location = 'facturap.php?id_compra=' + id_compra;
                                });
                            },

                            error: function () {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Payment failed',
                                    icon: 'error'
                                });
                            }
                        });
                    });
                }
            }).render('#paypal-button-container');
        });
    </script>
</body>
</html>
