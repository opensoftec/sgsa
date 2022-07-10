<?php

interface ICiudad {

    function crear(\Ciudad $ciudad);

    function editar(\Ciudad $ciudad);

    function eliminar($id);

    function listar();
    
    function listarComboProvincia();

    function buscar($id);

    function codigoMaximo();
}
