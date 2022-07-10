<?php
if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/jpg")|| ($_FILES["file"]["type"] == "image/JPG")|| ($_FILES["file"]["type"] == "image/pjpeg"))&& ($_FILES["file"]["size"] < 1000000000)) { 
    if (file_exists("../../static/" . $_FILES["file"]["name"])) {
        echo $_FILES["file"]["name"] . " already exists. ";
    } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../static/" . $_FILES["file"]["name"]);
        $nombreArchivo = $_FILES["file"]["name"];
    }
} else {
    echo "Archivo invalido, Solamente archivos GIF, JPG y PNG son permitidos";
}


