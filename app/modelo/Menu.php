<?php

class Menu {

    public $mendId;
    public $nombre;
    public $descripcion;
    public $url;
    public $orden;
    public $fecharegistro;
    public $estado;
    public $modId;

    public function __construct($mendId = 0, $nombre = '', $descripcion = '', $url = '', $orden = '', $fecharegistro = '', $estado = true, \ Modulo $modId = null) {
        $this->mendId = $mendId;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->url = $url;
        $this->orden = $orden;
        $this->fecharegistro = $fecharegistro;
        $this->estado = $estado;
        $this->modId = null ? new Modulo() : $modId;
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
