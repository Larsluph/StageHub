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
$router->add('termsofuse', ['controller' => 'HomeController', 'action' => "terms"]);

// company routes
$router->add('company', ['controller' => 'CompanyController', 'action' => "company_page"]);
$router->add('company/profile', ['controller' => 'CompanyController', 'action' => "company_profile"]);
$router->add('company/post', ['controller' => 'CompanyController', 'action' => "company_post"]); // TODO
$router->add('company/update', ['controller' => 'CompanyController', 'action' => "company_update"]); // TODO - Emmmene vers la page pour modif l'entreprise info et offre et supp

// student routes
$router->add('student', ['controller' => 'StudentController', 'action' => "student_page"]);
$router->add('student/profile', ['controller' => 'StudentController', 'action' => "student_profile"]);
$router->add('student/update', ['controller' => 'StudentController', 'action' => "student_update"]); //TODO - Emmene vers la page pour modif les infos de letudiant ? 
$router->add('student/wishlist', ['controller' => 'StudentController', 'action' => "wishlist"]); // TODO - Emmene vers la wishlist 

// admin routes
$router->add('admin', ['controller' => 'AdminController', 'action' => "view"]); // TODO - vu admin avec fonctionnalitéés?

/**
 * Processing / Rendering (call to Controllers)
 */
$router->dispatch($_SERVER['QUERY_STRING']);
