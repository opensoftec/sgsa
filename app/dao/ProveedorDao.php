<?php

class ProveedorDao implements IProveedor{
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select p.proId as pproId ,p.codigo as pcodigo,p.ruc as pruc,p.nombre as pnombre,p.descripcion as pdescripcion,p.telefono as ptelefono,p.email as pemail,p.direccion as pdireccion,p.fecharegistro as pfecharegistro,p.estado as pestado,pc.pcoId as pcpcoId from proveedor p, proveedor_contacto pc where p.proId= '".$id."' and p.pcoId = pc.pcoId";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $proveedor = new Proveedor($rs->pproId, $rs->pcodigo,$rs->pruc,$rs->pnombre,$rs->pdescripcion,$rs->ptelefono,$rs->pemail,$rs->pdireccion,$rs->pfecharegistro,$rs->pestado,$rs->pcpcoId);
                break;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $proveedor;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(proId) FROM proveedor";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Proveedor $proveedor) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into proveedor (codigo,ruc,nombre,descripcion,telefono,email,direccion,fecharegistro,estado,pcoId) values ("'.$proveedor->codigo.'","'.$proveedor->ruc.'","'.$proveedor->nombre.'","'.$proveedor->descripcion.'","'.$proveedor->telefono.'","'.$proveedor->email.'","'.$proveedor->direccion.'","'.$proveedor->fecharegistro.'","'.$proveedor->estado.'","'.$proveedor->pcoId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Proveedor $proveedor) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update proveedor set codigo ='".$proveedor->codigo."',  ruc = '".$proveedor->ruc."',nombre = '".$proveedor->nombre."',descripcion = '".$proveedor->descripcion."',telefono = '".$proveedor->telefono."',email = '".$proveedor->email."',direccion = '".$proveedor->direccion."',estado = '".$proveedor->estado."',pcoId = '".$proveedor->pcoId."' where proId = ".$proveedor->proId;
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
            $query = "update proveedor set estado=0 where proId = ".$id;
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
            $proveedores = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select p.proId as pproId ,p.codigo as pcodigo,p.ruc as pruc,p.nombre as pnombre,p.descripcion as pdescripcion,p.telefono as ptelefono,p.email as pemail,p.direccion as pdireccion,p.fecharegistro as pfecharegistro,p.estado as pestado,pc.pcoId as pcpcoId,pc.nombre as pcnombre,pc.principal as pcprincipal,pc.telefono as pctelefono,pc.email as pcemail,pc.direccion as pcdireccion,pc.estado as pcestado from proveedor p, proveedor_contacto pc where p.pcoId = pc.pcoId and p.estado=1";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $proveedores->append(new Proveedor($rs->pproId, $rs->pcodigo,$rs->pruc,$rs->pnombre,$rs->pdescripcion,$rs->ptelefono,$rs->pemail,$rs->pdireccion,$rs->pfecharegistro,$rs->pestado,new Proveedor_contacto($rs->pcpcoId,$rs->pcnombre,$rs->pcprincipal,$rs->pctelefono,$rs->pcemail,$rs->pcdireccion,$rs->pcestado)));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $proveedores;
    }

    public function listarProveedorcontacto() {
        try {
            $proveedoresContacto = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select * from proveedor_contacto";
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

}
