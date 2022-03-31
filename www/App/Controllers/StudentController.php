<?php

namespace App\Controllers;

use App\Models\Candidature;
use App\Models\User;
use Core\Controller;
use Core\View;

/**
 * Student controller
 *
 * PHP version 7.0
 */
class StudentController extends Controller
{

    /**
     * Show the student page
     *
     * @return void
     */
    public function index()
    {
        AccountController::redirectIfNotLoggedIn();

        $notifications = array(); // TODO: get notifications from database
        $offres = Candidature::readAllByUser(1); // FIXME: get correct user id

        View::render('Student_Page.php', compact("notifications", "offres"));
    }

    public function profile()
    {
        AccountController::redirectIfNotLoggedIn();

        $user = User::readOnebyId($_COOKIE['id_user']);

        View::render('Student_Profile.php', compact('user'));
    }

    public function create()
    {
        AccountController::blockIfNotLoggedIn('etudiant_add');

        //TODO: create a new user
    }

    public function update()
    {
        AccountController::blockIfNotLoggedIn('etudiant_edit');

        //TODO: update student
        View::render('Student_Update.php');
    }

    public function delete()
    {
        AccountController::blockIfNotLoggedIn('etudiant_delete');

        //TODO: delete student
    }

    public function wishlist()
    {
        //TODO : wishlist gestion etc 
        view::render('Wishlist.html');
    }

    public function applications()
    {
        AccountController::blockIfNotLoggedIn();

        //TODO : student application
        View::render('Student_Applications.php');
    }
}
