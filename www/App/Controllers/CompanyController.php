<?php

namespace App\Controllers;

use App\Models\OffreStage;
use App\Models\Entreprise;
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
    public function company_page()
    {
        $notifications = array();
        $offres = OffreStage::readAllByEntreprise(1);

        View::render('Company_page.php', compact("notifications", "offres"));
    }
   
    public function company_profile()
    {
        $offres = OffreStage::readAllByEntreprise(1);
        $entreprises = Entreprise::readOne('nom_entreprise'); // cest de la merde ça

        View::render('Profile_company_view.php', compact('entreprises', "offres"));
    }

    public function company_post()
    {
        //TODO
    }

    public function company_update()
    {
        //TODO
    }
}
