<?php

class CtrPersonal {

    private $model;
    private $dao;
    private $array;

    public function __construct() {
        require '../config/config.php';
        require '../modelo/Provincia.php';
        require '../modelo/Ciudad.php';
        require '../modelo/Categoria_personal.php';
        require '../modelo/Personal.php';
        require '../data/DataConection.php';
        require '../interfaz/IPersonal.php';
        require '../dao/PersonalDao.php';
        $this->model = new Personal;
        $this->dao = new PersonalDao;
        $this->array = new ArrayObject();
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':
                        $post = (object) $_POST;
                        $this->model->codigo = $post->codigo;
                        $this->model->cedula = $post->cedula;
                        $this->model->nombre = $post->nombre;
                        $this->model->apellido = $post->apellido;
                        $aux1 = $this->guardarImgn();
                        $this->model->img = $aux1 == '../../static/img/personal/' ? '../../static/img/img/avatar.png':$aux1; 
                        $this->model->genero = ($post->genero == "m" ? "m":"f");
                        $this->model->telefono = $post->telefono;
                        $this->model->email = $post->email;
                        $this->model->direccion = $post->direccion;
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->estado = isset($post->estado);
                        $this->model->ctgId = $post->selectCategoriaPersonal;
                        $this->model->ciuId = $post->selectCiudad;
                        $this->model->prvId = $post->selectProvincia;
                        if ($this->dao->crear($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
                        break;
                    case 'editar':
                        $post = (object)$_POST;
                        $this->model->perId = $post->perId;
                        $this->model->codigo = $post->codigo;
                        $this->model->cedula = $post->cedula;
                        $this->model->nombre = $post->nombre;
                        $this->model->apellido = $post->apellido;
                        $aux = $this->guardarImgn();
                        $this->model->img = $aux=='../../static/img/personal/'? $post->url:$aux; 
                        $this->model->genero = ($post->genero == "m" ? "m":"f");
                        $this->model->telefono = $post->telefono;
                        $this->model->email = $post->email;
                        $this->model->direccion = $post->direccion;
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->estado = isset($post->estado);
                        $this->model->ctgId = $post->selectCategoriaPersonal;
                        $this->model->ciuId = $post->selectCiudad;
                        $this->model->prvId = $post->selectProvincia;
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
                    require '../vista/personal.php';
                } else if ($action == 'nuevo') {
                    $this->model = new Personal();
                    require '../vista/personal.php';
                } else if ($action == 'tabla') {
                    require '../vista/vPersonalTabla.php';
                }else if ($action == 'buscarCiudad') {
                    echo json_encode($this->dao->listarComboCiudad(intval($_GET['prvId'])));
                }
            }
        }
    }
    
    private function guardarImgn() {
        if (isset($_FILES["img"])) {
            $file = $_FILES["img"];
            $nombre = $file["name"];
            $ruta_provisional = $file["tmp_name"];
            $carpeta = "../../static/img/personal/";
            $src = $carpeta . $nombre;
            move_uploaded_file($ruta_provisional, $src);
            return $src;
        } else {
            return '../../static/img/img/avatar.png';
        }
    }

}
