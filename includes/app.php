<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

$db=conectarDb();

use Model\ActiveRecord;

ActiveRecord::setDB($db); 

