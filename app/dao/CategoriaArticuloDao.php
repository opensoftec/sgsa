<?php

class CategoriaArticuloDao implements ICategoriaArticulo{
    
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select * from categoria_articulo where ctgId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $categoriaArticulo = new Categoria_articulo($rs->ctgId, $rs->nombre, $rs->estado);
                break;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $categoriaArticulo;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(ctgId) FROM categoria_articulo";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Categoria_articulo $categoriaArticulo) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into categoria_articulo (nombre,estado) values ("'.$categoriaArticulo->nombre.'","'.$categoriaArticulo->estado.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Categoria_articulo $categoriaArticulo) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update categoria_articulo set nombre = '".$categoriaArticulo->nombre."',estado = '".$categoriaArticulo->estado."' where ctgId = ".$categoriaArticulo->ctgId;
           $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function eliminar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update categoria_articulo set estado=0 where ctgId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>=0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function listar() {
        try {
            $categoriasArticulo = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select * from categoria_articulo where estado=1";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $categoriasArticulo->append(new Categoria_articulo($rs->ctgId, $rs->nombre, $rs->estado));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $categoriasArticulo;
    }

}
