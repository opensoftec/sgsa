<?php

class OrdenPedidoDetalleOrden {
    
    public $detId;
    public $ordId;
    public $articulo;
    public $cantidad;
    public $precio;
    public $totalitem;
    public $estado;
    public $artId;
    public $stockmax;
    
    public function __construct($detId = 0,$ordId = 0,$articulo = 0,$cantidad = 0,$precio = 0,$totalitem = 0,$estado = true,$artId = 0) {
        $this->detId = $detId;
        $this->ordId= $ordId;
        $this->articulo=$articulo;
        $this->cantidad =$cantidad;
        $this->precio =$precio;
        $this->totalitem =$totalitem;
        $this->estado =$estado;
        $this->artId =$artId;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($k, $v) {
        return $this->$k = $v;
    }
}
