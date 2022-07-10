<?php

class Tipo_usuario {

    public $tpuId;
    public $nombre;
    public $fecharegistro;
    public $estado;

    public function __construct($tpuId = 0, $nombre = '', $fecharegistro = '', $estado = true) {
        $this->tpuId = $tpuId;
        $this->nombre = $nombre;
        $this->fecharegistro = $fecharegistro;
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
