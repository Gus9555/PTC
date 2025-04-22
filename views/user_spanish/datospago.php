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
    exit;
}

$id_comprador = $_SESSION['id']; // Captura del id del usuario desde la sesión

// Verificar que los datos del seguro están disponibles
if (!isset($_POST['seguro']) || !isset($_POST['calidad']) || !isset($_POST['precio'])) {
     echo '<p><script>Swal.fire({
          title: "Error",
       text: "No se recibieron datos del seguro."
          }).then(function() {
        window.location = "paypal.php";
        });</script></p>';
    exit;
}

$seguro = htmlspecialchars($_POST['seguro']);
$calidad = htmlspecialchars($_POST['calidad']);
$precio = htmlspecialchars($_POST['precio']);
if ($seguro == "motorcycle") {
    $echoSeguro = "Motocicleta";
} elseif ($seguro == "Vehicule") {
    $echoSeguro = "Vehículo";
}else {
    $echoSeguro = $seguro;
}

// Obtener información del usuario
$pdo = getConnection();
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id_comprador, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Security-Policy"
        content="script-src 'self' 'unsafe-inline' https://code.jquery.com https://cdnjs.cloudflare.com;">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Pago</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">
    <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            <a class="navbar-brand logo-image" href="index.html"><img src="../../assets/boss/images/logo.png"
                    alt="alternative"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="view_user.php">INICIO <span
                                class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../spanish/buy.php">ESPAÑOL <span
                                class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../support/users.php">CHAT-SOPORTE <span
                                class="sr-only">(actual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../profile/profile.php">MI PERFIL <span
                                class="sr-only">(actual)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.html#pricing">PRECIOS</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="logout.php">CERRAR SESIÓN</a>
                </span>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Información de Pago</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Payment Content -->
    <div class="ex-basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h2>Información de Pago</h2>
                        <table class="table table-bordered">
                            <tr>
                                <th>Seguro</th>
                                <th>Calidad</th>
                                <th>Precio</th>
                            </tr>
                            <tr>
                                <td><?php echo $echoSeguro; ?></td>
                                <td><?php echo $calidad; ?></td>
                                <td><?php echo $precio; ?></td>
                            </tr>
                        </table>
                        <?php
                        if ($seguro == "Vehicule" || $seguro == "motorcycle" || $seguro == "Utility") {
                            $campos = '<h2>Información del Vehículo</h2>
                        <div class="form-group">
                            <label for="tarjeta_circulacion">Tarjeta de Circulación:</label>
                            <input type="file" class="form-control" onpaste="return false;" id="tarjeta_circulacion" name="tarjeta_circulacion" accept="application/pdf" required>
                        </div>
                        <div class="form-group">
                            <label for="dui">DUI del Propietario:</label>
                            <input type="text" class="form-control" onpaste="return false;" id="dui" name="dui" required>
                        </div>
                        <h2>Datos del Beneficiario:</h2>
                        <div class="form-group">
                            <label for="name">Nombre Completo:</label>
                            <input type="text" class="form-control" onpaste="return false;"
                                            onkeypress="return (event.charCode >= 65 && event.charCode <= 122 ||  event.charCode == 32)" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp"onpaste="return false;"
                                    onkeypress="return (event.charCode == 209 || event.charCode == 241 || (event.charCode >= 64 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) ||(event.charCode == 46)||(event.charCode == 95)||(event.charCode >= 48 && event.charCode <= 57))" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="num_telBene">Número de Teléfono:</label>
                            <input type="text" class="form-control"  id="num_telBene" name="num_telBene" required>
                        </div>
                        <div class="form-group">
                            <label for="parentesco">Parentesco:</label>
                            <select id="parentesco" name="parentesco">
                            <option value="Child">Hijo/a</option>
                            <option value="Sibling">Hermano/a</option>
                            <option value="Parent">Padre/Madre</option>
                            <option value="Grandparent">Abuelo/a</option>
                            <option value="Grandchild">Nieto/a</option>
                            <option value="Other">Otro</option>
                         </select>
                        </div>';
                        } elseif ($seguro == "Medical") {
                            $campos = '<h2>Datos de la Persona Asegurada</h2>
                        <div class="form-group">
                            <label for="name_asegrd">Nombre Completo:</label>
                            <input type="text" class="form-control" onpaste="return false;"
                                            onkeypress="return (event.charCode >= 65 && event.charCode <= 122 ||  event.charCode == 32)" id="name_asegrd" name="name_asegrd" required>
                        </div>
                        <div class="form-group">
                            <label for="num_tel">Número de Teléfono:</label>
                            <input type="text" class="form-control" onpaste="return false;" id="num_tel" name="num_tel" required>
                        </div>
                        <div class="form-group">
                          <label for="date">Seleccionar Fecha:</label>
                          <input type="date" class="form-control" id="date" name="date" max="' . date('Y-m-d') . '" required>
                        </div>
                        <div class="form-group">
                            <label for="vivienda">Dirección de la Casa:</label>
                            <input type="text" class="form-control" onpaste="return false;" id="vivienda" name="vivienda" required>
                        </div>
                        <h2>Datos del Beneficiario:</h2>
                        <div class="form-group">
                            <label for="name">Nombre Completo:</label>
                            <input type="text" class="form-control" onpaste="return false;"
                                            onkeypress="return (event.charCode >= 65 && event.charCode <= 122 ||  event.charCode == 32)" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" onpaste="return false;"
                                    onkeypress="return (event.charCode == 209 || event.charCode == 241 || (event.charCode >= 64 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) ||(event.charCode == 46)||(event.charCode == 95)||(event.charCode >= 48 && event.charCode <= 57))" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="num_telBene">Número de Teléfono:</label>
                            <input type="text" class="form-control"  onpaste="return false;"id="num_telBene" name="num_telBene" required>
                        </div>
                        <div class="form-group">
                            <label for="parentesco">Parentesco:</label>
                            <select id="parentesco" name="parentesco">
            <option value="Child">Hijo/a</option>
            <option value="Sibling">Hermano/a</option>
            <option value="Parent">Padre/Madre</option>
            <option value="Grandparent">Abuelo/a</option>
            <option value="Grandchild">Nieto/a</option>
            <option value="Other">Otro</option>
        </select>
                        </div>';
                        } elseif ($seguro == "Home") {
                            $campos = '<h2>Datos de la Propiedad Asegurada</h2>
                        <div class="form-group">
                            <label for="fotos">Fotos de la Propiedad:</label>
                            <input type="file" class="form-control"  id="fotos" name="fotos" accept="application/pdf" required>
                        </div>
                        <div class="form-group">
                            <label for="area">Área de la Propiedad en m<sup>2</sup>:</label>
                            <input type="number" class="form-control"  onpaste="return false;"id="area" name="area" required>
                        </div>
                        <div class="form-group">
                            <label for="habitaciones">Habitaciones en la propiedad:</label>
                            <input type="number" class="form-control" onpaste="return false;" id="habitaciones" name="habitaciones" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección de la Propiedad:</label>
                            <input type="text" class="form-control" onpaste="return false;" id="direccion" name="direccion" required>
                        </div>
                        <h2>Datos del Beneficiario:</h2>
                        <div class="form-group">
                            <label for="name">Nombre Completo:</label>
                            <input type="text" class="form-control" onpaste="return false;" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" onpaste="return false;"
                                    onkeypress="return (event.charCode == 209 || event.charCode == 241 || (event.charCode >= 64 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) ||(event.charCode == 46)||(event.charCode == 95)||(event.charCode >= 48 && event.charCode <= 57))" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="num_telBene">Número de Teléfono:</label>
                            <input type="text" class="form-control"onpaste="return false;"  id="num_telBene" name="num_telBene" required>
                        </div>
                        <div class="form-group">
                            <label for="parentesco">Parentesco:</label>
                            <select id="parentesco" name="parentesco">
            <option value="Child">Hijo/a</option>
            <option value="Sibling">Hermano/a</option>
            <option value="Parent">Padre/Madre</option>
            <option value="Grandparent">Abuelo/a</option>
            <option value="Grandchild">Nieto/a</option>
            <option value="Other">Otro</option>
        </select>
                        </div>';
                        }

                        ?>

                        <form id="paymentForm" action="datospago2.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nombre">Nombre Completo:</label>
                                <input type="text" class="form-control" onpaste="return false;"
                                    onkeypress="return (event.charCode >= 65 && event.charCode <= 122 ||  event.charCode == 32)"
                                    id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo Electrónico:</label>
                                <input type="email" class="form-control" aria-describedby="emailHelp"
                                    onpaste="return false;"
                                    onkeypress="return (event.charCode == 209 || event.charCode == 241 || (event.charCode >= 64 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) ||(event.charCode == 46)||(event.charCode == 95)||(event.charCode >= 48 && event.charCode <= 57))"
                                    id="correo" name="correo" required>
                            </div>
                            <div class="form-group">
                                <label for="numero_telefonico">Número de Teléfono:</label>
                                <input type="text" class="form-control" onpaste="return false;" id="numero_telefonico"
                                    name="numero_telefonico" required>
                            </div>
                            <?php echo $campos; ?>
                            <input type="hidden" name="user_id" value="<?php echo $id_comprador; ?>">
                            <input type="hidden" name="estado" value="pendiente">
                            <input type="hidden" name="seguro" value="<?php echo $seguro; ?>">
                            <input type="hidden" name="calidad" value="<?php echo $calidad; ?>">
                            <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                            <button type="submit" class="btn-solid-reg page-scroll">Enviar</button>
                        </form>
                    </div>
                </div>
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
                        <h4>Sobre Tivo</h4>
                        <p class="p-small">Estamos apasionados por ofrecer algunos de los mejores servicios de crecimiento empresarial para iniciar más palabras</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Enlaces Importantes</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-square"></i>
                                <div class="media-body">Nuestros socios comerciales <a class="white"
                                        href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media"><i class="fas fa-square"></i>
                                <div class="media-body">Lee nuestros <a class="white" href="terms-conditions.html">Términos y Condiciones</a>, <a class="white" href="privacy-policy.html">Política de Privacidad</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contacto</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">22 Innovative, San Francisco, CA 94043, US</div>
                            </li>
                            <li class="media"><i class="fas fa-envelope"></i>
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

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Plantilla por Inovatik</a></p>
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
        $(document).ready(function () {
            $('#numero_telefonico').mask('0000-0000');
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#num_telBene').mask('0000-0000');
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#num_tel').mask('0000-0000');
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#dui').mask('00000000-0');
        });
    </script>

</body>

</html>

<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['numero_telefonico'], $_POST['tarjeta_circulacion'], $_POST['dui'], $_POST['name'], $_POST['email'], $_POST['num_telBene'], $_POST['parentesco'])) {
//     $nombre = $_POST['nombre'];
//     $correo = $_POST['correo'];
//     $numero_telefonico = $_POST['numero_telefonico'];
//     $user_id = $id_comprador; // Obtener el id del usuario desde la sesión
//     $estado = 'pendiente';
//     $seguro = $_POST['seguro'];
//     $calidad = $_POST['calidad'];
//     $tarjetaCirc = $_POST['tarjeta_circulacion'];
//     $dui = $_POST['dui'];
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $num_telBene = $_POST['num_telBene'];
//     $parentesco = $_POST['parentesco'];

//     $uploadDir = '../../assets/docs';
//     if (!is_dir($uploadDir)) {
//         mkdir($uploadDir, 0777, true);
//     }
//     $tempFile = $_FILES['tarjeta_circulacion']['tmp_name'];
//     $fileName = basename($_FILES['tarjeta_circulacion']['name']);
//     $uploadFile = $uploadDir . $fileName;
//     if (move_uploaded_file($tempFile, $uploadFile)) {
//         echo "El archivo ha sido cargado exitosamente.";
//     } else {
//         echo "Ocurrió un error al cargar el archivo.";
//     }

//     $pdo = getConnection(); // Asegurarse de tener la conexión establecida antes de usarla
//     try {
//         $stmt = $pdo->prepare("INSERT INTO compras (nombre, correo, numero_telefonico, user_id, estado, seguro, calidad, precio) VALUES (:nombre, :correo, :numero_telefonico, :user_id, :estado, :seguro, :calidad, :precio)");
//         $stmt->bindParam(':nombre', $nombre);
//         //$stmt->bindParam(':apellido', $apellido);
//         $stmt->bindParam(':correo', $correo);
//         $stmt->bindParam(':numero_telefonico', $numero_telefonico);
//         $stmt->bindParam(':user_id', $user_id);
//         $stmt->bindParam(':estado', $estado);
//         $stmt->bindParam(':seguro', $seguro);
//         $stmt->bindParam(':calidad', $calidad);
//         $stmt->bindParam(':precio', $precio);
//         $stmt->execute();

//         try{
//         $stmt1 = $pdo->prepare("INSERT INTO datos_vehiculos (tarjetacirc, dui, num_tel, nombre, email, num_benefi, parentesco, activation) VALUES (:tarjetacirc, :dui, :num_tel, :nombre, :email, :num_benefi, :parentesco, 0)");
//         $stmt1->bindParam(':tarjetacirc', $tarjetaCirc);
//         $stmt1->bindParam(':dui', $dui);
//         $stmt1->bindParam(':num_tel', $num_tel);
//         $stmt1->bindParam(':nombre', $name);
//         $stmt1->bindParam(':email', $email);
//         $stmt1->bindParam(':num_benefi', $num_telBene);
//         $stmt1->bindParam(':parentesco', $parentesco);
//         $stmt1->execute();
//         }catch(PDOException $e) {
//             echo '<p><script>Swal.fire({
//                 title: "ERROR",
//                 text: "error al enviar los datos3: ' . $e->getMessage() . '",
//                 icon: "error"
//                 });</script></p>';
//         }

//         echo '<p><script>Swal.fire({
//               title: "¡Buen trabajo!",
//               text: "Datos enviados",
//               icon: "success"
//               }).then(function() {
//               window.location = "../user/pagar.php?seguro=' . urlencode($seguro) . '&calidad=' . urlencode($calidad) . '&precio=' . urlencode($precio) . '";
//               });</script></p>';
//     } catch (PDOException $e) {
//         echo '<p><script>Swal.fire({
//               title: "ERROR",
//               text: "error al enviar los datos2:",
//               icon: "error"
//               });</script></p>';
//     }
// }

?>
