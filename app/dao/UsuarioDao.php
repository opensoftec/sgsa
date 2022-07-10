<?php

class UsuarioDao implements IUsuario {
    
    public function add(\Usuario $user) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into usuario (nombre,clave,ultimoingreso,fecharegistro,estado,tpuId,perId) values ("'.$user->nombre.'","'.$user->clave.'","'.$user->ultimoingreso.'","'.$user->fecharegistro.'","'.$user->estado.'","'.$user->tpuId.'","'.$user->perId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            //$db->prepare( 'INSERT INTO data VALUES (?);' )->execute( array($binary[$i]) );
            $query = "select * from usuario where usuId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $usuario = new Usuario($rs->usuId,$rs->nombre,$rs->clave,$rs->ultimoingreso,$rs->fecharegistro,$rs->estado,$rs->tpuId,$rs->perId);
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $usuario;
    }

    public function editar(\Usuario $user) {
        try {
            $cn = DataConection::getInstancia();
            $query = "update usuario set nombre = '".$user->nombre."',clave = '".$user->clave."',ultimoingreso = '".$user->ultimoingreso."',fecharegistro = '".$user->fecharegistro."',estado = '".$user->estado."',tpuId = '".$user->tpuId."',perId = '".$user->perId."' where usuId = ".$user->usuId;
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
            $query = "update usuario set estado = 0  where usuId = ".$id;
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
            $usuarios = new ArrayObject();
            $cn = DataConection::getInstancia();
            //$db->prepare( 'INSERT INTO data VALUES (?);' )->execute( array($binary[$i]) );
            $query = "select u.usuId as 'uusuId',u.nombre as 'unombre', u.clave as 'uclave', u.ultimoingreso as 'uultimoingreso',u.fecharegistro as 'ufecharegistro',u.estado as 'uestado',tpuId.tpuId as 'tpuIdtpuId',tpuId.nombre as 'tpuIdnombre',p.perId as 'pperId',p.nombre as 'pnombre'  from usuario u,tipo_usuario tpuId, personal p where u.tpuId = tpuId.tpuId and u.perId = p.perId and u.estado=1";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $usuarios->append(new Usuario($rs->uusuId,$rs->unombre,$rs->uclave,$rs->uultimoingreso,$rs->ufecharegistro,$rs->uestado,new Tipo_usuario($rs->tpuIdtpuId,$rs->tpuIdnombre),new Personal($rs->pperId,0,'','',$rs->pnombre)));
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $usuarios;
    }

    public function listarComboTipoPersonal() {
        try {
            $personales = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select per.perId as 'perperId',per.codigo as 'percodigo',per.img as 'perimg',per.cedula as 'percedula',per.nombre as 'pernombre',per.apellido as 'perapellido',per.genero as 'pergenero',per.telefono as 'pertelefono',per.email as 'peremail',per.direccion as 'perdireccion',per.fecharegistro as 'perfecharegistro',per.estado as 'perestado',ctg.ctgId as 'ctgctgId',ctg.nombre as 'ctgnombre',ctg.estado as 'ctgestado', c.ciuId as 'cciuId', c.prvId as 'cprvId', c.nombre as 'cnombre', c.estado as 'cestado' from personal per,categoria_personal ctg,ciudad c where per.ctgId = ctg.ctgId and per.ciuId = c.ciuId order by perId asc";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $personales->append(new Personal($rs->perperId,$rs->percodigo,$rs->perimg,$rs->percedula,$rs->pernombre,$rs->perapellido,$rs->pergenero,$rs->pertelefono,$rs->peremail,$rs->perdireccion,$rs->perfecharegistro,$rs->perestado,null,null,null));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $personales;
    }

    public function listarComboTipoUsuario() {
        try {
            $tipoUsuarios = new ArrayObject();
            $cn = DataConection::getInstancia();
            //$db->prepare( 'INSERT INTO data VALUES (?);' )->execute( array($binary[$i]) );
            $query = "select * from tipo_usuario";
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

    public function login($cuenta, $passw) {
        $user = null;
        try {
             $sql = "SELECT u.usuId id,u.nombre nom,tu.tpuId tid,tu.nombre tipo 
                 FROM usuario u INNER JOIN tipo_usuario tu
                 ON u.tpuId = tu.tpuId
                 WHERE u.nombre = :nom AND u.clave =:clave";
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);
            $stmp->bindParam(':nom',$cuenta,2);
             $stmp->bindParam(':clave',$passw,1);
            //Ejecuto el Query SQL
            $stmp->execute();
            if(($u = $stmp->fetch(PDO::FETCH_OBJ))){
                $user = new Usuario($u->id,$u->nom);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $user;  
    }

}
