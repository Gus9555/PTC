<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';

if (!isset($_SESSION['id'])) {
    echo '<script>Swal.fire({
          title: "Advertencia",
          text: "Inicia sesión nuevamente",
          icon: "warning",
          confirmButtonText: "Aceptar"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script>';
    exit;
}

$user_id = $_SESSION['id'];
$nombre = $_SESSION['nombre']; // Asumiendo que 'nombre' está en la sesión como texto plano
$correo = $_SESSION['correo']; // Asumiendo que 'correo' está en la sesión como texto plano
$tipo_usuario = ''; // Aquí debes definir la lógica para obtener el tipo de usuario según tu aplicación.

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['plan'], $_POST['precio'])) {
    $plan = htmlspecialchars($_POST['plan']);
    $precio = htmlspecialchars($_POST['precio']);
} else {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Datos no recibidos.",
          icon: "error",
          confirmButtonText: "Aceptar"
          }).then(function() {
          window.location = "pagar.php";
          });</script>';
    exit;
}

$pdo = getConnection();

try {
    $stmt = $pdo->prepare("INSERT INTO compra_plan (user_id, nombre, correo, tipo_usuario, plan, precio, estado) 
                           VALUES (:user_id, :nombre, :correo, :tipo_usuario, :plan, :precio, 'pendiente')");
    $stmt->execute([
        'user_id' => $user_id,
        'nombre' => $nombre,
        'correo' => $correo,
        'tipo_usuario' => $tipo_usuario,
        'plan' => $plan,
        'precio' => $precio
    ]);

    $id_compra = $pdo->lastInsertId();

} catch (PDOException $e) {
    echo '<script>Swal.fire({
          title: "Error",
          text: "Error en la base de datos: ' . $e->getMessage() . '",
          icon: "error",
          confirmButtonText: "Aceptar"
          }).then(function() {
          window.location = "pagar.php";
          });</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pago - LifeLine</title>
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="../../assets/boss/images/favicon.png">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=Adr_ywjoTw8okgpD-dlDRDpaYbzlg3lh5L97nYjfvv3RFnbcCty-Z37ZH7SXoKR9eAQAye7J3P-vbRz_&currency=USD"></script>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mt-5">Información de Pago</h1>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $plan; ?></td>
                        <td>$<?php echo $precio; ?></td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" id="id_compra" value="<?php echo $id_compra; ?>">
            <div id="paypal-button-container" class="mt-3"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $precio; ?>'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    var user_id = document.getElementById('user_id').value;
                    var id_compra = document.getElementById('id_compra').value;

                    $.ajax({
                        url: 'status.php',
                        type: 'POST',
                        data: {
                            user_id: user_id,
                            id_compra: id_compra,
                            estado: 'completed'
                        },
                        success: function (response) {
                            console.log('ID de la compra:', id_compra); // Esto imprimirá el id_compra en la consola del navegador.

                            Swal.fire({
                                title: 'Éxito',
                                text: 'Proceso de pago completado',
                                icon: 'success'
                            }).then(function () {
                                window.location = 'facturap.php?id_compra=' + id_compra;
                            });
                        },

                        error: function () {
                            Swal.fire({
                                title: 'Error',
                                text: 'El pago ha fallado',
                                icon: 'error'
                            });
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    });
</script>

</body>
</html>
