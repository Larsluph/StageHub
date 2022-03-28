<?php

namespace App\Controllers;

use App\Models\OffreStage;
use Core\Controller;
use Core\View;

/**
 * Company controller
 *
 * PHP version 7.0
 */
class CompanyController extends Controller
{

    /**
     * Show the company page
     *
     * @return void
     */
    public function view()
    {
        $notifications = array();
        $offres = OffreStage::readAllByEntreprise(1);

        View::render('Company_page.php', compact("notifications", "offres"));
    }
}
