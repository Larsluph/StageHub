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
    public function indexActio()
    {
        View::render('Home/index.php');
    }

    public function entreprises()
    {
        $entreprises = Entreprise::readAll();
        View::render('Home/entreprises.php', compact("entreprises"));
    }

}
