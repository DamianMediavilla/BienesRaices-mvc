<?php
namespace Controllers;

use Model\Propiedad as ModelPropiedad;
use Model\Vendedor as ModelVendedor;
use MVC\Router;


class VendedorControlador {
       
    public static function index(Router $router) {
        estaAutenticado();
        $vendedores = ModelVendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('vendedores/index', [
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {
        estaAutenticado();
        // echo "<pre>";
        // var_dump($_SERVER);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($_SERVER['PATH_INFO']);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($_SERVER['REQUEST_URI']);
        // echo "</pre>";
        // debuguear($_SERVER['REQUEST_METHOD']);
        
        $errores = ModelVendedor::getErrores();
        $vendedor = new ModelVendedor;

        // Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $vendedor = new ModelVendedor($_POST['vendedor']);

            // Validar
            $errores = $vendedor->validar();


            if(empty($errores)) {

                // Guarda en la base de datos
                $resultado = $vendedor->guardar();
                

                if($resultado) {
                    header('location: /admin');
                }
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router) {
        estaAutenticado();
        


        $id = validarORedireccionar('/admin');

        // Obtener los datos de la propiedad
        $vendedor = ModelVendedor::buscaId($id);

        // Arreglo con mensajes de errores
        $errores = ModelVendedor::getErrores();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Asignar los atributos
                $args = $_POST['vendedor'];
                $vendedor->sincronizar($args);

                // Validación
                $errores = $vendedor->validar();
                
                if(empty($errores)) {

                    // Guarda en la base de datos
                    $resultado = $vendedor->guardar();

                    if($resultado) {
                        header('location: /admin');
                    }
                }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router) {

    }
}
