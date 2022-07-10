<?php

require('../../static/fpdf181/fpdf.php');

require '../config/config.php';
require '../data/DataConection.php';
require '../modelo/Compra.php';
require '../modelo/Compra_detalle.php';
require '../interfaz/ICompra.php';
require '../modelo/Categoria_articulo.php';
require '../modelo/Proveedor_contacto.php';
require '../modelo/Proveedor.php';
require '../modelo/Articulo.php';
require '../dao/CompraDao.php';

$pdf = new FPDF();
$f = (object) $_GET;
$daoVenta = new CompraDao();

$venta = $daoVenta->buscar($f->numero);
$cliente = $daoVenta->buscarProveedor($venta->proId);


//Cabecera
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190,40,$pdf->Image('../../static/img/menu/iconofinal1.png',80,12,30),0,0,'C');
$pdf->Line(35,42,190,42);

//Compra
$pdf->Ln(40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190,7, 'Numero de Compra   Nmro. '.$venta->compId, 0, 0, 'C');

$pdf->Ln(15);
$pdf->SetFillColor(300);

$pdf->SetFont('Helvetica', 'B', 11);
$pdf->Cell(40, 6, 'Empresa   :   ', 0, 0, 'L', 1);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(130, 6, 'Alfa Cacao', 0, 0, 'L', 1);
$pdf->Line(35,73,160,73);

$pdf->Ln(10);
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->Cell(40, 6, 'Fecha        :  ', 0, 0, 'L', 1);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(130, 6, $venta->fecha, 0, 0, 'L', 1);
$pdf->Line(35,83,160,83);

$pdf->Ln(10);
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->Cell(40, 6, 'Contado    :  ', 0, 0, 'L', 1);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(130, 6,($venta->contado==1?'Pgda. Contando':' Pgda. Otro') , 0, 0, 'L', 1);
$pdf->Line(35,93,160,93);

$pdf->Ln(10);
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->Cell(40, 6, 'Proveedor :  ', 0, 0, 'L', 1);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(130, 6,$cliente->nombre, 0, 0, 'L', 1);
$pdf->Line(35,103,160,103);


$pdf->Ln(10);


//Proveedor
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190,7, '|| Datos del Proveedor', 0, 0, 'L');

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
$pdf->Cell(47.5, 15, $cliente->nombre, 1, 0, 'C', 1);
$pdf->Cell(47.5, 15, $cliente->telefono , 1, 0, 'C', 1);
$pdf->Cell(47.5, 15, $cliente->direccion , 1, 0, 'C', 1);
$pdf->Cell(47.5, 15, $cliente->email , 1, 0, 'C', 1);
$pdf->Ln(10);

//Detalle de la Compra
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190,7, '|| Detalle de la Compra', 0, 0, 'L');

$pdf->Ln(10);
$pdf->SetFillColor(300);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(9, 7, 'Num', 1, 0, 'C', 1);
$pdf->Cell(40, 7, 'Articulo', 1, 0, 'C', 1);
$pdf->Cell(18, 7, 'Cantidad', 1, 0, 'C', 1);
$pdf->Cell(18, 7, 'Precio', 1, 0, 'C', 1);
$pdf->Cell(20, 7, 'SubTotal', 1, 0, 'C', 1);
$pdf->Cell(20, 7, 'Desc..', 1, 0, 'C', 1);
$pdf->Cell(16, 7, 'Desc..Lb', 1, 0, 'C', 1);
$pdf->Cell(20, 7, 'Total Art', 1, 0, 'C', 1);
$pdf->Cell(38, 7, 'Observacion', 1, 0, 'C', 1);

$pdf->Ln(8);
$pdf->SetFont('Helvetica', '', 10);
$detalles = $daoVenta->buscarDetalles($venta->compId); 
 $i = 0;
foreach ($detalles as $fila) {
    if($i % 2 == 0){
        $pdf->SetFillColor(235);
    }else{
        $pdf->SetFillColor(300);
    }
    
    $aux = 0; 
    $con = (strlen($fila->observacion)/22); 
    $conini = 0; 
    $cadena = "";
    if(strlen($fila->observacion)>22){
        while($con > 0){
            $cadena = $cadena.(substr($fila->observacion,$conini,10))."\r\n";
            $conini = $conini+22;
            $con = $con - 1;
            $aux++;
        }
    }else{
        $aux = 1;
    }
    
    $pdf->Cell(9, $aux*7, $i, 1, 0, 'C', 1);
    $pdf->Cell(40, $aux*7, $fila->articulo, 1, 0, 'L', 1);
    $pdf->Cell(18, $aux*7, $fila->cantidad, 1, 0, 'C', 1);
    $pdf->Cell(18, $aux*7,'$'. $fila->precio, 1, 0, 'C', 1);
    $pdf->Cell(20, $aux*7,'$'. $fila->subtotalitem, 1, 0, 'C', 1);   
    $pdf->Cell(20, $aux*7,'$'. $fila->descuento, 1, 0, 'C', 1);
    $pdf->Cell(16, $aux*7,'*'. $fila->descuentolibras, 1, 0, 'C', 1);
    $pdf->Cell(20, $aux*7,'$'. $fila->totalitem, 1, 0, 'C', 1);
    if($aux > 1){
        $pdf->Cell(38, $aux*7,$cadena, 1, 0, 'C', 1);
    }else{
        $pdf->Cell(38, $aux*7,$fila->observacion, 1, 0, 'C', 1);
    }
    
    $i++;
    $pdf->Ln($aux*7);
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
