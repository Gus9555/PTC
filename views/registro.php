<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>LifeLine</title>
    <link rel="icon" href="../assets/boss/images/favicon.png">
</head>

<body>

</body>

</html>
<?php
require '../funcs/conexion.php';
require '../funcs/funcs.php';

$errors = array();
if (!empty($_POST)) {

    $nombre = $mysqli->real_escape_string($_POST['nombre']); //evita sql inyection
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $passwordc = $mysqli->real_escape_string($_POST['passwordc']);
    $email = $mysqli->real_escape_string($_POST['email']);
    // $captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);

    $activo = 0; //indica que al registrar el usuario este desactivado
    $tipo_usuario = 2; //indica privilegios que tendra el usuario NO ASIGNAREMOS ADMINS
    // $secret = ''; //colocar clave secreta del captcha.

    if (isNull($nombre, $usuario, $password, $passwordc, $email)) {
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Do not leave empty fields",
            icon: "error"
            });</script></p>';
    }

    if (!isEmail($email)) {
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Unvalid E-Mail address",
            icon: "error"
            });</script></p>';
    }

    if (!validaPassword($password, $passwordc)) {
        $errors[] = "Both passwords need to match";
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Both passwords need to match",
            icon: "error"
            });</script></p>';
    }

    if (usuarioExiste($usuario)) {
        $errors[] = "The username: $usuario, already exists";
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "This username already exists",
            icon: "error"
            });</script></p>';
    }

    if (emailExiste($email)) {
        $errors[] = "The E-Mail: $email already exists";
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "This E-Mail already exists",
            icon: "error"
            });</script></p>';
    }

    if (count($errors) == 0) {
        //esto hace que las contraseñas tenga el encripatado en la base de datos
        $pass_hash = hashPassword($password);
        $token = generateToken();
        //convertimos el proceso del registro el una sola variable para mandarla a llamar 
        $registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);
        //proceso para acitvar la cuenta registrada si la variable registro es 0 hara el proceso
        if ($registro > 0) {

            //esta es la variable que redireccionara al usuario en el correo que se le enviara
            $url = 'http://' . $_SERVER["SERVER_NAME"] . '/PTC/views/activar.php?id=' . $registro . '&val=' . $token;
            //el asuto y cuerpo es lo que ira en el mesaje del correo
            $asunto = 'Confirm E-Mail - LIFELINE';
            $cuerpo = "Deer $nombre: <br /><br /> For joining lifeline, click the next link. <a href='$url'>Confirm E-Mail</a>";
            //aca se envia el correo usando las anteriores mencionadas variables
            if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {

                echo '<p><script>swal({
                    title: "Good job!",
                    text: "Check your E-Mail",
                    icon: "success",
                     }).then(function() {
                    window.location = "../views/index.php";
                    });</script></p>';

            } else {
                echo '<p><script>Swal.fire({
                    title: "Opsss!",
                    text: "We got a problem sending the E-Mail, try again",
                    type: "error"
                    }).then(function() {
                    window.location = "../views/registro.php";
                    });</script></p>';
            }

        } else {
            $errors[] = "Error";
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "Sign Up ERROR",
                icon: "error"
                });</script></p>';
        }
    }

}
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

    <!-- Website Title -->
    <title>Sign Up</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/boss/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../assets/boss/css/styles2.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../assets/images/favicon.png">
</head>

<body data-spy="scroll" data-target=".fixed-top"><a href="body" class="back-to-top page-scroll">Back to Top</a>




    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="index.php"><img src="../assets/boss/images/logo.png"
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
                        <a class="nav-link page-scroll" href="index.php">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#features">FEATURES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#details">DETAILS</a>
                    </li>

                    <!-- Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle page-scroll" href="#video" id="navbarDropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">VIDEO</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="article-details.html"><span class="item-text">ARTICLE
                                    DETAILS</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="terms-conditions.html"><span class="item-text">TERMS
                                    CONDITIONS</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="privacy-policy.html"><span class="item-text">PRIVACY
                                    POLICY</span></a>
                        </div>
                    </li>
                    <!-- end of dropdown menu -->

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#pricing">PRICING</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="index.php">LOG IN</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="ex-2-header">
        <div class="container">
            <div class="row">
                <!-- Preloader -->
                <div class="spinner-wrapper" style="display: none;">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
                <!-- end of preloader -->
                <div class="col-lg-12">
                    <h1>Sign Up</h1>
                    <br>
                    <!-- Sign Up Form -->
                    <div class="form-container">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="nombre">Full name</label>
                                        <input class="form-control-input" id="nombre" name="nombre" type="text"
                                            placeholder="Enter Full name" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="usuario">Username</label>
                                        <input class="form-control-input" id="usuario" name="usuario" type="text"
                                            placeholder="Enter Username" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control-input" id="inputEmailAddress" name="email" type="email"
                                    aria-describedby="emailHelp" placeholder="Example@gmail.com" required />
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input class="form-control-input" id="inputPassword" name="password"
                                            placeholder="password" type="password" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputConfirmPassword">Confirm
                                            Password</label>
                                        <input class="form-control-input" id="inputConfirmPassword" name="passwordc"
                                            type="password" placeholder="Confirm password" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4 mb-0"><button type="submit"
                                    class="form-control-submit-button">Create Account</button></div>
                        </form>
                    </div> <!-- end of form container -->
                    <!-- end of sign up form -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->


    <!-- Scripts -->
    <script src="../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../assets/boss/js/jquery.easing.min.js"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <!-- <script src="boss/js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
    <script src="../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->

</body>

</html>