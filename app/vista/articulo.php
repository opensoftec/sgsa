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
                                        <img src="../../static/img/menu/articulo.png" height="65">
                                    </div>
                                    <div class="col col-xs-5">
                                        <h3>Registro de Productos</h3>
                                    </div>                                      
                                </div>                     

                            </div>
                            <div class="panel-body text-center">
                                <div class="col col-md-3">
                                    <div class="panel panel-default panel-success">                                        
                                        <div class="panel-heading">
                                            Imagen
                                        </div>
                                        <div class="panel-body">
                                            <div class="text-center" style="width: 200px; height: 200px;">
                                                <img id="presentaimg" formaction="formpersonal" src="<?= $this->model->img == '' ? '../../static/img/img/avatar.png' : $this->model->img ?>" style="width: 250px; height: 200px;">                                              
                                            </div> 
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="col col-lg-9">
                                    <div class="panel panel-default panel-primary" style="background: #eee">
                                        <div class="panel-heading">
                                            <strong>Ficha de Registro</strong>
                                        </div>
                                        <div class="panel-body">                 
                                            <form id="frm-provincia" class="form-horizontal">
                                                <div class="row-fluid">
                                                    <input type="hidden" name="action" value="<?= $action ?>">
                                                    <input type="hidden" name="id" value="<?= $id ?>">
                                                    <div class="item form-group hidden">
                                                        <label class="control-label col-xs-2">artId</label>   
                                                        <div class="col-xs-4">
                                                            <input name="artId" type="text" class="form-control" value="<?= $this->model->artId ?>">
                                                        </div>     
                                                    </div> 
                                                    <div class="item form-group" style="display:none;">
                                                        <label class="control-label col-xs-2">Codigo</label>   
                                                        <div class="col-xs-4">
                                                            <input required="required" name="codigo" type="text" class="form-control" value="<?= $this->model->codigo ?>"  onkeypress="return controltag(event)">
                                                        </div>     
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Nombre</label>   
                                                        <div class="col-xs-7">
                                                            <input placeholder="nombre" required="required" name="nombre" type="" class="form-control" value="<?= $this->model->nombre ?>" >
                                                        </div>                                                        
                                                    </div> 

                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Descripción</label>   
                                                        <div class="col-xs-7">
                                                            <textarea  required="required" name="descripcion" type="" class="form-control" placeholder="Ingrese Descripcion"><?= $this->model->descripcion ?></textarea>
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Categoria</label>   
                                                        <div class="col-xs-7">
                                                            <select name="selectCategoria" class="form-control  id_categoria" data-live-search="true">
                                                                <?php foreach ($this->dao->listarComboCategoriaArticulo() as $categoriaPerosonal): ?>
                                                                    <option value="<?= $categoriaPerosonal->ctgId ?>"><?= $categoriaPerosonal->nombre ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Ubicación</label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="ubicacion" type="text" class="form-control" value="<?= $this->model->ubicacion; ?>" placeholder="Ingrese Ubicacion">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="form-group" style="display:none;">
                                                        <label class="control-label col-xs-2">Marca</label>   
                                                        <div class="col-xs-3">
                                                            <input placeholder="Ingrese Marca"  name="marca" type="text" class="form-control" value="<?= $this->model->marca; ?>" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}">
                                                        </div>   

                                                        <label class="control-label col-xs-2">Modelo</label>   
                                                        <div class="col-xs-4">
                                                            <input placeholder="Ingrese Modelo"  name="modelo" type="text" class="form-control" value="<?= $this->model->modelo; ?>" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}">
                                                        </div> 
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-2">Seleccione Una Imagen</label> 
                                                        <div class="col-xs-6">
                                                            <input type="hidden" id="url" name="url" value="<?= $this->model->img ?>"/> 
                                                            <input id="img" name="img" formaction="formpersonal" type="file" class="form-control">  
                                                        </div>
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Presentación</label>   
                                                        <div class="col-xs-5">
                                                            <input required="required" name="presentacion" type="text" class="form-control" value="<?= $this->model->presentacion; ?>" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Proveedor</label>   
                                                        <div class="col-xs-5">
                                                            <select name="selectProveedor" class="form-control id_proveedor" data-live-search="true">
                                                                <?php foreach ($this->dao->listarComboProveedor() as $categoriaPerosonal): ?>
                                                                    <option value="<?= $categoriaPerosonal->proId ?>"><?= $categoriaPerosonal->nombre ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-2">Fecha/Registro</label> 
                                                        <div class="col-xs-3">
                                                            <div class="input-group">
                                                                <input required="required" name="fechaRegistro" type="text" class="form-control" value="<?= ($this->model->fecharegistro == "" ? date("Y-m-d H:i:s") : $this->model->fecharegistro) ?>" >
                                                            </div>  
                                                        </div>
                                                        <label class="control-label col-xs-2">Fecha/Alta</label> 
                                                        <div class="col-xs-3">
                                                            <div class="input-group">
                                                                <input required="required" name="fechaAlta" type="text" class="form-control" value="<?= ($this->model->fecharegistro == "" ? date("Y-m-d H:i:s") : $this->model->fecha_alta) ?>" >
                                                            </div>  
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-2">Costo</label> 
                                                        <div class="col-xs-3">
                                                            <div class="input-group">
                                                                <input required="required" name="costo" class="form-control" type="" placeholder="0.00" step="any"  value="<?= $this->model->costo; ?>">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                            </div>  
                                                        </div>
                                                        <label class="control-label col-xs-2">Precio</label> 
                                                        <div class="col-xs-3">
                                                            <div class="input-group">
                                                                <input required="required" name="precio" class="form-control" type="number" placeholder="0.00" step="any"  value="<?= $this->model->precio; ?>">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <div class="col-xs-3 hidden" >
                                                            <div class="input-group">
                                                                <input required="required" name="pvp" class="form-control" type="number" placeholder="0.00" value="0">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                            </div>  
                                                        </div>
                                                        <label class="control-label col-xs-2">iva</label> 

                                                        <div class="col-xs-3 text-center">
                                                            <label class="checkbox form-control"><input type="checkbox" name="iva" <?= ($this->model->iva == true ? "checked" : "notchecked") ?> >Iva ?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" form-group">
                                                    <label class="control-label col-xs-2">Stock</label> 
                                                    <div class="col-xs-3">
                                                        <div class="input-group">
                                                            <input required="required" name="stock" class="form-control" type="number" placeholder="0.00" value="<?= $this->model->stock; ?>">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                                        </div>  
                                                    </div>
                                                    <label class="control-label col-xs-2">Stock Minimo</label> 
                                                    <div class="col-xs-3">
                                                        <div class="input-group">
                                                            <input required="required" name="stockMinimo" class="form-control" type="number" placeholder="0.00" value="<?= $this->model->stock_minimo; ?>">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Observación</label>   
                                                    <div class="col-xs-7">
                                                        <textarea required="required" name="observacion" class="form-control" ><?= $this->model->observacion ?></textarea>
                                                    </div>                                                        
                                                </div> 
                                                <div class="form-group">
                                                    <label class="control-label col-xs-2">Estado</label>
                                                    <div class="col-xs-3 text-center">
                                                        <label class="checkbox form-control"><input type="checkbox" name="activo" <?= ($this->model->activo == true ? "checked" : "notchecked") ?> >Activo ?</label>
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
                                                            <button type="reset" onClick="window.location = '../../app/inicio/warticulo.php?action=tabla'" class="btn btn-danger">
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
                      function controltag(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0||tecla==9)  return true;
       // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }
            $('input:text[name=nombre]').keypress(function (key) {
            window.console.log(key.charCode)
            if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 45) //retroceso
                && (key.charCode != 241) //ñ
                 && (key.charCode != 209) //Ñ
                 && (key.charCode != 32) //espacio
                 && (key.charCode != 225) //á
                 && (key.charCode != 233) //é
                 && (key.charCode != 237) //í
                 && (key.charCode != 243) //ó
                 && (key.charCode != 250) //ú
                 && (key.charCode != 193) //Á
                 && (key.charCode != 201) //É
                 && (key.charCode != 205) //Í
                 && (key.charCode != 211) //Ó
                 && (key.charCode != 218) //Ú
 
                )
                return false;
        });
        $('textarea[name=descripcion]').keypress(function (key) {
            window.console.log(key.charCode)
            if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 45) //retroceso
                && (key.charCode != 241) //ñ
                 && (key.charCode != 209) //Ñ
                 && (key.charCode != 32) //espacio
                 && (key.charCode != 225) //á
                 && (key.charCode != 233) //é
                 && (key.charCode != 237) //í
                 && (key.charCode != 243) //ó
                 && (key.charCode != 250) //ú
                 && (key.charCode != 193) //Á
                 && (key.charCode != 201) //É
                 && (key.charCode != 205) //Í
                 && (key.charCode != 211) //Ó
                 && (key.charCode != 218) //Ú
 
                )
                return false;
        });
        
        $('input:text[name=marca]').keypress(function (key) {
            window.console.log(key.charCode)
            if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 45) //retroceso
                && (key.charCode != 241) //ñ
                 && (key.charCode != 209) //Ñ
                 && (key.charCode != 32) //espacio
                 && (key.charCode != 225) //á
                 && (key.charCode != 233) //é
                 && (key.charCode != 237) //í
                 && (key.charCode != 243) //ó
                 && (key.charCode != 250) //ú
                 && (key.charCode != 193) //Á
                 && (key.charCode != 201) //É
                 && (key.charCode != 205) //Í
                 && (key.charCode != 211) //Ó
                 && (key.charCode != 218) //Ú
 
                )
                return false;
        });
        
        $('input:text[name=modelo]').keypress(function (key) {
            window.console.log(key.charCode)
            if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 45) //retroceso
                && (key.charCode != 241) //ñ
                 && (key.charCode != 209) //Ñ
                 && (key.charCode != 32) //espacio
                 && (key.charCode != 225) //á
                 && (key.charCode != 233) //é
                 && (key.charCode != 237) //í
                 && (key.charCode != 243) //ó
                 && (key.charCode != 250) //ú
                 && (key.charCode != 193) //Á
                 && (key.charCode != 201) //É
                 && (key.charCode != 205) //Í
                 && (key.charCode != 211) //Ó
                 && (key.charCode != 218) //Ú
 
                )
                return false;
        });
        $('input:text[name=presentacion]').keypress(function (key) {
            window.console.log(key.charCode)
            if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 45) //retroceso
                && (key.charCode != 241) //ñ
                 && (key.charCode != 209) //Ñ
                 && (key.charCode != 32) //espacio
                 && (key.charCode != 225) //á
                 && (key.charCode != 233) //é
                 && (key.charCode != 237) //í
                 && (key.charCode != 243) //ó
                 && (key.charCode != 250) //ú
                 && (key.charCode != 193) //Á
                 && (key.charCode != 201) //É
                 && (key.charCode != 205) //Í
                 && (key.charCode != 211) //Ó
                 && (key.charCode != 218) //Ú
 
                )
                return false;
        });
                                                                $(function () {

                                                                    $('.id_proveedor').val('<?php echo $this->model->proId; ?>');
                                                                    $('.id_categoria').val('<?php echo $this->model->ctgId; ?>');
                                                                    $('#frm-provincia').on({
                                                                        submit: function (event) {
                                                                            event.preventDefault();
                                                                            $.ajax({
                                                                                url: 'articuloAjax.php',
                                                                                type: 'POST',
                                                                                data: new FormData(this),
                                                                                contentType: false,
                                                                                processData: false,
                                                                                dataType: 'json'
                                                                            }).done(function (data) {
                                                                                if (data.resp) {
                                                                                    alert("Registro Guardado Correctamente");
                                                                                    window.location = '../inicio/warticulo.php?action=tabla';
                                                                                } else {
                                                                                    alert(data.error);
                                                                                }
                                                                            });
                                                                            return false;
                                                                        }
                                                                    });

                                                                    $('#img').on('change', function () {
                                                                        var rutaimg = $(this).val();
                                                                        var extension = rutaimg.substring(rutaimg.length - 3, rutaimg.length);
                                                                        if (extension.toLowerCase() === 'png' || extension.toLowerCase() === 'jpg') {
                                                                            $('#presentaimg').fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
                                                                        } else {
                                                                            $(this).val('');
                                                                            $('#presentaimg').fadeIn("fast").attr('src', '../../static/img/img/avatar.png');
                                                                            alert('Ingrese solo imágenes');
                                                                        }
                                                                    });

                                                                });
        </script>

    </body>
</html>
