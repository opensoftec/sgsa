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
                                        <img src="../../static/img/menu/cliente.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Registro de Clientes</h3>
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
                                                        <label class="control-label col-xs-2">cliId</label>   
                                                        <div class="col-xs-4">
                                                            <input name="cliId" type="text" class="form-control" value="<?= $this->model->cliId ?>">
                                                        </div>     
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Codigo</label>   
                                                        <div class="col-xs-4">
                                                            <input required="required" name="codigo" type="text" class="form-control" value="<?= $this->model->codigo ?>" placeholder="Ingrese Codigo" onkeypress="return controltag(event)">
                                                        </div>     
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Cedula</label>   
                                                        <div class="col-xs-4">
                                                            <input required="required" id="_cedula" name="cedula" type="text" class="form-control" value="<?= $this->model->cedula ?>" placeholder="Ingrese Cedula" pattern="[0-9]{10}" onkeypress="return controltag(event)">
                                                        </div>                                                        
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Cliente Comercial</label>
                                                        <div class="col-xs-3 text-center">
                                                            <label class="checkbox form-control"><input type="checkbox" name="big"   <?= ($this->model->big == true ? "checked" : "notchecked") ?>  >Cliente Comercial ?</label>
                                                        </div>
                                                    </div>                                                
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Nombre</label>   
                                                        <div class="col-xs-7">
                                                            <input type="text" required="required" name="nombre"  class="form-control" value="<?= $this->model->nombre ?>" placeholder="Ingrese Nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Apellido</label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="apellido" type="text" class="form-control" value="<?= $this->model->apellido ?>" placeholder="Ingrese apellido" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}">
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Genero</label>   
                                                        <div class="col-xs-3">
                                                            <label class="form-control"><input name="genero" id="generom" value="m" type="radio" class="" <?= $this->model->genero == "m" ? "checked" : "notchecked"; ?>>Masculino ?</label>
                                                            <label class="form-control"><input name="genero" id="generof" value="f" type="radio" class="" <?= $this->model->genero == "f" ? "checked" : "notchecked"; ?>>Femenino ?</label>
                                                        </div>                                                        
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-2">Seleccione Una Imagen</label> 
                                                        <div class="col-xs-6">
                                                            <input type="hidden" id="url" name="url" value="<?= $this->model->img?>"/> 
                                                            <input id="img" name="img" formaction="formpersonal" type="file" class="form-control">  
                                                        </div>
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-xs-2">Telefono</label>   
                                                        <div class="col-xs-7">
                                                            <input required="required" name="telefono" type="text" class="form-control" value="<?= $this->model->telefono ?>" placeholder="Ingrese Telefono" pattern="[0-9]{10}" onkeypress="return controltag(event)">
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
                                                                <option value="">Seleccione - Provincia</option>
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
                                                            <button type="reset" onClick="window.location = '../../app/inicio/wcliente.php?action=tabla'" class="btn btn-danger">
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
            function validaCedula(cedula){
                array = cedula.split( "" );
                num = array.length;
                    if ( num == 10 )
                        {
                            total = 0;
                            digito = (array[9]*1);
                            for( i=0; i < (num-1); i++ )
                            {
                                    mult = 0;
                                    if ( ( i%2 ) != 0 ) {
                                    total = total + ( array[i] * 1 );
                                    }
                                else
                                {
                                    mult = array[i] * 2;
                                        if ( mult > 9 )
                                        total = total + ( mult - 9 );
                                        else
                                            total = total + mult;
                                }
                            }
                    decena = total / 10;
                    decena = Math.floor( decena );
                    decena = ( decena + 1 ) * 10;
                    final = ( decena - total );
                        if ( ( final == 10 && digito == 0 ) || ( final == digito ) ) {
//                            alert( "La c\xe9dula ES v\xe1lida!!!" );
                            return true;
                        }
                        else
                        {
                            alert( "la cedula no es valida" );
                            return false;
                        }
                    }
                    else
                        {
                            alert("la cedula no debe tener menos ni mas de 10 digitos");
                            return false;
                    }   
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
        
        $('input:text[name=apellido]').keypress(function (key) {
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

                                                                    if (parseInt(('<?php echo (integer) $this->model->prvId; ?>').toString()) !== 0) {
                                                                        $.ajax({
                                                                            url: 'clienteAjax.php',
                                                                            type: 'get',
                                                                            data: {'prvId': '<?php echo $this->model->prvId; ?>', 'action': 'buscarCiudad'},
                                                                            dataType: 'json'
                                                                        }).done(function (data) {
                                                                            console.log(data);
                                                                            for (var i in data) {
                                                                                //alert(ob.nombre);
                                                                                var option = '<option value="' + data[i].ciuId + '">' + data[i].nombre + '</option>';
                                                                                $('.id_ciudad').append(option);
                                                                            }
                                                                            $('.id_provincia').val('<?php echo $this->model->prvId; ?>');
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
                                                                            console.log(data);
                                                                            for (var i in data) {
                                                                                var option = '<option value="' + data[i].ciuId + '">' + data[i].nombre + '</option>';
                                                                                $('.id_ciudad').append(option);
                                                                            }
                                                                        });
                                                                    });

                                                                    $('#frm-provincia').on({
                                                                        submit: function (event) {
                                                                            if(validaCedula($(_cedula).val())==true){
                                                                            event.preventDefault();
                                                                            $.ajax({
                                                                                url: 'clienteAjax.php',
                                                                                type: 'POST',
                                                                                data: new FormData(this),
                                                                                contentType: false,
                                                                                processData: false,
                                                                                dataType: 'json'
                                                                            }).done(function (data) {
                                                                                if (data.resp) {
                                                                                    alert("Registro Guardado Correctamente");
                                                                                    window.location = '../inicio/wcliente.php?action=tabla';
                                                                                } else {
                                                                                    alert(data.error);
                                                                                }
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                            });
                                                                            }
                                                                            else{
                                                                                alert("La cedula es incorrecta, verifique");
                                                                            } 
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



