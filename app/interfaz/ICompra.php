<?php

interface ICompra {
    function crear(\Compra $compra);
    
    function crearDetalle(\Compra_detalle $compraDetalle);

    function editar(\Compra $compra);

    function eliminar($id);

    function listar();

    function buscar($id);

    function codigoMaximo();
    
    function listarComboProveedor();
    
    function listarComboArticulo();
    
    function listarComboCompra($fechaInicio,$fechaFin);
}
