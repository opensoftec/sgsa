<?php

class Usuario {

    public $usuId;
    public $nombre;
    public $clave;
    public $ultimoingreso;
    public $fecharegistro;
    public $estado;
    public $tpuId;
    public $perId;
    public function __construct($usuId = 0, $nombre = '', $clave = '', $ultimoingreso = '', $fecharegistro = '', $estado = true,$tpuId = "",$perId = "") {

        $this->usuId = $usuId;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->ultimoingreso = $ultimoingreso;
        $this->fecharegistro = $fecharegistro;
        $this->estado = $estado;
        $this->tpuId = $tpuId;
        $this->perId = $perId;
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
