<!DOCTYPE html>
<html>
    <head><meta charset="euc-jp">
        
        <title>SGSC Web </title>
        <link href="../../static/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/login.css" rel="stylesheet" type="text/css"/>
        <style>
            body{
                background-image: url('../../static/img/menu/fondo_celulares2.jpg');
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100%,100%;
                background-color: #464646;
            }
            .logomain:hover{
                background: #b1dcf8;
                cursor: pointer;
            }
            .cuentahover:hover{
                background-color: #b1dcf8;
            }
            .clavehover:hover{
                background: #b1dcf8;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-blue navbar-fixed-top" role="navigation" style="background: #3f51b5  ; padding-bottom: 1px; padding-top: 2px;" ><!--#3f51b5  #ededf4   width="280px" height="50px"  <img style="position: fixed; margin-top: -37px" class="img-rounded" width="400px" height="115px" src="../../static/img/menu/logomaintrasparente.png" />-->
            <div class="navbar-header">
                <div class="left_col">
                    <div class="col-lg-12">
                        <div class="col-lg-3" >
                            <!--<img class="img-rounded logomain" width="100px" height="60px" src="../../static/img/menu/iconofinal.png" /> -->
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="span_3_of_2">
            <div >
                <div class="row-fluid">
                    <div class="col-lg-12" style="margin-top: 35px;">
                        <div class="col-lg-offset-7">
                            <div class="card card-container">
                                <div class="row-fluid text-center">
                                    <div id='loading' hidden="">
                                        <img src="../../static/img/menu/loading.gif" >
                                    </div>
                                </div>
                                <h4 class="text-center">Ingresa a SGSC</h4>
                                <img id="profile-img" class="profile-img-card" src="../../static/img/menu/avatar.png" />
                                <p id="profile-name" class="profile-name-card"></p>
                                <form class="form-signin" method="POST" id="frm-login" action="../controlador/CtrUsuario.php">
                                    <div style="display: none" class="alert alert-danger alert-dismissable" id="error"></div>
                                    <input type="text" id="cuenta" name="cuenta" class="form-control cuentahover" placeholder="tu Usuario jefferson@gmail.com" required autofocus>
                                    <input type="password" id="clave" name="clave" class="form-control clavehover" placeholder="Password ********" required>               
                                    <button id="btnLogin" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">
                                        <span id="caption">Iniciar Session</span>
                                    </button>
                                </form><!-- /form -->
                                <p style="margin-top: 15px; font-size: 12px;">
                                    En caso de problemas, contactarce a 
                                    <a href="#">opensoftec@gmail.com</a>
                                </p>
                                <p style="margin-top: -5px; font-size: 12px;">
                                    <a href="#">Olvido su cuenta o clave? </a>
                                </p>
                            </div><!-- /card-container -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../static/js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="../../static/js/vendor/jquery.min2.0.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('.logomain').on('click', function () {
                    alert();
                });
                $('#frm-login').on({
                    submit: function (e) {
                        e.preventDefault();
                        $.ajax({
                            url: "iniciarsession.php",
                            type: 'POST',
                            data: {cuenta: $('#cuenta').val(), clave: $('#clave').val(), action: 'login'},
                            dataType: 'json',
                            beforeSend: function (xhr) {
                                $('#loading').show('slow');
                            }
                        }).done(function (data) {
                            if (data.resp) {
                                window.location = 'admin.php';
                            } else {
                                alert('el usuario incorrecto');
                            }
                            $('#loading').hide('fast');
                        });
                        return false;
                    }
                });
            });
        </script>
    </body>
</html>