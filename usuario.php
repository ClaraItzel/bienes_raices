<?php
//Crear conexión
require 'includes/app.php';
$db= conectarDB();
//Crear email y psw
$email="correo@correo.com";
$pass='1234';
$passHash= password_hash($pass, PASSWORD_BCRYPT);
//Query para crear user
$query="INSERT INTO usuarios (email,password)
        VALUES ('${email}', '${passHash}')";

mysqli_query($db,$query);
//agregar a db
?>