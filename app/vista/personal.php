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
                    <div class="col-md-12 text-center">
                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../../static/img/menu/per.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Registro de Personal</h3>
                                    </div>                                      
                                </div>                     
                            </div>
                            <div class="panel-body">
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
                                                <input type="hidden" name="action" value="<?= $action ?>">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <div class="item form-group hidden">
                                                    <label class="control-label col-xs-2">perId</label>   
                                                    <div class="col-xs-4">
                                                        <input name="perId" type="text" class="form-control" value="<?= $this->model->perId ?>">
                                                    </div>     
                                                </div> 
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Codigo</label>   
                                                    <div class="col-xs-4">
                                                        <input required="required" name="codigo" type="text" class="form-control" value="<?= $this->model->codigo ?>" placeholder="Ingrese Codigo">
                                                    </div>     
                                                </div> 
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Cedula</label>   
                                                    <div class="col-xs-4">
                                                        <input required="required" name="cedula" type="text" class="form-control" value="<?= $this->model->cedula ?>" placeholder="Ingrese Cedula">
                                                    </div>                                                        
                                                </div>                                                                                               
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Nombre</label>   
                                                    <div class="col-xs-7">
                                                        <input required="required" name="nombre" type="text" class="form-control" value="<?= $this->model->nombre ?>" placeholder="Ingrese Nombre">
                                                    </div>                                                        
                                                </div> 
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Apellido</label>   
                                                    <div class="col-xs-7">
                                                        <input required="required" name="apellido" type="text" class="form-control" value="<?= $this->model->apellido ?>" placeholder="Ingrese Apellido">
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
                                                    <label class="control-label col-xs-2">Genero</label>   
                                                    <div class="col-xs-3">
                                                        <label class="form-control"><input name="genero" id="generom" value="m" type="radio" class="" <?= $this->model->genero == "m" ? "checked" : "notchecked"; ?>>Masculino ?</label>
                                                        <label class="form-control"><input name="genero" id="generof" value="f" type="radio" class="" <?= $this->model->genero == "f" ? "checked" : "notchecked"; ?>>Femenino ?</label>
                                                    </div>                                                        
                                                </div> 

                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Telefono</label>   
                                                    <div class="col-xs-7">
                                                        <input required="required" name="telefono" type="text" class="form-control" value="<?= $this->model->telefono ?>" placeholder="Ingrese Telefono">
                                                    </div>                                                        
                                                </div> 
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Email</label>   
                                                    <div class="col-xs-7">
                                                        <input required="required" name="email" type="email" class="form-control" value="<?= $this->model->email ?>" placeholder="Ingrese Email">
                                                    </div>                                                        
                                                </div> 

                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Direccion</label>   
                                                    <div class="col-xs-7">
                                                        <input required="required" name="direccion" type="text" class="form-control" value="<?= $this->model->direccion ?>" placeholder="Ingrese Direccion"> 
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Provincia : </label>   
                                                    <div class="col-xs-5">
                                                        <select class="form-control id_provincia" name="selectProvincia" >
                                                            <option value="">Seleccione</option>
                                                            <?php foreach ($this->dao->listarComboProvincia() as $ciudad): ?>
                                                                <option value="<?= $ciudad->prvId ?>"><?= $ciudad->nombre ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>                                                        
                                                </div> 
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Ciudad : </label>   
                                                    <div class="col-xs-5">
                                                        <select class="form-control id_ciudad" name="selectCiudad" >

                                                        </select>
                                                    </div>                                                        
                                                </div> 
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Categoria Personal : </label>   
                                                    <div class="col-xs-5">
                                                        <select class="form-control id_categoriaPersonal" name="selectCategoriaPersonal" >
                                                            <?php foreach ($this->dao->listarComboCategoriaPersonal() as $ciudad): ?>
                                                                <option value="<?= $ciudad->ctgId ?>"><?= $ciudad->nombre ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>                                                        
                                                </div> 
                                                <div class="item form-group">
                                                    <label class="control-label col-xs-2">Fecha/Registro</label> 
                                                    <div class="col-xs-3">
                                                        <input disabled="" required="required" name="fechaRegistroorg" type="text" class="form-control" value="<?= ($this->model->fecharegistro == "" ? date("Y-m-d H:i:s") : $this->model->fecharegistro) ?>">
                                                        <input required="required" name="fechaRegistro" type="hidden" class="form-control" value="<?= ($this->model->fecharegistro == "" ? date("Y-m-d H:i:s") : $this->model->fecharegistro) ?>">
                                                    </div>  
                                                </div>  
                                                <div class="form-group">
                                                    <label class="control-label col-xs-2">Estado</label>
                                                    <div class="col-xs-3 text-center">
                                                        <label class="checkbox form-control"><input type="checkbox" name="estado" <?= ($this->model->estado == true ? "checked" : "notchecked") ?> >Activo ?</label>
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
                                                            <button type="reset" onClick="window.location = '../../app/inicio/wpersonal.php?action=tabla'" class="btn btn-danger">
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
        </div>
    </article>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
                                                                $(function () {

                                                                    if (parseInt(('<?php echo (integer) $this->model->prvId; ?>').toString()) !== 0) {
                                                                        $.ajax({
                                                                            url: 'personalAjax.php',
                                                                            type: 'get',
                                                                            data: {'prvId': '<?php echo $this->model->prvId; ?>', 'action': 'buscarCiudad'},
                                                                            dataType: 'json'
                                                                        }).done(function (data) {
                                                                            console.log(data);
                                                                            for (var i in data) {
                                                                                var option = '<option value=' + parseInt(data[i].ciuId.toString()) + ' >' + data[i].nombre + '</option>';
                                                                                $('.id_ciudad').append(option);
                                                                            }
                                                                            $('.id_provincia').val(parseInt('<?php echo $this->model->prvId; ?>'));
                                                                            $('.id_ciudad').val('<?php echo $this->model->ciuId; ?>');
                                                                        });

                                                                    }

                                                                    $('.id_provincia').on('change', function () {
                                                                        $('.id_ciudad').html('');
                                                                        $.ajax({
                                                                            url: 'clienteAjax.php',
                                                                            type: 'get',
                                                                            data: {'prvId': $(this).val(), 'action': 'buscarCiudad'},
                                                                            dataType: 'json'
                                                                        }).done(function (data) {
                                                                            for (var i in data) {
                                                                                var option = '<option value="' + data[i].ciuId + '">' + data[i].nombre + '</option>';
                                                                                $('.id_ciudad').append(option);
                                                                            }
                                                                        });
                                                                    });

                                                                    $('.id_categoriaPersonal').val('<?php echo $this->model->ctgId; ?>');

                                                                    $('#frm-provincia').on({
                                                                        submit: function (event) {
                                                                            event.preventDefault();
                                                                            $.ajax({
                                                                                url: 'personalAjax.php',
                                                                                type: 'POST',
                                                                                data: new FormData(this),
                                                                                contentType: false,
                                                                                processData: false,
                                                                                dataType: 'json'
                                                                            }).done(function (data) {
                                                                                if (data.resp) {
                                                                                    alert("Registro Guardado Correctamente");
                                                                                    window.location = '../inicio/wpersonal.php?action=tabla';
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



