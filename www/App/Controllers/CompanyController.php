<?php

namespace App\Controllers;

use App\Models\OffreStage;
use Core\Controller;
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
        $notifications = array(); // FIXME: get notifications from database
        $offres = OffreStage::readAllByEntreprise(1); // FIXME: fetch company id
        $id_entreprise = 1;
        View::render('Company.php', compact("notifications", "offres", "id_entreprise"));
    }

    public function create()
    {
        if (!empty($_POST)) {
            //TODO: validate the form data
        }
        else {
            //TODO: display the form
        }
    }

    public function update()
    {
        // TODO: update company
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