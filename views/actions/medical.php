<?php
require_once '../../funcs/conexion.php';
require '../../funcs/funcs.php';
$pdo = getConnection();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and validate form data
    $nombre_completo = $_POST['nombre_completo'] ?? null;
    $telefono = preg_replace('/[^0-9]/', '', $_POST['telefono'] ?? null);  // Remover caracteres no numéricos
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
        if (emailExisteAsociados($pdo, $email)) {
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "This E-Mail already exists",
                icon: "error"
            });</script></p>';
        } else {
            // Verificar si se subió el archivo de documentación
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
                $documentacion = file_get_contents($_FILES["documentacion"]["tmp_name"]);
            } else {
                $documentacion = null;
            }
            $stmt5 = $pdo->prepare('SELECT * FROM constructuras WHERE email = :email');
            $stmt5->execute(['email' => $email]);
            $row = $stmt5->fetch(PDO::FETCH_ASSOC);
            $stmt6 = $pdo->prepare('SELECT * FROM talleres WHERE email = :email');
            $stmt6->execute(['email' => $email]);
            $row = $stmt6->fetch(PDO::FETCH_ASSOC);
            if ($stmt5->rowCount() == 0 && $stmt6->rowCount() == 0) {

                // Call the insert function
                $resultado = insertAsociados($pdo, $nombre_completo, $telefono, $email, $dui, $jvpm, $nit, $especialidad, $subespecialidad, $direccion_clinica, $zona_medica, $documentacion);

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
                    title: "Error",
                    text: "' . $resultado . '",
                    icon: "error"
                }).then(function() {
                    window.location = "../application.php";
                });</script></p>';
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