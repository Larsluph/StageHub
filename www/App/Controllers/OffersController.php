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
        AccountController::redirectIfNotLoggedIn();

        $notifications = array(
            ["title"=> "Isla Stage", "content"=> "New offer !"]
        );
        $offres = OffreStage::readAll();
        View::render('Offers.php', compact("notifications", "offres"));
    }

    public function create()
    {
        AccountController::blockIfNotLoggedIn('offre_add');

        if (!empty($_POST)) {
            OffreStage::create(
                $_POST['offer_name'],
                $_POST['duration'],
                $_POST['salary'],
                DateTime::createFromFormat('Y-m-d', $_POST['start_date']),
                $_POST['number_of_offers'],
                $_POST['id_entreprise'],
                explode('|', $_POST['location']),
                explode('|', $_POST['skills']),
            );
            Router::redirect('/companies' . $_POST['id_entreprise']);
        }

        $id_entreprise = $_GET['id_entreprise'];
        View::render('Offer_Create.php', compact("id_entreprise"));
    }

    public function update()
    {
        AccountController::blockIfNotLoggedIn('offre_edit');

        $id_offre = $this->route_params['id'];
        if (!empty($_POST)) {
            OffreStage::update(
                $id_offre,
                $_POST['offer_name'],
                $_POST['duration'],
                $_POST['salary'],
                DateTime::createFromFormat('Y-m-d', $_POST['start_date']),
                $_POST['number_of_offers'],
                $_POST['id_entreprise'],
                explode('|', $_POST['location']),
                explode('|', $_POST['skills'])
            );
            Router::redirect('/companies');
        }
        else
        {
            $offre = OffreStage::readOneById($id_offre);
            view::render('Offer_Update.php', compact("offre"));
        }
    }

    public function delete() {
        AccountController::blockIfNotLoggedIn('offre_delete');

        $id_offre = $this->route_params['id'];
        $id_entreprise = OffreStage::readOneById($id_offre)['id_entreprise'];
        OffreStage::delete($id_offre);
        Router::redirect('/companies/' . $id_entreprise);
    }
}
