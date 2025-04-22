<?php
require_once '../../funcs/conexion.php'; // Asegúrate de que la ruta es correcta
require '../../funcs/funcs.php';

$conn = getConnection(); // Obtener la conexión de la base de datos
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los valores del formulario
    $direccion_constructora = $_POST['direccion_constructora'] ?? null;
    $tipo_agencia = $_POST['tipo_agencia'] ?? null;
    $nombre_constructora = $_POST['nombre_constructora'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $telefono_fijo = $_POST['telefono_fijo'] ?? null;
    $nombre_dueño = $_POST['nombre_dueño'] ?? null;
    $departamento = $_POST['departamento'] ?? null;
   
    $EspacioBlanco = "    ";
    

    

    if (empty($direccion_constructora) || empty($tipo_agencia) || empty($nombre_constructora) || empty($email) || empty($telefono) || empty($telefono_fijo) || empty($nombre_dueño) || empty($departamento)  || empty($EspacioBlanco)) {
        echo '<p><script>Swal.fire({
            title: "ERROR!",
            text: "Do not leave empty fields",
            icon: "error"
             }).then(function() {
                window.location = "../application.php";
        });</script></p>';
    } else {

        // Verificar y manejar la carga del documento PDF
        if (isset($_FILES["documentacion"]) && $_FILES["documentacion"]["error"] == UPLOAD_ERR_OK) {
            if ($_FILES["documentacion"]["type"] != "application/pdf") {
                echo '<p><script>Swal.fire({
                title: "Error",
                text: "can only send pdf files.",
                icon: "error"
            }).then(function() {
                window.location = "../application.php";
            });</script></p>';
                exit();
            }
            // Lectura del archivo PDF y codificación en base64
            $documentacion_encoded = base64_encode(file_get_contents($_FILES["documentacion"]["tmp_name"]));
        } else {
            $documentacion_encoded = null;
            echo '<p><script>Swal.fire({
            title: "Ups...",
            text: "Error loading pdf document.",
            icon: "error"
        }).then(function() {
            window.location = "../application.php";
        });</script></p>';
            exit();
        }

        // Verificar si el email ya existe
        $sql = "SELECT * FROM constructuras WHERE email = ?";
        $stmt = $conn->prepare($sql);
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
        $activation ="2";

       

        // Insertar datos en la tabla constructuras
        $sql = "INSERT INTO constructuras (direccion_constructora, tipo_agencia, nombre_constructora, email, telefono, telefono_fijo, activation, documentacion, nombre_dueño, departamento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$direccion_constructora, $tipo_agencia, $nombre_constructora, $email, $telefono, $telefono_fijo, $activation, $documentacion_encoded, $nombre_dueño, $departamento]);

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
