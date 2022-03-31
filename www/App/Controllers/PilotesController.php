<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use Core\Controller;
use Core\View;

/**
 * Pilotes controller
 *
 * PHP version 7.0
 */
class PilotesController extends Controller
{

    /**
     * Show the pilote page
     *
     * @return void
     */
    public function index()
    {
        AccountController::blockIfNotLoggedIn(null, Role::ADMIN_ROLE_ID);
        // TODO: create page for admin
        View::render('Pilotes.php');
    }
}
