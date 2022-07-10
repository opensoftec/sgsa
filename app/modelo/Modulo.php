<?php

class Modulo {

    public $modId;
    public $nombre;
    public $descripcion;
    public $orden;
    public $estado;

    public function __construct($modId = 0, $nombre = '', $descripcion = '', $orden = '', $estado = true) {
        $this->modId = $modId;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->orden = $orden;
        $this->estado = $estado;
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
