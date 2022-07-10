<?php

require '../config/config.php';
require '../data/DataConection.php';
require '../modelo/Ciudad.php';
require '../modelo/Cliente.php';
require '../modelo/Venta_detalle.php';
require '../modelo/Venta.php';
require '../modelo/Top.php';
require '../modelo/Compra_detalle.php';
require '../modelo/Compra.php';
require '../interfaz/IVenta.php';
require '../interfaz/ICompra.php';
require '../modelo/Provincia.php';
require '../modelo/Categoria_articulo.php';
require '../modelo/Proveedor_contacto.php';
require '../modelo/Proveedor.php';
require '../modelo/Articulo.php';
require '../dao/CompraDao.php';
require '../dao/VentaDao.php';
require '../dao/GananciaDao.php';

//lineas nuevas***
require '../../app/modelo/Login.php';
require '../../app/modelo/Tipo_usuario.php';

if (session_id() == '') {
    session_start();
}
if (empty($_SESSION['_USER_'])) {
    header('location:login.php');
    exit();
}
$user = $_SESSION['_USER_'];


if ($_POST['opcion'] == 'true') {
    $daoVenta = new VentaDao();
    echo json_encode($daoVenta->listarComboVenta($_POST['fechaInicio'], $_POST['fechaFin']));
} 
else if ($_POST['opcion'] == 'false') {
    $daoCompra = new CompraDao();
    echo json_encode($daoCompra->listarComboCompra($_POST['fechaInicio'], $_POST['fechaFin']));
} 
else if ($_POST['opcion'] == 'top') {
    if ($_POST['opc'] == 'true') {
         $daoVenta = new VentaDao();
        echo json_encode($daoVenta->listarTopVenta($_POST['fechaInicio'], $_POST['fechaFin'],$_POST['limit'],$_POST['ordenMax'])); 
        die();
    } else {
        $daoCompra = new CompraDao();
        echo json_encode($daoCompra->listarTopCompra($_POST['fechaInicio'], $_POST['fechaFin'],$_POST['limit'],$_POST['ordenMax'])); 
        die();
    }
}elseif ($_POST['opcion'] == 'RGanancia') {
    $daoGanancia = new GananciaDao();
    echo json_encode($daoGanancia->Ganancia($_POST['fechaInicio'], $_POST['fechaFin']));

}elseif ($_POST['opcion'] == 'RGananciaSession') {
    $f = (object) $_POST;

    $detalle = $f->detalle;
    $total = $f->total;

    $rGanancia = array(
        'titulo' =>$f->titulo,
        'detalle' => $detalle,
        'total' => $total
    );

    $_SESSION['rGanancia'] = $rGanancia; 
    echo '{"resp":true}';
    exit();
}


