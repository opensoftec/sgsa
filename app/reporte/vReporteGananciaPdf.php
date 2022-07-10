<?php
require '../../app/modelo/Login.php';
require '../../app/modelo/Tipo_usuario.php';

if (session_id() == '') {
    session_start();
}
if (empty($_SESSION['_USER_'])) {
    header('location:login.php');
    exit();
}

require('../../static/fpdf181/fpdf.php');
require '../config/config.php';
require '../data/DataConection.php';
require '../dao/GananciaDao.php';

$pdf = new FPDF();
$f = $_SESSION['rGanancia'];

//Agregamos la primera pagina al documento pdf
$pdf->AddPage();

//Seteamos el inicio del margen superior en 25 pixeles

$y_axis_initial = 25;

//Seteamos el tiupo de letra y creamos el titulo de la pagina. No es un encabezado no se repetira
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(40, 6, '', 0, 0, 'C');
$pdf->Cell(100, 6, 'LISTA DE GANANCIA POR DIA', 1, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(0, 6, $f['titulo'], 1,0, 'C');

$pdf->Ln(10);

//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(300);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(20, 6, 'Dia', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Fecha.', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Venta', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Compra', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Empleado', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Ganancia', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Estado', 1, 0, 'C', 1);

$pdf->Ln(8);
$pdf->SetFont('Helvetica', '', 8);
$i = 0;

$detalle = $f['detalle'];
foreach ($detalle as $fila) {
    if($i % 2 == 0){
        $pdf->SetFillColor(235);
    }else{
        $pdf->SetFillColor(300);
    }
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(20, 8, $fila['dia'], 1, 0, 'L', 1);
    $pdf->Cell(20, 8, $fila['fecha'], 1, 0, 'C', 1);
    $pdf->Cell(30, 8, $fila['venta'], 1, 0, 'R', 1);
    $pdf->Cell(30, 8, $fila['compra'], 1, 0, 'R', 1);
    $pdf->Cell(30, 8, $fila['empleado'], 1, 0, 'R', 1);
    $pdf->Cell(30, 8, $fila['ganancia'], 1, 0, 'R', 1);
    if ($fila['ganancia'] == ''){
        $pdf->Cell(30, 8, '', 1, 0, 'L', 1);
    }else if ($fila['ganancia'] == 0.00){
        $pdf->Cell(30, 8, '--------------', 1, 0, 'L', 1);
    }else if ($fila['ganancia'] >= 0){
        $pdf->Cell(30, 8, 'Ganancia', 1, 0, 'L', 1);
    } else{
        $pdf->SetTextColor(236, 3, 3 );
        $pdf->Cell(30, 8, 'Perdida', 1, 0, 'L', 1);
    }
    $i++;
    $pdf->Ln(8);
}

if($i % 2 == 0){
    $pdf->SetFillColor(235);
}else{
    $pdf->SetFillColor(300);
}
$pdf->Ln(2);
$t = $f['total'];
$pdf->SetTextColor(0, 0, 0);
$pdf->cell(40, 8, 'TOTAL', 1, 0, 'C', 1);
$pdf->cell(30, 8, $t['TVenta'], 1, 0, 'R', 1); 
$pdf->cell(30, 8, $t['TCompra'], 1, 0, 'R', 1);
$pdf->cell(30, 8, $t['TEmpleado'], 1, 0, 'R', 1);
$pdf->cell(30, 8, $t['TGanancia'], 1, 0, 'R', 1);

//ELIMINAMOS array rGanancia de la session Y RESTABLECEMOS LA REPORTG A TRUE
unset($_SESSION['rGanancia']);

//Mostramos el documento pdf
$pdf->Output();