<?php

class Cliente {

    public $cliId;
    public $codigo;
    public $img;
    public $cedula;
    public $big;
    public $nombre;
    public $apellido;
    public $genero;
    public $telefono;
    public $email;
    public $direccion;
    public $fecharegistro;
    public $estado;
    public $ciuId;
    public $prvId;

    public function __construct($cliId = 0, $codigo = 0, $img = '', $cedula = '', $big = false, $nombre = '', $apellido = '', $genero = "m", $telefono = '', $email = '', $direccion = '', $fecharegistro = '', $estado = true,$ciuId = 0,$prvId = 0 ) {
        $this->cliId = $cliId;
        $this->codigo = $codigo;
        $this->img = $img;
        $this->cedula = $cedula;
        $this->big = $big;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->genero = $genero;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->fecharegistro = $fecharegistro;
        $this->estado = $estado;
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
