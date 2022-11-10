<?php

namespace Model;

class Propiedad extends ActiveRecord {

    // Base DE DATOS
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['idProp', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'toilet', 'garage', 'creado', 'vendedorId'];

    public $idProp;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $toilet;
    public $garage;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->idProp = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->toilet = $args['toilet'] ?? '';
        $this->garage = $args['garage'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar() {

        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = 'El Precio es Obligatorio';
        }

        if( strlen( $this->descripcion ) < 50 ) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if(!$this->habitaciones) {
            self::$errores[] = 'El Número de habitaciones es obligatorio';
        }
        
        if(!$this->toilet) {
            self::$errores[] = 'El Número de Baños es obligatorio';
        }

        if(!$this->garage) {
            self::$errores[] = 'El Número de lugares de garage es obligatorio';
        }
        
        if(!$this->vendedorId) {
            self::$errores[] = 'Elige un vendedor';
        }

        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

        return self::$errores;
    }

}