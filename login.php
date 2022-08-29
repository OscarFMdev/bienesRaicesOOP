<?php

    require 'includes/app.php';  
    //Importar conexión
    // require 'includes/config/database.php';
    $DB = conectarDB();

    $errores = [];

    //Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        //Obtener datos de POST, asegurarnos que sea un email y escapar los strings para que no nos inyecten código SQL
        //Cada que tengamos algo que llegue a la base de datos, tenemos que hacer un scape string
        $email = mysqli_real_escape_string( $DB, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) );
        $password = mysqli_real_escape_string( $DB, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es valido";
        }
        if(!$password) {
            $errores[] = "La contraseña es obligatoria";
        }

        //Para revisar que todo esté bien
        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";


        if(empty($errores)) {

            //Revisar que el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $resultado = mysqli_query($DB, $query);

            // var_dump($resultado); //Sirve para ver como se llama la propiedad del objeto y comprobarla
            //Si num_rows es cero es que no hubo un email igual


            if( $resultado -> num_rows ) {
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Para comparar la contraseña que puso el usuario con el que tenemos en la base de datos
                $auth = password_verify($password, $usuario['password']);

                // var_dump($auth); nos retorna un bool, para revisarlo hacemos var_dump

                if($auth) {
                    //El usuario está autenticado
                    session_start(); //TENEMOS QUE USARLO PARA TENER ACCESO A LA SUPERGLOBAL $_SESSION

                    //Llenar el arreglo de la sesión (PODEMOS PONER LO QUE QUERAMOS, COMO ROLES (1, 2 Y 3 POR EJEMPLO) E IR PASÁNDOLO DE PÁGINA EN PÁGINA)
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    // echo "<pre>";
                    // var_dump($_SESSION);
                    // echo "</pre>";

                    header('Location: /admin');
                } else {
                    $errores[] = "El password es incorrecto";
                }
            } else {
                //Si no existe el usuario:
                $errores[] = "El usuario no existe";
            }

        }


    }


    //Importar el header
   
    incluirTemplate('header');
 ?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesión</h1>

        <?php foreach($errores as $error):?>
            <div class="alerta error"> 
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST"> <!-- Si no colocamos el action lo manda al mismo archivo -->
        <fieldset>
                <legend>Email y password</legend>
                

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="ejemplo@correo.com" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Contraseña" id="password" required>

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>




    </main>


<?php
incluirTemplate('footer');
?>