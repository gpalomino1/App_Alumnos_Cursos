<?php 

require ('../librerias/fpdf.php');

include_once("../configuraciones/bd.php");
$conexionBD = BD::crearInstancia();
//********************************************************************************/
function agregarTexto($pdf, $texto, $x, $y, $fontSize = 10, $align = 'L', $r = 0, $g = 0, $b = 0){
    $pdf->SetFont('Arial', $align, $fontSize);
    $pdf->SetXY($x, $y);
    $pdf->SetTextColor($r, $g, $b);
$pdf->Cell(0, 10, $texto, 0, 0, $align);
    // $pdf->SetXY($x, $y); // Uncomment if you want to set position before adding text
    // $pdf->SetTextColor($r, $g, $b); // Uncomment to set text color
    // $pdf->SetFont('Arial', '', $fontSize); // Uncomment to set font size
    // $pdf->Cell(0, 10, $texto, 0, 1, $align); // Uncomment to actually add text

    // $pdf->Text($x, $y, $texto); // Uncomment to actually add text
}

//************************************************************************************ */
function agregarImagen($pdf, $rutaImagen, $x, $y, $ancho = 0, $alto = 0) {
    if (file_exists($rutaImagen)) {
        $pdf->Image($rutaImagen, $x, $y, $ancho, $alto);
    } else {
        echo "Error: La imagen no existe en la ruta especificada.";
    }
}



//************************************************************************************ */



print_r($_GET);
$idcurso = isset($_GET['id_curso']) ? $_GET['id_curso'] : '';
$id_alumno = isset($_GET['id_alumno']) ? $_GET['id_alumno'] : '';
$sql = "SELECT alumnos.nombre, alumnos.apellidos, cursos.nombre_curso as nombre_curso FROM alumnos, cursos 
WHERE alumnos.id = :id_alumno AND cursos.id = :id_curso";
$consulta = $conexionBD->prepare($sql);
$consulta->bindParam(':id_alumno', $id_alumno);
$consulta->bindParam(':id_curso', $idcurso);
$consulta->execute();
$alumno = $consulta->fetch(PDO::FETCH_ASSOC);   
if (!$alumno) {
    die("No se encontró el alumno o el curso.");
}   
$pdf=new FPDF("L","mm","A4");
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0, 10, 'Certificado de Finalizacion', 0, 1, 'C');
$pdf->Ln(10); // Salto de línea
$pdf->SetFont('Arial','',12);   

/*
print_r($alumno);
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();
*/
?>
