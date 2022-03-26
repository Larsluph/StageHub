<?php

namespace App\Controllers;

use App\Models\Entreprise;
use Core\Controller;
use Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index()
    {
        View::render('Principal_page.html');
    }
}
