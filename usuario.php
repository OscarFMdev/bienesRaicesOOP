<?php

require 'includes/app.php';
$DB = conectarDB();

//Crear un email y password
$correo = "correo@correo.com";
$password = "123456";

//Hash al password El segundo argumento nos sirve para ver el tipo de hash que se va a utilizar, también está PASSWORD_BCRYPT
$passwordHash = password_hash($password, PASSWORD_DEFAULT);


// var_dump($passwordHash);

//Query para crear el usuario

$query = "INSERT INTO usuarios (email, password) VALUES ('${correo}', '${passwordHash}')";


// echo $query;



// Agregarlo a la base de datos

mysqli_query($DB, $query);

//Tenemos que usar char cuando la extensión es algo fijo, en el caso de las contraseñas, se va a hashear a 50 caracteres, en el caso de
//Los usuarios es variable y no almacena todo lo que le pasamos, si usamos 10, 10 guarda en lugar de 60 por ejemplo