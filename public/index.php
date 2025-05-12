<?php

use core\Session;

session_start();

const BASE_PATH = __DIR__.'/../';

require BASE_PATH. 'core/functions.php';
spl_autoload_register(function ($class) {
   // core\Dtatabase
   $class = str_replace('\\',DIRECTORY_SEPARATOR,$class);
   
   require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new \core\Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);

// unset($_SESSION['_flashed']);
Session::unflash();
