
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

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Tivo is a HTML landing page template built with Bootstrap to help you crate engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">



    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles2.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../../assets/images/favicon.png">
</head>

<body data-spy="scroll" data-target=".fixed-top"><a href="body" class="back-to-top page-scroll">Back to Top</a>




    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="login.php"><img src="../../assets/boss/images/logo.png"
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
                        <a class="nav-link page-scroll" href="index.php">INICIO <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../user/registro.php">ENGLISH <span class="sr-only">(current)</span></a>
                    </li>

                    <!-- Dropdown Menu -->
                    

                    
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="login.php">INCIA SESION</a>
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
                    <h1>Regístrate</h1>
                    <br>
                    <!-- Sign Up Form -->
                    <div class="form-container">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="nombre">Nombre completo</label>
                                        <input class="form-control-input" id="nombre" name="nombre" type="text"
                                            placeholder="Ingrese tu nombre completo" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="usuario">Usuario</label>
                                        <input class="form-control-input" id="usuario" name="usuario" type="text"
                                            placeholder="Ingresa Usuario" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Correo electronico</label>
                                <input class="form-control-input" id="inputEmailAddress" name="email" type="email"
                                    aria-describedby="emailHelp" placeholder="Ejemplo@gmail.com" />
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">contraseña</label>
                                        <input class="form-control-input" id="inputPassword" name="password"
                                            placeholder="Contraseña" type="password" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputConfirmPassword">Confirmar contraseña</label>
                                        <input class="form-control-input" id="inputConfirmPassword" name="passwordc"
                                            type="password" placeholder="Confirmar contraseña" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4 mb-0"><button type="submit"
                                    class="form-control-submit-button">Crear cuenta</button></div>
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
    <!-- <script src="boss/js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
    <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->

</body>

</html>
<?php
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';
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

    trim($nombre);
    trim($usuario);
    trim($password);
    trim($email);

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number= preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if ($nombre == "" || $usuario == "" || $password == "" || $passwordc == "" || $email == "") {
        echo '<p><script>swal({
            title: "ERROR!",
            text: "No dejes espacios vacios",
            icon: "error",
            });</script></p>';
        $i = 100;
        $errors[] = "blank spaces";

    } else {
        if (!isEmail($email)) {
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "E-mail invalido, ingrese uno correcto",
                icon: "error"
                });</script></p>';

        } elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
            $errors[] = "La contraseña debe tener al menos 8 caracteres e incluir como mínimo una letra mayúscula, un número y un carácter especial.";
            echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "La contraseña debe tener al menos 8 caracteres e incluir como mínimo una letra mayúscula, un número y un carácter especial.",
            icon: "error"
            });</script></p>';
        } elseif (!validaPassword($password, $passwordc)) {
            $errors[] = "Las contraseñas no conciden";
            echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Las contraseñas no conciden",
            icon: "error"
            });</script></p>';

        } elseif (usuarioExiste($usuario)) {
            $errors[] = "El : $usuario, ya existe";
            echo '<p><script>Swal.fire({
                   title: "ERROR",
                   text: "El usuario, ya existe",
                   icon: "error"
                   });</script></p>';
        } elseif (emailExiste($email)) {
            $errors[] = "El E-Mail: $email ya existe";
            echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "El E-mail ya existe",
            icon: "error"
            });</script></p>';

        }else{
            if (count($errors) == 0) {
                function generador()
                {
                    $n = range(10, 99);
                    shuffle($n);
                    $resultado = '';
                    for ($x = 0; $x < 5; $x++) {
                        $resultado .= $n[$x] . ' ';
                    }
                    return $resultado;
                }
                //esto hace que las contraseñas tenga el encripatado en la base de datos
                $pass_hash = hashPassword($password);
                ///////////////
                $token = generateToken();
                $codigo = generador();
                $hora = date('h:i a', time() - 3600 * date('I'));
                $fecha = date("d/m/Y");
                $fechaRegistro = $fecha . " " . $hora;
                $estatus = "Active now";
                $ran_id = rand(time(), 100000000);
                //convertimos el proceso del registro el una sola variable para mandarla a llamar 
                $registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $token, $tipo_usuario, $codigo, $estatus, $fechaRegistro, $ran_id);
                //proceso para acitvar la cuenta registrada si la variable registro es 0 hara el proceso
                if ($registro > 0) {
        
                    $url = 'http://' . $_SERVER["SERVER_NAME"] . '/PTC/views/activar.php?id=' . $registro . '&val=' . $token;
                    //el asuto y cuerpo es lo que ira en el mesaje del correo
                    $asunto = 'PIN - LIFELINE';
                    $cuerpo = "Estimado $nombre: <br /><br />este es su código de identificación personal, no lo comparta con nadie: $codigo <br /><br /> Confirma tu identidad <a href='$url'>Confirma el correo</a>";
                    //aca se envia el correo usando las anteriores mencionadas variables
                    if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {
        
                        echo '<p><script>swal({
                            title: "Good job!",
                            text: "Con éxito, Confirme su identidad en su correo electrónico ",
                            icon: "success",
                             }).then(function() {
                            window.location = "../../views/login.php";
                            });</script></p>';
        
                    } else {
                        echo '<p><script>Swal.fire({
                            title: "Opsss!",
                            text: "Tenemos un problema, inténtelo de nuevo",
                            type: "error"
                            }).then(function() {
                            window.location = "../../views/registro.php";
                            });</script></p>';
                    }
        
                } else {
                    $errors[] = "Error";
                    echo '<p><script>Swal.fire({
                        title: "ERROR",
                        text: "Registrarse ERROR",
                        icon: "error"
                        });</script></p>';
                }
            }

        }

    }

}
?>