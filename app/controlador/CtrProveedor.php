<?php
class CtrProveedor {

    private $model;
    private $dao;

    public function __construct() {
        require '../config/config.php';
        require '../modelo/Proveedor_contacto.php';
        require '../modelo/Proveedor.php';
        require '../interfaz/IProveedor.php';
        require '../data/DataConection.php';
        require '../dao/ProveedorDao.php';
        $this->model = new Proveedor;
        $this->dao = new ProveedorDao;
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':
                        $post = (object) $_POST;
                        $this->model->proId = $post->proId;
                        $this->model->codigo = $post->codigo;
                        $this->model->ruc = $post->ruc;
                        $this->model->nombre = $post->nombre;
                        $this->model->descripcion = $post->descripcion;
                        $this->model->telefono = $post->telefono;
                        $this->model->email = $post->email;
                        $this->model->direccion = $post->direccion;
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->estado = isset($post->estado);
                        $this->model->pcoId = $post->selectProveedorContacto;
                        if ($this->dao->crear($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
                        break;
                    case 'editar':
                        
                        $post = (object) $_POST;
                        $this->model->proId = $post->proId;
                        $this->model->codigo = $post->codigo;
                        $this->model->ruc = $post->ruc;
                        $this->model->nombre = $post->nombre;
                        $this->model->descripcion = $post->descripcion;
                        $this->model->telefono = $post->telefono;
                        $this->model->email = $post->email;
                        $this->model->direccion = $post->direccion;
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->estado = isset($post->estado);
                        $this->model->pcoId = $post->selectProveedorContacto;
                        if ($this->dao->editar($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se Edito"}';
                        break;
                    case 'eliminar':

                        if ($this->dao->eliminar($_POST['id'])) {
                            echo '{"resp" : true}';
                            exit();
                        } else {
                            echo '{"resp" : false,"error" : "El registro no se a podido Eliminar"}';
                            exit();
                        }
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
                $id = 0;
                if ($action == 'editar') {
                    $id = intval($_GET['id']);
                    $this->model = $this->dao->buscar((string)$id);
                    require '../vista/proveedor.php';
                } else if ($action == 'nuevo') {
                    $this->model = new Proveedor();
                    require '../vista/proveedor.php';
                } else if ($action == 'tabla') {
                    require '../vista/vProveedorTabla.php';
                }
            }
        }
    }

}
