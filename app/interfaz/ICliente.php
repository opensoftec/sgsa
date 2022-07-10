<?php

interface ICliente {
    
    function crear(\Cliente $cliente);

    function editar(\Cliente $cliente);

    function eliminar($id);

    function listar();

    function listarComboCiudad($id);
    
    function listarComboProvincia();

    function buscar($id);

    function codigoMaximo();
    
}
