<?php

require('../../static/fpdf181/fpdf.php');

require '../config/config.php';
require '../data/DataConection.php';
require '../modelo/Venta.php';
require '../modelo/Cliente.php';
require '../modelo/Venta_detalle.php';
require '../interfaz/IVenta.php';
require '../modelo/Categoria_articulo.php';
require '../modelo/Articulo.php';
require '../dao/VentaDao.php';

$pdf = new FPDF();
$f = (object) $_GET;
$daoVenta = new VentaDao();

$venta = $daoVenta->buscar($f->numero);
$cliente = $daoVenta->buscarCliente($venta->cliId);


//Cabecera
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190,40,$pdf->Image('../../static/img/menu/nano_logo.png',80,12,30),0,0,'C');
$pdf->Line(35,42,190,42);

//Compra
$pdf->Ln(40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190,7, 'Venta Numero: '.$venta->venId, 0, 0, 'C');

$pdf->Ln(15);
$pdf->SetFillColor(300);

$pdf->SetFont('Helvetica', 'B', 11);
$pdf->Cell(40, 6, 'Empresa :   ', 0, 0, 'L', 1);
$pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(130, 6, 'NANOSH-CELL - RUC: 0953402963001', 0, 0, 'L', 1);
$pdf->Line(35,73,160,73);

$pdf->Ln(10);
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->Cell(40, 6, 'Contacto :  ', 0, 0, 'L', 1);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(130, 6,'0962578128 - nanoshcell@hotmail.com', 0, 0, 'L', 1);
$pdf->Line(35,83,160,83);

$pdf->Ln(10);
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->Cell(40, 6, 'Pago :  ', 0, 0, 'L', 1);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(130, 6,($venta->contado==1?'Contado':' Credito') , 0, 0, 'L', 1);
$pdf->Line(35,93,160,93);

$pdf->Ln(10);
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->Cell(40, 6, 'Fecha :  ', 0, 0, 'L', 1);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(130, 6,$venta->fecha, 0, 0, 'L', 1);
$pdf->Line(35,103,160,103);


$pdf->Ln(10);


//Proveedor
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190,7, '|| Datos del Cliente', 0, 0, 'L');

$pdf->Ln(10);
$pdf->SetFillColor(300);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(47.5, 6, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(47.5, 6, 'Telefono', 1, 0, 'C', 1);
$pdf->Cell(47.5, 6, 'Direccion', 1, 0, 'C', 1);
$pdf->Cell(47.5, 6, 'Correo', 1, 0, 'C', 1);

$pdf->Ln(6);
$pdf->SetFillColor(243);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(47.5, 15, $cliente->nombre." ".$cliente->apellido, 1, 0, 'C', 1);
$pdf->Cell(47.5, 15, $cliente->telefono , 1, 0, 'C', 1);
$pdf->Cell(47.5, 15, $cliente->direccion , 1, 0, 'C', 1);
$pdf->Cell(47.5, 15, $cliente->email , 1, 0, 'C', 1);
$pdf->Ln(10);

//Detalle de la Compra
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190,7, '|| Detalle de la Venta', 0, 0, 'L');

$pdf->Ln(10);
$pdf->SetFillColor(300);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(20, 7, 'Num', 1, 0, 'C', 1);
$pdf->Cell(56, 7, 'Articulo', 1, 0, 'C', 1);
$pdf->Cell(34, 7, 'Cantidad', 1, 0, 'C', 1);
$pdf->Cell(38, 7, 'Precio', 1, 0, 'C', 1);
$pdf->Cell(42, 7, 'Total Art', 1, 0, 'C', 1);

$pdf->Ln(8);
$pdf->SetFont('Helvetica', '', 10);
$detalles = $daoVenta->buscarDetalles($venta->venId); 
 $i = 0;
foreach ($detalles as $fila) {
    if($i % 2 == 0){
        $pdf->SetFillColor(235);
    }else{
        $pdf->SetFillColor(300);
    }
    $pdf->Cell(20, 7, $i, 1, 0, 'C', 1);
    $pdf->Cell(56, 7, $fila->articulo, 1, 0, 'L', 1);
    $pdf->Cell(34, 7, $fila->cantidad, 1, 0, 'C', 1);
    $pdf->Cell(38, 7,'$'. $fila->precio, 1, 0, 'C', 1);
    $pdf->Cell(42, 7,'$'. $fila->totalitem, 1, 0, 'C', 1);
    $i++;
    $pdf->Ln(7);
}

//Compra Totales
$pdf->Ln(10);

$pdf->Cell(110,7);
$pdf->Cell(29,8,"SUBTOTAL",1,0,'C');
$pdf->Cell(51,8," $ ".$venta->subtotal,1,0,'R');

$pdf->Ln(8);
$pdf->Cell(110,7);
$pdf->Cell(29,8,"DESCUENTO",1,0,'C');
$pdf->Cell(51,8," $ ".$venta->descuento,1,0,'R');

$pdf->Ln(8);
$pdf->Cell(110,7);
$pdf->Cell(29,8,"IMPUESTO",1,0,'C');
$pdf->Cell(51,8," $ ".$venta->impuesto,1,0,'R');

$pdf->Ln(8);
$pdf->Cell(110,7);
$pdf->Cell(29,8,"TOTAL",1,0,'C');
$pdf->Cell(51,8," $ ".$venta->total,1,0,'R');
 
//$pdf->Multicell(400,4, "Nota: ".$rowrepar['notapresu']);

$pdf->Output();
