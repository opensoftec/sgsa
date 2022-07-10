<?php

class CiudadDao implements ICiudad {

    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select c.ciuId as 'cciuId', c.prvId as 'pprvId', p.nombre as 'pnombre', p.estado as 'pestado', c.nombre as 'cnombre', c.estado as 'cestado' from ciudad c, provincia p where c.ciuId = '".$id."' and  c.prvId = p.prvId";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $cuidade = new Ciudad($rs->cciuId,$rs->pprvId, $rs->cnombre,$rs->cestado);
                break;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $cuidade;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "select Max(ciuId) from ciudad";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN)+1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Ciudad $ciudad) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into ciudad (prvId,nombre,estado) values ("'.$ciudad->prvId.'","'.$ciudad->nombre.'","'.$ciudad->estado.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Ciudad $ciudad) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'update ciudad set prvId = "'.$ciudad->prvId.'", nombre = "'.$ciudad->nombre.'", estado = "'.$ciudad->estado.'" where ciuId = '.$ciudad->ciuId;
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
            $query = "update ciudad set estado = 0 where ciuId = ".$id;
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
            $cuidades = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select c.ciuId as 'cciuId', c.prvId as 'pprvId', p.nombre as 'pnombre', p.estado as 'pestado', c.nombre as 'cnombre', c.estado as 'cestado' from ciudad c, provincia p where  c.prvId = p.prvId";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $cuidades->append(new Ciudad($rs->cciuId, new Provincia($rs->pprvId,$rs->pnombre,$rs->pestado), $rs->cnombre,$rs->cestado));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $cuidades;
    }

    public function listarComboProvincia() {
        try {
            $provincias = new ArrayObject();
            $cn = DataConection::getInstancia();
            //$db->prepare( 'INSERT INTO data VALUES (?);' )->execute( array($binary[$i]) );
            $query = "select * from provincia where estado=1";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $provincias->append(new Provincia($rs->prvId,$rs->nombre,$rs->estado));
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $provincias;
    }

}
