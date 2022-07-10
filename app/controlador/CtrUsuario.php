
<?php

class CtrUsuario {

    private $model;
    private $dao;

    public function __construct() {
        require '../config/config.php';
        require '../data/DataConection.php';
        require '../modelo/Tipo_usuario.php';
        require '../modelo/Personal.php';
        require '../modelo/Usuario.php';
        require '../interfaz/IUsuario.php';
        require '../dao/UsuarioDao.php';
        $this->model = new Usuario();
        $this->dao = new UsuarioDao();
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':
                        $post = (object) $_POST;
                        $this->model->usuId = $post->usuId;
                        $this->model->nombre = $post->nombre;
                        $this->model->clave = $post->clave;
                        $this->model->ultimoingreso = $post->ultimoIngreso;
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->tpuId = $post->selectTipoUsaurio;
                        $this->model->perId = $post->selectPersonal;
                        $this->model->estado = isset($post->estado);
                        if ($this->dao->add($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
                        break;
                    case 'editar':

                        $post = (object) $_POST;
                        $this->model->usuId = $post->usuId;
                        $this->model->nombre = $post->nombre;
                        $this->model->clave = $post->clave;
                        $this->model->ultimoingreso = $post->ultimoIngreso;
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->tpuId = $post->selectTipoUsaurio;
                        $this->model->perId = $post->selectPersonal;
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
                    require '../vista/usuario.php';
                } else if ($action == 'nuevo') {
                    $this->model = new Usuario();
                    require '../vista/usuario.php';
                } else if ($action == 'tabla') {
                    require '../vista/vUsuarioTabla.php';
                }
            }
        }
    }

}
