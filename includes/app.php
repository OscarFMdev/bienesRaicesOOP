<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a la base de datos
$db = conectarDB();



use App\Propiedad;


//Se usan dos puntos porque es static
Propiedad::setDB($db); //Todos los objetos creados como instancia de Propiedad, van a tener la referencia a la base de datos



