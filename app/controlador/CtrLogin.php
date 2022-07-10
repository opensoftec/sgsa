<?php

class CtrLogin {

    private $modelLogin;
    private $dao;

    public function __construct() {
        require '../config/config.php';
        require '../data/DataConection.php';
        require '../modelo/Login.php';
        require '../interfaz/ILogin.php';
        require '../dao/LoginDao.php';
        $this->modelLogin = new Login();
        $this->dao = new LoginDao();
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {

                $cuenta = $_POST['cuenta'];
                $passw = $_POST['clave'];

                $this->modelLogin = $this->dao->login($cuenta, $passw);
                if (is_object($this->modelLogin) && $this->modelLogin->usuId) {
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $_SESSION['_USER_'] = $this->modelLogin;
                    echo '{"resp":true}';
                    exit();
                } else {
                    echo '{"resp":false}';
                    exit();
                }
            }
        }
    }

}
