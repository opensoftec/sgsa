<?php

class Compra {
    public $compId;
    public $proveedor;
    public $fecha;
    public $contado;
    public $subtotal;
    public $descuento;
    public $impuesto;
    public $total;
    public $usuId;
    public $proId;

    public function __construct($compId = 0, $proveedor = '', $contado = true, $subtotal = 0, $descuento = 0, $impuesto = 0,$total = 0, $usuId = '', $proId = 0,$fecha = "") {
        $this->compId = $compId;
        $this->proveedor = $proveedor;
        $this->fecha = $fecha==""? date('Y-m-d H:i:s'):$fecha;
        $this->contado = $contado;
        $this->subtotal = $subtotal;
        $this->descuento = $descuento;
        $this->impuesto = $impuesto;
        $this->total = $total;
        $this->usuId = $usuId;
        $this->proId = $proId;        
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
