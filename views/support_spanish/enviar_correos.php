<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if (!isset($_SESSION['id'])) {
    echo '<script>Swal.fire({
          title: "Warning",
          text: "Login again",
          icon: "warning",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script>';
    exit;
}

// Configuración de la conexión a la base de datos
$pdo = getConnection();

// Verificar la conexión a la base de datos
if (!$pdo) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Database connection failed.",
          icon: "error",
          confirmButtonText: "OK"
          }).then(function() {
          window.location = "../../views/user/view_user.php";
          });</script>';
    exit;
}

// Consulta para obtener los datos de las compras pendientes de pago
$query = "SELECT id_c, nombre, correo, numero_telefonico, estado, seguro, calidad, precio, fecha_compra FROM compras WHERE (fecha_compra::date + interval '30 days') <= CURRENT_DATE AND estado != 'pendiente'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$compras = $stmt->fetchAll(PDO::FETCH_ASSOC);

$correosEnviados = 0;
$errores = [];

foreach ($compras as $compra) {
    $id = $compra['id_c'];
    $nombre = htmlspecialchars($compra['nombre']);
    $correo = htmlspecialchars($compra['correo']);
    $numero_telefonico = htmlspecialchars($compra['numero_telefonico']);
    $estado = htmlspecialchars($compra['estado']);
    $seguro = htmlspecialchars($compra['seguro']);
    $calidad = htmlspecialchars($compra['calidad']);
    $precio = htmlspecialchars($compra['precio']);

    // Actualizar el estado a "pendiente"
    $updateQuery = "UPDATE compras SET estado = 'pendiente' WHERE id_c = :id";
    $updateStmt = $pdo->prepare($updateQuery);
    if (!$updateStmt->execute(['id' => $id])) {
        $errores[] = "Error al actualizar el estado del ID $id";
        continue;
    }

    // Preparar el cuerpo del correo
    $asunto = "Renovación de Mensualidad";
    $cuerpo = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }
            .invoice-container {
                max-width: 800px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .invoice-header {
                text-align: center;
                margin-bottom: 20px;
            }
            .invoice-header h1 {
                margin: 0;
                font-size: 24px;
            }
            .invoice-details {
                margin-bottom: 20px;
            }
            .invoice-details table {
                width: 100%;
                border-collapse: collapse;
            }
            .invoice-details th, .invoice-details td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            .invoice-footer {
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="invoice-container">
            <div class="invoice-header">
                <h1>Renovación de Mensualidad</h1>
            </div>
            <div class="invoice-details">
                <table>
                    <tr>
                        <th>Nombre</th>
                        <td>' . $nombre . '</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>' . $correo . '</td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td>' . $numero_telefonico . '</td>
                    </tr>
                    <tr>
                        <th>Seguro</th>
                        <td>' . $seguro . '</td>
                    </tr>
                    <tr>
                        <th>Calidad</th>
                        <td>' . $calidad . '</td>
                    </tr>
                    <tr>
                        <th>Precio</th>
                        <td>$' . $precio . '</td>
                    </tr>
                </table>
            </div>
            <div class="invoice-footer">
                <p>Gracias por su preferencia.</p>
                <p>Por favor, haga clic en el siguiente enlace para realizar el pago:</p>
                <p><a href="http://' . $_SERVER["SERVER_NAME"] . '/PTC2/views/user/pagar.php?seguro=' . urlencode($seguro) . '&calidad=' . urlencode($calidad) . '&precio=' . urlencode($precio) . '">Realizar Pago</a></p>
            </div>
        </div>
    </body>
    </html>';

    // Enviar el correo
    if (enviarEmail($correo, $nombre, $asunto, $cuerpo)) {
        $correosEnviados++;
    } else {
        $errores[] = "Error al enviar el correo al ID $id (correo: $correo)";
    }
}

if (empty($errores)) {
    echo "Todos los correos han sido enviados y los estados actualizados.";
} else {
    echo "Se enviaron $correosEnviados correos. Los siguientes errores ocurrieron:\n";
    foreach ($errores as $error) {
        echo "- $error\n";
    }
}

$pdo = null;
?>
