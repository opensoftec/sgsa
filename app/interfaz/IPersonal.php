<?php

interface IPersonal {

    function crear(\Personal $personal);

    function editar(\Personal $personal);

    function eliminar($id);

    function listar();

    function listarComboCiudad($id);
    
    function listarComboProvincia();

    function listarComboCategoriaPersonal();

    function buscar($id);

    function codigoMaximo();
}
