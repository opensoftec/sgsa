<?php
session_start();
session_destroy();

header('location: http://localhost:88/ProyectoCarrito/app/inicio/login.php');