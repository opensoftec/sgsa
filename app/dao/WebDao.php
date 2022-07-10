<?php

class WebDao implements IWebUsuario{
    
    public function buscar($id) {
        echo $id;
    }

    public function crear(\Web_usuario $webusuario) {
        echo $webusuario;
    }

    public function editar(\Web_usuario $webusuario) {
        echo $webusuario;
    }

    public function eliminar(\Web_usuario $webusuario) {
        echo $webusuario;
    }

    public function listar() {
        echo null;
    }

    public function login($cuenta, $passw) {
        $user = null;
        try {
            $sql = "SELECT u.wusId id,u.nombre nom,cli.cliId cliId,cli.nombre client 
                 FROM web_usuario u INNER JOIN cliente cli
                 ON u.cliId = cli.cliId
                 WHERE u.nombre = :nom AND u.clave =:clave AND u.estado = 'A'";
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);
            $stmp->bindParam(':nom', $cuenta, 5);
            $stmp->bindParam(':clave', $passw, 5);
            //Ejecuto el Query SQL
            $stmp->execute();
            if (($u = $stmp->fetch(PDO::FETCH_OBJ))) {
                $user = new Web_usuario($u->id,$u->nom,new Cliente($u->proId,'','','','',$u->client));
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $user;
    }

    public function codigoMaximo() {
        
    }

    public function listarComboCliente() {
        
    }

}
