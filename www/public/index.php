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
$router->add('company', ['controller' => 'CompanyController', 'action' => "index"]);
$router->add('company/create', ['controller' => 'CompanyController', 'action' => "create"]);
$router->add('company/update', ['controller' => 'CompanyController', 'action' => "update"]);
$router->add('company/delete', ['controller' => 'CompanyController', 'action' => "delete"]);
$router->add('company/applications', ['controller' => 'CompanyController', 'action' => "applications"]);

// offers routes
$router->add('offers/create', ['controller' => 'OffersController', 'action' => "create"]);
$router->add('offers/update', ['controller' => 'OffersController', 'action' => "update"]);
$router->add('offers/delete', ['controller' => 'OffersController', 'action' => "delete"]);

// student routes
$router->add('student', ['controller' => 'StudentController', 'action' => "studentPage"]);
$router->add('student/profile', ['controller' => 'StudentController', 'action' => "studentProfile"]);
$router->add('student/update', ['controller' => 'StudentController', 'action' => "studentUpdate"]);
$router->add('student/wishlist', ['controller' => 'StudentController', 'action' => "wishlist"]);
$router->add('student/applications', ['controller' => 'StudentController', 'action' => "studentApplications"]); 


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
