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
$router->add('company', ['controller' => 'CompanyController', 'action' => "companyPage"]);
$router->add('company/profile', ['controller' => 'CompanyController', 'action' => "companyProfile"]);
$router->add('company/post', ['controller' => 'CompanyController', 'action' => "companyPost"]); // TODO
$router->add('company/update', ['controller' => 'CompanyController', 'action' => "companyUpdate"]); // TODO - Emmmene vers la page pour modif l'entreprise info et offre et supp

// student routes
$router->add('student', ['controller' => 'StudentController', 'action' => "studentPage"]);
$router->add('student/profile', ['controller' => 'StudentController', 'action' => "studentProfile"]);
$router->add('student/update', ['controller' => 'StudentController', 'action' => "studentUpdate"]); //TODO - Emmene vers la page pour modif les infos de letudiant ?
$router->add('student/wishlist', ['controller' => 'StudentController', 'action' => "wishlist"]); // TODO - Emmene vers la wishlist 

// admin routes
$router->add('admin', ['controller' => 'AdminController', 'action' => "view"]); // TODO - vu admin avec fonctionnalitées?

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
            $router->redirect('404');
            break;
        default:
            $router->redirect('500');
            break;
    }
}
