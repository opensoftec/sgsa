<?php

class CompraDao implements ICompra{
     
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'SELECT * FROM compra WHERE compId = '.$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            if(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $compra = new Compra($rs->compId,$rs->proveedor,$rs->contado,$rs->subtotal,$rs->descuento,$rs->impuesto,$rs->total,$rs->usuId,$rs->proId,$rs->fecha);
            }
            return $compra;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function buscarProveedor($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select p.proId as pproId ,p.codigo as pcodigo,p.ruc as pruc,p.nombre as pnombre,p.descripcion as pdescripcion,p.telefono as ptelefono,p.email as pemail,p.direccion as pdireccion,p.fecharegistro as pfecharegistro,p.estado as pestado,pc.pcoId as pcpcoId from proveedor p, proveedor_contacto pc where p.proId= '".$id."' and p.estado=1 and p.pcoId = pc.pcoId";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            if (($rs = $stmt->fetch(PDO::FETCH_OBJ))){
                $proveedor = new Proveedor($rs->pproId, $rs->pcodigo,$rs->pruc,$rs->pnombre,$rs->pdescripcion,$rs->ptelefono,$rs->pemail,$rs->pdireccion,$rs->pfecharegistro,$rs->pestado,$rs->pcpcoId);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $proveedor;
    }
    
    public function buscarDetalles($id){
        try {
            $detalles = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = 'SELECT * FROM compra_detalle WHERE estado=1 and compId = '.$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $detalles->append(new Compra_detalle($rs->detId,$rs->compId,$rs->articulo,$rs->cantidad,$rs->precio,$rs->subtotalitem,$rs->descuento,$rs->descuentolibras,$rs->totalitem,$rs->estado,$rs->artId,$rs->observacion));
            }
            return $detalles;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(compId) FROM compra";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Compra $compra) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into compra (proveedor,fecha,contado,subtotal,descuento,impuesto,total,usuId,proId) values ("'.$compra->proveedor.'","'.$compra->fecha.'","'.$compra->contado.'","'.$compra->subtotal.'","'.$compra->descuento.'","'.$compra->impuesto.'","'.$compra->total.'","'.$compra->usuId.'","'.$compra->proId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0? [true,$cn->lastInsertId()]:[false];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Compra $compra) {
        
    }

