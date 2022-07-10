<?php
require '../modelo/Login.php';
if (session_id() == '') {
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
                                        <img src="../../static/img/menu/orden.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Listado de Ordenes de Detalle</h3>
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

                                            <form id="frm-ciudad" class="form-horizontal">
                                                <div class="row-fluid">  
                                                    <input type="hidden" name="action" value="<?= $action ?>">
                                                    <input type="hidden" name="id" value="<?= $id ?>">  
                                                    <div class="item form-group ">
                                                        <label class="control-label col-xs-2">ordId : </label>   
                                                        <div class="col-xs-4">
                                                            <input name="codigo" id="ordId" type="text" class="form-control" value="<?= $this->model->ordId ?>">
                                                        </div>                  

                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Numero : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="numero" type="text" class="form-control" value="<?= $this->model->numero ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Fecha : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="fecha" type="text" class="form-control" value="<?= $this->model->fecha ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Tipo : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="tipo" value="1" type="text" class="form-control" value="<?= $this->model->tipo ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Cliento : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="cliente" type="text" class="form-control" value="<?= $this->model->proveedor ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">cliId : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="cliId" type="text" class="form-control" value="<?= $this->model->proId ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Subtotal : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="subtotal" type="text" class="form-control" value="<?= $this->model->subtotal ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Descuento : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="descuento" type="text" class="form-control" value="<?= $this->model->descuento ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Impuesto : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="impusto" type="text" class="form-control" value="<?= $this->model->impuesto ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Total : </label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="total" type="text" class="form-control" value="<?= $this->model->total ?>" placeholder="Ingrese Nombre">
                                                        </div>                                                        
                                                    </div> 

                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Estado : </label>
                                                        <div class="col-xs-3 text-center">
                                                            <label class="checkbox form-control"><input type="checkbox" name="estado"<?= ($this->model->estado == true ? "checked" : "notchecked") ?> >Activo ?</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid">

                                                    <div class="form-group">
                                                        <div class="col col-xs-9 col-xs-offset-2">
                                                            <button class="btn btn-success" type="submit">
                                                                <i class="glyphicon glyphicon-save"> </i> 
                                                                Despachar
                                                            </button>            
                                                            <button type="reset" onClick="window.location = '../../app/inicio/wdespachar.php?action=tabla'" class="btn btn-danger">
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
                    <div class="col-md-12">
                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/orden.png" height="65">
                                    </div>
                                    <div class="col col-xs-7">
                                        <h3>Listado de Ordenes de Detalle</h3>
                                    </div>                                    
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-xs-6">
                                        <div class="input-group">
                                            <div class="input-group-btn search-panel">
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                    <span id="search_concept">Buscar Por </span> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#contains">Contains</a></li>                                                    
                                                    <li class="divider"></li>
                                                    <li><a href="#all">Anything</a></li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="search_param" value="all" id="search_param">         
                                            <input type="text" class="form-control" name="x" placeholder="Buscar Orden Detalle">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col col-xs-6 text-right">
                                        <div class="btn-group">
                                            <a href="javascript:window.location.reload();" class="btn btn-primary">
                                                <i class="glyphicon glyphicon-refresh"> </i>
                                                Actualizar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body"  style="overflow: auto;">
                                <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos">
                                    <thead>
                                        <tr>
                                            <th>etId</th>
                                            <th>OrdId</th>
                                            <th>Articulo</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>TotalItem</th>
                                            <th>Estado</th>
                                            <th>artId</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tdetalle">
                                        <?php foreach ($this->array as $articulo): ?>
                                            <tr>
                                                <td align="center"><?= $articulo->detId ?></td>
                                                <td align="center"><?= $articulo->ordId ?></td>
                                                <td align="center"><?= $articulo->articulo ?></td>
                                                <td align="center"><?= $articulo->cantidad ?></td>
                                                <td align="center"><?= $articulo->precio ?></td>
                                                <td align="center"><?= $articulo->totalitem ?></td>
                                                <td align="center"><span class="label label-success" title="Activo"><?= (($articulo->estado == true) ? "Activo" : "Inactivo") ?></span></td>
                                                 <td align="center"><?= $articulo->artId ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

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
                $('#frm-ciudad').on({
                    submit: function (event) {
                        event.preventDefault();
                        alert();
                        $.ajax({
                            url: 'despacharAjax.php',
                            type: 'POST',
                            data: {'id':$('#ordId').val(),'action':'despachar'},
                            dataType: 'json'
                        }).done(function (data) {
                            console.log(data);
                            if (data.resp) {
                                alert(data.error);
                                window.location = '../inicio/wdespachar.php?action=tabla';
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
