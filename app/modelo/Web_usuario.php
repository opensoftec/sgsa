<?php

class Web_usuario {

    public $wusId;
    public $nombre;
    public $clave;
    public $ultimoingreso;
    public $fecharegistro;
    public $estado;
    public $cliId;

    public function __construct($wusId = 0, $nombre = '', $clave = '', $ultimoingreso = '', $fecharegistro = '', $estado = true,$cliId = "") {
        $this->wusId = $wusId;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->ultimoingreso = $ultimoingreso;
        $this->fecharegistro = $fecharegistro;
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
