<?php

interface IUsuario {
    function add(Usuario $user);
    function editar(Usuario $user);
    function eliminar($id);
    function buscar($id);
    function login($cuenta,$passw);
    function listar();
    function listarComboTipoPersonal();
    function listarComboTipoUsuario();
    
}
