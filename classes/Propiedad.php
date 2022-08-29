<?php namespace App;

//En cualquiera podemos usar debuguear() para ver que es lo que nos va a rrojar, antes de usar return

class Propiedad {
    

    //BASE DE DATOS
    //protected porque solo dentro de la clase podemos acceder a él
    //static porque si creamos 1000 objetos, todos requieren la misma conexión
    protected static $db;
    protected static $columnasDB = [
    'id',
    'titulo',
    'precio',
    'imagen',
    'descripcion',
    'habitaciones',
    'wc',
    'estacionamiento',
    'creado',
    'vendedorId'
    ];


    //Errores (protected porque solo se va a modificar en la clase)
    protected static $errores = [];



    //public porque podemos acceder a ellos también desde un formulario
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    //Definir la conexión a la base de datos
    public static function setDB($database) {
        self:: $db = $database; //self hace referencia a los atributos estáticos de la misma clase
    } 

    public function __construct($args = [])
    {

        /* NO DEBEMOS CREAR LA CONEXIÓN A LA BASE DE DATOS DENTRO DEL CONSTRUCT PORQUE SI SE CREAN 100 INSTANCIAS SE TENDRÍAN 100 CONEXIONES A LA BASE DE DATOS */

        $this->id = $args['id'] ?? null; //En caso de que no haya título, poner un null para las validaciones $this->id (como es null no se pone)
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    //Principio de Active record USAR MISMO NOMBRE PARA ACTUALIZAR Y GUARDAR
    public function guardar() {
        if(!is_null($this->id)) {
            //Actualizar
            $this->actualizar();
        } else {
            //Creando un nuevo registro
            $this->crear(); 
        }
    }

    //Para usarlo en guardar
    public function crear() {

        //Sanear los datos
        $atributos = $this->sanearAtributos();


        

        // debuguear($atributos); Podemos checar desde aquí para ver si se están mandando bien los datos de abajo (atributos)


        //Insertar en la base de datos
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos)); //JOIN USA LAS COMAS Y EL ESPACIO PARA DIFERENCIAR DE UNO Y OTRO
        $query .= " ) VALUES (' ";  //NOTAR LA ' SOLO UNA PARA APERTURA Y DESPUÉS LA DE CIERRE
        $query .= join("', '", array_values($atributos));
        $query.= " ') ";

        // \debuguear($query);

        // debuguear($query); si queremos ver el query

        $resultado = self::$db->query($query);

        //Mensaje de éxito
        if($resultado) {
            //Redireccionar a un usuario (Usamos query string, se pone después de un ?)
            header('Location: /admin?resultado=1'); //se va a agregar en el url de index el mensaje
            //Podemos poner mas query strings usando & por ejemplo: &registrado=1
        }

    }

    //Para usarlo en Guardar
    public function actualizar() {
        //Sanear los datos
        $atributos = $this->sanearAtributos();

        $valores = [];

        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores); 
        $query .= " WHERE  id = '" . self::$db->escape_string($this->id) . "' "; //Sanear id antes de insertar en base
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        //Evitar registros duplicados
        if($resultado) {
            //Redireccionar a un usuario (Usamos query string, se pone después de un ?)
            header('Location: /admin?resultado=2'); //se va a agregar en el url de index el mensaje
            //Podemos poner mas query strings usando & por ejemplo: &registrado=1
        }
        
    }

    // Eliminar un registro
    public function eliminar() {
        //Eliminar la propiedad
        $query = "DELETE FROM propiedades WHERE id =  " . self::$db->escape_string($this->id) . " LIMIT 1 ";
        
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->eliminarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    //Identificar y unir los atributos de las columnas de la base de datos mediante iteración
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna):
            
            if($columna ==="id") continue; //ignorar el id e ir al siguiente (porque cuando creamos un nuevo registro, id todavía no existe)
    
            $atributos[$columna] = $this->$columna; //Lleva $ porque no es un atributo, es una variable del foreach
        endforeach;
        return $atributos;
    }
    
    //Función encargada de sanear
    public function sanearAtributos() { //NO PODEMOS USAR mysqli_real_scape... porque no es la forma orientada a objetos
        $atributos = $this->atributos();
        $saneado =[];
        
        foreach($atributos as $key => $value ): //key nos va a dar el nombre de las columnas y value lo que ponga el usuario
            $saneado[$key] = self::$db->escape_string($value);
        endforeach;
        
        // \debuguear($saneado); LO HACEMOS USANDO 'S PARA QUE NOS DE UN \'S

        return $saneado;
    
    }

    //Subida de archivos
    public function setImagen($imagen) {
        
        
        // Elimina la imagen previa
        if( !is_null( $this->id ) )  {
            $this->eliminarImagen();    
        }



        //Asignar al atributo de imagen el nombre de la imagen 
        if($imagen) {
            $this->imagen = $imagen; //Si hay una imagen, asígnala
        }
    }


    //Eliminar archivo
    public function eliminarImagen() {
        // Comprobar si existe archivo 
        $existeArchivo = \file_exists(CARPETA_IMAGENES . $this->imagen); //Retorna bool(true) si existe

        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen); //unlink es para eliminar archivos
        }
    }
    

    //Validación
    public static function getErrores() {
        return self::$errores;
    }



    //
    public function validar() {
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un título";
        }
        
        
        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }
        
        if(strlen( $this->descripcion ) < 50){
            self::$errores[] = "La descripción es obligatoria y debe de tener por lo menos 50 caracteres";
        }
        
        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }
        
        if(!$this->wc){
            self::$errores[] = "El número de baños es obligatorio";
        }
        
        if(!$this->estacionamiento){
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }
        
        if(!$this->vendedorId){
            self::$errores[] = "Elige un vendedor";
        }
        
        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }
        //NO SE REQUIERE UNA VALIDACIÓN DE TAMAÑO PORQUE USAMOS UN RESIZE
        return self::$errores;
    }


    // Listar todos los registros
    public static function all() {

        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    //Busca un registro por su id (public porque vamos a acceder a él desde el archivo de actualizar)
    public static function find($id) {
        $query = "SELECT * FROM propiedades WHERE id  = ${id}";

        $resultado = self::consultarSQL( $query );

        return (array_shift($resultado));
    }


    //Hacemos esta función para usarlo en diferentes métodos del CRUD
    public static function consultarSQL($query) {
        //Consultar la base de datos
        $resultado =self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while( $registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        // \debuguear($array); sirve para ver que se hayan llenado todos correctamente

        //Liberar la memoria
        $resultado->free();



        //Retornar los resultados
        return $array;
    }


    protected static function crearObjeto($registro) {
        //Esto hace referencia a a la clase padre (es decir una nueva propiedad)
        $objeto = new self;

        // \debuguear($objeto);

        foreach($registro as $key => $value) {
            if(property_exists( $objeto, $key )) {
                $objeto->$key = $value; //Darle el valor a la llave
            } //property_exists() sirve para ver si una propiedad existe (si el objeto tiene una llave)
        }

        return $objeto;
    }

    // SIncroniza los cambios en memoria con los cambios realizados por el usuario
    public function sincronizar ( $args = [] ) {
        //El objeto está en memoria y vamos a ir leyendo cada uno de ellos del arreglo al objeto en memoria
        foreach( $args as $key => $value ) {
            //Si la propiedad existe y si no está vacío el valor, llenar en el objeto
            if( property_exists( $this, $key ) && !is_null( $value ) ) {
                $this->$key = $value; //Asignar cada uno de los valores a las llaves de este objeto
            }
        }
    }

}