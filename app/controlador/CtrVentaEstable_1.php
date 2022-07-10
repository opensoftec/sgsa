<?php

require '../config/config.php';
require '../data/DataConection.php';
require '../modelo/Cliente.php';
require '../modelo/Venta_detalle.php';
require '../modelo/Venta.php';
require '../interfaz/IVenta.php';
require '../dao/VentaDao.php';

$i = 0;
foreach ($_POST['items'] as $arti) {
    $i +=1;
    break;
}

if ($i == 0) {
    $resul = ['rs' => 'true', 'error' => 'Ha ocurrido un error'];
    echo json_encode($resul);
    die();
}else{
}

$daoVenta = new VentaDao();

$fila = $daoVenta->crear(new Venta(0, $_POST['numero'], $_POST['numero_orden'], $_POST['cliente'], $_POST['tipo'], ($_POST['contado'] == 'true' ? true : false), $_POST['entregado'], $_POST['subtotal'], $_POST['descuento'], $_POST['impuesto'], $_POST['total'], $_POST['usuId'], $_POST['vendedor'], $_POST['cliId'], $_POST['fecha']));
if ($fila[0]) {
    $filaDetalle = 0;
    foreach ($_POST['items'] as $articulo) {
        $daoVenta->crearDetalle(new Venta_detalle(0, $fila[1], $articulo['producto'], $articulo['cantidad'], $articulo['precio'], $articulo['total'], true, $articulo['codigo']));
        $filaDetalle +=1;
    }
    $resul = ['rs' => 'true', 'error' => 'Venta realizada con Exito', 'id'=>$fila[1]];
} else {
    $resul = ['rs' => '$false', 'error' => 'No se pudo hacer la venta'];
}
echo json_encode($resul);
