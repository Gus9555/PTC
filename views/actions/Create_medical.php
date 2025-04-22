<?php
ob_start(); // Iniciar el almacenamiento en búfer de salida

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
    $pdf->Cell(0, 10, 'Medical Insurance', 0, 1, 'C');
    $pdf->Ln(10);

    // Obtener datos de seguros médicos
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

    $segurosMedical = getSegurosByTipo($pdo, 'Medical');

    if (count($segurosMedical) > 0) {
        foreach ($segurosMedical as $row) {
            // Mostrar la calidad y precio
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, ucfirst($row['calidad']) . ' - Price: ' . $row['precio'], 0, 1);
            $pdf->Ln(5);

            // Mostrar las descripciones solo si están llenas
            $pdf->SetFont('Arial', '', 10);

            for ($i = 1; $i <= 6; $i++) { 
                $descripcion = "descripcion{$i}";
                if (trim($row[$descripcion]) !== '') {
                    $pdf->MultiCell(0, 10, "{$i}. " . $row[$descripcion]);
                }
            }

            // Espacio entre calidades
            $pdf->Ln(10);
        }
    } else {
        $pdf->Cell(0, 10, 'No se encontraron registros para este tipo de seguro.', 0, 1);
    }

    // Limpiar el búfer de salida antes de generar el PDF
    ob_end_clean();
    $pdf->Output('I', 'medical_insurance_report.pdf');

} catch (Exception $e) {
    ob_end_clean(); // Limpiar el búfer de salida si ocurre un error
    echo 'Error al generar el PDF: ',  $e->getMessage();
    exit;
}
?>
