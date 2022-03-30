<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

use App\Controllers\ErrorController;

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

//////////////////
// basic routes //
//////////////////

// default route
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);

// default route pattern
//$router->add('{controller}/{action}');

///////////////////
// custom routes //
///////////////////

// account routes
$router->add('login', ['controller' => 'AccountController', 'action' => "login"]);
$router->add('logout', ['controller' => 'AccountController', 'action' => "logout"]);

// misc
$router->add('termsofuse', ['controller' => 'HomeController', 'action' => "terms"]);

// company routes
$router->add('companies', ['controller' => 'CompanyController', 'action' => "index"]);
$router->add('companies/create', ['controller' => 'CompanyController', 'action' => "create"]);
$router->add('companies/update', ['controller' => 'CompanyController', 'action' => "update"]);
$router->add('companies/delete', ['controller' => 'CompanyController', 'action' => "delete"]);
$router->add('companies/applications', ['controller' => 'CompanyController', 'action' => "applications"]);

// offers routes
$router->add('offers', ['controller' => 'OffersController', 'action' => "index"]);
$router->add('offers/create', ['controller' => 'OffersController', 'action' => "create"]);
$router->add('offers/update', ['controller' => 'OffersController', 'action' => "update"]);
$router->add('offers/delete', ['controller' => 'OffersController', 'action' => "delete"]);

// student routes
$router->add('student', ['controller' => 'StudentController', 'action' => "index"]);
$router->add('student/profile', ['controller' => 'StudentController', 'action' => "profile"]);
$router->add('student/update', ['controller' => 'StudentController', 'action' => "update"]);
$router->add('student/delete', ['controller' => 'StudentController', 'action' => "delete"]);
$router->add('student/wishlist', ['controller' => 'StudentController', 'action' => "wishlist"]);
$router->add('student/applications', ['controller' => 'StudentController', 'action' => "applications"]);


// admin routes
$router->add('admin', ['controller' => 'AdminController', 'action' => "dashboard"]);

// error routes
$router->add('403', ['controller' => 'ErrorController', 'action' => "forbidden"]);
$router->add('404', ['controller' => 'ErrorController', 'action' => "notFound"]);

/**
 * Processing / Rendering (call to Controllers)
 */
try {
    $router->dispatch($_SERVER['QUERY_STRING']);
} catch (Exception $e) {
    switch ($e->getCode()) {
        case 404:
            // No route matched
            ErrorController::notFound();
            break;
        default:
            ErrorController::unknownError($e);
            break;
    }
}
