<?php


define('FUNCIONES_URL', __DIR__ . "/funciones/funciones.php");
define('TEMPLATES_URL', __DIR__ . "/templates");
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . "/imagenes/");


function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    
    if(!$_SESSION['login']) {
        header('Location: /');
    } 
}

function debuguear($variable){

    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    
    exit;
}
 function s($html) : string{
    $s= htmlspecialchars($html);
    return $s;
 }
 // Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creada Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizada Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminada Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url) {
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
   

    if(!$id) {
        header("Location: ${url} " );
    }

    return $id;
}
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}
