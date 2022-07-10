<?php

class CtrWeb {

    private $model;
    private $dao;
    private $dao2;
    private $modelcliente;
    private $daocliente;

    public function __construct() {
        require '../../app/config/config.php';
        require '../../app/data/DataConection.php';
        require '../../app/modelo/Ciudad.php';
        require '../../app/modelo/Provincia.php';
        require '../../app/modelo/Cliente.php';
        require '../../app/modelo/Login.php';
        require '../../app/modelo/Web_usuario.php';
        require '../../app/interfaz/ICliente.php';
        require '../../app/interfaz/ILogin.php';
        require '../../app/interfaz/IWebUsuario.php';
        require '../../app/dao/ClienteDao.php';
        require '../../app/dao/LoginDao.php';
        require '../../app/dao/WebUsuarioDao.php';
        $this->model = new Web_usuario;
        $this->dao = new LoginDao;
        $this->dao2 = new WebUsuarioDao;
        $this->modelcliente = new Cliente;
        $this->daocliente = new ClienteDao;
    }

    public function view() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {           
            $cuenta = $_POST['cuenta'];
            $passw = $_POST['clave'];

            $this->model = $this->dao->loginWeb($cuenta, $passw);
            if (is_object($this->model) && $this->model->wusId) {
                if (session_id() == '') {
                    session_start();
                }
                $_SESSION['_WEBUSER_'] = $this->model;
                echo '{"resp":true}';
            } else {
                echo '{"resp":false}';
            }
        } else {
            
        }
    }

    public function newRegister() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $post = (object) $_POST;
            $this->modelcliente->nombre = $post->nombrecli;
            $this->modelcliente->apellido = $post->apellidocli;
            $this->modelcliente->cedula = $post->cedulacli;
            $this->modelcliente->prvId=$post->prvId;
            $this->modelcliente->ciuId=$post->ciuId;
            $this->modelcliente->estado = 1;
            $r = $this->daocliente->add($this->modelcliente); 
            if ($r[0]) {
                $this->model->nombre = $post->nombre;
                $this->model->clave = $post->clave;
                $this->model->ultimoingreso = $post->ultimoingreso;
                $this->model->fecharegistro = $post->fecharegistro;
                $this->model->estado = true;
                $this->model->cliId = $r[1];
                if ($this->dao2->crear($this->model)) {
                    if (session_id() == '') {
                        session_start();
                    }
                    $_SESSION['_WEBUSER_'] = $this->model;
                    echo '{"resp":true}';
                } else {
                    echo '{"resp":false}';
                }
            } else {
                echo '{"resp":false}';
            }
        } else {
            echo '{"resp":false}';
        }
    }

}