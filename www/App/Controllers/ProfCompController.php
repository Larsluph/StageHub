<?php

namespace App\Controllers;

use App\Models\Entreprise;
use App\Models\OffreStage;
use Core\Controller;
use Core\View;

/**
 * Profile Company controller
 *
 * PHP version 7.0
 */
class ProfCompController extends Controller
{

    /**
     * Show the profile company page
     *
     * @return void
     */
    public function view()
    {
        $entreprises = Entreprise::readOne('nom_entreprise');
        $offres = OffreStage::readAllByEntreprise(1);


        View::render('Profile_company_view.php', compact('entreprises', "offres"));
    }
}
