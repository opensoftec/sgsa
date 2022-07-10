<?php
require '../../app/config/config.php';
require '../../app/data/DataConection.php';
require '../../app/modelo/Ciudad.php';
require '../../app/modelo/Cliente.php';
require '../../app/modelo/Venta.php';
require '../../app/interfaz/IVenta.php';
require '../../app/dao/VentaDao.php';
require '../../app/modelo/Provincia.php';
require '../../app/modelo/Categoria_articulo.php';
require '../../app/modelo/Proveedor_contacto.php';
require '../../app/modelo/Proveedor.php';
require '../../app/modelo/Articulo.php';

$daoVenta = new VentaDao();

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
            <?php require '../../app/inicio/menutop.php'; ?>
        </header>
        <article id="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="breadcrumb">
                                <li><a href="../../app/inicio/admin.php">Inicio</a><span class="divider"></span></li>
                                <li><a href="" class="active">Venta</a> <span class="divider">/</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading" style="padding-bottom: 0px">
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/caja.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Venta</h3>
                                    </div>                                    
                                </div>
                                <br>
                            </div>
                            <div class="panel-body">
                                <form id="formulario" class="form-horizontal" action="" method="POST">
                                    <div class="row-fluid">
                                        <div class="col-lg-4">
                                            <label class="control-label col-xs-4">Num. Venta</label>   
                                            <div class="col-xs-8">
                                                <input id="ventIdaux" type="text" class="form-control" value="<?= $daoVenta->codigoMaximo() ?>" disabled>
                                                <input id="ventId" type="hidden" class="form-control" value="<?= $daoVenta->codigoMaximo() ?>">
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
                                                <input required="required" id="fechaaux" type="text" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" disabled>
                                                <input required="required" id="fecha" type="hidden" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" >
                                            </div>
                                        </div>  
                                    </div>      
                                    <div class="col-lg-12">
                                        <hr>
                                        <div class="panel panel-warning">
                                            <div class="panel-heading">
                                                <h4>Datos de Pedido</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-lg-4">
                                                    <label class="control-label col-xs-3">Cliente</label>   
                                                    <div class="col-xs-9">
                                                        <select id="id_cliente" class="form-control" data-live-search="true">
                                                            <?php foreach ($daoVenta->listarComboCliente() as $cliente): ?>
                                                                <option data-cjson='<?= json_encode($cliente) ?>' value="<?= $cliente->cliId ?>"><?= $cliente->nombre ?> <?= $cliente->apellido ?></option>
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
                                                <div class="col-lg-5">
                                                    <label class="control-label col-xs-5">Numero de Orden</label>   
                                                    <div class="col-xs-7">
                                                        <input required="required" id="numeroOrden" type="number" class="form-control" value="">
                                                    </div>                                                        
                                                </div>
                                                <hr>
                                                <hr>
                                                <div class="col-lg-9">
                                                    <label class="control-label col-xs-3">La venta se Encuentra</label>   
                                                    <div class="col-xs-4">
                                                        <label class="form-control"><input name="entregado" value="m" id="entregados" type="radio" class="" checked>Entregada?</label>
                                                    </div> 
                                                    <div class="col-xs-4">
                                                        <label class="form-control"><input name="entregado" value="f" id="entregadon" type="radio" class=""notchecked>NoEntregada?</label>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-3">
                                                    <label class="control-label col-xs-4">Iva %?</label>
                                                    <div class="col-xs-8 text-center">
                                                        <input type="number" class="form-control" id="iva" min="0" max="24" maxlength="99" value="0">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </form>
                            </div>                            
                        </div>
                        <div class="row-fluid">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4><strong>Detalle de Venta</strong></h4>  
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
                                                <input id="id_precio" readonly class="form-control" type="number" placeholder="Precio" />
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
                                                <th>Cant</th>
                                                <th>Pvp</th>
                                                <th>Total</th>
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
                                                        <div style="margin-top: 10px">
                                                            <h4 class="label label-info"><strong>Impuesto </strong></h4> 
                                                        </div>
                                                        <div style="margin-top: 10px">
                                                            <h4 class="label label-warning"><strong>Total Pagar </strong></h4>
                                                        </div>
                                                    </div> 
                                                    <div class="col-xs-8">                                                
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-usd"></i>
                                                            </span>
                                                            <input id="id_subtotal2" readonly class="form-control" type="number" placeholder="0.00" step="any" />
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-usd"></i>
                                                            </span>
                                                            <input id="id_impuesto2" readonly class="form-control" type="number" placeholder="0.00" step="any" />
                                                        </div>

                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-usd"></i>
                                                            </span>
                                                            <input id="id_total2" class="form-control" type="number" placeholder="0.00" step="any" />
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
                                                <button  class="btn btn-danger" type="reset" onClick="window.location = '../../app/vista/vVentaEstable.php'">
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
        <script src="../../static/js/vendor/ventaEstable.js" type="text/javascript"></script>

        <script>
            $("#id_producto").chosen().change(function () {
                selectedValue = $(this).find("option:selected").val();
            });

            $(function () {
                $('#id_cantidad').attr('max', 0);
                $('#id_cantidad').attr('min', 0);

$('#iva').on('change',function(){
                    app.listar();
                });


                $('.producto').on('change', function () {
                    var p = $('.producto option:selected').data('pjson');
                    //console.log(p); 
                    $('#id_precio').val(p.precio);
                    $('#id_codigo').val(p.artId);
                    $('#id_stock').val(p.stock.toString());
                    $('#id_cantidad').attr('max', p.stock.toString());
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
                    if (parseInt($('#id_cantidad').val()) > 0 && parseInt($('#id_cantidad').val()) <= (document.getElementById("id_cantidad").max)) {
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
                $('#id_det').on('change', '.actualizar', function () {
                    var item = new Object();
                    item.codigo = $(this).data('codigo');
                    item.cantidad = parseInt($(this).val());
                    if (parseInt($(this).val()) <= parseInt($(this).attr('max')) && parseInt($(this).val()) > 0) {
                        app.actualizar(item);
                        app.listar();
                    } else {
                        alert('Stock no Permitido');
                        app.listar();
                    }
                });

                $('#btn_grabarFactura').on('click', function () {

                    if (app.factura.items.length === 0) {
                        alert('Tiene que seleccionar un articulo');
                    } else {
                        if (window.confirm("Esta Seguro de Guardar la Factura")) {
                            var c = $('#id_cliente option:selected').data('cjson');
                            app.factura.venId = $('#ventId').val();
                            app.factura.numero = 0;
                            app.factura.numero_orden = $('#numeroOrden').val();
                            app.factura.cliente = c.nombre;
                            app.factura.fecha = $('#fecha').val();
                            app.factura.tipo = '';
                            app.factura.contado = $('#contado').is(':checked');
                            app.factura.entregado = ($('#entregados').is(':checked') ? 's' : 'n');
                            app.factura.subtotal = $('#id_subtotal2').val();
                            app.factura.descuento = '0';
                            app.factura.impuesto = $('#id_impuesto2').val();
                            app.factura.total = $('#id_total2').val();
                            app.factura.usuId = '<?= $user->usuId; ?>';
                            app.factura.vendedor = '<?= $user->nombre; ?>';
                            app.factura.cliId = c.cliId;
                            console.log(app.factura);

                            $.ajax({
                                data: app.factura,
                                url: "../../app/controlador/CtrVentaEstable_1.php",
                                type: 'POST',
                                dataType: 'JSON',
                                beforeSend: function () {
                                    $('#id_cargando').removeClass('hidden');
                                },
                                success: function (data) {
                                    if (data.rs) {
                                        alert(data.error);
                                        window.open('../reporte/vReporteVentaFirtsPdf.php?numero='+parseInt(data.id),'ventana',"width=1000,height=500,s crollbars=NO");
                                        location = "vVentaEstable.php";
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