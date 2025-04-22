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
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

$pdo = getConnection(); 

$errors = array();

if (!empty($_POST)) {
    $correo = $_POST['email'];

    // Validar formato de correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
       
    } else {
        // Encriptar el correo
        $email = encryptPayload($correo);
        
        // Desencriptar para verificar la dirección
        $decryptedEmail = decryptPayload($email);

        // Verificar si el correo desencriptado es válido
        if (!filter_var($decryptedEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "An error occurred while processing the e-mail.";
        } else {
            // Verificar si el correo electrónico existe en la base de datos
            if (emailExiste($pdo, $email)) {
                // Obtener el ID y el nombre del usuario
                $user_id = getValor('id', 'correo', $email, $pdo);
                $nombre = getValor('nombre', 'correo', $email, $pdo);

                // Generar token de recuperación de contraseña
                $token = generateTokenPass($user_id, $pdo);
                
                // Verifica manualmente si el token y el campo password_request se han actualizado
                $stmt = $pdo->prepare("SELECT token_password, password_request FROM users WHERE id = :id");
                $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Construir la URL para el correo de recuperación
                $url = 'http://' . $_SERVER["SERVER_NAME"] . '/PTC2/views/user/cambiaPass.php?id=' . $user_id . '&token=' . $token;

                // Construir el asunto y cuerpo del correo
                $asunto = 'Recover Password - LIFELINE';
                $cuerpo = "Dear $nombre: <br /><br /> A password reset has been requested. <br /> To reset your password, click on the following link: <a href='$url'>$url</a>";

                // Enviar el correo electrónico utilizando la dirección desencriptada
                if (enviarEmail($decryptedEmail, $nombre, $asunto, $cuerpo)) {
                    echo '<p><script>Swal.fire({
                        title: "E-Mail Sent!",
                        text: "Check your E-Mail",
                        icon: "success"
                    }).then(function() {
                        window.location = "../user/login.php";
                    });</script></p>';
                    exit;
                } else {
                    echo '<p><script>Swal.fire({
                        title: "Opsss!",
                        text: "We got a problem sending the E-Mail!",
                        icon: "error"
                    }).then(function() {
                        window.location = "../user/registro.php";
                    });</script></p>';
                }
            } else {
                echo '<p><script>Swal.fire({
                    title: "Opsss!",
                    text: "This E-Mail address does not exist, try again",
                    icon: "error"
                }).then(function() {
                    window.location = "../user/registro.php";
                });</script></p>';
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Title -->
    <title>Log In</title>

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


<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container">

                <!-- Text Logo - Use this if you don't have a graphic logo -->
                <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

                <!-- Image Logo -->
                <a class="navbar-brand logo-image" href="../index.php"><img src="../../assets/boss/images/logo.png"
                        alt="alternative"></a>

                <!-- Mobile Menu Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-awesome fas fa-bars"></span>
                    <span class="navbar-toggler-awesome fas fa-times"></span>
                </button>
                <!-- end of mobile menu toggle button -->

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <!-- Preloader -->
                    <div class="spinner-wrapper">
                        <div class="spinner">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </div>
                    <!-- end of preloader -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="../index.php">HOME<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="../user_spanish/login.php">ESPAÑOL<span
                                    class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <span class="nav-item">
                        <a class="btn-outline-sm" href="../user/registro.php">SIGN UP</a>
                    </span>
                </div>
            </div> <!-- end of container -->
        </nav> <!-- end of navbar -->
        <!-- end of navigation -->

    <!-- Header -->
    <header id="header" class="ex-2-header">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Password Recovery</h1>
                    <br>
                    <!-- Sign Up Form -->
                    <div class="form-container">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="card-header">
                                <a class="navbar-brand logo-image" href=""><img src="../../assets/boss/images/padlock-unlock.png"
                                        alt="alternative" width="100px"></a>
                            </div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Enter your email address and we will send you a link
                                    to reset your password.</div>
                                <form id="loginform" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4" id="correo" name="email"
                                            type="email" aria-describedby="emailHelp"
                                            placeholder="Enter email address" />
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                        <button type="submit" class="form-control-submit-button">Send</a>
                                    </div>
                                    <div>
                                        <a class="small" href="../user/login.php">Return to login</a>
                                    </div>
                                </form>
                                <?php echo resultBlock($errors); ?>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="../user/registro.php">No account? Sign up!</a></div>
                            </div>
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
    <script src="../../assets/boss/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <!--  <script src="boss/js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
    <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>