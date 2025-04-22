<?php
require '../../../funcs/conexion.php';
require '../../../funcs/funcs.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = getConnection();
        $sql = "SELECT documentacion FROM asociados WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && !empty($row['documentacion'])) {
            $documentacion = base64_decode($row['documentacion'], true); // 'true' returns false on failure
            
            if ($documentacion === false) {
                echo "Error: La cadena base64 no es válida.";
                exit;
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->buffer($documentacion);

            // Depuración: Imprimir el tipo MIME detectado
            echo "Tipo MIME detectado: " . $mime_type . "<br>";

            if ($mime_type === 'application/pdf') {
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="documentacion.pdf"');
                header('Content-Length: ' . strlen($documentacion));
                echo $documentacion;
                exit;
            } else {
                echo "Error: El archivo no es un PDF válido. Tipo MIME detectado: " . $mime_type;
            }
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
