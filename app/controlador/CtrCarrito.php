<?php

class CtrCarrito {

    public $ctrArticulo;

    public function __construct() {
        require_once '../controlador/CtrArticulo.php';
        require_once '../../app/modelo/DetalleOrden.php';
        //require_once '../../app/modelo/Articulo.php';
        
        $this->ctrArticulo = new CtrArticulo; 
    }
    
    public function buscarArticulo($id) {
        return $this->ctrArticulo->buscarArticulo($id);
    }

    public function add() {
        if (!empty($_POST)) {
            $post = (object) $_POST;
            $art = $this->buscarArticulo($post->artId);
            $pedido = new Detalle1();
            $pedido->artId = $art->artId;
            $pedido->stockmax = $art->stock;
            $pedido->articulo = $art->nombre;
            $pedido->cantidad = $post->cantidad;
            $pedido->precio = $art->pvp;
            $pedido->totalitem = ($post->cantidad * $art->pvp);
            if (session_id() == '') {
                session_start();
            }
            $detalles = new ArrayObject();
            if (!isset($_SESSION['detalles'])) {
                $_SESSION['detalles'] = $detalles;
            }
            $detalles = & $_SESSION['detalles'];
            if (!$this->exists($detalles, $pedido,$art)) {
                $detalles->append($pedido);
            }
            echo '{"result":true,"error":"Operación realizada con éxito"}';
            die();
        }
    }

    public function editar() {
        if (!empty($_POST)) {
            $post = (object) $_POST;
            if (session_id() == '') {
                session_start();
            }
            $detalles = new ArrayObject();
            if (!isset($_SESSION['detalles'])) {
                $_SESSION['detalles'] = $detalles;
            }
            $detalles = & $_SESSION['detalles'];
            foreach ($detalles as $det) {
                if ($det->artId == $post->artId && $post->cantidad <= $det->stockmax) {
                    $det->cantidad = $post->cantidad;
                    $det->totalitem = $det->cantidad * $det->precio;
                    echo '{"result":true,"error":"Operación realizada con éxito"}';
                    die();
                }
            }
            echo '{"result":false,"error":"Cantidad excedida"}';
            die();
        }
    }

    public function eliminar() {
        if (!empty($_POST)) {
            $post = (object) $_POST;
            if (session_id() == '') {
                session_start();
            }
            $detalles = new ArrayObject();
            if (!isset($_SESSION['detalles'])) {
                $_SESSION['detalles'] = $detalles;
            }
            $detalles = & $_SESSION['detalles'];
            foreach ($detalles as $k => $det) {
                if ($det->artId == $post->artId) {
                    $detalles->offsetUnset($k);
                    echo '{"result":true,"error":"Operación realizada con éxito"}';
                    die();
                }
            }
            echo '{"result":false,"error":"Error en la transacción"}';
            die();
        }
    }

    public function exists($detalles, $pedido, $articulo) {
        foreach ($detalles as $det) {
            if ($det->artId == $pedido->artId) {
                $cantidad = $det->cantidad + $pedido->cantidad;
                if ($cantidad <= $articulo->stock) {
                    $det->cantidad += $pedido->cantidad;
                    $det->totalitem = $det->cantidad * $det->precio;
                    return true;
                } else {
                    echo '{"result":false,"error":"Cantidad excedida"}';
                    die();
                }
            }
        }
        return false;
    }
    
}
