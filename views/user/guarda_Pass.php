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

// Obtener y escapar los parámetros POST usando PDO::quote
$user_id = $_POST['user_id'];
$token = $_POST['token'];
$password = $_POST['password'];
$con_password = $_POST['con_password'];

// Validaciones de complejidad de la contraseña
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    echo '<script>
        Swal.fire({
            title: "Weak Password!",
            text: "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.",
            icon: "error"
        }).then(function() {
            window.location = "../user/cambiaPass.php?id=' . $user_id . '&token=' . $token . '";
        });
    </script>';
    exit();
}

// Validar que las contraseñas coincidan
if (!validaPassword($password, $con_password)) {
    echo '<script>
        Swal.fire({
            title: "Passwords Do Not Match!",
            text: "Both passwords need to match.",
            icon: "error"
        }).then(function() {
            window.location = "../user/cambiaPass.php?id=' . $user_id . '&token=' . $token . '";
        });
    </script>';
    exit();
}

// Si no hay errores, procede con el cambio de contraseña
if (empty($errors)) {
    // Hashear la contraseña
    $pass_hash = encryptPayload($password);

    // Llamar a la función cambiaPassword
    if (cambiaPassword($pass_hash, $user_id, $token, $pdo)) {
        echo '<script>
            Swal.fire({
                title: "Done!",
                text: "Password updated successfully",
                icon: "success"
            }).then(function() {
                window.location = "../user/login.php";
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                title: "Error!",
                text: "There was an error updating the password.",
                icon: "error"
            }).then(function() {
                window.location = "../user/cambiaPass.php?id=' . $user_id . '&token=' . $token . '";
            });
        </script>';
    }
}
?>
