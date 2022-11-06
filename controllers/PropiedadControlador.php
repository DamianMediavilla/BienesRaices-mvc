<?php

namespace Controllers;

use Model\Propiedad as ModelPropiedad;
use Model\Vendedor as ModelVendedor;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadControlador {
    public static function admin(Router $router) {
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if ($_POST['tipo']==='propiedad'){
                $propiedad = ModelPropiedad::buscaId($_POST['id']);
                $propiedad->eliminar();
            }
        }
        $propiedades = ModelPropiedad::All();
        $vendedores = ModelVendedor::All();
        $resultado = null;
        
    

        $router->render("propiedades/admin", [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'mensaje' => 'mensaje desde funcion',
            'resultado' => $resultado
        ]);
        
    }
    public static function crear(Router $router){
        $propiedades = ModelPropiedad::All();
        $resultado = null;
        $errores = [];
        $propiedad = new ModelPropiedad();
        $vendedores = ModelVendedor::all();

        if ($_SERVER['REQUEST_METHOD']=== 'POST'){
            /** Crea una nueva instancia */
            $propiedad = new ModelPropiedad($_POST['propiedad']);

            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";


            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar
            $errores = $propiedad->validar();
            if(empty($errores)) {
                echo "sin errores";
                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datos
                $resultado = $propiedad->guardar();

                if($resultado) {
                    header('location: /admin');
                }
            }
        }
    
    
        $router->render("propiedades/crear", [
            'propiedades' => $propiedades,
            'propiedad' => $propiedad,
            'errores' => $errores,
            'mensaje' => 'mensaje desde funcion',
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
        
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        $propiedad = ModelPropiedad::buscaId($id);
        $vendedores = ModelVendedor::all();
        
        
        $resultado = null;
        $errores = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);

            // Validación
            $errores = $propiedad->validar();

            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen);
                }
            
            if(empty($errores)) {
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }


                // Guarda en la base de datos
                $resultado = $propiedad->actualizar();

                if($resultado) {
                    header('location: /admin');
                }
            }
    }
        
        $router->render("propiedades/actualizar", [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'mensaje' => 'mensaje desde funcion',
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
        
    }
}