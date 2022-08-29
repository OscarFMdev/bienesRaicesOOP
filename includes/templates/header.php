<?php

    //Este if nos quita un notice que nos da información sensible
    if(!isset($_SESSION)){
        session_start(); //Para tener la superglobal de _SESSION
    }
    // var_dump($_SESSION); //Hacer esto para comprobar datos

    $auth = $_SESSION['login'] ?? false;
    // var_dump($auth);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a class="imagen-logo" href="index.php">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="ícono menú responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if(!$auth): //Este if nos sirve para agregar la opción de cerrar sesión si estamos autenticados y no ponerla si no ?>

                        <a href="login.php">Iniciar sesión</a>

                        <?php endif; ?>
                        <?php if($auth): //Este if nos sirve para agregar la opción de cerrar sesión si estamos autenticados y no ponerla si no ?>

                            <a href="/admin/">Administrar</a>
                            <a href="/cerrar-sesion.php">Cerrar Sesión</a>

                        <?php endif; ?>

                    </nav>
                </div>
            </div> <!-- barra -->
            


            <?php 
            
            if($inicio) {
                echo "<h1>Ventas de Casas y Departamentos Exclusivos de Lujo</h1>";
            }


            ?>


        </div>  



    </header>