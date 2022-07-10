<?php

class Orden_pedido {

    public $ordId;
    public $numero;
    public $fecha;
    public $tipo;
    public $cliente;
    public $subtotal;
    public $descuento;
    public $impuesto;
    public $total = 0;
    public $estado;
    public $cliId;

    public function __construct($ordId = 0, $numero = 0, $tipo = true, $cliente = '', $subtotal = 0, $descuento = 0, $impuesto = 0, \ Cliente $cliId = null) {
        $this->ordId = $ordId;
        $this->numero = $numero;
        $this->fecha = date('Y-m-d');
        $this->tipo = $tipo;
        $this->cliente = $cliente;
        $this->subtotal = $subtotal;
        $this->descuento = $descuento;
        $this->impuesto = $impuesto;
        $this->cliId = null ? new Cliente() : $cliId;
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
