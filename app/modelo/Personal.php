<?php

class Personal {

    public $perId;
    public $codigo;
    public $img;
    public $cedula;
    public $nombre;
    public $apellido;
    public $genero;
    public $telefono;
    public $email;
    public $direccion;
    public $fecharegistro;
    public $estado;
    public $ctgId;
    public $ciuId;
    public $prvId;

    public function __construct($perId = 0, $codigo = 0, $img = '', $cedula = '', $nombre = '', $apellido = '', $genero = "m", $telefono = '', $email = "", $direccion = '', $fecharegistro = '', $estado = true,$ctgId = 0,$ciuId = 0,$prvId = 0) {
        $this->perId = $perId;
        $this->codigo = $codigo;
        $this->img = $img;
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->genero = $genero;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->fecharegistro = $fecharegistro;
        $this->estado = $estado;
        $this->ctgId = $ctgId;
        $this->ciuId = $ciuId;
        $this->prvId = $prvId;
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
