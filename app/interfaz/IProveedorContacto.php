<?php

interface IProveedorContacto {
    
    function crear(\Proveedor_contacto $proveedorContacto);

    function editar(\Proveedor_contacto $proveedorContacto);

    function eliminar($id);

    function listar();

    function buscar($id);

    function codigoMaximo();
    
}
