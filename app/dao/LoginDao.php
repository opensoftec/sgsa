<?php

class LoginDao implements ILogin {
    public function login($cuenta, $passw) {
        $user = null;
        try {
             $sql = "SELECT u.usuId id,u.nombre nom,tu.tpuId tid,tu.nombre tipo 
                 FROM usuario u INNER JOIN tipo_usuario tu
                 ON u.tpuId = tu.tpuId
                 WHERE u.nombre = :nom AND u.clave =:clave AND u.estado = 1 ";
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);
            $stmp->bindParam(':nom',$cuenta,2);
            $stmp->bindParam(':clave',$passw,1);
            //Ejecuto el Query SQL
            $stmp->execute();
            if(($u = $stmp->fetch(PDO::FETCH_OBJ))){
                $user = new Login($u->id,$u->nom,$u->tid);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $user; 
    }
    
    
    public function loginWeb($cuenta, $passw) {
        $user = null;
        try {
             $sql = "SELECT u.wusId id,u.nombre nom, u.cliId cliId 
                 FROM web_usuario u
                 WHERE u.nombre = :nom AND u.clave =:clave AND u.estado = 1 ";
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);
            $stmp->bindParam(':nom',$cuenta,2);
             $stmp->bindParam(':clave',$passw,1);
            //Ejecuto el Query SQL
            $stmp->execute();
            if(($u = $stmp->fetch(PDO::FETCH_OBJ))){
                $user = new Web_usuario($u->id,$u->nom,"","","",true,$u->proId);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $user; 
    }
//put your code here
}
