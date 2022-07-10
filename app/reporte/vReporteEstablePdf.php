<?php

require('../../static/fpdf181/fpdf.php');

require '../config/config.php';
require '../data/DataConection.php';
require '../modelo/Ciudad.php';
require '../modelo/Cliente.php';
require '../modelo/Venta.php';
require '../interfaz/IVenta.php';
require '../dao/VentaDao.php';
require '../modelo/Provincia.php';
require '../modelo/Categoria_articulo.php';
require '../modelo/Proveedor_contacto.php';
require '../modelo/Proveedor.php';
require '../modelo/Articulo.php';

$pdf = new FPDF();
$f = (object) $_GET;

//Agregamos la primera pagina al documento pdf
$pdf->AddPage();

//Seteamos el inicio del margen superior en 25 pixeles

$y_axis_initial = 25;

//Seteamos el tiupo de letra y creamos el titulo de la pagina. No es un encabezado no se repetira
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(40, 6, '', 0, 0, 'C');
$pdf->Cell(100, 6, 'LISTA DE VENTAS REALIZADAS', 1, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(0, 6, 'Fecha de "'.$f->fechaInicio.'" al "'.$f->fechaFin.'"', 1,0, 'C');

$pdf->Ln(10);

//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(300);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(16, 6, 'venId', 1, 0, 'C', 1);
$pdf->Cell(14, 6, 'N Ord.', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Cliente', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Fecha', 1, 0, 'C', 1);
$pdf->Cell(31, 6, 'Subtotal', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Descuento', 1, 0, 'C', 1);
$pdf->Cell(22, 6, 'Impuesto', 1, 0, 'C', 1);
$pdf->Cell(31, 6, 'Total', 1, 0, 'C', 1);

$pdf->Ln(8);

$daoVenta = new VentaDao();
$pdf->SetFont('Helvetica', '', 10);
$i = 0;

foreach ($daoVenta->listarComboVenta($f->fechaInicio, $f->fechaFin) as $fila) {
    if($i % 2 == 0){
        $pdf->SetFillColor(235);
    }else{
        $pdf->SetFillColor(300);
    }
    $pdf->Cell(16, 8, $fila->venId, 1, 0, 'C', 1);
    $pdf->Cell(14, 8, $fila->num_orden, 1, 0, 'C', 1);
    $pdf->Cell(25, 8, $fila->cliente, 1, 0, 'C', 1);
    $pdf->Cell(25, 8, substr($fila->fecha,0,10), 1, 0, 'C', 1);
    $pdf->Cell(31, 8, $fila->subtotal, 1, 0, 'C', 1);
    $pdf->Cell(30, 8, $fila->descuento, 1, 0, 'C', 1);
    $pdf->Cell(22, 8, $fila->impuesto, 1, 0, 'C', 1);
    $pdf->Cell(31, 8, $fila->total, 1, 0, 'C', 1);
    $i++;
    $pdf->Ln(8);
}

//Mostramos el documento pdf
$pdf->Output();
