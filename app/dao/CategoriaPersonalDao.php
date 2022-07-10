<?php

class CategoriaPersonalDao implements ICategoriaPersonal {

    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select * from categoria_personal where ctgId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $categoriaPersonal=new Categoria_personal($rs->ctgId, $rs->nombre, $rs->estado);
                break;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $categoriaPersonal;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(ctgId) FROM categoria_personal";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Categoria_personal $categoriaPersonal) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into categoria_personal (nombre,estado) values ("'.$categoriaPersonal->nombre.'","'.$categoriaPersonal->estado.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Categoria_personal $categoriaPersonal) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update categoria_personal set nombre = '".$categoriaPersonal->nombre."',estado = '".$categoriaPersonal->estado."' where ctgId = ".$categoriaPersonal->ctgId;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function eliminar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update categoria_personal set estado=0 where ctgId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function listar() {
        try {
            $categoriasPersonal = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select * from categoria_personal where estado=1";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $categoriasPersonal->append(new Categoria_personal($rs->ctgId, $rs->nombre, $rs->estado));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $categoriasPersonal;
    }

}
