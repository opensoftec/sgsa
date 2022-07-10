<?php

class Detalle1 {

    public $detId;
    public $ordId;
    public $articulo;
    public $cantidad;
    public $precio;
    public $totalitem;
    public $estado;
    public $artId;
    public $stockmax;

    public function __construct($detId = 0,$ordId = 0, $ariculo = '', $cantidad = 1, $precio = 0, $totalitem = 0, $estado = true,$artId = 0) {
        $this->detId = $detId;
        $this->ordId = $ordId;
        $this->articulo = $ariculo;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->totalitem = $totalitem;
        $this->estado = $estado;
        $this->artId = $artId;
    }

    public function __get($k) {
        return $this->$k;
    }

    public function __set($k, $v) {
        return $this->$k = $v;
    }

    public function __toString() {
        return json_encode($this);
    }

}