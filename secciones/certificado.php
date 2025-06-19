<?php
// Mostrar errores para depuración (quitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir la clase BD para la conexión (sin que imprima nada)
include_once __DIR__ . '/../configuraciones/bd.php';

// Crear conexión a la base de datos
$conexionBD = BD::crearInstancia();

// Incluir FPDF
require(__DIR__ . '/../librerias/fpdf.php');

// Obtener parámetros GET
$idcurso = $_GET['id_curso'] ?? '';
$id_alumno = $_GET['id_alumno'] ?? '';

try {
    $sql = "SELECT alumnos.nombre, alumnos.apellidos, cursos.nombre_curso 
            FROM alumnos, cursos 
            WHERE alumnos.id = :id_alumno AND cursos.id = :id_curso";
    $consulta = $conexionBD->prepare($sql);
    $consulta->bindParam(':id_alumno', $id_alumno);
    $consulta->bindParam(':id_curso', $idcurso);
    $consulta->execute();
    $alumno = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$alumno) {
        die("No se encontró el alumno o el curso.");
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

// Crear el PDF
$pdf = new FPDF("L", "mm", "A4");
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'CERTIFICADO DE FINALIZACIÓN', 0, 1, 'C');
$pdf->Ln(10);

// Agregar contenido del certificado
$nombreCompleto = $alumno['nombre'] . ' ' . $alumno['apellidos'];
$nombreCurso = $alumno['nombre_curso'];

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Se otorga el presente certificado a:', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, $nombreCompleto, 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Por haber completado satisfactoriamente el curso:', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, $nombreCurso, 0, 1, 'C');

// Agregar fecha
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Fecha de emisión: ' . date('d/m/Y'), 0, 1, 'C');

// Salida del PDF
$pdf->Output();
exit;
