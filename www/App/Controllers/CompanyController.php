<?php

namespace App\Controllers;

use App\Models\Candidature;
use App\Models\Entreprise;
use App\Models\OffreStage;
use Core\Controller;
use Core\Router;
use Core\View;

/**
 * Company Controller
 */
class CompanyController extends Controller
{
    /**
     * Show the index page
     * @return void
     */
    public function index()
    {
        AccountController::redirectIfNotLoggedIn();

        // Show all companies
        $notifications = array(
            ["title"=> "Isla Stage", "content"=> "New offer !"]
        ); // FIXME: get notifications from database
        $entreprises = Entreprise::readAll();
        View::render('Companies.php', compact("notifications", "entreprises"));
    }

    public function profile()
    {
        AccountController::redirectIfNotLoggedIn();

        // Show company profile
        $id_entreprise = $this->route_params["id"];
        $notifications = array(); // FIXME: get notifications from database
        $entreprise = Entreprise::readOneById($id_entreprise);
        $offres = OffreStage::readAllByEntreprise($id_entreprise);
        View::render('Company.php', compact(["notifications", "entreprise", "offres"]));
    }

    public function create()
    {
        AccountController::blockIfNotLoggedIn('entreprise_create');

        if (!empty($_POST)) {
            Entreprise::create(
                $_POST['nom_entreprise'],
                explode('|', $_POST['localites']),
                explode('|', $_POST['secteurs'])
            );
            Router::redirect('/companies');
        }
        View::render('Company_Create.html');
    }

    public function update()
    {
        AccountController::blockIfNotLoggedIn('entreprise_edit');

        $id_entreprise = $this->route_params["id"];
        if (!empty($_POST)) {
            Entreprise::update(
                $id_entreprise,
                $_POST['nom_entreprise'],
                explode('|', $_POST['localites']),
                explode('|', $_POST['secteurs'])
            );
            Router::redirect('/companies');
        }
        else {
            $entreprise = Entreprise::readOneById($id_entreprise);
            View::render('Company_Update.php', compact('entreprise'));
        }
    }

    public function delete()
    {
        AccountController::blockIfNotLoggedIn('entreprise_delete');

        $id_entreprise = $this->route_params['id'];
        Entreprise::delete($id_entreprise);
        Router::redirect('/companies');
    }

    public function applications()
    {
        AccountController::blockIfNotLoggedIn();


        $id_entreprise = $this->route_params['id'];
        $candidatures = array();
        foreach (OffreStage::readAllByEntreprise($id_entreprise) as $offre) {
            $candidatures = array_merge($candidatures, Candidature::readAllByOffre($offre['id_offre']));
        }

        View::render('Company_Applications.php', compact("candidatures"));
    }
}