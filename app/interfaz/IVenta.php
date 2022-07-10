<?php

interface IVenta {
    
    function crear(\Venta $venta);
    
    function crearDetalle(\Venta_detalle $ventaDetalle);

    function editar(\Venta $venta);

    function eliminar($id);

    function listar();

    function buscar($id);

    function codigoMaximo();
    
    function listarComboCliente();
    
    function listarComboArticulo();
    
    function listarComboVenta($fechaInicio,$fechaFin);
    
}
