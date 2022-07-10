<?php

class CtrProveedorContacto {

    private $model;
    private $dao;

    public function __construct() {
        require '../config/config.php';
        require '../modelo/Proveedor_contacto.php';
        require '../interfaz/IProveedorContacto.php';
        require '../data/DataConection.php';
        require '../dao/ProveedorContactoDao.php';
        $this->model = new Proveedor_contacto;
        $this->dao = new ProveedorContactoDao;
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':
                        $post = (object) $_POST;
                        $this->model->pcoId = $post->pcoId;
                        $this->model->nombre = $post->nombre;
                        $this->model->principal = isset($post->principal);
                        $this->model->telefono = $post->telefono;
                        $this->model->email = $post->email;
                        $this->model->direccion = $post->direccion;
                        $this->model->estado = isset($post->estado);
                        if ($this->dao->crear($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
                        break;
                    case 'editar':
                        $post = (object) $_POST;
                        $this->model->pcoId = $post->pcoId;
                        $this->model->nombre = $post->nombre;
                        $this->model->principal = isset($post->principal);
                        $this->model->telefono = $post->telefono;
                        $this->model->email = $post->email;
                        $this->model->direccion = $post->direccion;
                        $this->model->estado = isset($post->estado);
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
                    $this->model = $this->dao->buscar((string) $id);
                    require '../vista/proveedorContacto.php';
                } else if ($action == 'nuevo') {
                    $this->model = new Proveedor_contacto();
                    require '../vista/proveedorContacto.php';
                } else if ($action == 'tabla') {
                    require '../vista/vProveedorContactoTabla.php';
                }
            }
        }
    }

}
