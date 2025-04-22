<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeLine</title>
    <!-- Favicon  -->
    <link rel="icon" href="../../assets/boss/images/favicon.png">
</head>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

$pdo = getConnection();

if (empty($_GET['id']) || empty($_GET['token'])) {
    echo '<p><script>Swal.fire({
        title: "Información que falta",
        text: "Falta el ID de usuario o el token.",
        icon: "error"
    }).then(function() {
        window.location = "../user_spanish/login.php"; // Redirigir al login
    });</script></p>';
    exit;
}

$user_id = $_GET['id'];
$token = $_GET['token'];

if (!verificaTokenPass($user_id, $token, $pdo)) {
    echo '<p><script>Swal.fire({
        title: "Token no válido",
        text: "La información no ha podido ser verificada.",
        icon: "error"
    }).then(function() {
        window.location = "../user_spanish/login.php"; // Redirigir al login
    });</script></p>';
    exit;
}

// Si llega aquí, la verificación fue exitosa, se permite la ejecución del código de guarda_Pass.php
?>





<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Title -->
    <title>LifeLine</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles2.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../../assets/boss/images/favicon.png">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Navigation -->

    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="ex-2-header">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1> Cambiar contraseña</h1>
                    <br>
                    <!-- Sign Up Form -->
                    <div class="form-container">
                        <form id="loginform" action="guarda_Pass.php" method="POST">
                            <div class="card-header">
                                <a class="navbar-brand logo-image" href=""><img
                                        src="../../assets/boss/images/padlock-unlock.png" alt="alternative"
                                        width="100px"></a>
                            </div>
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" />
                            <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />
                            <div class="form-group">
                                <label class="small mb-1" for="inputPassword">Nueva contraseña</label>
                                <input class="form-control py-4"onpaste="return false;" id="inputPassword" name="password" type="password"
                                    placeholder="Enter password" />
                                <label class="small mb-1" for="inputPassword">Confirmar contraseña</label>
                                <input class="form-control py-4" onpaste="return false;" id="inputPassword" name="con_password" type="password"
                                    placeholder="Enter password"  />
                            </div>
                            <label class="small mb-1" for="usuario">La contraseña debe tener al menos 8 caracteres
                                e incluir al menos una letra mayúscula, un número y un carácter especial.
                                especial.</label>
                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                <button type="submit" class="form-control-submit-button">Send</a>
                            </div>
                            <a class="small" href="login.php">Volver al Inicio de sesion</a>
                        </form>

                    </div> <!-- end of form container -->
                    <!-- end of sign up form -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->


    <!-- Scripts -->
    <script src="../../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../../assets/boss/js/jquery.easing.min.js"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <!--  <script src="boss/js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
    <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>