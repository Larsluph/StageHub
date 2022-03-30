<?php

namespace App\Controllers;

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
     *
     * @return void
     */
    public function index()
    {
        if (array_key_exists("id_entreprise", $_GET)) {
            self::profile($_GET["id_entreprise"]);
        }
        else {
            $notifications = array(); // FIXME: get notifications from database
            $entreprises = Entreprise::readAll();
            View::render('Companies.php', compact("notifications", "entreprises"));
        }
    }

    public function profile(int $id_entreprise)
    {
        $notifications = array(); // FIXME: get notifications from database
        $entreprise = Entreprise::readOneById($id_entreprise);
        $offres = OffreStage::readAllByEntreprise($id_entreprise);
        View::render('Company.php', compact(["notifications", "entreprise", "offres"]));
    }

    public function create()
    {
        if (!empty($_POST)) {
            Entreprise::create(
                $_POST['nom_entreprise'],
                explode('|', $_POST['localites']),
                explode('|', $_POST['secteurs'])
            );
            Router::redirect('/companies');
        }
        View::render('Company_Create.php');
    }

    public function update()
    {
        if (!empty($_POST)) {
            Entreprise::update(
                $_POST['id_entreprise'],
                $_POST['nom_entreprise'],
                explode('|', $_POST['localites']),
                explode('|', $_POST['secteurs'])
            );
            Router::redirect('/companies');
        }
        else {
            $entreprise = Entreprise::readOneById($_GET['id_entreprise']);
            View::render('Company_Update.php', compact('entreprise'));
        }
    }

    public function delete()
    {
        // TODO: delete company
    }

    public function applications()
    {
        // TODO : company applications
        View::render('Company_Applications.php');
    }
}