<?php

namespace Model;

class Vendedor extends ActiveRecord{

    protected static $columnasDB=['idvendedores', 'nombre', 'apellido', 'telefono'];
    protected static $tabla = 'vendedores';

    public $idvendedores;
    public $nombre;
    public $apellido;
    public $telefono;
    
    public function __construct($args=[]){
        $this->idvendedores =$args['idvendedores'] ?? '';
        $this->nombre =$args['nombre'] ?? '';
        $this->apellido =$args['apellido'] ?? '';
        $this->telefono =$args['telefono'] ?? '';
    }
    
    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "El Nombre es Obligatorio";
        }

        if(!$this->apellido) {
            self::$errores[] = "El Apellido es Obligatorio";
        }

        if(!$this->telefono) {
            self::$errores[] = "El Teléfono es Obligatorio";
        }
        return self::$errores;
    }
    public function guardar(){
        

        
        $query = "INSERT INTO " . static::$tabla . " (nombre, apellido, telefono) VALUES ('$this->nombre', '$this->apellido', '$this->telefono')";
        
        $resultado = self::$db->query($query);

        return $resultado;



    }
    public function eliminar() {
        // Eliminar el registro
        $query = "DELETE FROM "  . static::$tabla . " WHERE ". self::$columnasDB[0] . " =  " . $this->idvendedores . "  LIMIT 1";
        $resultado = self::$db->query($query);

        
        return $resultado;
    }
};