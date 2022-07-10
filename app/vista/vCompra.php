<?php
require '../../app/config/config.php';
require '../../app/data/DataConection.php';
require '../../app/modelo/Categoria_articulo.php';
require '../../app/modelo/Proveedor_contacto.php';
require '../../app/modelo/Proveedor.php';
require '../../app/modelo/Articulo.php';
require '../../app/interfaz/ICompra.php';
require '../../app/dao/CompraDao.php';

$daoVenta = new CompraDao();

require '../../app/modelo/Login.php';

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
<html lang="es">

    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <!-- Meta, title, CSS, favicons, etc. -->
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SGSC Web </title>
        <link href="../../static/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/chosen.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/estilo.css" rel="stylesheet" type="text/css"/>

    </head>

    <body >

        <header>
            <?php require '../inicio/menutop.php'; ?>
        </header>
        <article id="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="breadcrumb">
                                <li><a href="../../app/inicio/admin.php">Inicio</a><span class="divider"></span></li>
                                <li><a href="" class="active">Compra</a> <span class="divider">/</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default panel-table panel-info"  >
                            <div class="panel-heading" style="padding-bottom: 0px">
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/compra2.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Compra</h3>
                                    </div>                                    
                                </div>
                                <br>
                            </div>
                            <div class="panel-body">
                                <form id="formulario" class="form-horizontal" action="" method="POST">
                                    <div class="row-fluid">
                                        <div class="col-lg-4">
                                            <label class="control-label col-xs-4">Num. compra</label>   
                                            <div class="col-xs-8">
                                                <input id="compIdaux" type="number" class="form-control" value="<?= $daoVenta->codigoMaximo() ?>" disabled>
                                                <input id="compId" type="hidden" class="form-control" value="<?= $daoVenta->codigoMaximo() ?>">
                                            </div>     
                                        </div> 
                                        <div class="col-lg-4">
                                            <label class="control-label col-xs-4">Usuario</label>   
                                            <div class="col-xs-8">
                                                <input required="required" name="vendedoraux" type="text" class="form-control" value="<?php echo ucwords($user->nombre) ?>" disabled>
                                                <input required="required" name="vendedor" type="hidden" class="form-control" value="<?php echo ucwords($user->nombre) ?>">
                                            </div>                                                        
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="control-label col-xs-4">Fecha</label> 
                                            <div class="col-xs-8">
                                                <input required="required" id="fechaaux" type="text" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" disabled >
                                                <input required="required" id="fecha" type="hidden" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" >
                                            </div>
                                        </div>  
                                    </div>      
                                    <div class="col-lg-12">
                                        <hr>
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h4>Datos de Compra</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-lg-4">
                                                    <label class="control-label col-xs-3">Proveedor</label>   
                                                    <div class="col-xs-9">
                                                        <select id="id_proveedor" class="form-control" data-live-search="true">
                                                            <?php foreach ($daoVenta->listarComboProveedor() as $cliente): ?>
                                                                <option data-cjson='<?= json_encode($cliente) ?>' value="<?= $cliente->proId ?>"><?= $cliente->nombre ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>                                            
                                                </div> 
                                                <div class="col-lg-3">
                                                    <label class="control-label col-xs-4">Contado</label>
                                                    <div class="col-xs-8 text-center">
                                                        <label class="checkbox form-control"><input type="checkbox" id="contado" checked >Contado ?</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="control-label col-xs-8">Desc Prov Habitual %?</label>
                                                    <div class="col-xs-4 text-center">
                                                        <input type="number" class="form-control" id="clienteAvitual" min="0" max="99" maxlength="99" value="0">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="control-label col-xs-4">Iva %?</label>
                                                    <div class="col-xs-8 text-center">
                                                        <input type="number" class="form-control" id="iva" min="8" max="24" maxlength="24" value="12">
                                                    </div>
                                                </div>

                                                <hr>
                                            </div> 
                                        </div>
                                    </div>
                                </form>
                            </div>                            
                        </div>
                        <div class="row-fluid">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4><strong>Detalle de Compra</strong></h4>  
                                </div>  
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <div class="input-group">                                                   
                                                    <input type="text" class="form-control" id="id_codigo"  placeholder="codigo" disabled/>
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-search"></i></span>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                                <select class="form-control producto" id="id_producto" style="overflow: scroll">
                                                    <option value=""></option>
                                                    <?php foreach ($daoVenta->listarComboArticulo() as $a): ?>
                                                        <option data-pjson='<?= json_encode($a) ?>'><?= $a->nombre ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-xs-2">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-signal"></i>
                                                </span>
                                                <input id="id_cantidad" class="form-control" type="number" placeholder="Cantidad" />
                                            </div>
                                        </div>
                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <div class="input-group">                                                   
                                                    <input type="text" class="form-control" id="id_stock"  placeholder="Stock" disabled/>
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-asterisk"></i></span>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-xs-offset-5">
                                            <button class="btn btn-primary btn-round" id="btn_agregar" type="button">
                                                <i class="glyphicon glyphicon-plus-sign"> </i>
                                                Agregar Producto
                                            </button>
                                        </div>
                                        <div class="col-xs-2 ">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-usd"></i>
                                                </span>
                                                <input id="id_precio" readonly class="form-control" type="number" placeholder="Costo" />
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!--</div> -->
                                    <table id="id_tabla" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Codigo</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>%Des</th>
                                                <th>Obser...</th>
                                                <th>Obser</th>
                                                <th>$Pvp</th>
                                                <th>$SubTotal</th>
                                                <th>*Desc.LB</th>
                                                <th>$Desc...</th>
                                                <th>$Total</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody id="id_det">

                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Observaciones </strong>
                                            <textarea rows="4" class="form-control">Ninguna</textarea> 
                                        </div> 
                                        <div class="col-xs-5 col-xs-offset-1">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <strong>TOTALES</strong> 
                                                </div>
                                                <div class="panel-body">
                                                    <div class="col-xs-4">
                                                        <div style="margin-top: 10px"> 
                                                            <h4 class="label label-danger" ><strong>Subtotal </strong></h4>                     
                                                        </div>
                                                        <div style="margin-top: 14px">
                                                            <h4 class="label label-primary"><strong>Decuento </strong></h4> 
                                                        </div>
                                                        <div style="margin-top: 14px">
                                                            <h4 class="label label-info"><strong>Impuesto </strong></h4> 
                                                        </div>
                                                        <div style="margin-top: 13px">
                                                            <h4 class="label label-warning"><strong>Total Pagar </strong></h4>
                                                        </div>
                                                    </div> 
                                                    <div class="col-xs-8">                                                
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-usd"></i>
                                                            </span>
                                                            <input id="id_subtotal2" readonly class="form-control" type="text" placeholder="0.00" />
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-usd"></i>
                                                            </span>
                                                            <input id="id_descuento2" readonly class="form-control" type="text" placeholder="0.00" />
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-usd"></i>
                                                            </span>
                                                            <input id="id_impuesto2" readonly class="form-control" type="text" placeholder="0.00" />
                                                        </div>

                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-usd"></i>
                                                            </span>
                                                            <input id="id_total2" readonly class="form-control" type="text" placeholder="0.00" />
                                                        </div>
                                                    </div>
                                                </div>                                      

                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col col-xs-4 col-xs-offset-8"> 
                                            <div class="col-xs-6">
                                                <button id="btn_grabarFactura" class="btn btn-success">
                                                    <i class="glyphicon glyphicon-save"></i> 
                                                    Guardar Factura
                                                </button> 
                                            </div> 
                                            <div class="col-xs-6">
                                                <button  class="btn btn-danger" type="reset" onClick="window.location = '../../app/vista/vCompra.php'">
                                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                                    Cancelar Factura
                                                </button> 
                                            </div> 
                                        </div>    
                                    </div> 
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <script src="../../static/js/vendor/jquery-1.11.2.js" type="text/javascript"></script>
        <script src="../../static/js/vendor/bootstrap.min_1.js" type="text/javascript"></script>
        <script src="../../static/js/vendor/chosen.jquery.min.js" type="text/javascript"></script>
        <script src="../../static/js/vendor/compraEstableAux2.js" type="text/javascript"></script>

        <script>
            $("#id_producto").chosen().change(function () {
                selectedValue = $(this).find("option:selected").val();
            });
            
            $("#id_proveedor").chosen().change(function () {
                selectedValue = $(this).find("option:selected").val();
            });
            
            $(function () {
                //$('#id_cantidad').attr('max', 0);estaba antes sellecionado 1
                $('#id_cantidad').attr('min', 0);

                $('.producto').on('change', function () {
                    var p = $('.producto option:selected').data('pjson');
                    //console.log(p); 
                    $('#id_precio').val(p.costo);
                    $('#id_codigo').val(p.artId);
                    $('#id_stock').val(p.stock.toString());
                    ///$('#id_cantidad').attr('max', p.stock.toString()); estaba antes sellecionado 1
                    $('#id_cantidad').val('0');
                    //document.getElementById("id_cantidad").max = p.stock.toString();
                });

                $('#btn_agregar').on('click', function () {
                    var item = new Object();
                    item.codigo = $('#id_codigo').val();
                    item.producto = $('#id_producto option:selected').text();
                    item.precio = parseFloat($('#id_precio').val());
                    item.cantidad = parseInt($('#id_cantidad').val());
                    item.stock = parseInt($('#id_stock').val());
                    item.descuentoPorcentaje = 0;
                    item.observacion = "...";
                    item.subtotal = 0.0;
                    item.descuento = 0.0;
                    item.descuentoLibras = 0;
                    
                    if (parseInt($('#id_cantidad').val()) > 0) {//parseInt($('#id_cantidad').val()) > 0 estaba antes sellecionado 1
                        app.add(item);
                    } else {
                        alert('Stock No Permitido');
                    }

                });
                
                $('#id_det').on("click", ".delete", function () {
                    var codigo = $(this).val();
                    if (app.eliminar(codigo)) {
                        app.listar();
                    }
                });
                
                $('#id_det').on('change', '.actualizarCantidad', function () {
                    var item = new Object();
                    item.codigo = $(this).data('codigo');
                    item.cantidad = parseInt($(this).val());
                    if (parseInt($(this).val()) > 0) {
                        app.actualizar(item);
                    } else {
                        alert('Stock no Permitido');
                    }
                    app.listar();
                });
                
                $('#id_det').on('change', '.actualizarDescuento', function () {
                    var item = new Object();
                    item.codigo = $(this).data('codigo');
                    item.descuentoPorcentaje = parseInt($(this).val());
                    if (parseInt($(this).val()) > -1) {
                        app.actualizarDescuento(item);
                    } else {
                        alert('Descuento no Permitido');
                    }
                     app.listar();
                });
                
                var observacion = "";
                var codigo = -1;
                $('#id_det').on('change','.cajaObservacion',function(){
                    observacion = $(this).val();
                    codigo = $(this).data('codigo');
                });
                
                $('#id_det').on('click', '.actualizarObservacion', function () {
                    if(codigo.toString() === $(this).data('codigo').toString()){
                        var item = new Object();
                        item.codigo = $(this).data('codigo');
                        item.observacion = observacion;
                        app.actualizarObservacion(item);
                        observacion = "";
                        codigo = -1;
                        app.listar();
                    }
                });
                
                $('#clienteAvitual').on('change',function(){
                    app.factura.aux = ($(this).val()/100);
                    app.listar();
                });

$('#iva').on('change',function(){
                    app.listar();
                });
                
                $('#btn_grabarFactura').on('click', function () {
                    if (app.factura.items.length === 0) {
                        alert('Tiene que seleccionar un articulo');
                    } else {
                        if (window.confirm("Esta Seguro de Guardar la Factura")) {
                            var c = $('#id_proveedor option:selected').data('cjson');
                            app.factura.proveedor = c.nombre;
                            app.factura.fecha = $('#fecha').val();
                            app.factura.contado = $('#contado').is(':checked');
                            app.factura.subtotal = $('#id_subtotal2').val();
                            app.factura.descuento = $('#id_descuento2').val();
                            app.factura.impuesto = $('#id_impuesto2').val();
                            app.factura.total = $('#id_total2').val();
                            app.factura.usuId = '<?= $user->usuId; ?>';
                            app.factura.comprador = '<?= $user->nombre; ?>';
                            app.factura.proId = c.proId;
                            console.log(app.factura);

                            $.ajax({
                                data: app.factura,
                                url: "../controlador/CtrCompra.php",
                                type: 'POST',
                                dataType: 'JSON',
                                beforeSend: function () {
                                    $('#id_cargando').removeClass('hidden');
                                },
                                success: function (data) {
                                    console.log(data);
                                    if (data.rs) {
                                        alert(data.error);

 window.open('../reporte/vReporteCompraFirtsPdf.php?numero='+parseInt(data.id),'ventana',"width=1000,height=500,s crollbars=NO");

                                        location = "vCompra.php";
                                    } else {
                                        alert(data.error);
                                    }
                                },
                                error: function () {
                                    $('#error').show().html("A ocurrido un error");
                                    $('#id_cargando').addClass('hidden');
                                    alert('Ha ocurrido un error');
                                }
                            }).done(function () {
                                $('#id_cargando').addClass('hidden');
                            });

                        }
                    }

                });

            });
        </script> 

    </body>
</html>