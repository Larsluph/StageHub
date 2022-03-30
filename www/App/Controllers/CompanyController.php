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

    public function companyPost()
    {
        //TODO : company post
        /*
        offer_name
        duration
        location
        salary
        start_date
        number_of_offers
        */
        view::render('Company_Post_Stage.php');
    }

    public function companyUpdate()
    {
        //TODO : company update
        /*
        */
        view::render('Company_Update_Stage.php');
    }

    public function companyApplications()
    {
        // TODO : company applications 
        view::render('Company_Applications.php');
    }
}
