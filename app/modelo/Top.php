<?php

class Top {
    public $Id;
    public $nombre;
    public $apellido;
    public $total;
    public $contador;
    
    public function __construct($Id = 0,$nombre = "",$apellido = "",$total = 0.0,$contador = 0) {
        $this->Id = $Id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->total = $total;
        $this->contador = $contador;
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
