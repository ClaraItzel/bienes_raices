<?php
function conectarDB() : mysqli{
    $db= new mysqli('localhost','root','','bienes_raices');
    $db->set_charset("utf8");
    if (!$db) {
       
        echo'Error no se conecto';
        exit;
    }

    return $db;

}