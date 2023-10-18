<?php

namespace Model;

class ActiveRecord {
    protected static $db;
    protected static $columnasDB=['idProp', 'titulo', 'precio', 'imagen', 'descripcion', 'garage', 'toilet', 'habitaciones', 'creado', 'vendedorId'];
    protected static $tabla = '';
    protected static $errores = [];

    public $idProp;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $garage;
    public $toilet;
    public $habitaciones;
    public $creado;
    public $vendedorId;

    //definir conexion DB
    public static function setDB($database){
        self::$db = $database;
    }
    
    public function __construct($args=[]){
        $this->idProp =$args['idProp'] ?? '';
        $this->titulo =$args['titulo'] ?? '';
        $this->precio =$args['precio'] ?? '';
        $this->imagen =$args['imagen'] ?? '';
        $this->descripcion =$args['descripcion'] ?? '';
        $this->garage =$args['garage'] ?? '';
        $this->toilet =$args['toilet'] ?? '';
        $this->habitaciones =$args['habitaciones'] ?? '';
        $this->creado =date('Y/m/d');
        $this->vendedorId = '1';
    }
    public function guardar(){
        

        //sanitizacion
        $atributos = $this->sanitizarAtributos();
       
        //insercion en DB
       // $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, toilet, garage, vendedorId, creado  ) VALUES ( '$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion',  '$this->habitaciones', '$this->toilet', '$this->garage', '$this->vendedorId', '$this->creado' )";
        
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        
        $resultado = self::$db->query($query);

        return $resultado;



    }
    public function actualizar(){


        //sanitizacion
        $atributos = $this->sanitizarAtributos();

        //insercion en DB
       $query = "UPDATE " . static::$tabla . " SET titulo = '$this->titulo', precio = '$this->precio', descripcion = '$this->descripcion', habitaciones = '$this->habitaciones', toilet = '$this->toilet', garage = '$this->garage', vendedorId = '$this->vendedorId', imagen = '$this->imagen'  WHERE idProp = '$this->idProp' ";

        // $valores = [];
        // foreach($atributos as $key => $value){
        //     $valores[] = "{$key}='{$value}'";
        // }

        // $query = "UPDATE propiedades SET ";
        // $query.= join(', ', $valores );
        // $query.= " WHERE id = '" . self::$db->escape_string($this->idProp) . "' ";
        // $query.= " LIMIT 1";



        
        $resultado = self::$db->query($query);

        return $resultado;



    }
    
    public function atributos(){
        $atributos =[];
        foreach(self::$columnasDB as $columna){
            if($columna==='idProp') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado=[];
        foreach ($atributos as $key=>$value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;

    }

    public static function getErrores(){
        return self::$errores;

    }
    
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }


    public function validar(){
        
    if (!$this->titulo) {
        self::$errores[] = 'Debes añadir un Titulo';
    }
    if (!$this->precio) {
        self::$errores[] = 'El Precio es Obligatorio';
    }
    if (strlen($this->descripcion) < 50) {
        self::$errores[] = 'La Descripción es obligatoria y debe tener al menos 50 caracteres';
    }
    if (!$this->habitaciones) {
        self::$errores[] = 'La Cantidad de Habitaciones es obligatoria';
    }
    if (!$this->toilet) {
        self::$errores[] = 'La cantidad de toilet es obligatoria';
    }
    if (!$this->garage) {
        self::$errores[] = 'La cantidad de lugares de garage es obligatoria';
    }
    if (!$this->vendedorId) {
        self::$errores[] = 'Elige un vendedor';
    }

    // if (!$this->imagen['name'] || !str_contains($imagen['type'],  'image')) {
    //     self::$errores = 'Imagen no válida';
    // }
    $medida = 2 * 1000 * 1000;
    // var_dump($imagen['size']);
    // var_dump($imagen);

    // if ($this->imagen['size'] > $medida) {
    //     self::$errores = 'La Imagen es muy grande';
    // }
    }
    //subida de archivos
  

       // Subida de archivos
    public function setImagen($imagen) {
        // Elimina la imagen previa
        if( !is_null($this->idProp) ) {
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    public static function All(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado =self::consultarSQL($query);
        return $resultado;

    }
    


    public static function buscaId($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] . " = $id";
        $resultado =self::consultarSQL($query);
        return array_shift($resultado);

    }

    public static function consultarSQL($query){
        //consulta db
        $resultado = self::$db->query($query);


        //itera resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[]= self::crearObjeto($registro);
        }
        //libera memoria
        $resultado->free();
        //retorna resultados
        return $array;
    }
    protected static function crearObjeto($registro){
        $objeto=new static;
        foreach($registro as $key=>$value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;

    }
    public function sincronizar($args = []){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }

        }
 
    }
    public function eliminar() {
        // Eliminar el registro
        $query = "DELETE FROM "  . static::$tabla . " WHERE ". self::$columnasDB[0] . " =  " . $this->idProp . "  LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
        }

        return $resultado;
    }
 
    // Elimina el archivo
    public function borrarImagen() {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

}