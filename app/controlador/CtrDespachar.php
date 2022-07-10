
<?php

class CtrDespachar {

    private $model;
    private $dao;
    private $daoVenta;
    private $array;

    public function __construct() {
        require '../config/config.php';
        require '../data/DataConection.php';
        require_once '../modelo/DetalleOrden.php';
        require_once '../modelo/Pedido.php';
        require '../dao/OrdenPedidoDao.php';
        require '../modelo/Web_usuario.php';
        
        
        require '../modelo/Cliente.php';
        require '../modelo/Venta_detalle.php';
        require '../modelo/Venta.php';
        require '../interfaz/IVenta.php';
        require '../dao/VentaDao.php';
        
        $this->model = new Pedido();
        $this->array = new ArrayObject();
        $this->dao = new OrdenPedidoDao();
        $this->daoVenta = new VentaDao();
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':

                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
                        break;
                    case 'despachar':
                       
                        $this->model = $this->dao->buscar($_POST['id']);
                        if($this->model->estado == "1" ? false:true){
                            echo '{"resp" : false,"error" : "La Orden esta despachada"}';
                            die();
                        }
                        $fila = $this->daoVenta->crear(new Venta(0,0,$this->model->ordId,$this->model->cliente,$this->model->tipo,true,'s',$this->model->subtotal,$this->model->descuento,$this->model->impuesto,$this->model->total,0,0,$this->model->cliId,$this->model->fecha));
                        
                        //echo json_encode($this->model);
                        //break;
                        if($fila[0]){
                            $this->array = $this->dao->buscarDetalles($_POST['id']);
                            foreach ($this->array as $det){
                                $this->daoVenta->crearDetalle(new Venta_detalle(0,$fila[1],$det->articulo,$det->cantidad,$det->precio,$det->totalitem,$det->estado,$det->artId));
                            }
                            $this->dao->actulizarEstado($_POST['id']);
                        }else{
                            echo '{"resp" : false,"error" : "No se a podido despachar y no se ha generado la Venta"}';
                            break;
                        }
                        echo '{"resp" : true,"error" : "Se a despachado y se ha generado la venta del pedido"}';
                        break;
                    case 'eliminar':
                        $this->model = $this->dao->buscar($_POST['id']);
                        if($this->model->estado == "1" ? false:true){
                            echo '{"resp" : false,"error" : "La Orden esta Eliminada"}';
                            die();
                        }
                        $this->dao->actulizarEstado($_POST['id']);
                        echo '{"resp" : true,"error" : "Se a eliminado corractamente el pedido"}';
                        break;
                    default :
                        echo '{"resp" : false}';
                        break;
                }
            }
        } else {

            //acciones por GET
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                if ($action == 'ver') {
                    $id = intval($_GET['id']);
                    $this->model = $this->dao->buscar($id);
                    $this->array = $this->dao->buscarDetalles($id);
                    require '../vista/despachar.php';
                } else if ($action == 'tabla') {
                    require '../vista/vDespacharTabla.php';
                }
            }
        }
    }

}
