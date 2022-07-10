<?php

class VentaDao implements IVenta{
    
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT v.`venId`,v.numero vnumero,v.num_orden vnumorden,v.fecha vfecha,v.tipo vtipo,"
                    . "v.contado vcontacto,v.entregado ventregado,v.subtotal vsubtotal,v.descuento vdescuento,"
                    . "v.impuesto vimpuesto,v.total vtotal,v.vendedor vvendedor ,v.cliId vcliId "
                    . "FROM venta v WHERE v.venId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            if(($rs = $stmt->fetch(PDO::FETCH_OBJ))){
                $venta = new Venta($rs->venId,$rs->vnumero,$rs->vnumorden,"",$rs->vtipo,$rs->vcontacto,$rs->ventregado,$rs->vsubtotal,$rs->vdescuento,$rs->vimpuesto,$rs->vtotal,0,$rs->vvendedor,$rs->vcliId,$rs->vfecha);
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $venta;
    }
    
    public function buscarCliente($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "select cli.cliId as 'clicliId',cli.codigo as 'clicodigo',cli.img as 'cliimg',cli.cedula as 'clicedula',cli.big as 'clibig',cli.nombre as 'clinombre',cli.apellido as 'cliapellido',cli.genero as 'cligenero',cli.telefono as 'clitelefono',cli.email as 'cliemail',cli.direccion as 'clidireccion',cli.fecharegistro as 'clifecharegistro',cli.estado as 'cliestado', c.ciuId as 'cciuId', c.prvId as 'cprvId', c.nombre as 'cnombre', c.estado as 'cestado' from cliente cli,ciudad c where cli.cliId = '".$id."' and cli.ciuId = c.ciuId";
            $stmt = $cn->prepare($query);
            $stmt->execute();

            if (($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $cliente = new Cliente($rs->clicliId,$rs->clicodigo,$rs->cliimg,$rs->clicedula,$rs->clibig,$rs->clinombre,$rs->cliapellido,$rs->cligenero,$rs->clitelefono,$rs->cliemail,$rs->clidireccion,$rs->clifecharegistro,$rs->cliestado,$rs->cciuId,$rs->cprvId);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $cliente;
    }
    public function buscarDetalles($id){
        try {
            $detalles = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = 'SELECT * FROM venta_detalle WHERE venId = '.$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();

            while(($rs = $stmt->fetch(PDO::FETCH_OBJ))) {
                $detalles->append(new Venta_detalle($rs->detId,$rs->venId,$rs->articulo,$rs->cantidad,$rs->precio,$rs->totalitem,$rs->estado,$rs->artId));
            }
            return $detalles;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(venId) FROM venta";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Venta $venta) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into venta (numero,num_orden,cliente,fecha,tipo,contado,entregado,subtotal,descuento,impuesto,total,usuId,vendedor,cliId) values ("'.$venta->numero.'","'.$venta->num_orden.'","'.$venta->cliente.'","'.$venta->fecha.'","'.$venta->tipo.'","'.$venta->contado.'","'.$venta->entregado.'","'.$venta->subtotal.'","'.$venta->descuento.'","'.$venta->impuesto.'","'.$venta->total.'","'.$venta->usuId.'","'.$venta->vendedor.'","'.$venta->cliId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0? [true,$cn->lastInsertId()]:[false];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function editar(\Venta $venta) {
        
    }

    public function eliminar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = "delete from venta where venId = ".$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $result = $stmt->rowCount() > 0? true:false;
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
        return false;
    }

    public function listar() {
        try {
            $ventas = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "SELECT v.`venId`,v.numero vnumero,v.num_orden vnumorden,v.fecha vfecha,v.tipo vtipo,"
                    . "v.contado vcontacto,v.entregado ventregado,v.subtotal vsubtotal,v.descuento vdescuento,"
                    . "v.impuesto vimpuesto,v.total vtotal,v.vendedor vvendedor ,c.CliId cliId ,c.nombre cnombre "
                    . "FROM venta v INNER JOIN cliente c ON v.`cliId` = c.`cliId`";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $ventas->append( new Venta($rs->venId,$rs->vnumero,$rs->vnumorden,$rs->cnombre,$rs->vfecha,$rs->vtipo,$rs->vcontacto,$rs->ventregado,$rs->vsubtotal,$rs->vdescuento,$rs->vimpuesto,$rs->vtotal,0,$rs->vvendedor,new Cliente($rs->cliId,0,'',0,false,$rs->cnombre)));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $ventas;
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

    public function crearDetalle(\Venta_detalle $ventaDetalle) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into venta_detalle (venId,articulo,cantidad,precio,totalitem,estado,artId) values ("' . $ventaDetalle->venId . '","' . $ventaDetalle->articulo . '","' . $ventaDetalle->cantidad . '","' .$ventaDetalle->precio. '","' . $ventaDetalle->totalitem . '","' . $ventaDetalle->estado . '","' . $ventaDetalle->artId. '")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return false;
    }

    public function listarComboVenta($fechaInicio,$fechaFin) {
        try {
            $ventas = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = 'SELECT v.`venId`,v.cliente vcliente, v.numero vnumero,v.num_orden vnumorden,v.fecha vfecha,v.tipo vtipo,'
                    . 'v.contado vcontado,v.entregado ventregado,v.subtotal vsubtotal,v.descuento vdescuento,'
                    . 'v.impuesto vimpuesto,v.total vtotal,v.vendedor vvendedor '
                    . ' FROM venta v where v.fecha between  "'.$fechaInicio.'" and "'.$fechaFin.'" ';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $ventas->append(new Venta($rs->venId,$rs->vnumero,$rs->vnumorden,$rs->vcliente,$rs->vtipo,$rs->vcontado,$rs->ventregado,$rs->vsubtotal,$rs->vdescuento,$rs->vimpuesto,$rs->vtotal,0,$rs->vvendedor,0,$rs->vfecha));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $ventas;
    }
    
    public function listarTopVenta($fechaInicio,$fechaFin,$limit,$ordenMax) {
        try {
            $ventas = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = 'SELECT v.venId venIdaux ,v.cliente nombreaux,c.apellido apellidoaux,MAX(v.total) totalaux,count(c.cliId) cliIdaux FROM venta v '
                    .' INNER JOIN cliente c '
                    .' ON v.cliId = c.cliId '
                    .' where fecha between "'.$fechaInicio.'" and "'.$fechaFin.'" '
                    .' group by c.nombre '
                    .' order by '.($ordenMax=='true'?'cliIdaux':'totalaux')
                    .' desc '
                    .' limit '.$limit;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $ventas->append(new Top($rs->venIdaux,$rs->nombreaux,$rs->apellidoaux,$rs->totalaux,$rs->cliIdaux));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $ventas;
    }

}
