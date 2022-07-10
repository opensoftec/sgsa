<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../../static/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../static/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <section>
            <div class="container">
                <div class="card card-container">
                    <img id="profile-img" class="profile-img-card" src="../../static/img/avatar.png" />
                    <p id="profile-name" class="profile-name-card"></p>
                    <form class="form-signin" method="POST" id="frm-login" action="../controlador/CtrUsuario.php">
                        <div style="display: none" class="alert alert-danger alert-dismissable" id="error"></div>
                        <input type="text" id="cuenta" name="cuenta" class="form-control" placeholder="tu Usuario" required autofocus>
                        <input type="password" id="clave" name="clave" class="form-control" placeholder="Password" required>               
                        <button id="btnLogin" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">
                            <span id="caption">Iniciar Session</span>
                        </button>
                        <div id='loading' hidden="">
                            <img src="../../static/img/menu/loading3.gif" >
                        </div>
                    </form><!-- /form -->
                </div><!-- /card-container -->
            </div>
        </section>
        <script src="../../static/js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="../../static/js/vendor/jquery.min2.0.js" type="text/javascript"></script>
        <script>
            $(function () {
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