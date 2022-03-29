<?php

namespace App\Controllers;

use App\Models\Entreprise;
use Core\Controller;
use Core\View;

/**
 * Terms controller
 *
 * PHP version 7.0
 */
class TermsController extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function view()
    {
        View::render('Terms_of_use.html');
    }
}
