<?php
require_once '../../funcs/conexion.php'; // Asegúrate de que la ruta es correcta
require '../../funcs/funcs.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$edit = $_POST['edit'];

$pdo = getConnection();

switch ($edit) {
    case 'talleres':
        $email = $_POST['id'];
        $direccion = $_POST['direccion'];
        $numFijo = $_POST['telefono_fijo'];
        $numPers = $_POST['telefono_personal'];
        $ubicacionTaller = $_POST['ubicacion_taller'];

        $sqlUpdate = "UPDATE talleres SET direccion = :direccion, telefono_fijo = :telefono_fijo, telefono_personal = :telefono_personal, ubicacion_taller = :ubicacion_taller
                  WHERE email = :email";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':direccion', $direccion);
        $stmtUpdate->bindParam(':telefono_fijo', $numFijo);
        $stmtUpdate->bindParam(':telefono_personal', $numPers);
        $stmtUpdate->bindParam(':ubicacion_taller', $ubicacionTaller);
        $stmtUpdate->bindParam(':email', $email);
        if (strlen($numFijo) == 8 && strlen($numPers) == 8) {

            if ($stmtUpdate->execute()) {
                echo '<p><script>Swal.fire({
                text: "Datos editados con éxito",
                icon: "success"
            }).then(function() {
                window.location = "index.php";
            });</script></p>';
            }
        } else {
            echo '<p><script>Swal.fire({
                text: "Los números de teléfono deben tener 8 caracteres",
                icon: "warning"
            }).then(function() {
                window.location = "index.php";
            });</script></p>';
        }

        break;
    case 'asociados':
        $email = $_POST['id'];
        $departamento = $_POST['departamento'];
        $subespecialidad = $_POST['subespecialidad'];
        $numPers = $_POST['telefono_personal'];
        trim($numPers);
        $direccion_clinica = $_POST['direccion'];

        $sqlUpdate = "UPDATE asociados SET telefono = :telefono, subespecialidad = :subespecialidad, direccion_clinica = :direccion_clinica, zona_medica = :zona_medica
                      WHERE email = :email";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':zona_medica', $departamento);
        $stmtUpdate->bindParam(':subespecialidad', $subespecialidad);
        $stmtUpdate->bindParam(':telefono', $numPers);
        $stmtUpdate->bindParam(':direccion_clinica', $direccion_clinica);
        $stmtUpdate->bindParam(':email', $email);
        if (strlen($numPers) == 8) {
            if ($stmtUpdate->execute()) {
                echo '<p><script>Swal.fire({
                    text: "Datos editados con éxito",
                    icon: "success"
                }).then(function() {
                    window.location = "index.php";
                });</script></p>';
            }
        } else {
            echo '<p><script>Swal.fire({
            text: "Los números de teléfono deben tener 8 caracteres",
            icon: "warning"
        }).then(function() {
            window.location = "index.php";
        });</script></p>';
        }

        break;
    case 'constructuras':
        $email = $_POST['id'];
        $direccion = $_POST['direccion'];
        $numFijo = $_POST['telefono_fijo'];
        $numPers = $_POST['telefono_personal'];
        $ubicacionTaller = $_POST['ubicacion_constructora'];

        $sqlUpdate = "UPDATE constructuras SET direccion_constructora = :direccion_constructora, telefono_fijo = :telefono_fijo, telefono = :telefono, departamento = :departamento
                          WHERE email = :email";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':direccion_constructora', $ubicacionTaller);
        $stmtUpdate->bindParam(':telefono_fijo', $numFijo);
        $stmtUpdate->bindParam(':telefono', $numPers);
        $stmtUpdate->bindParam(':departamento', $direccion);
        $stmtUpdate->bindParam(':email', $email);
        if (strlen($numFijo) == 8 && strlen($numPers) == 8) {
            if ($stmtUpdate->execute()) {
                echo '<p><script>Swal.fire({
                        text: "Datos editados con éxito",
                        icon: "success"
                    }).then(function() {
                        window.location = "index.php";
                    });</script></p>';
            }
        } else {
            echo '<p><script>Swal.fire({
                text: "Los números de teléfono deben tener 8 caracteres",
                icon: "warning"
            }).then(function() {
                window.location = "index.php";
            });</script></p>';
        }

        break;

    default:
        # code...
        break;

}

?>
