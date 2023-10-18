<?php 

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginControlador {
    public static function login( Router $router) {

        $errores = [];



        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();
        
            if(empty($errores)) {

                $resultado = $auth->existeUsuario();
     
                
                if( !$resultado ) {
                    //no se encuentra usuario
                    $errores = Admin::getErrores();
                } else {
                    //encontrado el usuario, verifica pass

                    

                    if($auth->comprobarPassword($resultado)) {
                       $auth->autenticar();
                    } else {
                        $errores =Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]); 
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}