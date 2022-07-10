<?php

class ProvinciaDao implements IProvincia {

    public function buscar($id) {
        $provincia = null;
        try {
            //sentencia SQL
            $sql = 'select prvId id,nombre nom,estado estd from provincia '
                    . 'Where prvId =:prvId;';
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);
            $stmp->bindParam(':prvId',$id,2);
            //Ejecuto el Query SQL
            $stmp->execute();

            if( ($p = $stmp->fetch(PDO::FETCH_OBJ)) ) {
               $provincia = new Provincia($p->id, $p->nom, $p->estd);
            }
            
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $provincia;
    }

    public function crear(\Provincia $provincia) {
        try {
            $sql = 'INSERT INTO provincia(nombre,estado)VALUE(:nombre,:estado);';
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);                  
            $stmp->bindParam(':nombre',$provincia->nombre,2);
            $stmp->bindParam(':estado',$provincia->estado,5);            
            $stmp->execute();
            
            return $stmp->rowCount()> 0 ? true: false;         
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function editar(\Provincia $provincia) {
        try {
            $sql = 'UPDATE provincia SET nombre =:nombre,estado =:estado '
                    . 'WHERE prvId = :prvId;';
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);                  
            $stmp->bindParam(':nombre',$provincia->nombre,2);
            $stmp->bindParam(':estado',$provincia->estado,5);  
            $stmp->bindParam(':prvId',$provincia->id,1);
            $stmp->execute();
            
            return $stmp->rowCount()> 0 ? true: false;         
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function listar() {
        $provincias = new ArrayObject;
        try {
            //sentencia SQL
            $sql = 'select prvId id,nombre nom,estado estd from provincia where estado=1;';
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);
            //Ejecuto el Query SQL
            $stmp->execute();

            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $p) {
                $provincias->append(new Provincia($p->id, $p->nom, $p->estd));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $provincias;
    }
    
    public function eliminar($id) {
        try {
            $sql = 'UPDATE provincia SET estado = 0 '
                    . 'WHERE prvId = :prvId;';
            //Abro la conexion a la BD
            $con = DataConection::getInstancia();
            //prepar el Query SQL
            $stmp = $con->prepare($sql);    
            $stmp->bindParam(':prvId',$id,1);
            $stmp->execute();
            
            return $stmp->rowCount()> 0 ? true: false;         
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

}
