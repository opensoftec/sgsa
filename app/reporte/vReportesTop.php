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
            <?php require '../inicio/menutop.php'; ?>
        </header>

        <article id="content">
            <div class="container">

                <div class="row">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="breadcrumb">
                                <li><a href="../../app/inicio/admin.php">Inicio</a><span class="divider"></span></li>
                                <li><a href="" class="active">Top Clientes</a> <span class="divider">/</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12">

                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading" >
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/top1.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Top Clientes</h3>
                                    </div>                                    
                                </div>
                                <br>
                            </div>
                            <div class="panel-body">
                                <br>
                                <br>
                                <div class="container-fluid">
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
                                    <div class="col-lg-12 text-center">
                                        <div class="col-lg-6 text-center">
                                            <div class="col col-lg-6">
                                                <label class="control-label col-lg-2 label label-info">De</label>
                                                <div class="col col-lg-10">
                                                    <select class="form-control" id="id_comboAños1">
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="col col-lg-6">
                                                <label class="control-label col-lg-3 label label-info">Hasta</label>
                                                <div class="col col-lg-9">
                                                    <select class="form-control" id="id_comboAños2">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <div class="col col-lg-6">
                                                <label class="control-label col-lg-2 label label-warning">De</label>
                                                <div class="col col-lg-10">
                                                    <select  class="form-control" id="id_comboMes1">
                                                        <option value="1">Mes Enero</option>
                                                        <option value="2">Mes Febrero</option>
                                                        <option value="3">Mes Marzo</option>
                                                        <option value="4">Mes Abril</option>
                                                        <option value="5">Mes Mayo</option>
                                                        <option value="6">Mes Junio</option>
                                                        <option value="7">Mes Julio</option>
                                                        <option value="8">Mes Agosto</option>
                                                        <option value="9">Mes Septiembre</option>
                                                        <option value="10">Mes Octubre</option>
                                                        <option value="11">Mes Noviembre</option>
                                                        <option value="12">Mes Diciembre</option>
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="col col-lg-6">
                                                <label class="control-label col-lg-3 label label-warning">Hasta</label>
                                                <div class="col col-lg-9">
                                                    <select  class="form-control" id="id_comboMes2">
                                                        <option value="1">Mes Enero</option>
                                                        <option value="2">Mes Febrero</option>
                                                        <option value="3">Mes Marzo</option>
                                                        <option value="4">Mes Abril</option>
                                                        <option value="5">Mes Mayo</option>
                                                        <option value="6">Mes Junio</option>
                                                        <option value="7">Mes Julio</option>
                                                        <option value="8">Mes Agosto</option>
                                                        <option value="9">Mes Septiembre</option>
                                                        <option value="10">Mes Octubre</option>
                                                        <option value="11">Mes Noviembre</option>
                                                        <option value="12">Mes Diciembre</option>
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-lg-12 text-center">
                                            <div class="col-xs-3 col-lg-offset-1 text-center">
                                                <input class="form-control" type="button" id="btn_año" name="año" value="Año Actual ?">
                                            </div>
                                            <div class="col-xs-3 col-lg-offset-3 text-center">
                                                <input class="form-control " type="button" id="btn_mes" name="mes" value="Mes Actual ?">
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <hr>
                                        <hr>
                                        <hr>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <div class="col-lg-4 text-center">
                                            <div class="col col-lg-12">
                                                <h4><strong><label class="control-label  col-lg-12 label label-primary">Escoger el Top </label></strong></h4>  
                                                <div class="col col-lg-5 col-lg-offset-4">
                                                    <input id="id_Top" class="form-control" type="number" value="5" max="20" maxlength="20" min="0" minlength="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 text-center">
                                            <div class="col-lg-12 text-center">
                                                <h4><strong><label class="control-label  col-lg-12 label label-primary">Top en Ordenes o el Total Maxima ? </label></strong></h4> 
                                                <br>
                                                <div class="col-lg-5 text-center">
                                                    <label class="control-label col-lg-4"><h4><strong><span class="label label-primary">Ordenes</span></strong></h4></label>
                                                    <div class="col-lg-8 text-center">
                                                        <label class="checkbox form-control"><input type="radio" id="id_rbnOrden" name="orden" checked>Ordenes ?</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 text-center">
                                                    <label class="control-label col-lg-5"><h4><strong><span class="label label-primary">Total Maximo</span></strong></h4></label>
                                                    <div class="col-lg-7 text-center">
                                                        <label class="checkbox form-control"><input type="radio" id="id_rbnTotal" name="orden" >Total Maximo ?</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <hr>
                                        <hr>
                                        <hr>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="col col-xs-3 col-xs-offset-5">
                                        <button id="btn_listarTopReportes" class="btn btn-round btn-default" type="button" value="nuevo">
                                            <i class="glyphicon glyphicon-filter"> </i> 
                                            Listar Top 
                                        </button> 
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="text-center">
                                    <div class="col col-xs-7">
                                        <button id="btn_generarReporte" class="btn btn-round btn-info" type="button" value="nuevo">
                                            <i class="glyphicon glyphicon-file"> </i> 
                                            Generar Top en Ventas
                                        </button> 
                                    </div>
                                    <div class="col col-xs-3">
                                        <button id="btn_generarReporteCompra" class="btn btn-round btn-warning" type="button" value="nuevo">
                                            <i class="glyphicon glyphicon-file"> </i> 
                                            Generar Top en Compras
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
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="panel-footer">
                            <div class="panel panel-info text-center">
                                <h4><strong><span class="label label-info">Venta</span></strong></h4>
                                <div  style="overflow: auto;">
                                    <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos1">
                                        <thead >
                                            <tr>
                                                <th class="text-center">Puesto. Top</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">Num Ordenes Vendindas al Cli...</th>
                                                <th class="text-center">Venta Maxima</th>
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
                                        <thead class="text-center">
                                            <tr>
                                                <th class="text-center">Puesto. Top</th>
                                                <th class="text-center">Proveedor</th>
                                                <th class="text-center">Num Ordenes Compradas al Prov...</th>
                                                <th class="text-center">Compra Maxima</th>
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
                //$('#id_comboAños').html('');

                var f = new Date();
                var con = 2000;
                while (con !== (f.getFullYear() + 1)) {
                    var option = '<option value=' + con + ' > Año ' + con + '</option>';
                    $('#id_comboAños1').append(option);
                    $('#id_comboAños2').append(option);
                    con += 1;
                }
                $('#id_comboAños1').val(2000);
                $('#id_comboAños2').val(f.getFullYear());
                $('#id_comboMes1').val(1);
                $('#id_comboMes2').val(f.getMonth() + 1);

                $('#btn_año').on('click', function () {
                    $('#id_comboAños1').val(f.getFullYear());
                    $('#id_comboAños2').val(f.getFullYear());
                });
                $('#btn_mes').on('click', function () {
                    $('#id_comboMes1').val(f.getMonth() + 1);
                    $('#id_comboMes2').val(f.getMonth() + 1);
                });

                $('#btn_generarReporte').on('click', function () {
                    window.open('vReporteTopVentaFirtsPdf.php?limit='+$('#id_Top').val()+'&ordenMax='+$('#id_rbnOrden').is(':checked').toString()+'&fechaInicio='+ '' + $('#id_comboAños1').val() + '-' + ($('#id_comboMes1').val().toString().length === 1 ? '0' + $('#id_comboMes1').val() : $('#id_comboMes1').val()) + '-00' + ' 00:00:00.000'+'&fechaFin='+'' + $('#id_comboAños2').val() + '-' + ($('#id_comboMes2').val().toString().length === 1 ? '0' + $('#id_comboMes2').val() : $('#id_comboMes2').val()) + '-31' + ' 23:59:59.000', 'ventana', "width=1000,height=500,s crollbars=NO");
                });
                $('#btn_generarReporteCompra').on('click', function () {
                    window.open('vReporteTopCompraFirtsPdf.php?limit='+$('#id_Top').val()+'&ordenMax='+$('#id_rbnOrden').is(':checked').toString()+'&fechaInicio='+ '' + $('#id_comboAños1').val() + '-' + ($('#id_comboMes1').val().toString().length === 1 ? '0' + $('#id_comboMes1').val() : $('#id_comboMes1').val()) + '-00' + ' 00:00:00.000'+'&fechaFin='+'' + $('#id_comboAños2').val() + '-' + ($('#id_comboMes2').val().toString().length === 1 ? '0' + $('#id_comboMes2').val() : $('#id_comboMes2').val()) + '-31' + ' 23:59:59.000', 'ventana', "width=1000,height=500,s crollbars=NO");
                });

                $('#btn_limpiarReportes').on('click', function () {
                    $('#id_comboReporte').html('');
                    $('#tdatos1 #tdetalle1').html('');
                    $('#tdatos2 #tdetalle2').html('');
                });

                $('#btn_listarTopReportes').on('click', function () {
                    //alert('' + $('#id_comboAños1').val()+ '-' + ($('#id_comboMes1').val().toString().length === 1?'0'+$('#id_comboMes1').val():$('#id_comboMes1').val()) + '-00' +' 00:00:00.000');
                    //alert('' + $('#id_comboAños2').val() + '-' + ($('#id_comboMes2').val().toString().length === 1 ? '0' + $('#id_comboMes2').val() : $('#id_comboMes2').val()) + '-31' + ' 23:59:59.000');
                    //alert($('#id_Top').val()+$('#id_rbnOrden').is(':checked').toString());
                    //alert('Enttro sx');
                    $.ajax({
                        url: '../controlador/CtrReporte.php',
                        type: 'POST',
                        data: {opcion: 'top', opc: $('#chkVenta').is(':checked').toString(),limit:$('#id_Top').val(), ordenMax: $('#id_rbnOrden').is(':checked').toString(), fechaInicio: '' + $('#id_comboAños1').val() + '-' + ($('#id_comboMes1').val().toString().length === 1 ? '0' + $('#id_comboMes1').val() : $('#id_comboMes1').val()) + '-00' + ' 00:00:00.000', fechaFin: '' + $('#id_comboAños2').val() + '-' + ($('#id_comboMes2').val().toString().length === 1 ? '0' + $('#id_comboMes2').val() : $('#id_comboMes2').val()) + '-31' + ' 23:59:59.000'},
                        dataType: 'json'
                    }).done(function (data) {
                        console.log(data);
                        //alert('Enttro s');
                        $('#id_comboReporte').html('');

                        if ($('#chkVenta').is(':checked')) {
                            // alert('Enttro Venta');
                            $('#tdatos1 #tdetalle1').html('');
                            for (var i in data) {
                                var option = '<option value="' + data[i].venId + '" >' + data[i].fecha + " - cliente " + data[i].cliente + '</option>';
                                $('#id_comboReporte').append(option);

                                var rw = '<tr class="fila_tbody">';
                                rw += '<td class="text-center">' + (parseInt(i) + 1) + '</td>';
                                rw += '<td class="text-center">' + data[i].nombre + ' ' + data[i].apellido + '</td>';
                                rw += '<td class="text-center">' + data[i].contador + '</td>';
                                rw += '<td class="text-center">' + data[i].total + '</td>';
                                rw += '</tr>';
                                $('#tdatos1 #tdetalle1').append(rw);
                            }
                        } else {
                         //alert('Enttro Compra');
                            $('#tdatos2 #tdetalle2').html('');
                            for (var i in data) {
                                var option = '<option value="' + data[i].venId + '" >' + data[i].fecha + " - cliente " + data[i].cliente + '</option>';
                                $('#id_comboReporte').append(option);

                                var rw = '<tr class="fila_tbody">';
                                rw += '<td class="text-center">' + (parseInt(i) + 1) + '</td>';
                                rw += '<td class="text-center">' + data[i].nombre + ' ' + data[i].apellido + '</td>';
                                rw += '<td class="text-center">' + data[i].contador + '</td>';
                                rw += '<td class="text-center">' + data[i].total + '</td>';
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


