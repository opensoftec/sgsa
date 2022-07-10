<?php

class CtrCategoriaArticulo {

    private $model;
    private $dao;

    public function __construct() {
        require '../config/config.php';
        require '../modelo/Categoria_articulo.php';
        require '../interfaz/ICategoriaArticulo.php';
        require '../data/DataConection.php';
        require '../dao/CategoriaArticuloDao.php';
        $this->model = new Categoria_articulo;
        $this->dao = new CategoriaArticuloDao;
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':
                        $post = (object) $_POST;
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
                        $this->model->ctgId = $post->ctgId;
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
                    require '../vista/categoriaArticulo.php';
                } else if ($action == 'nuevo') {
                    $this->model = new Categoria_articulo();
                    require '../vista/categoriaArticulo.php';
                } else if ($action == 'tabla') {
                    require '../vista/vCategoriaArticuloTabla.php';
                }
            }
        }
    }

}
