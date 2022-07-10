<?php

class PersonalDao implements IPersonal{
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select per.prvId perprvId,per.perId as 'perperId',per.codigo as 'percodigo',per.img as 'perimg',per.cedula as 'percedula',per.nombre as 'pernombre',per.apellido as 'perapellido',per.genero as 'pergenero',per.telefono as 'pertelefono',per.email as 'peremail',per.direccion as 'perdireccion',per.fecharegistro as 'perfecharegistro',per.estado as 'perestado',ctg.ctgId as 'ctgctgId',ctg.nombre as 'ctgnombre',ctg.estado as 'ctgestado', c.ciuId as 'cciuId', c.prvId as 'cprvId', c.nombre as 'cnombre', c.estado as 'cestado' from personal per,categoria_personal ctg,ciudad c where per.perId= '".$id."' and per.ctgId = ctg.ctgId and per.ciuId = c.ciuId";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
               $personal = new Personal($rs->perperId,$rs->percodigo,$rs->perimg,$rs->percedula,$rs->pernombre,$rs->perapellido,$rs->pergenero,$rs->pertelefono,$rs->peremail,$rs->perdireccion,$rs->perfecharegistro,$rs->perestado,$rs->ctgctgId,$rs->cciuId,$rs->perprvId);
               break;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $personal;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(perId) FROM personal";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Personal $personal) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into personal (codigo,img,cedula,nombre,apellido,genero,telefono,email,direccion,fecharegistro,estado,ctgId,ciuId,prvId) values ("'.$personal->codigo.'","'.$personal->img.'","'.$personal->cedula.'","'.$personal->nombre.'","'.$personal->apellido.'","'.$personal->genero.'","'.$personal->telefono.'","'.$personal->email.'","'.$personal->direccion.'","'.$personal->fecharegistro.'","'.$personal->estado.'","'.$personal->ctgId.'","'.$personal->ciuId.'","'.$personal->prvId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Personal $personal) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'update personal set codigo="'.$personal->codigo.'", img="'.$personal->img.'", cedula="'.$personal->cedula.'",nombre="'.$personal->nombre.'",apellido="'.$personal->apellido.'",genero="'.$personal->genero.'",telefono="'.$personal->telefono.'",email="'.$personal->email.'",direccion="'.$personal->direccion.'",estado="'.$personal->estado.'",ctgId="'.$personal->ctgId.'",ciuId="'.$personal->ciuId.'",prvId="'.$personal->prvId.'"  where perId = '.$personal->perId;
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
            $query = "update personal set estado =0 where perId = ".$id;
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
            $personales = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select per.perId as 'perperId',per.codigo as 'percodigo',per.img as 'perimg',per.cedula as 'percedula',per.nombre as 'pernombre',per.apellido as 'perapellido',per.genero as 'pergenero',per.telefono as 'pertelefono',per.email as 'peremail',per.direccion as 'perdireccion',per.fecharegistro as 'perfecharegistro',per.estado as 'perestado',ctg.ctgId as 'ctgctgId',ctg.nombre as 'ctgnombre',ctg.estado as 'ctgestado', c.ciuId as 'cciuId', c.prvId as 'cprvId', c.nombre as 'cnombre', c.estado as 'cestado', p.prvId pprvId,p.nombre pnombre from personal per,categoria_personal ctg,ciudad c,provincia p where per.ctgId = ctg.ctgId and per.estado=1 and per.ciuId = c.ciuId and per.prvId = p.prvId order by perId asc";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $personales->append(new Personal($rs->perperId,$rs->percodigo,$rs->perimg,$rs->percedula,$rs->pernombre,$rs->perapellido,$rs->pergenero,$rs->pertelefono,$rs->peremail,$rs->perdireccion,$rs->perfecharegistro,$rs->perestado,new Categoria_personal($rs->ctgctgId, $rs->ctgnombre, $rs->ctgestado),new Ciudad($rs->cciuId,null, $rs->cnombre,$rs->cestado),new Provincia($rs->pprvId,$rs->pnombre)));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $personales;
    }

    public function listarComboCategoriaPersonal() {
        try {
            $categoriasPersonal = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select * from categoria_personal";
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

    public function listarComboCiudad($id) {
        try {
            $cuidades = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select c.ciuId as 'cciuId', c.prvId as 'pprvId', c.nombre as 'cnombre', c.estado as 'cestado' from ciudad c where  c.prvId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $cuidades->append(new Ciudad($rs->cciuId,$rs->pprvId, $rs->cnombre,$rs->cestado));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $cuidades;
    }

    public function listarComboProvincia() {
        $provincias = new ArrayObject;
        try {
            //sentencia SQL
            $sql = 'select prvId id,nombre nom,estado estd from provincia';
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

//put your code here
}
