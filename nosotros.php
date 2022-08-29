<?php
    require 'includes/app.php';
    incluirTemplate('header');
 ?>

    <main class="contenedor seccion">
        <h1>Conoce más sobre Nosotros</h1>
        <div class="seccion-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type = "image/webp">
                    <source srcset="build/img/nosotros.jpg" type = "image/jpeg">
                    <img loading ="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros"> 
                </picture>
            </div>

            <div class="texto-nosotros">
                <h2>25 años de experiencia</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae aut nobis natus quam dolorum sint dolor! Repellat asperiores doloremque accusantium. Eaque hic vitae ratione nesciunt distinctio soluta voluptatem sapiente explicabo Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis molestiae suscipit magnam incidunt. Sunt voluptatem, impedit placeat veniam incidunt necessitatibus soluta pariatur nemo, numquam, dicta architecto. Illo voluptatibus officiis accusantium? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam nam tempore ab repellendus doloribus ipsam sint, ipsa sit facere, ad, soluta molestiae ratione porro distinctio explicabo ut maxime molestias officia!</p>
            </div>
        </div>
    </main>
    <section class="contenedor seccion">
        <h1>Más sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi adipisci earum, mollitia dolores ipsum praesentium. Quis ullam perspiciatis aspernatur quae optio sapiente, numquam doloremque ab pariatur ea voluptatem impedit a.</p>
            </div> <!--icono-->
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi adipisci earum, mollitia dolores ipsum praesentium. Quis ullam perspiciatis aspernatur quae optio sapiente, numquam doloremque ab pariatur ea voluptatem impedit a.</p>
            </div> <!--icono-->
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi adipisci earum, mollitia dolores ipsum praesentium. Quis ullam perspiciatis aspernatur quae optio sapiente, numquam doloremque ab pariatur ea voluptatem impedit a.</p>
            </div> <!--icono-->
        </div>
    </section>

    <?php
    incluirTemplate('footer');
    ?>

    