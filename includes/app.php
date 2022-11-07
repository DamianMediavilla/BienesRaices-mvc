<?php

require __DIR__ . '/../vendor/autoload.php';
require 'funciones.php';
require 'config/database.php';
//requiere .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeload();



$db=conectarDb();

use Model\ActiveRecord;

ActiveRecord::setDB($db); 

