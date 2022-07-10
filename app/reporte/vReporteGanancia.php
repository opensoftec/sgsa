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
                                <li><a href="" class="active">Ganancia</a> <span class="divider">/</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading" >
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/ganancia.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Ganancia</h3>
                                    </div>                                    
                                </div>
                                <br>
                            </div>

                            <div class="panel-body">
                                <div class="container-fluid">
                                    <div class="">
                                        <div class="col-lg-12 text-center">
                                            <h2><strong><span class='label label-info' >Reporte de Ganancias</span></strong></h2> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
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
                                </div>
                            </div>

                            <div class="container">
                                <div class="text-center">
                                    <div class="col col-xs-7">
                                        <button id="btn_presentar" class="btn btn-round btn-default" type="button" value="nuevo">
                                            <i class="glyphicon glyphicon-filter"> </i> 
                                            Presentar en la web
                                        </button> 
                                    </div>
                                    <div class="col col-xs-3">
                                        <button id="btn_generarReporte" class="btn btn-round btn-warning" type="button" value="nuevo" disabled="true">
                                            <i class="glyphicon glyphicon-file"> </i> 
                                            Generar Reporte en Pdf
                                        </button> 
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="panel-footer">
                            <div class="panel panel-info text-center">
                                <div class="">
                                    <div class="col col-xs-1">
                                        <button id="btn_limpiarReportes" class="btn btn-round btn-success" type="button" value="nuevo">
                                            <i class="glyphicon glyphicon-file"> </i> 
                                            Limpiar Tabla
                                        </button> 
                                    </div>
                                </div>
                                <h4><strong><label id="lbl_titulo"> Reporte no Generado </label></strong></h4>
                                <div  style="overflow: auto;" id="tabla">
                                    <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos1">
                                        <thead >
                                            <tr>
                                                <th class="text-center">Dia</th>
                                                <th class="text-center">Fecha</th>
                                                <th class="text-center">Venta</th>
                                                <th class="text-center">Compra</th>
                                                <th class="text-center">Sueldo Empleado</th>
                                                <th class="text-center">Ganacia</th>
                                                <th class="text-center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tdetalle1">
                                            
                                        </tbody>
                                        <tfoot id="tfoot1">
                                            <tr>
                                                <th class="text-center" colspan="2">Total</th>
                                                <th class="text-right" id="totalVenta">$0.00</th>
                                                <th class="text-right" id="totalCompra">$0.00</th>
                                                <th class="text-right" id="totalEmpleado">$0.00</th>
                                                <th class="text-right" id="totalGanancia">$0.00</th>
                                            </tr>
                                        </tfoot>
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
        <script src="../../static/js/moment.min.js"></script>

        <script>
            $(document).ready(function() {
                var date = new Date();
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                if (month < 10) month = "0" + month;
                if (day < 10) day = "0" + day;
                var today = year + "-" + month + "-" + day;
                //$("#fechaInicio").val('2017-04-08');
                //$("#fechaFin").val('2017-04-12');
                $("#fechaInicio").val(today);
                $("#fechaFin").val(today);
            });

            $(function () {
                $('#btn_limpiarReportes').on('click',function(){
                     limpiar();
                });

                $('#tdatos1 #tdetalle1').on('change', '.empleado', function () {
                    var ganancia = 0.00;
                    if ($(this).parents('tr').find('td').eq(4).children('input').val() == ""){
                        $(this).parents('tr').find('td').eq(4).children('input').val(0);
                    }
                    ganancia = parseFloat($(this).parents('tr').find("td").eq(2).html()) - (parseFloat($(this).parents('tr').find("td").eq(3).html()) + parseFloat($(this).parents('tr').find('td').eq(4).children('input').val()));
                    $(this).parents('tr').find("td").eq(5).html(ganancia.toFixed(2));

                    if (ganancia == 0){
                        $(this).parents('tr').find("td").eq(6).html('<span style="color:black;">----------</span>');
                    }else if (ganancia < 0){
                        $(this).parents('tr').find("td").eq(6).html('<span style="color:red;">Perdida</span>');
                    }else{
                        $(this).parents('tr').find("td").eq(6).html('<span style="color:green;">Ganancia</span>');
                    }
                    $(this).parents('tr').find('td').eq(4).children('input').attr('title','valores correctos');
                    total();
                });

                /*$('#tdatos1 #tdetalle1').on('input', '.empleado', function () { 
                    //this.value = this.value.replace(/[^0-9\.]/g,'');
                });*/

                $('#btn_presentar').on('click', function () {
                    var fecha1 = moment($('#fechaInicio').val());
                    var fecha2 = moment($('#fechaFin').val());
                    if ($('#fechaInicio').val() > $('#fechaFin').val()){
                        alert('fechas incorrectas, Favor de seleccionar la fecha como se indica');
                        limpiar();
                        return;
                    }else if ($('#fechaInicio').val() == "" || $('#fechaFin').val() == "" ){
                        alert('fechas incorrectas, Favor de ingresar la fecha correcta');
                        limpiar();
                        return;
                    }else if (fecha2.diff(fecha1, 'days') > 90){
                        alert('fechas incorrectas, Favor de ingresar un rango menor o igual a 3 meses de diferencia');
                        limpiar();
                        return;
                    }
                        

                    $.ajax({
                        url: '../controlador/CtrReporte.php',
                        type: 'POST',
                        data: {opcion: 'RGanancia', fechaInicio: '' + $('#fechaInicio').val() + ' 00:00:00.000', fechaFin: '' + $('#fechaFin').val() + ' 23:59:59.000'},
                        dataType: 'json'
                    }).done(function (data) {
                        var totalVenta = 0;
                        var totalCompra = 0;
                        var totalGanancia = 0;
                        $('#tdatos1 #tdetalle1').html('');
                        for (var i in data) {
                            var rw = '<tr class="fila_tbody">';
                            rw += '<td class="text-left">' + data[i][0] + '</td>';
                            rw += '<td class="text-left">' + data[i][1] + '</td>';
                            rw += '<td class="text-right">' + data[i][2] + '</td>';
                            rw += '<td class="text-right">' + data[i][3] + '</td>';
                            rw += "<td> <input type='text' id='fechaFin' class='form-control empleado' value=0 title='Valores incompletos' onkeypress='return filterFloat(event,this);'></td>";
                            rw += '<td class="text-right">' + data[i][4].toFixed(2) + '</td>';
                            if (data[i][4] == 0){
                                rw += '<td class="text-left"><span style="color:black;">----------</span></td>';
                            }else if (data[i][4] < 0){
                                rw += '<td class="text-left"><span style="color:red;">Perdida</span></td>';
                            }else{
                                rw += '<td class="text-left"><span style="color:green;">Ganancia</span></td>';
                            }
                            $('#tdatos1 #tdetalle1').append(rw);
                            totalVenta += parseFloat(data[i][2]);
                            totalCompra += parseFloat(data[i][3]);
                            totalGanancia += parseFloat(data[i][4]);
                        }
                        $('#tdatos1 #tfoot1 #totalVenta').html('$'+totalVenta.toFixed(2));
                        $('#tdatos1 #tfoot1 #totalCompra').html('$'+totalCompra.toFixed(2));
                        $('#tdatos1 #tfoot1 #totalEmpleado').html('$0.00');
                        $('#tdatos1 #tfoot1 #totalGanancia').html('$'+totalGanancia.toFixed(2));
                        $('#btn_generarReporte').removeAttr('disabled');
                        $('#lbl_titulo').html('Reporte de "' + $('#fechaInicio').val() + '" al "' + $('#fechaFin').val() +'"');
                        
                    });
                });
                $('#btn_generarReporte').on('click', function () {
                    var data = dataD();
                    data['titulo'] = $('#lbl_titulo').html();
                    data['opcion'] = 'RGananciaSession';
                    $.ajax({
                        url: '../controlador/CtrReporte.php',
                        type: 'POST',
                        data: data,
                        dataType: 'json'
                    }).done(function (data) {
                        if (data.resp == true){
                            window.open('vReporteGananciaPdf.php','ventana',"width=1000,height=500,s crollbars=NO");
                        }                        
                    });
                });
            });
            function dataD() {
                var json = {'detalle' : []};
                $('#tdatos1 #tdetalle1 tr').each(function () {
                    var item = {
                        'dia' : $(this).find('td').eq(0).html(),
                        'fecha' : $(this).find('td').eq(1).html(),
                        'venta': $(this).find('td').eq(2).html(),
                        'compra' : $(this).find('td').eq(3).html(),
                        'empleado' : $(this).find('td').eq(4).children('input').val(),
                        'ganancia' : $(this).find('td').eq(5).html()
                    };
                    json.detalle.push(item);
                });
                var item = {'dia' : '','fecha' : '','venta': '','compra' : '','empleado' : '','ganancia' : ''};
                json.detalle.push(item);
                var total = {
                    'TVenta' : $('#tdatos1 #tfoot1 #totalVenta').html(),
                    'TCompra' : $('#tdatos1 #tfoot1 #totalCompra').html(),
                    'TEmpleado' : $('#tdatos1 #tfoot1 #totalEmpleado').html(),
                    'TGanancia' : $('#tdatos1 #tfoot1 #totalGanancia').html(),
                };
                json['total'] = total;
                return json;
            }
            function total() {
                var totalGanancia = 0.0;
                var totalEmpleado = 0.0;
                $('#tdatos1 #tdetalle1 tr').each(function () {
                    totalEmpleado += parseFloat($(this).find('td').eq(4).children('input').val());
                    totalGanancia += parseFloat($(this).find("td").eq(5).html());
                });
                $('#tdatos1 #tfoot1 #totalEmpleado').html("$"+totalEmpleado.toFixed(2));
                $('#tdatos1 #tfoot1 #totalGanancia').html("$"+totalGanancia.toFixed(2));
            }
            function limpiar(){
                $('#tdatos1 #tdetalle1').html('');
                $('#tdatos1 #tfoot1 #totalVenta').html('$0.00');
                $('#tdatos1 #tfoot1 #totalCompra').html('$0.00');
                $('#tdatos1 #tfoot1 #totalEmpleado').html('$0.00');
                $('#tdatos1 #tfoot1 #totalGanacia').html('$0.00');
                $("#btn_generarReporte").attr('disabled','disabled');
                $('#lbl_titulo').html('Reporte no Generado');
            }
            function filterFloat(evt,input){
                // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
                var key = window.Event ? evt.which : evt.keyCode;    
                var chark = String.fromCharCode(key);
                var tempValue = input.value+chark;
                if(key >= 48 && key <= 57){
                    if(filter(tempValue)=== false){
                        return false;
                    }else{       
                        return true;
                    }
                }else{
                    if(key == 8 || key == 13 || key == 0) {     
                        return true;              
                    }else if(key == 46){
                        if(filter(tempValue)=== false){
                            return false;
                        }else{       
                            return true;
                        }
                    }else{
                        return false;
                    }
                }
            }
            function filter(__val__){
                var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
                if(preg.test(__val__) === true){
                    return true;
                }else{
                   return false;
                }   
            }
        </script>    
    </body>
</html>