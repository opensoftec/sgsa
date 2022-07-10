<?php

interface IWebUsuario {
    
    function crear(\Web_usuario $webUsuario);

    function editar(\Web_usuario $webUsuario);

    function eliminar($id);

    function listar();

    function buscar($id);

    function codigoMaximo();
    
    function listarComboCliente();
    
}
