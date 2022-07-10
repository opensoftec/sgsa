<?php

interface ICategoriaArticulo {
    
    function crear(\Categoria_articulo $categoriaArticulo);

    function editar(\Categoria_articulo $categoriaArticulo);

    function eliminar($id);

    function listar();

    function buscar($id);

    function codigoMaximo();
    
}
