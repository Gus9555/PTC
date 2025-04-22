<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">

    <title>LifeLine</title>
    <link rel="icon" href="../../../assets/boss/images/favicon.png">
    <!-- Google Sign-In Library -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Tivo is a HTML landing page template built with Bootstrap to help you create engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../../assets/boss/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../../assets/boss/css/styles2.css" rel="stylesheet">
</head>

<body>
    

</body>

</html>
<?php
    require '../../funcs/conexion.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id']) && isset($_POST['id_compra'])) {
        $user_id = htmlspecialchars($_POST['user_id']);
        $id_compra = htmlspecialchars($_POST['id_compra']);

        // Obtener la conexión
        $pdo = getConnection();

        // Iniciar una transacción para asegurar la integridad de la actualización
        $pdo->beginTransaction();

        try {
            // Actualizar el estado de la compra en la tabla compra_plan
            $stmt = $pdo->prepare("UPDATE compra_plan SET estado = 'activo' WHERE id = :id_compra AND user_id = :user_id");
            $stmt->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si la actualización fue exitosa
            if ($stmt->rowCount() > 0) {
                // Actualizar el estado del usuario en la tabla users
                $stmt_user = $pdo->prepare("UPDATE users SET pago = 'activo' WHERE id = :user_id");
                $stmt_user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt_user->execute();

                // Si todo fue bien, confirmar la transacción
                $pdo->commit();

                // Enviar respuesta de éxito con SweetAlert
                echo "<script>
                Swal.fire({
                    title: 'Success',
                    text: 'Payment and user status updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'facturap.php';
                });
            </script>";
            } else {
                // Si no se actualizó nada, hacer rollback
                $pdo->rollBack();
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to update purchase status.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'error.php';
                });
            </script>";
            }
        } catch (Exception $e) {
            // En caso de error, hacer rollback
            $pdo->rollBack();
            echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'An error occurred: " . $e->getMessage() . "',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = 'error.php';
            });
        </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'Invalid request.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(function() {
            window.location = 'error.php';
        });
    </script>";
    }
    ?> 