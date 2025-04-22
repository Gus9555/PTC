<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">

    <title>LifeLine</title>
    <link rel="icon" href="../../../assets/boss/images/favicon.png">
    <!-- Google Sign-In Library -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Tivo is a HTML landing page template built with Bootstrap to help you create engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../../assets/boss/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../../assets/boss/css/styles2.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../../../assets/images/favicon.png">
</head>

<body data-spy="scroll" data-target=".fixed-top">
    <a href="body" class="back-to-top page-scroll">Back to Top</a>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand logo-image" href="registro.php"><img src="../../../assets/boss/images/logo.png"
                    alt="alternative"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <div class="spinner-wrapper">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../../Admin/register_partner/registro.php">English <span
                                class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header id="header" class="ex-2-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Registrate</h1>
                    <br>
                    <!-- Sign Up Form -->
                    <div class="form-container">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="password_request"
                                            value="<?= $request['password_request'] ?? '0' ?>" />
                                        <label class="small mb-1" for="nombre">Nombre Completo</label>
                                        <input class="form-control-input" id="nombre" name="nombre" type="text"
                                            maxlength="35" size="35" onpaste="return false;"
                                            onkeypress="return (event.charCode >= 65 && event.charCode <= 122 ||  event.charCode == 32)"
                                            placeholder="Ingrese su nombre completo" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="usuario">Usuario</label>
                                        <input class="form-control-input" id="usuario" maxlength="35" size="35"
                                            name="usuario" type="text"onpaste="return false;"
                                            onkeypress="return (event.charCode >= 65 && event.charCode <= 122 ||  event.charCode == 45 ||  event.charCode == 95 ||  event.charCode == 36 ||  event.charCode == 45 || (event.charCode >= 48 && event.charCode <= 57))"
                                            placeholder="Ingrese su usuario" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Correo Electronico</label>
                                <input class="form-control-input" id="inputEmailAddress" name="email" type="email"
                                    aria-describedby="emailHelp"onpaste="return false;"
                                    onkeypress="return (event.charCode == 209 || event.charCode == 241 || (event.charCode >= 64 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) ||(event.charCode == 46)||(event.charCode == 95)||(event.charCode >= 48 && event.charCode <= 57))"
                                    maxlength="50" size="50" placeholder="ejemplo@gmail.com" />
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Contraseña</label>
                                        <input class="form-control-input" id="inputPassword" onpaste="return false;" maxlength="50" size="50"
                                            name="password" placeholder="Ingrese su contraseña" type="password"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputConfirmPassword">Confirme su Contraseña</label>
                                        <input class="form-control-input" id="inputConfirmPassword" name="passwordc"
                                            type="password" onpaste="return false;" maxlength="50" size="50" placeholder="Confirme la contraseña" />
                                    </div>
                                </div>
                            </div>
                            <label class="small mb-1" for="usuario">La contraseña debe incluir al menos 8 caracteres, un numero, una mayuscula y un caracter especial</label>
                            <div class="form-group mt-4 mb-0">
                                <button type="submit" class="form-control-submit-button">Crear Cuenta</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Scripts -->
    <script src="../../../assets/boss/js/jquery.min.js"></script>
    <script src="../../../assets/boss/js/popper.min.js"></script>
    <script src="../../../assets/boss/js/bootstrap.min.js"></script>
    <script src="../../../assets/boss/js/jquery.easing.min.js"></script>
    <script src="../../../assets/boss/js/swiper.min.js"></script>
    <script src="../../../assets/boss/js/jquery.magnific-popup.js"></script>
    <script src="../../../assets/boss/js/scripts.js"></script>

    <script>
        $(function () {
            $('#inputPassword').on('keypress', function (e) {
                if (e.which == 32) {
                    console.log('Space Detected');
                    return false;
                }
            });
        });
        $(function () {
            $('#inputConfirmPassword').on('keypress', function (e) {
                if (e.which == 32) {
                    console.log('Space Detected');
                    return false;
                }
            });
        });

    </script>
</body>

</html>

