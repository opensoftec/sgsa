<?php
require '../config/config.php';
require '../data/DataConection.php';
require '../modelo/Cliente.php';
require_once '../modelo/DetalleOrden.php';
require_once '../modelo/Pedido.php';
require '../dao/OrdenPedidoDao.php';
require '../modelo/Web_usuario.php';

session_start();


if (empty($_SESSION['_WEBUSER_'])) {
    echo '{"result":false,"error":"No ha inciado Session"}';
    die();
} else {
    $webUser = $_SESSION['_WEBUSER_'];
}

$detalles = new ArrayObject();
if (!isset($_SESSION['detalles'])) {
    $_SESSION['detalles'] = $detalles;
    echo "{'result':false,'error':'No ha escodigo ningun articulo'}";
    die();
}
$detalles = & $_SESSION['detalles'];

$subtotal = 0;
foreach ($_SESSION['detalles'] as $det) {
   $subtotal += $det->precio;
}

//echo json_encode($subtotal);
//die();

$daoVenta = new OrdenPedidoDao();
//echo json_encode($webUser->cliId);
//die();
//echo json_encode(date("Y-m-d H:i:s"));
//echo json_encode(new Pedido(0,0, $date('Y-m-d H:i:s'),'',$webUser->nombre, $subtotal, 0, $subtotal * 0.14, (($subtotal * 0.14) + $subtotal), true, $webUser->cliId));
//echo json_encode($daoOrden->add());
//die();
$fila = $daoVenta->add(new Pedido(0,0, date("Y-m-d H:i:s"),'',$webUser->nombre, $subtotal, 0, $subtotal * 0.14, (($subtotal * 0.14) + $subtotal), true, $webUser->cliId));
//echo json_encode($fila);
//die();
if ($fila[0]) {

    $filaDetalle = 0;
    foreach ($detalles as $articulo) {
        $daoVenta->crearDetalle(new Detalle1(0, $fila[1], $articulo->articulo, $articulo->cantidad, $articulo->precio, $articulo->totalitem, true, $articulo->artId));
        $filaDetalle +=1;
    }
    $detalles = new ArrayObject();
    $resul = ['result' => true,'error' => 'Transaccion realizada correctamente "Gracias por su compra :v" ', 'resultdetalle' => $filaDetalle];
} else {
    $resul = ['result' => false, 'error' => 'No se a podido realizar la transaccion'];
}

echo json_encode($resul);
