<?php

class Provincia {

    public $prvId;
    public $nombre;
    public $estado;

    public function __construct($prvId = 0, $nombre = '', $estado = true) {
        $this->prvId = $prvId;
        $this->nombre = $nombre;
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
