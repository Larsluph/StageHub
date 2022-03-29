<?php

namespace App\Controllers;

use App\Models\Entreprise;
use Core\Controller;
use Core\View;

/**
 * Home and terms controller
 *
 * PHP version 7.0
 */
class HomeController extends Controller
{

    /**
     * Show the index page and terms and conditions page
     *
     * @return void
     */
    public function index()
    {
        View::render('Principal_page.html');
    }

    public function terms()
    {
        View::render('Terms_of_use.html');
    }
}
