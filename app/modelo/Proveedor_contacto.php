<?php


class Proveedor_contacto {
    public $pcoId;
    public $nombre;
    public $principal;
    public $telefono;
    public $email;
    public $direccion;
    public $estado;
    
    public function __construct($pcoId=0,$nombre='',$principal='',$telefono='',$email='',$direccion='',$estado=true) {
        $this->pcoId = $pcoId;
        $this->nombre = $nombre;
        $this->principal = $principal;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
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
