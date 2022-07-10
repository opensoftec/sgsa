<?php

interface IArticulo {
    
    function crear(\Articulo $articulo);

    function editar(\Articulo $articulo);

    function eliminar($id);

    function listar();
    
    function listarComboProveedor();
    
    function listarComboCategoriaArticulo();

    function buscar($id);

    function codigoMaximo();
    
}
