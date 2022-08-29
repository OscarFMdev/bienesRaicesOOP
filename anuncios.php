<?php
    require 'includes/app.php';
    incluirTemplate('header');


    
 ?>


    <main class="contenedor seccion">
        <h2>Casas y Depas en venta</h2>

        <?php

            $limite = 10; //Para pasar la variable al query de template y solo mostrar 3 propiedades

            include 'includes/templates/anuncios.php';
        ?>
       
    </main>


    <?php
    incluirTemplate('footer');
    ?>




    