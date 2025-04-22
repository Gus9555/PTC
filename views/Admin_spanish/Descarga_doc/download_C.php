<?php
require '../../../funcs/conexion.php';
require '../../../funcs/funcs.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = getConnection();
        $sql = "SELECT documentacion FROM constructuras WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && !empty($row['documentacion'])) {
            $documentacion = base64_decode($row['documentacion']);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->buffer($documentacion);
            $file_extension = "pdf"; // Asumimos PDF, ajusta según el tipo de archivo real

            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="documentacion.' . $file_extension . '"');
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