<?php
require_once '../../../funcs/conexion.php';
$pdo = getConnection();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../../funcs/funcs.php';
$errors = array();
$pago = 'pendiente';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y escapar datos del formulario
    $nombre = trim(htmlspecialchars($_POST['nombre']));
    $usuario = trim(htmlspecialchars($_POST['usuario']));
    $password = trim(htmlspecialchars($_POST['password']));
    $passwordc = trim(htmlspecialchars($_POST['passwordc']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password_request = $_POST['password_request'] ?? '0';  // Asegúrate de que esté definido

    // Validaciones y verificaciones de seguridad
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    $EspacioBlanco = "    ";

    $stmt4 = $pdo->prepare('SELECT * FROM talleres WHERE email = :email');
    $stmt4->execute(['email' => $email]);
    $row = $stmt4->fetch(PDO::FETCH_ASSOC);
    $stmt5 = $pdo->prepare('SELECT * FROM asociados WHERE email = :email');
    $stmt5->execute(['email' => $email]);
    $row = $stmt5->fetch(PDO::FETCH_ASSOC);
    $stmt6 = $pdo->prepare('SELECT * FROM constructuras WHERE email = :email');
    $stmt6->execute(['email' => $email]);
    $row = $stmt6->fetch(PDO::FETCH_ASSOC);
    if ($stmt4->rowCount() > 0 || $stmt5->rowCount() > 0 || $stmt6->rowCount() > 0) {
        $hayEmailTabla = 1;
    }

    if (empty($nombre) || empty($usuario) || empty($password) || empty($passwordc) || empty($email) || empty($EspacioBlanco)) {
        echo '<p><script>Swal.fire({
            title: "ERROR!",
            text: "Do not leave empty fields",
            icon: "error"
        });</script></p>';
        $errors[] = "blank spaces";
    } elseif (!isEmail($email)) {
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Invalid E-Mail address",
            icon: "error"
        });</script></p>';
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.",
            icon: "error"
        });</script></p>';
        $errors[] = "Password requirements not met";
    } elseif (!validaPassword($password, $passwordc)) {
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "Both passwords need to match",
            icon: "error"
        });</script></p>';
        $errors[] = "Passwords do not match";
    } elseif (usuarioExiste($pdo, $usuario)) {
        echo '<p><script>Swal.fire({
            title: "ERROR",
            text: "This username already exists",
            icon: "error"
        });</script></p>';
        $errors[] = "Username already exists";
    } else {
        // Todos los datos son válidos, proceder con el registro
        $pass_hash = encryptPayload($password);
        $token = generateToken(); // Función para generar un token
        $tipo_usuario = 5; // Asigna el tipo de usuario correspondiente
        $codigo = generador(); // Función para generar un código
        $estatus = "Disconnected";
        $ran_id = rand(time(), 100000000);
        $fechaRegistro = date("d/m/Y h:i a", time() - 3600 * date('I'));
        $nombre_hash = encryptPayload($nombre);
        $email_hash = encryptPayload($email);

        if (emailExisteR($pdo, $email_hash)) {
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "This E-Mail already exists",
                icon: "error"
            });</script></p>';

        } else {
            $stmt4 = $pdo->prepare('SELECT * FROM talleres WHERE email = :email');
            $stmt4->execute(['email' => $email]);
            $row = $stmt4->fetch(PDO::FETCH_ASSOC);
            $stmt5 = $pdo->prepare('SELECT * FROM asociados WHERE email = :email');
            $stmt5->execute(['email' => $email]);
            $row = $stmt5->fetch(PDO::FETCH_ASSOC);
            $stmt6 = $pdo->prepare('SELECT * FROM constructuras WHERE email = :email');
            $stmt6->execute(['email' => $email]);
            $row = $stmt6->fetch(PDO::FETCH_ASSOC);
            if ($stmt5->rowCount() > 0 || $stmt6->rowCount() > 0 || $stmt4->rowCount() > 0) {
                // Registro del usuario en la base de datos
                $registro = registraPartner($pdo, $usuario, $pass_hash, $nombre_hash, $email_hash, $token, $tipo_usuario, $codigo, $estatus, $fechaRegistro, $ran_id, $pago);

                // Manejo de la respuesta
                if ($registro > 0) {
                    $url = 'http://' . $_SERVER["SERVER_NAME"] . '/PTC2/views/Admin_spanish/register_partner/activar.php?id=' . $registro . '&val=' . $token;
                    //el asuto y cuerpo es lo que ira en el mesaje del correo
                    $asunto = 'Activation - LIFELINE';
                    $cuerpo = "Dear $nombre: <br /><br/> Confirm your identity <a href='$url'>Confirm E-Mail</a>";
                    //aca se envia el correo usando las anteriores mencionadas variables
                    if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {
                        echo '<p><script>Swal.fire({
                   title: "Good job!",
                   text: "Successfully, Confirm your identity in your email ",
                   icon: "success"
               }).then(function() {
                   window.location = "../../user/login.php";
               });</script></p>';
                    } else {
                        echo '<p><script>Swal.fire({
                   title: "Opsss!",
                   text: "We got a problem, try again",
                   icon: "error"
               }).then(function() {
                   window.location = "../../Admin_spanish/register_partner/registro.php";
               });</script></p>';
                    }
                } else {
                    echo '<p><script>Swal.fire({
                   title: "ERROR",
                   text: "There was an error creating your account",
                   icon: "error"
               });</script></p>';
                }
            }else{
                echo '<p><script>Swal.fire({
                    text: "There is not an associate request with this E-Mail address",
                    icon: "error"
               }).then(function() {
                   window.location = "../../Admin_spanish/register_partner/registro.php";
                });</script></p>';
            }
        }
    }
}
?>