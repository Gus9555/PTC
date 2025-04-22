<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
    <title>Document</title>
</head>

<body>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
    <title>Document</title>
</head>

<body>

</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pdf'])) {
        // Obtener el valor enviado por el botón
        $pdfKey = $_POST['pdf'];

        // Mapea los valores a los archivos PDF correspondientes
        $file = '';
        if ($pdfKey == "vehi") {
            $file = 'Car Insurance.pdf';
        } elseif ($pdfKey == "moto") {
            $file = 'Motorcycle Insurance.pdf';
        } elseif ($pdfKey == "home") {
            $file = 'Home Insurance.pdf';
        } elseif ($pdfKey == "medical") {
            $file = 'Healthcare Insurance.pdf';
        } elseif ($pdfKey == "util") {
            $file = 'Utility Vehicles Insurance.pdf';
        }

        // Ruta del archivo PDF
        $filePath = __DIR__ . '/../../assets/images/' . $file;

        // Verifica si el archivo existe
        if (file_exists($filePath)) {
            // Limpiar el buffer de salida
            if (ob_get_length()) {
                ob_end_clean();
            }

            // Configurar las cabeceras para la descarga
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));

            // Leer el archivo y enviarlo al navegador
            readfile($filePath);
            exit;
        } else {
            echo '<p><script>Swal.fire({
                title: "Oops!",
                text: "The requested file does not exist.",
                icon: "error"
                }).then(function() {
                window.location = "view_user.php";
                });</script></p>';
        }
    }
}
?>
