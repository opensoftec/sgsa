<?php

class OrdenPedidoDao{
    public function buscar($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'SELECT * FROM orden_pedido where ordId = '.$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $orden = new Pedido($rs->ordId,$rs->numero,$rs->fecha,$rs->tipo,$rs->proveedor,$rs->subtotal,$rs->descuento,$rs->impuesto,$rs->total,$rs->estado,$rs->proId);
                break;
            }
            return $orden;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function actulizarEstado($id) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'update orden_pedido set estado = 0 where ordId = '.$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            $query = 'update orden_pedido_detalle set estado = 0 where ordId = '.$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function buscarDetalles($id) {
        try {
            $detalles = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = 'SELECT * FROM orden_pedido_detalle where ordId = '.$id;
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $detalles->append(new Detalle1($rs->detId,$rs->ordId,$rs->articulo,$rs->cantidad,$rs->precio,$rs->totalitem,$rs->estado,$rs->artId));
            }
            return $detalles;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function listar() {
        try {
            $ordenes = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = 'SELECT * FROM orden_pedido;';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $ordenes->append(new Pedido($rs->ordId,$rs->numero,$rs->fecha,$rs->tipo,$rs->proveedor,$rs->subtotal,$rs->descuento,$rs->impuesto,$rs->total,$rs->estado,$rs->proId));
            }
            return $ordenes;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function add($pedido) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into orden_pedido (numero,fecha,tipo,cliente,subtotal,descuento,impuesto,total,estado,cliId) values ("'.$pedido->numero.'","'.$pedido->fecha.'","'.$pedido->tipo.'","'.$pedido->proveedor.'","'.$pedido->subtotal.'","'.$pedido->descuento.'","'.$pedido->impuesto.'","'.$pedido->total.'","'.$pedido->estado.'","'.$pedido->proId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount()>0? [true,$cn->lastInsertId()]:[false];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function crearDetalle($ordenPedido) {
        try {
            $cn = DataConection::getInstancia();
            $query = 'insert into orden_pedido_detalle (ordId,articulo,cantidad,precio,totalItem,estado,artId) values ("'.$ordenPedido->ordId.'","'.$ordenPedido->articulo.'","'.$ordenPedido->cantidad.'","'.$ordenPedido->precio.'","'.$ordenPedido->totalitem.'","'.$ordenPedido->estado.'","'.$ordenPedido->artId.'")';
            $stmt = $cn->prepare($query);
            $stmt->execute();
             return $stmt->rowCount()>0? true:false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function defecto() {
        return true;
    }
//put your code here
}
