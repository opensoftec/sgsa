<?php

class Pedido {

    public $ordId;
    public $numero;
    public $fecha;
    public $tipo;
    public $cliente;
    public $subtotal;
    public $descuento;
    public $impuesto;
    public $total;
    public $estado;
    public $cliId;

    public function __construct($ordId = 0, $numero = 0,$fecha = "", $tipo = "", $cliente = '', $subtotal = 0, $descuento = 0, $impuesto = 0,$total = 0,$estado = true,$cliId= 0) {
        $this->ordId = $ordId;
        $this->numero = $numero;
        $this->fecha = $fecha;
        $this->tipo = $tipo;
        $this->cliente = $cliente;
        $this->subtotal = $subtotal;
        $this->descuento = $descuento;
        $this->impuesto = $impuesto;
        $this->total = $total;
        $this->estado = $estado;
        $this->cliId = $cliId;
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
