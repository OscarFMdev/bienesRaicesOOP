<?php
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;
    estaAutenticado();


    //Obtener información desde el botón actualizar
    $id = $_GET["id"];
    //Validar que el id sea válido
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //Redireccionar a admin si ponen algo que no sea int
    if(!$id) {
        header('Location: /admin');
    }

    $propiedad = Propiedad::find($id);

    // debuguear($propiedad);
    


    //CONSULTAR PARA OBTENER LOS VENDEDORES
    $consulta = "SELECT * FROM vendedores";
    /*Primer parámetro la conexión y el segundo parámetro la variable de consulta*/
    $resultados = mysqli_query($db, $consulta);
    
    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores(); //Para que tome los errores que tenemos en la clase 


    



    //Ejecutar el código después de que el usuario envía el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        
        // debuguear($_POST); PARA REVISAR EL POST CON LA MODIFICACION propiedad[titulo]... EN FORMULARIO

        //Asignar los atributos
        $args = $_POST['propiedad'];

                                            /* Tendríamos que hacerlo así, pero mejor modificamos el name del formulario propiedad[titulo] y así */
                                            // $args['titulo'] = $_POST['titulo'] ?? null;
                                            // $args['precio'] = $_POST['precio'] ?? null;
                                            // // $args['titulo'] = $_POST['titulo'] ?? null;
                                            // // $args['titulo'] = $_POST['titulo'] ?? null;
                                            // // $args['titulo'] = $_POST['titulo'] ?? null;
                                            // // $args['titulo'] = $_POST['titulo'] ?? null;
                                            // // $args['titulo'] = $_POST['titulo'] ?? null;

        //Sincronizar itera mapea propiedades del objeto con llaves del arreglo y las une (sincroniza)
        $propiedad->sincronizar( $args );

        // debuguear($propiedad);

        //Validación
        $errores = $propiedad->validar();


        //Subida de archivos
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg"; //Generar nombre único

        if($_FILES['propiedad']['tmp_name']['imagen'])
        {
            //Importante poner propiedad porque lo agregamos en los names del formulario
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); //Hacer debuguear a files para ver el orden
            $propiedad->setImagen($nombreImagen); //Guardar el nombre, no el archivo como tal
        }




        //Revisar que el array de errores esté vacío
        if(empty($errores)){ //Si no hay errores...

            //ALMACENAR LA IMAGEN (si no no aparece en la página)
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            $propiedad->guardar();

            
        }

    }

    
    incluirTemplate('header');
 ?>


    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data"> <!--Eliminar el action hace que lo envíe al mismo archivo-->
            
        <?php require '../../includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>


<?php

incluirTemplate('footer');
?>