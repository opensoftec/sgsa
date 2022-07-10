<?php

interface IProvincia {
    function crear(\Provincia $provincia);
    function editar(\Provincia $provincia);
    function eliminar($id);
    function listar();
    function buscar($id);
}
