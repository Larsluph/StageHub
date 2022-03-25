<?php

namespace App\Controllers;

use App\Models\Entreprise;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $entreprises = Entreprise::readAll();
        View::render('Home/index.php', compact("entreprises"));
    }
}
