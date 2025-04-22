<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../../views/user/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_c'])) {
        $id_c = $_POST['id_c'];

        try {
            $pdo = getConnection();
            $sql = "DELETE FROM compras WHERE id_c = :id_c";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_c', $id_c, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Redirigir a la página de compras después de eliminar el registro
                header("Location: tabla_compras.php?message=Record+Deleted+Successfully");
                exit();
            } else {
                echo "Error: Could not execute the delete statement.";
            }
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }
    } else {
        echo "Error: ID not set.";
    }
}
?>
