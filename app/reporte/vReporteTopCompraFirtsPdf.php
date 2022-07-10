<?php

require('../../static/fpdf181/fpdf.php');

require '../config/config.php';
require '../data/DataConection.php';
require '../modelo/Compra.php';
require '../modelo/Top.php';
require '../modelo/Compra_detalle.php';
require '../interfaz/ICompra.php';
require '../modelo/Categoria_articulo.php';
require '../modelo/Proveedor_contacto.php';
require '../modelo/Proveedor.php';
require '../modelo/Articulo.php';
require '../dao/CompraDao.php';

$pdf = new FPDF();
$f = (object) $_GET;
$daoCompra = new CompraDao();

//Cabecera
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190,40,$pdf->Image('../../static/img/menu/top2.png',80,12,50),0,0,'C');
$pdf->Line(35,42,190,42);

//Venta
$pdf->Ln(60);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190,7, 'Top de los mejores Proveedores', 0, 0, 'C');

$pdf->Ln(15);
$pdf->SetFillColor(300);
$pdf->Ln(10);

//Top
$pdf->Ln(10);
$pdf->SetFillColor(300);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(30, 7, 'Puesto. Top', 1, 0, 'C', 1);
$pdf->Cell(46, 7, 'Cliente', 1, 0, 'C', 1);
$pdf->Cell(65, 7, 'Num Ordenes Compradas al Prov...', 1, 0, 'C', 1);
$pdf->Cell(38, 7, 'Venta Maxima', 1, 0, 'C', 1);

$pdf->Ln(8);
$pdf->SetFont('Helvetica', '', 10);

$i = 0; 
$detalles = $daoCompra->listarTopCompra($f->fechaInicio, $f->fechaFin, $f->limit, $f->ordenMax);

foreach ($detalles as $fila) {
    if($i % 2 == 0){
        $pdf->SetFillColor(235);
    }else{
        $pdf->SetFillColor(300);
    }
    $pdf->Cell(30, 7, ($i+1), 1, 0, 'C', 1);
    $pdf->Cell(46, 7, $fila->nombre.' '.$fila->apellido, 1, 0, 'C', 1);
    $pdf->Cell(65, 7, $fila->contador, 1, 0, 'C', 1);
    $pdf->Cell(38, 7,'$'. $fila->total, 1, 0, 'C', 1);
    $i++;
    $pdf->Ln(7);
}

$pdf->Output();
