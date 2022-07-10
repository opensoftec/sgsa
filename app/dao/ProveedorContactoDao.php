<?php

class ProveedorContactoDao implements IProveedorContacto{
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select * from proveedor_contacto where pcoId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $proveedoreContacto = new Proveedor_contacto($rs->pcoId, $rs->nombre,$rs->principal,$rs->telefono,$rs->email,$rs->direccion,$rs->estado);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $proveedoreContacto;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(pcoId) FROM proveedor_contacto";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Proveedor_contacto $proveedorContacto) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into proveedor_contacto (nombre,principal,telefono,email,direccion,estado) values ("'.$proveedorContacto->nombre.'","'.$proveedorContacto->principal.'","'.$proveedorContacto->telefono.'","'.$proveedorContacto->email.'","'.$proveedorContacto->direccion.'","'.$proveedorContacto->estado.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Proveedor_contacto $proveedorContacto) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update proveedor_contacto set nombre = '".$proveedorContacto->nombre."',principal = '".$proveedorContacto->principal."',telefono = '".$proveedorContacto->telefono."',email = '".$proveedorContacto->email."',direccion = '".$proveedorContacto->direccion."',estado = '".$proveedorContacto->estado."' where pcoId = ".$proveedorContacto->pcoId;
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
            $query = "update  proveedor_contacto set estado=0 where pcoId = ".$id;
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
            $proveedoresContacto = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select * from proveedor_contacto where estado=1";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $proveedoresContacto->append(new Proveedor_contacto($rs->pcoId, $rs->nombre,$rs->principal,$rs->telefono,$rs->email,$rs->direccion,$rs->estado));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $proveedoresContacto;
    }

//put your code here
}
