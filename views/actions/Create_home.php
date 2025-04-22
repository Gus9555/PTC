<?php
ob_start(); // Iniciar el almacenamiento en búfer de salida

// Mostrar todos los errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../../plugins/fpdf/fpdf.php');
require_once '../../funcs/conexion.php'; 
require '../../funcs/funcs.php';

class PDF extends FPDF {
    // Función para agregar la imagen de fondo en cada página
    function Header() {
        $this->Image('../../assets/images/fondopdf.jpg', 0, 0, 210, 297); // A4: 210x297 mm
        $this->SetMargins(30, 60, 30); // Margen izquierdo, superior, derecho
    }
}

try {
    $pdo = getConnection();

    // Crear una instancia de FPDF
    $pdf = new PDF();
    $pdf->AddPage();

    // Título principal
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Home Insurance', 0, 1, 'C');
    $pdf->Ln(10);

    // Tipos de seguro
    $segurosHome = getSegurosByTipo($pdo, 'Home');

    if (count($segurosHome) > 0) {
        foreach ($segurosHome as $row) {
            // Mostrar la calidad y precio
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, ucfirst($row['calidad']) . ' - Price: ' . $row['precio'], 0, 1);
            $pdf->Ln(5);
            
            // Mostrar las descripciones solo si están llenas
            $pdf->SetFont('Arial', '', 10);

            if(trim($row['description']) !== '') {
                $pdf->MultiCell(0, 10, '1. ' . $row['description']);
            }
            if(trim($row['description2']) !== '') {
                $pdf->MultiCell(0, 10, '2. ' . $row['description2']);
            }
            if(trim($row['description3']) !== '') {
                $pdf->MultiCell(0, 10, '3. ' . $row['description3']);
            }
            if(trim($row['description4']) !== '') {
                $pdf->MultiCell(0, 10, '4. ' . $row['description4']);
            }
            if(trim($row['description5']) !== '') {
                $pdf->MultiCell(0, 10, '5. ' . $row['description5']);
            }
            if(trim($row['description6']) !== '') {
                $pdf->MultiCell(0, 10, '6. ' . $row['description6']);
            }

            // Espacio entre calidades
            $pdf->Ln(10);
        }
    } else {
        $pdf->Cell(0, 10, 'No se encontraron registros para este tipo de seguro.', 0, 1);
    }

    // Limpiar el búfer de salida antes de generar el PDF
    ob_end_clean();
    $pdf->Output('I', 'home_insurance_report.pdf');

} catch (Exception $e) {
    ob_end_clean(); // Limpiar el búfer de salida si ocurre un error
    echo 'Error al generar el PDF: ',  $e->getMessage();
    exit;
}

// Función para obtener datos de seguros por tipo
function getSegurosByTipo($pdo, $tipo) {
    $sql = "SELECT * FROM seguros WHERE seguro = :tipo ORDER BY 
            CASE calidad 
                WHEN 'Silver' THEN 1 
                WHEN 'Gold' THEN 2 
                WHEN 'Diamond' THEN 3 
            END";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
