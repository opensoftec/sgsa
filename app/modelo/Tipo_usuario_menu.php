<?php

class Tipo_usuario_menu {

    public $tumId;
    public $tpuId;
    public $menId;
    public $ingresar;
    public $crear;
    public $editar;
    public $eliminar;
    public $fecharegistro;
    public $estado;

    public function __construct($tumId = 0, \ Tipo_usuario $tpuId = null, \ Menu $menId = null, $ingresar = '', $crear = '', $editar = '', $eliminar = '', $fecharegistro = '', $estado = true) {
        $this->tumIdId = $tumId;
        $this->tpuId = null ? Tipo_usuario() : $tpuId;
        $this->menId = null ? Menu() : $menId;
        $this->ingresar = $ingresar;
        $this->crear = $crear;
        $this->editar = $editar;
        $this->eliminar = $eliminar;
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
