<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__. '/../vendor/autoload.php';
//Conectando a db
$db= conectarDB();
use App\ActiveRecord;

ActiveRecord::setDb($db);



