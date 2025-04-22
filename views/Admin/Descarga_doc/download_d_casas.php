<?php
require '../../../funcs/conexion.php';
require '../../../funcs/funcs.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = getConnection();
        $sql = "SELECT fotos FROM datos_propiedad WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && !empty($row['fotos'])) {
            $documentacion = base64_decode($row['fotos']);
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="documentacion.pdf"');
            header('Content-Length: ' . strlen($documentacion));
            echo $documentacion;
            exit;
        } else {
            echo "Documento no encontrado.";
        }
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        exit;
    }
} else {
    echo "ID no proporcionado.";
}
?>
