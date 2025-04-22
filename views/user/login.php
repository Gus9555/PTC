<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require '../../funcs/conexion.php';
    require '../../funcs/funcs.php';

    session_start();

    $pdo = getConnection(); // Asegúrate de que esta función exista y devuelva una conexión PDO
    $errors = array();

    if (!empty($_POST)) {
        // Obtener y sanitizar los parámetros del formulario
        $email = trim($_POST['correo']);
        $correo = encryptPayload($email);
        $pass = trim($_POST['password']);
        $password = encryptPayload($pass);

        // Verificar si hay campos vacíos
        if (isNullLogin($correo, $pass)) {
            $errors[] = "No empty fields";
        }

        // Si no hay errores, proceder con el inicio de sesión
        if (empty($errors)) {
            try {
                // Preparar la consulta para obtener los datos del usuario
                $stmt = $pdo->prepare("SELECT id, id_tipo, unique_id, password, nombre, imagen, activacion FROM users WHERE correo = :correo LIMIT 1");
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmt->execute();

                // Obtener el resultado
                $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);
                // Verificar si se encontró algún usuario
                if ($usuarioData) {

                    // Verificar si el usuario está activo (asegurando comparación con entero)
                    if ((int) $usuarioData['activacion'] === 1) {
                        // Verificar la contraseña
                        if ($password == $usuarioData['password']) {
                            // Iniciar la sesión
                            $_SESSION['id'] = $usuarioData['id'];
                            $_SESSION['tipo_usuario'] = $usuarioData['id_tipo'];
                            $_SESSION['nombre'] = $usuarioData['nombre'];
                            $_SESSION['correo'] = $correo;
                            $_SESSION['imagen'] = $usuarioData['imagen'];
                            $_SESSION['unique_id'] = $usuarioData['unique_id'];

                            // Actualizar estado del usuario a "en línea"
                            $stmt_update_status = $pdo->prepare("UPDATE users SET estatus = 'Active now' WHERE id = :id");
                            $stmt_update_status->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
                            $stmt_update_status->execute();
                            $stmt_update_status->closeCursor();

                            // Redirigir según el tipo de usuario
                            switch ($_SESSION['tipo_usuario']) {
                                case "2":
                                    header("location:../user/view_user.php");
                                    exit;
                                case "1":
                                    header("location:../Admin/Admin.php");
                                    exit;
                                case "3":
                                    header("location:../support/users.php");
                                    exit;
                                case "5":
                                  header("location:../partner/index.php");
                                  exit;
                                default:
                                    echo '<p><script>Swal.fire({
                                        title: "ERROR",
                                        text: "User not Active",
                                        icon: "error"
                                        });</script></p>';
                            }
                        } else {
                            echo '<p><script>Swal.fire({
                                title: "ERROR",
                                text: "Incorrect credentials, try again.",
                                icon: "error"
                                });</script></p>';
                        }
                    } else {
                        echo '<p><script>Swal.fire({
                            title: "ERROR",
                            text: "The account needs to be active, verify your email address.",
                            icon: "error"
                            });</script></p>';
                    }
                } else {
                    echo '<p><script>Swal.fire({
                        title: "ERROR",
                        text: "This e-mail address is not registered.",
                        icon: "error"
                        });</script></p>';
                }

            } catch (PDOException $e) {
                // Manejo de errores - puedes personalizar según tu aplicación
                echo "Error al iniciar sesión: " . $e->getMessage();
            }
        } else {
            // Manejo de errores de validación
            foreach ($errors as $error) {
                echo '<p><script>Swal.fire({
                    title: "ERROR",
                    text: "' . $error . '",
                    icon: "error"
                    });</script></p>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
    <title>LifeLine</title>

    <link rel="icon" href="../../assets/boss/images/favicon.png">
</head>

<body>



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
            <!-- Preloader -->
            <div class="spinner-wrapper" style="display: none;">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
            <!-- end of preloader -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Log In</h1>
                        <br>
                        <!-- Sign Up Form -->
                        <div class="form-container">
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="loginForm">

                                <div class="form-group">
                                    <input class="form-control-input" id="inputEmailAddress" onpaste="return false;"
                                        onkeypress="return (event.charCode == 209 || event.charCode == 241 || (event.charCode >= 64 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 45)||(event.charCode == 46)||(event.charCode == 95)||(event.charCode >= 48 && event.charCode <= 57))"
                                        maxlength="50" size="50" name="correo" type="email"
                                        placeholder="Enter email address" required />
                                </div>

                                <div class="form-group">
                                    <input class="form-control-input" onpaste="return false;" maxlength="50" size="50"
                                        id="inputPassword" name="password" type="password"
                                        placeholder="Enter password" />
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="rememberPasswordCheck"
                                            type="checkbox" />
                                        <label class="custom-control-label" for="rememberPasswordCheck">Remember
                                            password</label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <button type="submit" class="form-control-submit-button">Login</button>
                                </div>
                                <br>
                                <div class="form-group">
                                    <a class="small" href="../user/restorePass.php">Forgot Password?</a>
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
        <script src="../../assets/boss/js/jquery.easing.min.js"></script>
        <!-- jQuery Easing for smooth scrolling between anchors -->
        <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
        <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
        <!--  <script src=".../assets/boss/js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
        <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Check if credentials are stored in localStorage
                if (localStorage.getItem('correo') && localStorage.getItem('password')) {
                    document.getElementById('inputEmailAddress').value = localStorage.getItem('correo');
                    document.getElementById('inputPassword').value = localStorage.getItem('password');
                    document.getElementById('rememberPasswordCheck').checked = true;
                }

                document.getElementById('loginForm').addEventListener('submit', function (event) {
                    if (document.getElementById('rememberPasswordCheck').checked) {
                        // Save credentials to localStorage
                        localStorage.setItem('correo', document.getElementById('inputEmailAddress').value);
                        localStorage.setItem('password', document.getElementById('inputPassword').value);
                    } else {
                        // Clear credentials from localStorage
                        localStorage.removeItem('correo');
                        localStorage.removeItem('password');
                    }
                });
            });

            function handleCredentialResponse(response) {
                const responsePayload = parseJwt(response.credential);

                // Send the token to the server for verification and login/registration
                fetch('your_login_endpoint.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        google_id: responsePayload.sub,
                        email: responsePayload.email,
                        name: responsePayload.name
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect based on user type
                            switch (data.user_type) {
                                case "2":
                                    window.location.href = "../user/view_user.php";
                                    break;
                                case "1":
                                    window.location.href = "../Admin/Admin.php";
                                    break;
                                case "3":
                                    window.location.href = "../support/users.php";
                                    break;
                                default:
                                    Swal.fire({
                                        title: "ERROR",
                                        text: "User type not recognized",
                                        icon: "error"
                                    });
                            }
                        } else {
                            Swal.fire({
                                title: "ERROR",
                                text: data.message,
                                icon: "error"
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: "ERROR",
                            text: "There was an error processing your request. Please try again.",
                            icon: "error"
                        });
                    });
            }

            function parseJwt(token) {
                var base64Url = token.split('.')[1];
                var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                var jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));

                return JSON.parse(jsonPayload);
            }
        </script>
        <script>
            $(function () {
                $('#inputPassword').on('keypress', function (e) {
                    if (e.which == 32) {
                        console.log('Space Detected');
                        return false;
                    }
                });
            });
        </script>
    </body>

    </html>