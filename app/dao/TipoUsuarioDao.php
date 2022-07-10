<?php

class TipoUsuarioDao implements ITipoUsuario {

    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select * from tipo_usuario where tpuId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $tipoUsuario=new Tipo_usuario($rs->tpuId,$rs->nombre,$rs->fecharegistro,$rs->estado);
                break;
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $tipoUsuario;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(tpuId) FROM tipo_usuario";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN)+1;
            //$result = $cn->query($query);
            //$codigoMaximo = $result->fetchColumn();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo+1;
    }

    public function crear(\Tipo_usuario $tipoUsuario) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into tipo_usuario (nombre,fecharegistro,estado) values ("'.$tipoUsuario->nombre.'","'.$tipoUsuario->fecharegistro.'","'.$tipoUsuario->estado.'")';
            //$query = 'insert into provincia (nombre,estado) values ("'. "Oro" .'","'.false.'");';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
        return false;
    }

    public function editar(\Tipo_usuario $tipoUsuario) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update tipo_usuario set nombre = '".$tipoUsuario->nombre."',estado = '".$tipoUsuario->estado."' where tpuId = ".$tipoUsuario->tpuId;
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
            $query = "update tipo_usuario set estado = 0  where tpuId = ".$id;
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
            $tipoUsuarios = new ArrayObject();
            $cn = DataConection::getInstancia();
            //$db->prepare( 'INSERT INTO data VALUES (?);' )->execute( array($binary[$i]) );
            $query = "select * from tipo_usuario where estado=1";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $tipoUsuarios->append(new Tipo_usuario($rs->tpuId,$rs->nombre,$rs->fecharegistro,$rs->estado));
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $tipoUsuarios;
    }

}
