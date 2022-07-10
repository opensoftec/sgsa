
<?php

class CtrArticulo {

    private $model;
    private $dao;

    public function __construct() {
        require '../config/config.php';
        require '../modelo/Provincia.php';
        require '../modelo/Ciudad.php';
        require '../modelo/Categoria_articulo.php';
        require '../modelo/Proveedor_contacto.php';
        require '../modelo/Proveedor.php';
        require '../modelo/Articulo.php';
        require '../data/DataConection.php';
        require '../interfaz/IArticulo.php';
        require '../dao/ArticuloDao.php';
        $this->model = new Articulo;
        $this->dao = new ArticuloDao();
    }

    public function view() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'nuevo':
                        $post = (object) $_POST;
                        $this->model->artId = $post->artId;
                        $this->model->codigo = $post->codigo;
                        $this->model->nombre = $post->nombre;
                        $this->model->descripcion = $post->descripcion;
                        $this->model->img = "";
                        $this->model->ubicacion = $post->ubicacion;
                        $aux1 = $this->guardarImgn();
                        $this->model->img = $aux1 == '../../static/img/articulo/' ? '../../static/img/img/avatar.png':$aux1;  
                        $this->model->fecha_alta = $post->fechaAlta;
                        $this->model->presentacion = $post->presentacion;
                        $this->model->marca = $post->marca;
                        $this->model->modelo = $post->modelo;
                        $this->model->stock_minimo = $post->stockMinimo;
                        $this->model->stock = $post->stock;
                        $this->model->precio = $post->precio;
                        $this->model->costo = $post->costo;
                        $this->model->pvp = $post->pvp;
                        $this->model->iva = isset($post->iva);
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->observacion = $post->observacion;
                        $this->model->activo = isset($post->activo);
                        $this->model->proId = $post->selectProveedor;
                        $this->model->ctgId = $post->selectCategoria;
                        if ($this->dao->crear($this->model)) {
                            echo '{"resp" : true}';
                            exit();
                        }
                        echo '{"resp" : false,"error" : "El registro no se guardo"}';
                        break;
                    case 'editar':
                        $post = (object) $_POST;
                        $this->model->artId = $post->artId;
                        $this->model->codigo = $post->codigo;
                        $this->model->nombre = $post->nombre;
                        $this->model->descripcion = $post->descripcion;
                        $this->model->ubicacion = $post->ubicacion;
                        $this->model->fecha_alta = $post->fechaAlta;
                        $this->model->presentacion = $post->presentacion;
                        $aux = $this->guardarImgn();
                        $this->model->img = $aux=='../../static/img/articulo/'? $post->url:$aux; 
                        $this->model->marca = $post->marca;
                        $this->model->modelo = $post->modelo;
                        $this->model->stock_minimo = $post->stockMinimo;
                        $this->model->stock = $post->stock;
                        $this->model->precio = $post->precio;
                        $this->model->costo = $post->costo;
                        $this->model->pvp = $post->pvp;
                        $this->model->iva = isset($post->iva);
                        $this->model->fecharegistro = $post->fechaRegistro;
                        $this->model->observacion = $post->observacion;
                        $this->model->activo = isset($post->activo);
                        $this->model->proId = $post->selectProveedor;
                        $this->model->ctgId = $post->selectCategoria;
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
                    require '../vista/articulo.php';
                } else if ($action == 'nuevo') {
                    $this->model = new Articulo();
                    require '../vista/articulo.php';
                } else if ($action == 'tabla') {
                    require '../vista/vArticuloTabla.php';
                }
            }
        }
    }
    
    private function guardarImgn() {
        if (isset($_FILES["img"])) {
            $file = $_FILES["img"];
            $nombre = $file["name"];
            $ruta_provisional = $file["tmp_name"];
            $carpeta = "../../static/img/articulo/";
            $src = $carpeta . $nombre;
            move_uploaded_file($ruta_provisional, $src);
            return $src;
        } else {
            return '../../static/img/img/avatar.png';
        }
    }
    
    public function listar(){
        return $this->dao->listar();
    }
    
    public function buscarArticulo($id) {
        return $this->dao->buscar($id);
    }

}
