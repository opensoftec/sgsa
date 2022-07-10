
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SGSC Web </title>
        <link href="../../static/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/table.css" rel="stylesheet" type="text/css"/>
        <style>
            tr:hover{
                color: #000000;
            }
        </style>
    </head>
    <body>
        <article id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="breadcrumb">
                                <li><a href="../inicio/admin.php">Inicio</a><span class="divider"></span></li>
                                <li><a href="javascript:window.location.reload();" class="active">Proveedor Contacto</a> <span class="divider">/</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/pc1.jpeg" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Listado de Proveedor Contacto</h3>
                                    </div>                                    
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-xs-6">
<!--                                        <div class="input-group">
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
                                            <input type="text" class="form-control" name="x" placeholder="Buscar Proveedor Contacto">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                            </span>
                                        </div>-->
                                    </div>
                                    <div class="col col-xs-6 text-right">
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="../ajax/proveedorContactoAjax.php?action=nuevo">
                                                <i class="glyphicon glyphicon-plus-sign"> </i>  
                                                Nuevo Registro
                                            </a>
                                            <a href="javascript:window.location.reload();" class="btn btn-primary">
                                                <i class="glyphicon glyphicon-refresh"> </i>
                                                Actualizar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Pricipal?</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
                                            <th>Direccion</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tdetalle">
                                        <?php foreach ($this->dao->listar() as $articulo): ?>
                                            <tr>
                                                <td align="center"><?= $articulo->pcoId ?></td>
                                                <td align="center"><?= $articulo->nombre ?></td>
                                                <td align="center"><span class="label label-warning" title="Activo"><?= (($articulo->principal == true) ? "Principal" : "No-Principal") ?></span></td>
                                                <td align="center"><?= $articulo->telefono ?></td>
                                                <td align="center"><?= $articulo->email ?></td>
                                                <td align="center"><?= $articulo->direccion ?></td>
                                               <?php if ($articulo->estado != true) { ?>
                                                        <td align="center"><span class="label label-danger" title="Inactivo">Inactivo</span></td>
                                                    <?php } else { ?>
                                                        <td align="center"><span class="label label-success" title="Activo">Activo</span></td>
                                                    <?php } ?>
                                                <td align="center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm">
                                                            <i class="glyphicon glyphicon-log-in"></i> Opciones
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a rel="action" data-json='{"action":"editar","id":"<?= $articulo->pcoId ?>"}'>
                                                                    <i class="glyphicon glyphicon-edit"></i> Editar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a rel="action" data-json='{"action":"eliminar","id":"<?= $articulo->pcoId ?>"}'>
                                                                    <i class="glyphicon glyphicon-remove"></i> Eliminar
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col col-xs-4">Page 1 of 5
                                    </div>
                                    <div class="col col-xs-8">
                                        <ul class="pagination hidden-xs pull-right">
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                        </ul>
                                        <ul class="pagination visible-xs pull-right">
                                            <li><a href="#">«</a></li>
                                            <li><a href="#">»</a></li>
                                        </ul>
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
                $('#tdatos #tdetalle').on('click', 'a[rel="action"]', function () {
                    var data = $(this).data('json');
                    if (data.action === 'editar') {
                        window.location = '../ajax/proveedorContactoAjax.php?action=editar&id=' + data.id;
                    } else {
                        $.ajax({
                            url: '../ajax/proveedorContactoAjax.php',
                            type: 'POST',
                            data: {'id': data.id, 'action': data.action},
                            dataType: 'json'
                        }).done(function (data) {
                            if (data.resp) {
                                alert("Eliminado");
                                window.location = 'wproveedorContacto.php?action=tabla';
                            } else {
                                alert(data.error);
                            }
                        });
                    }
                });
            });
        </script>    
    </body>
</html>


