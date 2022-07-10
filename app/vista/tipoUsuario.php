<?php
require '../modelo/Login.php';
if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['_USER_'])) {
    header('location:login.php');
    exit();
}
$user = $_SESSION['_USER_'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SGSC Web </title>
        <link href="../../static/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/table.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <?php require '../inicio/menutop.php'; ?>
        </header>
        <article id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="breadcrumb">
                                <li><a href="../inicio/admin.php">Inicio</a><span class="divider"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/tu.png" height="65">
                                    </div>
                                    <div class="col col-xs-6">
                                        <h3>Registro de Tipo Usuario</h3>
                                    </div>                                      
                                </div>                     

                            </div>
                            <div class="panel-body text-center">
                                <div class="col col-lg-10 col-lg-offset-1">
                                    <div class="panel panel-default panel-primary" style="background: #eee">
                                        <div class="panel-heading">
                                            <strong>Ficha de Registro</strong>
                                        </div>
                                        <div class="panel-body">                 
                                            <form id="frm-tipoUsuario" class="form-horizontal">
                                                <div class="row-fluid">  
                                                    <input type="hidden" name="action" value="<?= $action ?>">
                                                    <input type="hidden" name="id" value="<?= $id ?>">
                                                    <div class="form-group hidden">
                                                        <label class="control-label col-xs-2">tpuId</label>   
                                                        <div class="col-xs-4">
                                                            <input required="required" name="tpuId" type="text" class="form-control" value="<?= $this->model->tpuId ?>">
                                                        </div>                  
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-2">Nombre</label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="nombre" type="text" class="form-control" required placeholder="Ingrese Nombre" value="<?= $this->model->nombre ?>">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-2">Fecha Registro</label>   
                                                        <div class="col-xs-7">
                                                            <input disabled="" required="required" name="fechaRegistroorg" type="text" class="form-control" required placeholder="Ingrese el nombre" value="<?= ($this->model->fecharegistro == "" ? date("Y-m-d H:i:s") : $this->model->fecharegistro) ?>">
                                                            <input required="required" name="fechaRegistro" type="hidden" class="form-control" required placeholder="Ingrese el nombre" value="<?= ($this->model->fecharegistro == "" ? date("Y-m-d H:i:s") : $this->model->fecharegistro) ?>">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-2">Estado</label>
                                                        <div class="col-xs-3 text-center">
                                                            <label class="checkbox form-control"><input type="checkbox" name="estado" <?= ($this->model->estado == true ? "checked" : "notchecked") ?> >Activo ?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="form-group">
                                                        <div class="col col-xs-9 col-xs-offset-2">
                                                            <button class="btn btn-success" type="submit">
                                                                <i class="glyphicon glyphicon-save"> </i> 
                                                                Guardar Registro
                                                            </button>                                                            
                                                            <button type="reset" class="btn btn-info">
                                                                <i class="glyphicon glyphicon-refresh"> </i>
                                                                Restablecer
                                                            </button>   
                                                            <button type="reset" onClick="window.location = '../../app/inicio/wtipoUsuario.php?action=tabla'" class="btn btn-danger">
                                                                <i class="glyphicon glyphicon-remove"> </i>
                                                                Cancelar
                                                            </button> 
                                                        </div>                                    
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script>
            $(function () {

                $('#frm-tipoUsuario').on({
                    submit: function (event) {
                        event.preventDefault();
                        //var form = new FormData($(this)[0]);
                        $.ajax({
                            url: 'tipoUsuarioAjax.php',
                            type: 'POST',
                            data: $(this).serialize(),
                            dataType: 'json'
                        }).done(function (data) {
                            if (data.resp) {
                                alert("Registro Guardado Correctamente");
                                window.location = '../inicio/wtipoUsuario.php?action=tabla';
                            } else {
                                alert(data.error);
                            }
                        });
                        return false;
                    }
                });
            });
        </script>

    </body>
</html>
