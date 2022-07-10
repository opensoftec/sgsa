<?php

class ClienteDao implements ICliente {
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select cli.cliId as 'clicliId',cli.codigo as 'clicodigo',cli.img as 'cliimg',cli.cedula as 'clicedula',cli.big as 'clibig',cli.nombre as 'clinombre',cli.apellido as 'cliapellido',cli.genero as 'cligenero',cli.telefono as 'clitelefono',cli.email as 'cliemail',cli.direccion as 'clidireccion',cli.fecharegistro as 'clifecharegistro',cli.estado as 'cliestado', c.ciuId as 'cciuId', c.prvId as 'cprvId', c.nombre as 'cnombre', c.estado as 'cestado' from cliente cli,ciudad c where cli.cliId = '".$id."' and cli.ciuId = c.ciuId";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $cliente = new Cliente($rs->clicliId,$rs->clicodigo,$rs->cliimg,$rs->clicedula,$rs->clibig,$rs->clinombre,$rs->cliapellido,$rs->cligenero,$rs->clitelefono,$rs->cliemail,$rs->clidireccion,$rs->clifecharegistro,$rs->cliestado,$rs->cciuId,$rs->cprvId);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $cliente;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(cliId) FROM cliente";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Cliente $cliente) {
         try {
            $cn = DataConection::getInstancia();
            $query = 'insert into cliente (codigo,img,cedula,big,nombre,apellido,genero,telefono,email,direccion,fecharegistro,estado,ciuId,prvId) values ("'.$cliente->codigo.'","'.$cliente->img.'","'.$cliente->cedula.'","'.$cliente->big.'","'.$cliente->nombre.'","'.$cliente->apellido.'","'.$cliente->genero.'","'.$cliente->telefono.'","'.$cliente->email.'","'.$cliente->direccion.'","'.$cliente->fecharegistro.'","'.$cliente->estado.'","'.$cliente->ciuId.'","'.$cliente->prvId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function add(\Cliente $cliente) {
         try {
            $cn = DataConection::getInstancia();
            $query = 'insert into cliente (nombre,apellido,cedula,ciuId,prvId,estado) values ("'.$cliente->nombre.'","'.$cliente->apellido.'","'.$cliente->cedula.'","'.$cliente->ciuId.'","'.$cliente->prvId.'","'.$cliente->estado.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0? [true,$cn->lastInsertId()]:[false];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Cliente $cliente) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'update cliente set codigo="'.$cliente->codigo.'",cedula="'.$cliente->cedula.'",big="'.$cliente->big.'",nombre="'.$cliente->nombre.'",apellido="'.$cliente->apellido.'",genero="'.$cliente->genero.'",telefono="'.$cliente->telefono.'",email="'.$cliente->email.'",direccion="'.$cliente->direccion.'",estado="'.$cliente->estado.'",ciuId="'.$cliente->ciuId.'",prvId="'.$cliente->prvId.'",img="'.$cliente->img.'" where cliId = '.$cliente->cliId;
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
            $query = "update cliente set estado=0  where cliId = ".$id;
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
            $clientes = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select cli.cliId as 'clicliId',cli.codigo as 'clicodigo',cli.img as 'cliimg',cli.cedula as 'clicedula',cli.big as 'clibig',cli.nombre as 'clinombre',cli.apellido as 'cliapellido',cli.genero as 'cligenero',cli.telefono as 'clitelefono',cli.email as 'cliemail',cli.direccion as 'clidireccion',cli.fecharegistro as 'clifecharegistro',cli.estado as 'cliestado', c.ciuId as 'cciuId', c.prvId as 'cprvId', c.nombre as 'cnombre', c.estado as 'cestado', p.prvId pprvId, p.nombre pnombre from cliente cli,ciudad c, provincia p where cli.ciuId = c.ciuId and cli.prvId = p.prvId and cli.estado = 1 order by cli.cliId asc";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $clientes->append(new Cliente($rs->clicliId,$rs->clicodigo,$rs->cliimg,$rs->clicedula,$rs->clibig,$rs->clinombre,$rs->cliapellido,$rs->cligenero,$rs->clitelefono,$rs->cliemail,$rs->clidireccion,$rs->clifecharegistro,$rs->cliestado,new Ciudad($rs->cciuId,null, $rs->cnombre,$rs->cestado),new Provincia($rs->pprvId,$rs->pnombre)));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $clientes;
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
    
    public function listarComboCiudad1() {
        try {
            $cuidades = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select c.ciuId as 'cciuId', c.prvId as 'pprvId', c.nombre as 'cnombre', c.estado as 'cestado' from ciudad c";
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
