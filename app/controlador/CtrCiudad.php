<?php
class CtrCiudad {

    private $model;
    private $dao;

    public function __construct() {
        require '../config/config.php';
        require '../modelo/Ciudad.php';
        require '../modelo/Provincia.php';
        require '../interfaz/ICiudad.php';
        require '../data/DataConection.php';
        require '../dao/CiudadDao.php';
        $this->model = new Ciudad;
        $this->dao = new CiudadDao;
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':
                        $post = (object) $_POST;
                        
                        $this->model->prvId = (integer)$post->selectProvincia;
                        $this->model->nombre = $post->nombre;
                        $this->model->estado = isset($post->estado);
                        
                        if ($this->dao->crear($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
                        break;
                    case 'editar':
                        $post = (object) $_POST;
                        $this->model->ciuId = $post->codigo;
                        $this->model->prvId = $post->selectProvincia;
                        $this->model->nombre = $post->nombre;
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
                    require '../vista/ciudad.php';
                } else if ($action == 'nuevo') {
                    $this->model = new Ciudad();
                    require '../vista/ciudad.php';
                } else if ($action == 'tabla') {
                    require '../vista/vCiudadTabla.php';
                }
            }
        }
    }

}
