<?php

class CtrCliente {

    private $model;
    private $dao;
    private $array;

    public function __construct() {
        require '../config/config.php';
        require '../modelo/Provincia.php';
        require '../modelo/Ciudad.php';
        require '../modelo/Cliente.php';

        require '../data/DataConection.php';
        require '../interfaz/ICliente.php';
        require '../dao/ClienteDao.php';
        $this->model = new Cliente;
        $this->dao = new ClienteDao();
        $this->array = new ArrayObject();
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':
                        $post = (object) $_POST;
                        $this->model->cliId = $post->cliId;
                        $this->model->codigo = $post->codigo;
                        $this->model->cedula = $post->cedula;
                        $this->model->big = isset($post->big);
                        $this->model->nombre = $post->nombre;
                        $aux1 = $this->guardarImgn();
                        $this->model->img = $aux1 == '../../static/img/cliente/' ? '../../static/img/img/avatar.png':$aux1; 
                        $this->model->apellido = $post->apellido;
                        $this->model->genero = ($post->genero == "m" ? "m" : "f");
                        $this->model->telefono = $post->telefono;
                        $this->model->email = $post->email;
                        $this->model->direccion = $post->direccion;
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->estado = isset($post->estado);
                        $this->model->ciuId = $post->selectCiudad;
                        $this->model->prvId = $post->selectProvincia;
                        if ($this->dao->crear($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
                        break;
                    case 'editar':
                        $post = (object) $_POST;
                        $this->model->cliId = $post->cliId;
                        $this->model->codigo = $post->codigo;
                        $this->model->cedula = $post->cedula;
                        $this->model->big = isset($post->big);
                        $this->model->nombre = $post->nombre;
                        $this->model->apellido = $post->apellido;
                        $aux = $this->guardarImgn();
                        $this->model->img = (($aux == '../../static/img/cliente/') ? $post->url : $aux);
                        $this->model->genero = ($post->genero == "m" ? "m" : "f");
                        $this->model->telefono = $post->telefono;
                        $this->model->email = $post->email;
                        $this->model->direccion = $post->direccion;
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->estado = isset($post->estado);
                        $this->model->ciuId = $post->selectCiudad;
                        $this->model->prvId = $post->selectProvincia;
                        if ($this->dao->editar($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
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
                    require '../vista/cliente.php';
                } else if ($action == 'nuevo') {
                    $this->model = new Cliente();
                    require '../vista/cliente.php';
                } else if ($action == 'tabla') {
                    require '../vista/vClienteTabla.php';
                } else if ($action == 'buscarCiudad') {
                    echo json_encode($this->dao->listarComboCiudad(intval($_GET['prvId'])));
                    die();
                }
            }
        }
    }

    private function guardarImgn() {
        if (isset($_FILES["img"])) {
            $file = $_FILES["img"];
            $nombre = $file["name"];
            $ruta_provisional = $file["tmp_name"];
            $carpeta = "../../static/img/cliente/";
            $src = $carpeta . $nombre;
            move_uploaded_file($ruta_provisional, $src);
            return $src;
        } else {
            return '../../static/img/img/avatar.png';
        }
    }

}
