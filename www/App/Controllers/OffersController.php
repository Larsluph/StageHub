<?php

namespace App\Controllers;

use App\Models\OffreStage;
use App\Models\Entreprise;
use Core\Controller;
use Core\Router;
use Core\View;
use DateTime;

/**
 * Offers controller
 *
 * PHP version 7.0
 */
class OffersController extends Controller
{

    /**
     * Show the company page
     *
     * @return void
     */
    public function index()
    {
        $notifications = array(); // FIXME: get notifications from database
        $offres = OffreStage::readAllByEntreprise(1); // FIXME: fetch company id
        $id_entreprise = 1;
        View::render('Company_Page.php', compact("notifications", "offres", "id_entreprise"));
    }

    public function create()
    {
        if (!empty($_POST)) {
            $new_offre = OffreStage::create(
                $_POST['offer_name'],
                $_POST['duration'],
                $_POST['salary'],
                DateTime::createFromFormat('Y-m-d', $_POST['start_date']),
                $_POST['number_of_offers'],
                $_POST['id_entreprise'],
                explode('|', $_POST['location']),
                explode('|', $_POST['skills']),
            );
            Router::redirect('/company');
        }
        else
        {
            View::render('Offer_Create.php');
        }
    }

    public function update()
    {
        if (!empty($_POST)) {
            OffreStage::update(
                $_POST['id_offre'],
                $_POST['offer_name'],
                $_POST['duration'],
                $_POST['salary'],
                DateTime::createFromFormat('Y-m-d', $_POST['start_date']),
                $_POST['number_of_offers'],
                $_POST['id_entreprise'],
                explode('|', $_POST['location']),
                explode('|', $_POST['skills'])
            );
            Router::redirect('/company');
        }
        else
        {
            $offre = OffreStage::readOneById($_GET['id_offre']);
            view::render('Offer_Update.php', compact("offre"));
        }
    }

    public function delete() {
        OffreStage::delete($_GET['id_offre']);
        Router::redirect('/company');
    }
}
