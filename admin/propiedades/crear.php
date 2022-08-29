<?php
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    // $propiedad = new Propiedad;


    // debuguear($propiedad);

    estaAutenticado();

    $DB = conectarDB();

    $propiedad = new Propiedad;

    //CONSULTAR PARA OBTENER LOS VENDEDORES
    $consulta = "SELECT * FROM vendedores";
    /*Primer parámetro la conexión y el segundo parámetro la variable de consulta*/
    $resultados = mysqli_query($DB, $consulta);
    
    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // debuguear($errores);


    //Ejecutar el código después de que el usuario envía el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        
        
        /* Crear una nueva instancia */
        $propiedad = new Propiedad($_POST['propiedad']);
        

        // debuguear($_FILES['propiedad']);

        // debuguear($propiedad); Aquí tenemos una instancia de la clase
       
       

        /* SUBIDA DE ARCHIVOS */
        //Crear carpeta
        $carpetaImagenes = "../../imagenes/";

        //Validar que no exista la carpeta para no crearla multiples veces cada que se ejecute el código
        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        //Generar un nombre único (para que no se sobreescriban las imágenes)
        //md5 NO ES SEGURO, no debe usarse para nada de seguridad
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg"; //md5 se uasaba antes para hashear ( no es lo mismo que encriptar )


        //Setear imagen
        //Realiza un resize a la imagen con intervention

        if($_FILES['propiedad']['tmp_name']['imagen'])
        {
            //Importante poner propiedad porque lo agregamos en los names del formulario
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); //Hacer debuguear a files para ver el orden
            $propiedad->setImagen($nombreImagen); //Guardar el nombre, no el archivo como tal
        }


        //Validar
        $errores = $propiedad->validar();

        
        //Revisar que el array de errores esté vacío
        if(empty($errores)){ //Si no hay errores...
            
            
            
            // Crear la carpeta para subir imágenes
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            //Guardas imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            //Guarda en la base de datos 
            $propiedad->guardar();


            
        }

    }

    
    incluirTemplate('header');
 ?>


    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>


<?php
incluirTemplate('footer');
?>