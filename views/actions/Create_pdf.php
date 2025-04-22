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
    $conn = getConnection();

    // Crear una instancia de FPDF
    $pdf = new PDF();
    $pdf->AddPage();

    // Título principal
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Car Insurance', 0, 1, 'C');
    $pdf->Ln(10);

    // Tipos de seguro
    $types = ['Vehicule', 'motorcycle', 'Utility'];

    foreach ($types as $type) {
        // Mostrar el tipo de seguro como título
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, ucfirst($type) . " Insurance", 0, 1, 'L');
        $pdf->Ln(5);

        // Consultar los datos del tipo de seguro
        $query = "
            SELECT * FROM seguros 
            WHERE seguro = :tipo 
            ORDER BY 
                CASE calidad 
                    WHEN 'Silver' THEN 1 
                    WHEN 'Gold' THEN 2 
                    WHEN 'Diamond' THEN 3 
                END";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tipo', $type);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Verificar si se necesita una nueva página
                if ($pdf->GetY() > 240) {
                    $pdf->AddPage();
                }

                // Mostrar la calidad y precio
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 10, ucfirst($row['calidad']) . ' - Price: ' . $row['precio'], 0, 1);
                $pdf->Ln(5);
                
                // Mostrar las descripciones solo si están llenas
                $pdf->SetFont('Arial', '', 10);

                if(trim($row['descripcion']) !== '') {
                    $pdf->MultiCell(0, 10, '1. ' . $row['descripcion']);
                }
                if(trim($row['descripcion2']) !== '') {
                    $pdf->MultiCell(0, 10, '2. ' . $row['descripcion2']);
                }
                if(trim($row['descripcion3']) !== '') {
                    $pdf->MultiCell(0, 10, '3. ' . $row['descripcion3']);
                }
                if(trim($row['descripcion4']) !== '') {
                    $pdf->MultiCell(0, 10, '4. ' . $row['descripcion4']);
                }
                if(trim($row['descripcion5']) !== '') {
                    $pdf->MultiCell(0, 10, '5. ' . $row['descripcion5']);
                }
                if(trim($row['descripcion6']) !== '') {
                    $pdf->MultiCell(0, 10, '6. ' . $row['descripcion6']);
                }

                // Espacio entre calidades
                $pdf->Ln(10);
            }
        } else {
            $pdf->Cell(0, 10, 'No se encontraron registros para este tipo de seguro.', 0, 1);
        }

        // Espacio entre tipos de seguro
        $pdf->Ln(10);
    }

    // Limpiar el búfer de salida antes de generar el PDF
    ob_end_clean();
    $pdf->Output('car_insurance_report.pdf', 'I');

} catch (Exception $e) {
    ob_end_clean(); // Limpiar el búfer de salida si ocurre un error
    echo 'Error al generar el PDF: ',  $e->getMessage();
    exit;
}
?>
