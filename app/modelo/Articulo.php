<?php

class Articulo {
    public $artId;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $img;
    public $ubicacion;
    public $fecha_alta;
    public $presentacion;
    public $marca;
    public $modelo;
    public $stock_minimo;
    public $stock;
    public $precio;
    public $costo;
    public $pvp;
    public $iva;
    public $fecharegistro;
    public $observacion;
    public $activo;
    public $proId;
    public $ctgId;
    
   
    public function __construct($artId=0,$codigo=0,$nombre='',$descripcion='',$img='',$ubicacion='',$fecha_alta='',$presentacion='',$marca='',$modelo='',$stock_minimo=0,$stock=0,$precio=0,$costo=0,$pvp=0,$iva=0,$fecharegistro='',$observacion='',$activo=true,$proId=0,$ctgId =0) {
     $this->artId=$artId;
     $this->codigo=$codigo;
     $this->nombre=$nombre;
     $this->descripcion=$descripcion;
     $this->img=$img;
     $this->ubicacion=$ubicacion;
     $this->fecha_alta=$fecha_alta;
     $this->presentacion=$presentacion;
     $this->marca=$marca;
     $this->modelo=$modelo;
     $this->stock_minimo=$stock_minimo;
     $this->stock=$stock;
     $this->precio=$precio;
     $this->costo=$costo;
     $this->pvp=$pvp;
     $this->iva=$iva;
     $this->fecharegistro=$fecharegistro;
     $this->observacion=$observacion;
     $this->activo=$activo;
     $this->proId=$proId;
     $this->ctgId=$ctgId;
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
