<?php
require_once '../../funcs/conexion.php'; // Asegúrate de que la ruta es correcta
require '../../funcs/funcs.php';

$pdo = getConnection(); // Obtener la conexión de la base de datos
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los valores del formulario
    $direccion_constructora = $_POST['direccion_constructora'] ?? null;
    $tipo_agencia = $_POST['tipo_agencia'] ?? null;
    $nombre_constructora = $_POST['nombre_constructora'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefono = $_POST['telefono_constructora'] ?? null;
    $telefono_fijo = $_POST['telefono_fijo_constructora'] ?? null;
    $nombre_dueño = $_POST['nombre_dueño'] ?? null;
    $departamento = $_POST['departamento'] ?? null;

    if (isset($_FILES["documentacion"]) && $_FILES["documentacion"]["error"] == UPLOAD_ERR_OK) {
        $file_type = $_FILES["documentacion"]["type"];
        if ($file_type != "application/pdf") {
            echo '<p><script>Swal.fire({
                title: "Error",
                text: "Only PDF files are allowed.",
                icon: "error"
            }).then(function() {
                window.location = "../application.php";
            });</script></p>';
            exit();
        }
        // Codificar el archivo en base64
        $documentacion = base64_encode(file_get_contents($_FILES["documentacion"]["tmp_name"]));
    } else {
        $documentacion = null;
    }

    // Verificar si el email ya existe
    $sql = "SELECT * FROM constructuras WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo '<p><script>Swal.fire({
            title: "Error",
            text: "The email is already registered, try a different one.",
            icon: "error"
        }).then(function() {
            window.location = "../application.php";
        });</script></p>';
        exit;
    }
    $activation = "2";
    if (emailExisteconstructoras($pdo, $email)) {
        echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "This E-Mail already exists",
                icon: "error"
            });</script></p>';
    } else {
        $stmt5 = $pdo->prepare('SELECT * FROM asociados WHERE email = :email');
        $stmt5->execute(['email' => $email]);
        $row = $stmt5->fetch(PDO::FETCH_ASSOC);
        $stmt6 = $pdo->prepare('SELECT * FROM talleres WHERE email = :email');
        $stmt6->execute(['email' => $email]);
        $row = $stmt6->fetch(PDO::FETCH_ASSOC);
        if ($stmt5->rowCount() == 0 && $stmt6->rowCount() == 0) {
            // Insertar datos en la tabla constructuras
            $sql = "INSERT INTO constructuras (direccion_constructora, tipo_agencia, nombre_constructora, email, telefono, telefono_fijo, activation, documentacion, nombre_dueño, departamento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$direccion_constructora, $tipo_agencia, $nombre_constructora, $email, $telefono, $telefono_fijo, $activation, $documentacion, $nombre_dueño, $departamento]);


            if ($result) {
                echo '<p><script>Swal.fire({
            title: "Good job!",
            text: "Request successfully sent, please wait for our response",
            icon: "success"
        }).then(function() {
            window.location = "../application.php";
        });</script></p>';
            } else {
                $errorInfo = $stmt->errorInfo();
                echo '<p><script>Swal.fire({
            title: ":(",
            text: "Register Error, try again",
            icon: "error"
        }).then(function() {
            window.location = "../application.php";
        });</script></p>' . $errorInfo[2];
            }
        }else{
            echo '<p><script>Swal.fire({
                text: "There are other associates with this E-Mail address",
                icon: "error"
            }).then(function() {
                window.location = "../application.php";
            });</script></p>';
        }
    }
} else {
    echo '<p><script>Swal.fire({
        title: ":(",
        text: "Access not allowed",
        icon: "error"
    }).then(function() {
        window.location = "../application.php";
    });</script></p>';
}
?>