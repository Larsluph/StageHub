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
        $id_entreprise = 1;
        View::render('Company_Page.php', compact("notifications", "offres", "id_entreprise"));
    }

    public function companyPost()
    {
        if (!empty($_POST)) {
            OffreStage::create(
                $_POST['offer_name'],
                $_POST['duration'],
                $_POST['salary'],
                $_POST['start_date'],
                $_POST['number_of_offers'],
                $_POST['id_entreprise'],
                explode('|', $_POST['location']),
                explode('|', $_POST['skills']),
            );
        }
        else
        {
            View::render('Company_Post_Stage.php');
        }
    }

    public function companyUpdate()
    {
        if (!empty($_POST)) {
            OffreStage::update(
                $_POST['id_offre'],
                $_POST['offer_name'],
                $_POST['duration'],
                $_POST['salary'],
                $_POST['start_date'],
                $_POST['number_of_offers'],
                explode('|', $_POST['location']),
                explode('|', $_POST['skills'])
            );
        }
        else
        {
            $offre = OffreStage::readOneById($_GET['id_offre']);
            view::render('Company_Update_Stage.php', compact("offre"));
        }
    }

    public function companyApplications()
    {
        // TODO : company applications 
        view::render('Company_Applications.php');
    }
}