    public function eliminar($id) {
        try {
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
        return false;
    }

    public function listar() {
        try {
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function listarComboArticulo() {
        try {
            $articulos = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query1 = "select a.artId as aartId,a.codigo as acodigo,a.nombre as anombre,a.descripcion as adescripcion,a.img as aimg,a.ubicacion as aubicacion,a.fecha_alta as afecha_alta,a.presentacion as apresentacion,a.marca as amarca,a.modelo as amodelo,a.stock_minimo as astock_minimo,a.stock as astock,a.precio as aprecio,a.costo as acosto,a.pvp as apvp,a.iva as aiva,a.fecharegistro as afecharegistro,a.observacion as aobservacion,a.activo as aactivo,a.proId as aproId,a.ctgId as actgId,";
            $query2 = "p.proId as pproId ,p.codigo as pcodigo,p.ruc as pruc,p.nombre as pnombre,p.descripcion as pdescripcion,p.telefono as ptelefono,p.email as pemail,p.direccion as pdireccion,p.fecharegistro as pfecharegistro,p.estado as pestado,pc.pcoId as pcpcoId,pc.nombre as pcnombre,pc.principal as pcprincipal,pc.telefono as pctelefono,pc.email as pcemail,pc.direccion as pcdireccion,pc.estado as pcestado,ct.ctgId as ctctgId, ct.nombre as ctnombre, ct.estado as ctestado ";
            $query3 = "from articulo a, proveedor p, proveedor_contacto pc, categoria_articulo ct where a.proId = p.proId and p.pcoId = pc.pcoId and a.ctgId = ct.ctgId order by a.artId asc";
            
            $stmt = $cn->prepare($query1.$query2.$query3);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $articulos->append(new Articulo($rs->aartId,$rs->acodigo,$rs->anombre,$rs->adescripcion,$rs->aimg,$rs->aubicacion,$rs->afecha_alta,$rs->apresentacion,$rs->amarca,$rs->amodelo,$rs->astock_minimo,$rs->astock,$rs->aprecio,$rs->acosto,$rs->apvp,$rs->aiva,$rs->afecharegistro,$rs->aobservacion,$rs->aactivo,new Proveedor($rs->pproId, $rs->pcodigo,$rs->pruc,$rs->pnombre,$rs->pdescripcion,$rs->ptelefono,$rs->pemail,$rs->pdireccion,$rs->pfecharegistro,$rs->pestado,new Proveedor_contacto($rs->pcpcoId,$rs->pcnombre,$rs->pcprincipal,$rs->pctelefono,$rs->pcemail,$rs->pcdireccion,$rs->pcestado)),new Categoria_articulo($rs->ctctgId, $rs->ctnombre, $rs->ctestado)));
                //echo new Articulo($rs->aartId,$rs->acodigo,$rs->anombre,$rs->adescripcion,$rs->aimg,$rs->aubicacion,$rs->afecha_alta,$rs->apresentacion,$rs->amarca,$rs->amodelo,$rs->astock_minimo,$rs->astock,$rs->aprecio,$rs->acosto,$rs->apvp,$rs->aiva,$rs->afecharegistro,$rs->aobservacion,$rs->aactivo,new Proveedor($rs->pproId, $rs->pcodigo,$rs->pruc,$rs->pnombre,$rs->pdescripcion,$rs->ptelefono,4,4,date('Y-m-d'),true,new Proveedor_contacto($rs->pcpcoId,$rs->pcnombre,$rs->pcprincipal,$rs->pctelefono,$rs->pcemail,$rs->pcdireccion,$rs->pcestado)),new Categoria_articulo($rs->ctctgId, $rs->ctnombre, $rs->ctestado));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $articulos;
    }

    public function listarComboProveedor() {
        try {
            $clientes = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select * from proveedor";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $clientes->append(new Proveedor($rs->proId,$rs->codigo,$rs->ruc,$rs->nombre,$rs->descripcion,$rs->telefono,$rs->email,$rs->direccion,$rs->fecharegistro,$rs->estado,$rs->pcoId));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $clientes;
    }
    
    public function crearDetalle(\Compra_detalle $compraDetalle) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into compra_detalle (compId,articulo,cantidad,precio,subtotalitem,descuento,descuentolibras,totalitem,estado,artId,observacion) values ("' . $compraDetalle->compId . '","' . $compraDetalle->articulo . '","' . $compraDetalle->cantidad . '","' .$compraDetalle->precio. '","' .$compraDetalle->subtotalitem. '","' .$compraDetalle->descuento. '","' .$compraDetalle->descuentolibras. '","' . $compraDetalle->totalitem . '","' . $compraDetalle->estado . '","' . $compraDetalle->artId. '","' . $compraDetalle->observacion. '")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function listarComboCompra($fechaInicio,$fechaFin) {
        try {
            $ventas = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = 'SELECT * '
                    .' FROM compra where fecha between  "'.$fechaInicio.'" and "'.$fechaFin.'" ';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $ventas->append(new Compra($rs->compId,$rs->proveedor,$rs->contado,$rs->subtotal,$rs->descuento,$rs->impuesto,$rs->total,$rs->fecha));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $ventas;
    }
    
    public function listarTopCompra($fechaInicio,$fechaFin,$limit,$ordenMax) {
        try {
            $ventas = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = 'SELECT c.compId compIdaux,c.proveedor nombreaux,MAX(c.total) totalaux,count(p.proId) proIdaux FROM compra c '
                    .' INNER JOIN proveedor p '
                    .' ON c.proId = p.proId '
                    .' where fecha between "'.$fechaInicio.'" and "'.$fechaFin.'" '
                    .' group by p.nombre '
                    .' order by '.($ordenMax=='true'?'proIdaux':'totalaux')
                    .' desc '
                    .' limit '.$limit;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $ventas->append(new Top($rs->compIdaux,$rs->nombreaux,'',$rs->totalaux,$rs->proIdaux));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $ventas;
    }

}
