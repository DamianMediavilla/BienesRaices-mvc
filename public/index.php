<?php
require_once __DIR__ . '/../includes/app.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Controllers\PropiedadControlador;
use Controllers\VendedorControlador;
use Controllers\PaginasControlador;
use Controllers\LoginControlador;
use MVC\Router;

$router = new Router();

//Rutas accesibles con login

$router->get('/admin', [PropiedadControlador::class, 'admin']);
$router->post('/admin', [PropiedadControlador::class, 'admin']);
$router->get('/admin/propiedades/crear', [PropiedadControlador::class, 'crear']);
$router->get('/admin/propiedades/actualizar', [PropiedadControlador::class, 'actualizar']);

$router->post('/admin/propiedades/crear', [PropiedadControlador::class, 'crear']);
$router->post('/admin/propiedades/actualizar', [PropiedadControlador::class, 'actualizar']);


$router->get('/admin/vendedores/admin', [VendedorControlador::class, 'index']);
$router->get('/admin/vendedores/crear', [VendedorControlador::class, 'crear']);
$router->post('/admin/vendedores/crear', [VendedorControlador::class, 'crear']);

//Rutas publicas
$router->get('/', [PaginasControlador::class, 'index']);
$router->get('/nosotros', [PaginasControlador::class, 'nosotros']);
$router->get('/propiedades', [PaginasControlador::class, 'propiedades']);
$router->get('/propiedad', [PaginasControlador::class, 'propiedad']);
$router->get('/blog', [PaginasControlador::class, 'blog']);
$router->get('/entrada', [PaginasControlador::class, 'entrada']);
$router->get('/contacto', [PaginasControlador::class, 'contacto']);
$router->post('/contacto', [PaginasControlador::class, 'contacto']);


$router->get('/login', [LoginControlador::class, 'login']);
$router->post('/login', [LoginControlador::class, 'login']);
$router->get('/logout', [LoginControlador::class, 'logout']);


$router->comprobarRutas();

?>