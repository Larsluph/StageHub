<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

session_start();

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// default route
$router->add('', ['controller' => 'Home', 'action' => 'index']);
// default route pattern
$router->add('{controller}/{action}');

// custom routes
$router->add('login', ['controller' => 'Accounts', 'action' => "login"]);
$router->add('logout', ['controller' => 'Accounts', 'action' => "logout"]);


/**
 * Processing / Rendering (call to Controllers)
 */
$router->dispatch($_SERVER['QUERY_STRING']);
