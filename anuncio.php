<?php
    

    //Obtener el id del get
    $id = $_GET['id'];

    //Comprobar que sea un int
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //Redireccionar si no es un inr
    if(!$id){
        header("Location: /index.php");
    }

    require 'includes/app.php';

    // //Conectar a base de datos
    // require __DIR__ . '/../bienesraices_inicio/includes/config/database.php';
    $DB = conectarDB();

    //Obtener los datos de la propiedad
    $consultaPropiedad = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultadoPropiedad = mysqli_query($DB, $consultaPropiedad);

    //Validamos que exista el id
    if(!$resultadoPropiedad->num_rows) {
        header("Location: /");
    }


    $propiedad = mysqli_fetch_assoc($resultadoPropiedad);

    //Podemos comprobar la información:
    // echo $propiedad['titulo'];
    // echo $propiedad['descripcion'];
    // echo $propiedad['precio'];
    // echo $propiedad['wc'];
    // echo $propiedad['habitaciones'];
    // echo $propiedad['estacionamiento'];

    
    incluirTemplate('header');





 ?>


    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>
        <picture>
            <img loading ="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen destacada"> 
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p class="lista"><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p class="lista"><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p class="lista"><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>
    </main>




<?php

mysqli_close($DB);
incluirTemplate('footer');
?>


    