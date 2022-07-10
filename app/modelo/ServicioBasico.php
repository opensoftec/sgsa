<?php
class ServicioBasico {
    private $idServicioBasico;
    private $descripcion;
    private $monto;
    private $estado;
    
    function __construct($idServicioBasico=0, $descripcion="", $monto=0, $estado=true) {
        $this->idServicioBasico = $idServicioBasico;
        $this->descripcion = $descripcion;
        $this->monto = $monto;
        $this->estado = $estado;
    }
    
    function getIdServicioBasico() {
        return $this->idServicioBasico;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getMonto() {
        return $this->monto;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdServicioBasico($idServicioBasico) {
        $this->idServicioBasico = $idServicioBasico;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }


}
