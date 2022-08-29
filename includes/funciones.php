<?php


define('TEMPLATES_URL', __DIR__ . "/templates");
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ .'/../imagenes/');


function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();


    if(!$_SESSION['login']) {
        header('Location: /');
    } //Como rturn hace que no se ejecute lo demás esto es equivalente a poner un else
}

function debuguear( $variable ) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

//ESCAPA / SANEAR HTML (en la entrada de datos de usuario)
function s($html) : string {
    $s = htmlspecialchars($html); //Escapa y sanea el código html

    return $s;
}