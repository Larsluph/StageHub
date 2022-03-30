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
    public function companyPage()
    {
        $notifications = array(); // FIXME: get notifications from database
        $offres = OffreStage::readAllByEntreprise(1); // FIXME: fetch company id

        View::render('Company_Page.php', compact("notifications", "offres"));
    }
   
    public function companyProfile()
    {
        $offres = OffreStage::readAllByEntreprise(1); // FIXME: fetch company id
        $entreprises = Entreprise::readOne('nom_entreprise'); // FIXME: bullshit

        View::render('Company_Profile.php', compact('entreprises', "offres"));
    }

    public function companyPost()
    {
        view::render('Company_Post_Stage.html');
    }

    public function companyUpdate()
    {
        view::render('Company_Update_Stage.php');
    }

    public function companyStage()
    {
        view::render('Company_Applications.php');
    }
}
