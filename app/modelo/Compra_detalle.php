<?php

class Compra_detalle {
    
    public $detId;
    public $compId;
    public $articulo;
    public $cantidad;
    public $precio;
    public $subtotalitem;
    public $descuento;
    public $descuentolibras;
    public $totalitem;
    public $estado;
    public $artId;
    public $observacion;
    
    

    public function __construct($detId = 0,$compId = 0, $ariculo = '', $cantidad = 1, $precio = 0, $subtotalitem = 0,$descuento = 0,$descuentolibras = 0,$totalitem = 0, $estado = true,$artId = 0,$observacion = "") {
        $this->detId = $detId;
        $this->compId = $compId;
        $this->articulo = $ariculo;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->subtotalitem = $subtotalitem;
        $this->descuento = $descuento;
        $this->descuentolibras = $descuentolibras;
        $this->totalitem = $totalitem;
        $this->estado = $estado;
        $this->artId = $artId;   
        $this->observacion = $observacion;   
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
