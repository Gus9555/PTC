<?php
require_once '../../funcs/conexion.php';
require '../../funcs/funcs.php';
$conn = getConnection(); // Get the database connection
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and validate form data
    $nombre_completo = $_POST['nombre_completo'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $email = $_POST['email'] ?? null;
    $dui = $_POST['dui'] ?? null;
    $jvpm = $_POST['jvpm'] ?? null;
    $nit = $_POST['nit'] ?? null;
    $especialidad = $_POST['especialidad'] ?? null;
    $subespecialidad = $_POST['subespecialidad'] ?? null;
    $direccion_clinica = $_POST['direccion_clinica'] ?? null;
    $zona_medica = $_POST['zona_medica'] ?? null;
    $password = $_POST['password'] ?? null;
    $password_confirm = $_POST['passwordc'] ?? null;
    $EspacioBlanco = "    ";

   
    if (empty($nombre_completo) || empty($telefono) || empty($email) || empty($dui) || empty($nit) || empty($jvpm) || empty($nit) || empty($especialidad) || empty($subespecialidad) || empty($direccion_clinica) || empty($zona_medica) || empty($EspacioBlanco)) {
        echo '<p><script>Swal.fire({
            title: "ERROR!",
            text: "Do not leave empty fields",
            icon: "error"
             }).then(function() {
                window.location = "../application.php";
        });</script></p>';
    } else {
        // Handle PDF file upload
        if (isset($_FILES["documentacion"]) && $_FILES["documentacion"]["error"] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['documentacion']['tmp_name'];
            $documentacion = file_get_contents($fileTmpPath);
        } else {
            $documentacion = null;
        }

    
        // Call the insert function
        $resultado = insertAsociados($conn, $nombre_completo, $telefono, $email, $dui, $jvpm, $nit, $especialidad, $subespecialidad, $direccion_clinica, $zona_medica,  $documentacion);

        // Output the result
        if ($resultado === "Registration successful") {
            echo '<p><script>Swal.fire({
            title: "Good job!",
            text: "Request successfully sent, please wait for our response",
            icon: "success"
        }).then(function() {
            window.location = "../application.php";
        });</script></p>';
        } else {
            echo '<p><script>Swal.fire({
            title: "Oops..",
            text: "Error inserting the record: ' . $resultado . '",
            icon: "error"
        }).then(function() {
            window.location = "../application.php";
        });</script></p>';
        }

    }



}
else {
    echo '<p><script>Swal.fire({
        title: ":(",
        text: "Access not allowed",
        icon: "error"
    }).then(function() {
        window.location = "../application.php";
    });</script></p>';
}
?>