<?php


class Proveedor {
    public $proId;
    public $codigo;
    public $ruc;
    public $nombre;
    public $descripcion;
    public $telefono;
    public $email;
    public $direccion;
    public $fecharegistro;
    public $estado;
    public $pcoId;
    
    public function __construct($proId=0,$codigo=0,$ruc='',$nombre='',$descripcion='',$telefono='',$email='',$direccion='',$fecharegistro='',$estado=true,$pcoId=0) {
        $this->proId=$proId;
        $this->codigo=$codigo;
        $this->ruc=$ruc;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->telefono=$telefono;
        $this->email=$email;
        $this->direccion=$direccion;
        $this->fecharegistro=$fecharegistro;
        $this->estado=$estado;
        $this->pcoId = $pcoId;
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
