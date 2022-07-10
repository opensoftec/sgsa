<?php

class OrdenPedidoDetalleAux {
    public $detId;
    public $ordId;
    public $articulo;
    public $cantidad;
    public $precio;
    public $totalitem;
    public $estado;
    public $artId;
    public $stockmax;
    
    public function __construct($detId = 0,$ordId = 0, $ariculo = '', $cantidad = 1, $precio = 0, $totalitem = 0, $estado = true,$artId = null) {
        $this->detId = $detId;
        $this->venId = $ordId;
        $this->articulo = $ariculo;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->totalitem = $totalitem;
        $this->estado = $estado;
        $this->artId = $artId;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        return $this->$name = $value;
    }
    
}
