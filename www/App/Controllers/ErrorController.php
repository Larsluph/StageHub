<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\View;

/**
 * Error controller
 *
 * PHP version 7.0
 */
class ErrorController extends Controller
{
    public function forbidden()
    {
        View::render('403.html');
    }

    public function notFound()
    {
        View::render('404.html');
    }
}
