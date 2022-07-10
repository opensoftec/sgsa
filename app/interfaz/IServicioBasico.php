<?php

interface IServicioBasico {
    
    public function crear (\ServicioBasico $servicioBasico);
    
    function editar (\ServicioBasico $servicioBasico);
    
    function eliminar ($id);
    
    function listar();
    
    function buscar($id);
    
    function codigoMaximo();
    
}
