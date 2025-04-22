<?php
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];
    $email = $_POST['email'];

    $pdo = getConnection();

    switch ($tipo) {
        case 'talleres':
            $stmt = $pdo->prepare('UPDATE talleres SET activacion = 0 WHERE email = :email');
            break;
        case 'asociados':
            $stmt = $pdo->prepare('UPDATE asociados SET activacion = 0 WHERE email = :email');
            break;
        case 'constructuras':
            $stmt = $pdo->prepare('UPDATE constructuras SET activacion = 0 WHERE email = :email');
            break;
        default:
            echo 'Invalid type';
            exit;
    }

    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() > 0) {
        echo 'Activation field set to 0';
    } else {
        echo 'No changes made';
    }
}
?>
