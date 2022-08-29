<?php

session_start();

$_SESSION = []; //Para cerrar sesión podemos hacer un arreglo vacío

var_dump($_SESSION);

header('Location: /');