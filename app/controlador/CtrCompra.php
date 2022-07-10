<?php

require '../../app/config/config.php';
require '../../app/data/DataConection.php';
require '../../app/modelo/Categoria_articulo.php';
require '../../app/modelo/Proveedor_contacto.php';
require '../../app/modelo/Proveedor.php';
require '../../app/modelo/Compra.php';
require '../../app/modelo/Compra_detalle.php';
require '../../app/modelo/Articulo.php';
require '../../app/interfaz/ICompra.php';
require '../../app/dao/CompraDao.php';

$i = 0;
foreach ($_POST['items'] as $arti) {
    $i +=1;
    break;
}

if ($i == 0) {
    $resul = ['rs' => 'true', 'error' => 'Ha ocurrido un error aki'];
    echo json_encode($resul);
    die();
}else{
}

$daoVenta = new CompraDao();


$fila = $daoVenta->crear(new Compra(0, $_POST['proveedor'], ($_POST['contado'] == 'true' ? true : false), $_POST['subtotal'], $_POST['descuento'], $_POST['impuesto'], $_POST['total'], $_POST['usuId'], $_POST['proId']));


if ($fila[0]) {

    $filaDetalle = 0;
    foreach ($_POST['items'] as $articulo) {

        $daoVenta->crearDetalle(new Compra_detalle(0, $fila[1],$articulo['producto'], $articulo['cantidad'],$articulo['precio'], 
                  $articulo['subtotal'], $articulo['descuento'],$articulo['descuentoLibras'],$articulo['total'],true, $articulo['codigo'], 
                  $articulo['observacion']));
        $filaDetalle +=1;
    }
    $resul = ['rs' => 'true', 'error' => 'Compra realizada con Exito','id'=>$fila[1]];
} else {
    $resul = ['rs' => '$false', 'error' => 'No se pudo hacer la Compra'];
}
echo json_encode($resul);



