<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

/**
 * Error controller
 *
 * PHP version 7.0
 */
class ErrorController extends Controller
{
    public function notFound()
    {
        View::render('404.html');
    }
}
