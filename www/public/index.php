<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

use App\Controllers\ErrorController;

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

///////////////////
// custom routes //
///////////////////

// account routes
$router->add('login', ['controller' => 'AccountController', 'action' => "login"]);
$router->add('logout', ['controller' => 'AccountController', 'action' => "logout"]);

// company routes
$router->add('companies', ['controller' => 'CompanyController', 'action' => "index"]);
$router->add('companies/{id:\d+}', ['controller' => 'CompanyController', 'action' => "profile"]);
$router->add('companies/create', ['controller' => 'CompanyController', 'action' => "create"]);
$router->add('companies/{id:\d+}/update', ['controller' => 'CompanyController', 'action' => "update"]);
$router->add('companies/{id:\d+}/delete', ['controller' => 'CompanyController', 'action' => "delete"]);
$router->add('companies/{id:\d+}/applications', ['controller' => 'CompanyController', 'action' => "applications"]);

// error routes
$router->add('403', ['controller' => 'ErrorController', 'action' => "forbidden"]);
$router->add('404', ['controller' => 'ErrorController', 'action' => "notFound"]);

// misc
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('termsofuse', ['controller' => 'HomeController', 'action' => "terms"]);

// offers routes
$router->add('offers', ['controller' => 'OffersController', 'action' => "index"]);
$router->add('offers/create', ['controller' => 'OffersController', 'action' => "create"]);
$router->add('offers/{id:\d+}/update', ['controller' => 'OffersController', 'action' => "update"]);
$router->add('offers/{id:\d+}/delete', ['controller' => 'OffersController', 'action' => "delete"]);

// pilotes routes
$router->add('pilotes', ['controller' => 'PilotesController', 'action' => "index"]);
$router->add('pilotes/create', ['controller' => 'PilotesController', 'action' => "create"]);
$router->add('pilotes/{id:\d+}/update', ['controller' => 'PilotesController', 'action' => "update"]);
$router->add('pilotes/{id:\d+}/delete', ['controller' => 'PilotesController', 'action' => "delete"]);

// students routes
$router->add('students', ['controller' => 'StudentController', 'action' => "index"]);
$router->add('students/{id:\d+}', ['controller' => 'StudentController', 'action' => "profile"]);
$router->add('students/create', ['controller' => 'StudentController', 'action' => "create"]);
$router->add('students/{id:\d+}/update', ['controller' => 'StudentController', 'action' => "update"]);
$router->add('students/{id:\d+}/delete', ['controller' => 'StudentController', 'action' => "delete"]);
$router->add('students/{id:\d+}/wishlist', ['controller' => 'StudentController', 'action' => "wishlistIndex"]);
$router->add('students/{id:\d+}/wishlist/add/{to_add:\d+}', ['controller' => 'StudentController', 'action' => "wishlistAdd"]);
$router->add('students/{id:\d+}/wishlist/delete/{to_delete:\d+}', ['controller' => 'StudentController', 'action' => "wishlistDelete"]);
$router->add('students/{id:\d+}/applications', ['controller' => 'StudentController', 'action' => "applications"]);

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
