<?php

class WebUsuarioDao implements IWebUsuario{
    
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            //$db->prepare( 'INSERT INTO data VALUES (?);' )->execute( array($binary[$i]) );
            $query = "select u.wusId as 'uusuId',u.nombre as 'unombre', u.clave as 'uclave', u.ultimoingreso as 'uultimoingreso',u.fecharegistro as 'ufecharegistro',u.estado as 'uestado',c.cliId as 'ccliId',c.nombre as 'cnombre'  from web_usuario u,cliente c where u.wusId = '".$id."' and u.cliId = c.cliId";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $webUsuario = new Web_usuario($rs->uusuId,$rs->unombre,$rs->uclave,$rs->uultimoingreso,$rs->ufecharegistro,$rs->uestado,new Cliente($rs->ccliId,0,'','',true,$rs->cnombre));
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $webUsuario;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(wusId) FROM web_usuario";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Web_usuario $webUsuario) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into web_usuario (nombre,clave,ultimoingreso,fecharegistro,estado,cliId) values ("'.$webUsuario->nombre.'","'.$webUsuario->clave.'","'.$webUsuario->ultimoingreso.'","'.$webUsuario->fecharegistro.'","'.$webUsuario->estado.'","'.$webUsuario->cliId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Web_usuario $webUsuario) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update web_usuario set nombre = '".$webUsuario->nombre."',clave = '".$webUsuario->clave."',ultimoingreso = '".$webUsuario->ultimoingreso."',fecharegistro = '".$webUsuario->fecharegistro."',estado = '".$webUsuario->estado."',cliId = '".$webUsuario->cliId->proId."' where wusId = ".$webUsuario->wusId;
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
            $query = "delete from web_usuario where wusId = ".$id;
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
            $webUsuarios = new ArrayObject();
            $cn = DataConection::getInstancia();
            //$db->prepare( 'INSERT INTO data VALUES (?);' )->execute( array($binary[$i]) );
            $query = "select u.wusId as 'uusuId',u.nombre as 'unombre', u.clave as 'uclave', u.ultimoingreso as 'uultimoingreso',u.fecharegistro as 'ufecharegistro',u.estado as 'uestado',c.cliId as 'ccliId',c.nombre as 'cnombre'  from web_usuario u,cliente c where u.cliId = c.cliId";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $webUsuarios->append(new Web_usuario($rs->uusuId,$rs->unombre,$rs->uclave,$rs->uultimoingreso,$rs->ufecharegistro,$rs->uestado,new Cliente($rs->ccliId,0,'','',true,$rs->cnombre)));
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $webUsuarios;
    }

    public function listarComboCliente() {
        try {
            $clientes = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select cli.cliId as 'clicliId',cli.codigo as 'clicodigo',cli.img as 'cliimg',cli.cedula as 'clicedula',cli.big as 'clibig',cli.nombre as 'clinombre',cli.apellido as 'cliapellido',cli.genero as 'cligenero',cli.telefono as 'clitelefono',cli.email as 'cliemail',cli.direccion as 'clidireccion',cli.fecharegistro as 'clifecharegistro',cli.estado as 'cliestado', c.ciuId as 'cciuId', c.prvId as 'cprvId', c.nombre as 'cnombre', c.estado as 'cestado' from cliente cli,ciudad c where cli.ciuId = c.ciuId order by cli.cliId asc";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $clientes->append(new Cliente($rs->clicliId,$rs->clicodigo,$rs->cliimg,$rs->clicedula,$rs->clibig,$rs->clinombre,$rs->cliapellido,$rs->cligenero,$rs->clitelefono,$rs->cliemail,$rs->clidireccion,$rs->clifecharegistro,$rs->cliestado,null,null));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $clientes;
    }

}
