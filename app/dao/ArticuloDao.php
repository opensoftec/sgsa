<?php

class ArticuloDao implements IArticulo{
    
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query1 = "select a.artId as aartId,a.codigo as acodigo,a.nombre as anombre,a.descripcion as adescripcion,a.img as aimg,a.ubicacion as aubicacion,a.fecha_alta as afecha_alta,a.presentacion as apresentacion,a.marca as amarca,a.modelo as amodelo,a.stock_minimo as astock_minimo,a.stock as astock,a.precio as aprecio,a.costo as acosto,a.pvp as apvp,a.iva as aiva,a.fecharegistro as afecharegistro,a.observacion as aobservacion,a.activo as aactivo,a.proId as aproId,a.ctgId as actgId,";
            $query2 = "p.proId as pproId ,p.codigo as pcodigo,p.ruc as pruc,p.nombre as pnombre,p.descripcion as pdescripcion,p.telefono as ptelefono,p.email as pemail,p.direccion as pdireccion,p.fecharegistro as pfecharegistro,p.estado as pestado,pc.pcoId as pcpcoId,pc.nombre as pcnombre,pc.principal as pcprincipal,pc.telefono as pctelefono,pc.email as pcemail,pc.direccion as pcdireccion,pc.estado as pcestado,ct.ctgId as ctctgId, ct.nombre as ctnombre, ct.estado as ctestado ";
            $query3 = " from articulo a, proveedor p, proveedor_contacto pc, categoria_articulo ct where a.artId = '".$id."'and a.proId = p.proId and p.pcoId = pc.pcoId and a.ctgId = ct.ctgId ";
            
            $stmt = $cn->prepare($query1.$query2.$query3);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $articulo = new Articulo($rs->aartId,$rs->acodigo,$rs->anombre,$rs->adescripcion,$rs->aimg,$rs->aubicacion,$rs->afecha_alta,$rs->apresentacion,$rs->amarca,$rs->amodelo,$rs->astock_minimo,$rs->astock,$rs->aprecio,$rs->acosto,$rs->apvp,$rs->aiva,$rs->afecharegistro,$rs->aobservacion,$rs->aactivo,$rs->pproId,$rs->ctctgId);
                break;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $articulo;
    }

    public function codigoMaximo() {
        try {
            $cn = DataConection::getInstancia();
            $query = "SELECT Max(artId) FROM articulo";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $codigoMaximo = $stmt->fetch(PDO::FETCH_COLUMN) + 1;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $codigoMaximo;
    }

    public function crear(\Articulo $articulo) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into articulo (codigo,nombre,descripcion,img,ubicacion,fecha_alta,presentacion,marca,modelo,stock_minimo,stock,precio,costo,pvp,iva,fecharegistro,observacion,activo,proId,ctgId) values ("'.$articulo->codigo.'","'.$articulo->nombre.'","'.$articulo->descripcion.'","'.$articulo->img.'","'.$articulo->ubicacion.'","'.$articulo->fecha_alta.'","'.$articulo->presentacion.'","'.$articulo->marca.'","'.$articulo->modelo.'","'.$articulo->stock_minimo.'","'.$articulo->stock.'","'.$articulo->precio.'","'.$articulo->costo.'","'.$articulo->pvp.'","'.$articulo->iva.'","'.$articulo->fecharegistro.'","'.$articulo->observacion.'","'.$articulo->activo.'","'.$articulo->proId.'","'.$articulo->ctgId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function editar(\Articulo $articulo) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'update articulo set codigo="'.$articulo->codigo.'",  nombre = "'.$articulo->nombre.'", descripcion = "'.$articulo->descripcion.'",img="'.$articulo->img.'",ubicacion="'.$articulo->ubicacion.'",fecha_alta="'.$articulo->fecha_alta.'",presentacion="'.$articulo->presentacion.'",marca="'.$articulo->marca.'",modelo="'.$articulo->modelo.'",stock_minimo="'.$articulo->stock_minimo.'",stock="'.$articulo->stock.'",precio="'.$articulo->precio.'",costo="'.$articulo->costo.'",pvp="'.$articulo->pvp.'",iva="'.$articulo->iva.'",fecharegistro="'.$articulo->fecharegistro.'",observacion="'.$articulo->observacion.'",activo="'.$articulo->activo.'",proId="'.$articulo->proId.'",ctgId="'.$articulo->ctgId.'" where artId = '.$articulo->artId;
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
            $query = "update articulo set activo = 0 where artId = ".$id;
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

    public function listarComboCategoriaArticulo() {
        try {
            $categoriasArticulo = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select * from categoria_articulo";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $categoriasArticulo->append(new Categoria_articulo($rs->ctgId, $rs->nombre, $rs->estado));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $categoriasArticulo;
    }

    public function listarComboProveedor() {
        try {
            $proveedores = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select p.proId as pproId ,p.codigo as pcodigo,p.ruc as pruc,p.nombre as pnombre,p.descripcion as pdescripcion,p.telefono as ptelefono,p.email as pemail,p.direccion as pdireccion,p.fecharegistro as pfecharegistro,p.estado as pestado,pc.pcoId as pcpcoId,pc.nombre as pcnombre,pc.principal as pcprincipal,pc.telefono as pctelefono,pc.email as pcemail,pc.direccion as pcdireccion,pc.estado as pcestado from proveedor p, proveedor_contacto pc where p.pcoId = pc.pcoId";
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

//put your code here
}
