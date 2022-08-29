<?php 
    //Importar la conexión

    //Borrar porque choca con la redeclaración de una constante
    // require __DIR__ . '/../config/database.php'; //La ruta debe de ser relativo a donde se va a usar, en este caso en la raíz

    $DB = conectarDB();

    //Consultar
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    //Obtener resultados
    $resultado = mysqli_query($DB, $query);


?>



<div class="contenedor-anuncios">
    <?php 
        function truncate(string $texto, int $cantidad) : string
        {
            if(strlen($texto) >= $cantidad) {
                return substr($texto, 0, $cantidad) . "...";
            } else {
                return $texto;
            }
        }
    ?>    

    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>


        <div class="anuncio">
            <picture>
                <!-- Como se van a subir los archivos al servidor, la versión webp no va a estar disponible -->
                <!-- <source srcset="build/img/anuncio3.webp" type="image/webp">
                <source srcset="build/img/anuncio3.jpg" type="image/jpeg"> -->
                <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">
            </picture>
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo']; ?></h3>
                <p><?php echo truncate($propiedad['descripcion'], 100); ?></p>
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

                <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>
            </div> <!--Contenido anuncio-->
        </div> <!--Anuncio-->
        <?php endwhile; ?>
</div> <!--Contenedor de anuncios-->


<?php 

    //Cerrar la conexión
    mysqli_close($DB);
?>