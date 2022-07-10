<?php

interface ICategoriaPersonal {
    
    function crear(\Categoria_personal $categoriaPersonal);

    function editar(\Categoria_personal $categoriaPersonal);

    function eliminar($id);

    function listar();

    function buscar($id);

    function codigoMaximo();
    
}
