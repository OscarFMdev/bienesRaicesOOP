<?php

    require '../includes/app.php';
    estaAutenticado();

    use App\Propiedad;

    //Implementar un método para obtener todas las propiedades usando (Active Record)
    $propiedades = Propiedad::all(); //Podemos ponerle el nombre que queramos pero si ponemos todas quizas tenga que cambiar a todos en ocasiones, mejor all

    // debuguear($propiedades); PARA VER QUE SE MANDEN LOS DATOS CORRECTAMENTE


    //Mostrar un mensaje condicional
    $resultado = $_GET['resultado'] ?? null; //Agregamos un placeholder null con ?? para evitar problemas de no tene $resultado
    //(?? lo que hace es revisar que exista el valor de resultado y si no hay le asigna el valor que le pongamos)

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id']; //Tiene que ir dentro de este if porque si aún no existe nos arrojará undefined
        $id = filter_var($id, FILTER_VALIDATE_INT); //Para evitar que metan código

        if($id) {

            $propiedad = Propiedad::find($id);

            $propiedad->eliminar();

        
            
        }

    }





    //Incluir el template
    incluirTemplate('header');
 ?>


    <main class="contenedor seccion">
        
        <h1>Administrador de Bienes Raíces</h1>

        <?php if( intval( $resultado )  === 1):  //asgurarnos que sea un 1 de tipo int y no de tipo string ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif(intval( $resultado ) === 2): ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif(intval( $resultado ) === 3): ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

        <table class="propiedades"> <!--Creamos una tabla para mostrar las propiedades -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!--Mostrar los resultados-->
                <?php foreach($propiedades as $propiedad): ?>

                <tr>
                    <td> <?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>"> <!--id es lo que queremos eliminar-->
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>





                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </main>


<?php

    //Cerrar la base de datos
    mysqli_close($db);

    incluirTemplate('footer');
?>