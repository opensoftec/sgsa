<?php

interface IProveedor {

    function crear(\Proveedor $proveedor);

    function editar(\Proveedor $proveedor);

    function eliminar($id);

    function listar();

    function buscar($id);

    function codigoMaximo();
    
    function listarProveedorcontacto();
}
