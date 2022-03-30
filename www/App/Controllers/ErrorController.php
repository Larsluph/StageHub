<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\View;
use Exception;

/**
 * Error controller
 *
 * PHP version 7.0
 */
class ErrorController extends Controller
{
    public static function forbidden()
    {
        http_response_code(403);
        View::render('403.html');
    }

    public static function notFound()
    {
        http_response_code(404);
        View::render('404.html');
    }

    public static function unknownError(Exception $exception) {
        http_response_code(500);
//        View::render('500.html');
        echo "<pre>$exception->getMessage()\n$exception->getTraceAsString()</pre>";
    }
}
