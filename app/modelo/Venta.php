<?php

class Venta{

    public $venId;
    public $numero;
    public $num_orden;
    public $cliente;
    public $fecha;
    public $tipo;
    public $contado;
    public $entregado;
    public $subtotal;
    public $descuento;
    public $impuesto;
    public $total = 0;
    public $usuId;
    public $vendedor;
    public $cliId;

    public function __construct($venId = 0, $numero = 0, $num_orden = 0, $cliente = '', $tipo = '', $contado = true, $entregado = '', $subtotal = 0, $descuento = 0, $impuesto = 0,$total = 0, $usuId = '', $vendedor = '', $cliId = 0,$fecha = "") {
        $this->venId = $venId;
        $this->numero = $numero;
        $this->num_orden = $num_orden;
        $this->cliente = $cliente;
        $this->fecha = $fecha==""? date('Y-m-d H:i:s'):$fecha;
        $this->tipo = $tipo;
        $this->contado = $contado;
        $this->entregado = $entregado;
        $this->subtotal = $subtotal;
        $this->descuento = $descuento;
        $this->impuesto = $impuesto;
        $this->usuId = $usuId;
        $this->vendedor = $vendedor;
        $this->cliId = $cliId;
        $this->total = $total;
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
