<?php
require '../../app/modelo/Login.php';
require '../../app/modelo/Tipo_usuario.php';

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
        <link href="../../static/css/chosen.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/table.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <header>
            <?php require '../../app/inicio/menutop.php'; ?>
        </header>

        <article id="content">
            <div class="container">

                <div class="row">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="breadcrumb">
                                <li><a href="../../app/inicio/admin.php">Inicio</a><span class="divider"></span></li>
                                <li><a href="" class="active">Reportes</a> <span class="divider">/</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12">

                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/reporte.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Reportes</h3>
                                    </div>                                    
                                </div>
                                <br>
                            </div>
                            <div class="panel-body">
                                <br>
                                <br>
                                <div class="container">
                                    <div class="span12 col-md-6 text-center">
                                        <h4><strong><span class='label label-danger' >Escoger</span>Fecha de Inicio</strong></h4>  
                                        <hr>
                                        <div class="span12 col-md-6 col-md-offset-3">
                                            <input type="date" id='fechaInicio' class='form-control '>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="span12 col-md-6 text-center">
                                        <h4 ><strong><span class='label label-danger'>Escoger</span>Fecha de Fin</strong></h4>  
                                        <hr>
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="date" id='fechaFin' class='form-control '>
                                            <hr>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="">
                                        <div class="col-lg-12 text-center">
                                            <h4><strong><span class='label label-danger' >Escoger Reporte de </span>...<span class="label label-info">Venta</span> o <span class="label label-warning">Compra?</span></strong></h4>  
                                            <br>
                                            <div class="col-lg-4 col-lg-offset-2  text-center">
                                                <label class="control-label col-xs-4"><h4><strong><span class="label label-info">Venta</span></strong></h4></label>
                                                <div class="col-xs-7 text-center">
                                                    <label class="checkbox form-control"><input type="radio" id="chkVenta" name="rdn" checked>Venta ?</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-center">
                                                <label class="control-label col-xs-3"><h4><strong><span class="label label-warning">Compra</span></strong></h4></label>
                                                <div class="col-xs-5 text-center">
                                                    <label class="checkbox form-control"><input type="radio" id="chkCompra" name="rdn" >Compra ?</label>
                                                </div>
                                            </div>
                                            <hr>
                                            <hr>
                                            <hr>
                                            <hr>
                                        </div>
                                    </div>
                                    <hr>
                                    <hr>
                                    <div class="">
                                        <div class="col col-xs-3 col-xs-offset-5">
                                            <button id="btn_listarComboReportes" class="btn btn-round btn-default" type="button" value="nuevo">
                                                <i class="glyphicon glyphicon-filter"> </i> 
                                                Listar Combo Reportes
                                            </button> 
                                        </div>
                                    </div>
                                </div>

                                <div class="span12">
                                    <h4><strong>Escoger Reporte</strong></h4>  
                                    <form class='well'>
                                        <select class="form-control producto" id="id_comboReporte" style="overflow: scroll">
                                            <option value="Escoger Fecha de Inicio"></option>

                                        </select>
                                    </form>
                                    <div class="text-center">
                                        <div class="col col-xs-7">
                                            <button id="btn_generarReporte" class="btn btn-round btn-default" type="button" value="nuevo">
                                                <i class="glyphicon glyphicon-file"> </i> 
                                                Generar Reporte de Ventas
                                            </button> 
                                        </div>
                                        <div class="col col-xs-3">
                                            <button id="btn_generarReporteCompra" class="btn btn-round btn-default" type="button" value="nuevo">
                                                <i class="glyphicon glyphicon-file"> </i> 
                                                Generar Reporte de Compras
                                            </button> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <hr>
                                    <div class="">
                                        <div class="col col-xs-12">
                                            <button id="btn_limpiarReportes" class="btn btn-round btn-success" type="button" value="nuevo">
                                                <i class="glyphicon glyphicon-file"> </i> 
                                                Limpiar Tablas
                                            </button> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="panel panel-info text-center">
                                    <h4><strong><span class="label label-info">Venta</span></strong></h4>
                                    <div  style="overflow: auto;">
                                        <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos1">
                                            <thead>
                                                <tr>
                                                    <th>venId</th>
                                                    <th>Numero</th>
                                                    <th>Numero Orden</th>
                                                    <th>Cliente</th>
                                                    <th>Fecha</th>
                                                    <th>Tipo</th>
                                                    <th>Entregado</th>
                                                    <th>Subtotal</th>
                                                    <th>Descuento</th>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tdetalle1">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-warning text-center">
                                    <h4><strong><span class="label label-warning">Compra</span></strong></h4>
                                    <div  style="overflow: auto;">
                                        <table class="table table-hover table-bordered table-responsive table-striped table-warning" id="tdatos2">
                                            <thead>
                                                <tr>
                                                    <th>compId</th>
                                                    <th>Proveedor</th>
                                                    <th>Fecha</th>
                                                    <th>Contado</th>
                                                    <th>Subtotal</th>
                                                    <th>Descuento</th>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tdetalle2">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </article>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../../static/js/vendor/bootstrap.min_1.js" type="text/javascript"></script>
        <script src="../../static/js/vendor/chosen.jquery.min.js" type="text/javascript"></script>

        <script>

            $(function () {
                $('#btn_generarReporte').on('click', function () {
                    window.open('vReporteEstablePdf.php?fechaInicio=' + '' + $('#fechaInicio').val() + ' 00:00:00.000' + '&fechaFin=' + '' + $('#fechaFin').val() + ' 23:59:59.000','ventana',"width=1000,height=500,s crollbars=NO");
                });
                $('#btn_generarReporteCompra').on('click', function () {
                    window.open('vReporteCompraPdf.php?fechaInicio=' + '' + $('#fechaInicio').val() + ' 00:00:00.000' + '&fechaFin=' + '' + $('#fechaFin').val() + ' 23:59:59.000','ventana',"width=1000,height=500,s crollbars=NO");
                });
                
                $('#tdatos1').on('click','.delegadoVenta', function () {
                    window.open('vReporteVentaFirtsPdf.php?numero='+$(this).val(),'ventana',"width=1000,height=500,s crollbars=NO");
                });
                
                $('#tdatos2').on('click','.delegadoCompra', function () {
                    window.open('vReporteCompraFirtsPdf.php?numero='+$(this).val(),'ventana',"width=1000,height=500,s crollbars=NO");
                });
                
                $('#btn_limpiarReportes').on('click',function(){
                    $('#id_comboReporte').html('');
                     $('#tdatos1 #tdetalle1').html('');
                     $('#tdatos2 #tdetalle2').html('');
                });
                $('#btn_listarComboReportes').on('click', function () {
                    $.ajax({
                        url: '../controlador/CtrReporte.php',
                        type: 'POST',
                        data: {opcion: $('#chkVenta').is(':checked').toString(), fechaInicio: '' + $('#fechaInicio').val() + ' 00:00:00.000', fechaFin: '' + $('#fechaFin').val() + ' 23:59:59.000'},
                        dataType: 'json'
                    }).done(function (data) {
                        console.log(data);
                        $('#id_comboReporte').html('');
                       
                        if ($('#chkVenta').is(':checked')) {
                            $('#tdatos1 #tdetalle1').html('');
                            for (var i in data) {
                                var option = '<option value="' + data[i].venId + '" >' + data[i].fecha + " - cliente " + data[i].cliente + '</option>';
                                $('#id_comboReporte').append(option);

                                var rw = '<tr class="fila_tbody">';
                                rw += '<td>' + data[i].venId + '</td>';
                                rw += '<td>' + data[i].numero + '</td>';
                                rw += '<td>' + data[i].num_orden + '</td>';
                                rw += '<td>' + data[i].cliente + '</td>';
                                rw += '<td>' + data[i].fecha + '</td>';
                                rw += '<td>' + data[i].tipo + '</td>';
                                rw += '<td>' + (data[i].entregado === "s" ? "<a class='label label-info'>Entregado</a>" : "<a class='label label-warning'>No Entregado</a>") + '</td>';
                                rw += '<td>' + data[i].subtotal + '</td>';
                                rw += '<td>' + data[i].descuento + '</td>';
                                rw += '<td>' + data[i].impuesto + '</td>';
                                rw += '<td>' + data[i].total + '</td>';
                                rw += '<td class="text-center"><button value="' + data[i].venId + '" type="button" class="btn btn-info delegadoVenta"><i class="glyphicon glyphicon-file"></i>Reporte</button></td>';
                                rw += '</tr>';
                                $('#tdatos1 #tdetalle1').append(rw);
                            }
                        } else {
                            $('#tdatos2 #tdetalle2').html('');
                            for (var i in data) {
                                var option = '<option value="' + data[i].compId + '" >' + data[i].fecha + " - proveedor " + data[i].proveedor + '</option>';
                                $('#id_comboReporte').append(option);

                                var rw = '<tr class="fila_tbody">';
                                rw += '<td>' + data[i].compId + '</td>';
                                rw += '<td>' + data[i].proveedor + '</td>';
                                rw += '<td>' + data[i].fecha + '</td>';
                                rw += '<td>' + (data[i].contado.toString() === '1' ? "<a class='label label-warning'>Si</a>" : "<a class='label label-warning'>No</a>") + '</td>';
                                rw += '<td>' + data[i].subtotal + '</td>';
                                rw += '<td>' + data[i].descuento + '</td>';
                                rw += '<td>' + data[i].impuesto + '</td>';
                                rw += '<td>' + data[i].total + '</td>';
                                rw += '<td class="text-center"><button value="' + data[i].compId + '" type="button" class="btn btn-warning delegadoCompra"><i class="glyphicon glyphicon-file"></i>Reporte</button></td>';
                                rw += '</tr>';
                                $('#tdatos2 #tdetalle2').append(rw);
                            }
                        }
                    });
                });

                var config = {
                    '.chosen-select': {}
                };
                for (var selector in config) {
                    $(selector).chosen(config[selector]);
                }

            });

        </script>    
    </body>
</html>


