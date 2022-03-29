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
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
// default route pattern
$router->add('{controller}/{action}');

// custom routes
// account routes
$router->add('login', ['controller' => 'AccountController', 'action' => "login"]);
$router->add('logout', ['controller' => 'AccountController', 'action' => "logout"]);

// misc
$router->add('terms', ['controller' => 'TermsController', 'action' => "view"]);

// company routes
$router->add('company', ['controller' => 'CompanyController', 'action' => "view"]);

// student routes
$router->add('student', ['controller' => 'StudentController', 'action' => "view"]);
$router->add('profile_student', ['controller' => 'ProfStudentController', 'action' => "view"]);


/**
 * Processing / Rendering (call to Controllers)
 */
$router->dispatch($_SERVER['QUERY_STRING']);
