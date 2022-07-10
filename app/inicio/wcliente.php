<?php
require '../modelo/Login.php';
 if(session_id()==''){
     session_start();    
 }
 if(empty($_SESSION['_USER_'])){
     header('location:login.php');
     exit();
 } 
 $user = $_SESSION['_USER_']; 
?>
<!DOCTYPE html>
<html>
    <body>
        <header>
            <?php require './menutop.php';?>
        </header>
        <?php
            require '../controlador/CtrCliente.php';
            $ctrUsuario = new CtrCliente();
            $ctrUsuario->view();                 
        ?>
    </body>
</html>
