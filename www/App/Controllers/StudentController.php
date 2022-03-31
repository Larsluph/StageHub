<?php

namespace App\Controllers;

use App\Models\Candidature;
use App\Models\Role;
use App\Models\User;
use Core\Controller;
use Core\Router;
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

        $notifications = array(
            ["title"=> "Isla Stage", "content"=> "New offer !"]
        );

        if (array_key_exists('student_name', $_GET)) {
            $name_student = $_GET['student_name'];
            $etudiants = array();
            foreach (User::readAllByRole(Role::STUDENT_ROLE_ID) as $etudiant) {
                $full_name = $etudiant['nom_user'] . ' ' . $etudiant['prenom_user'];
                if (strpos(strtolower($full_name), strtolower($name_student)) !== false) {
                    $etudiants[] = $etudiant;
                }
            }
        }
        else {
            $etudiants = User::readAllByRole(Role::STUDENT_ROLE_ID);
        }

        View::render('Students.php', compact("notifications", "etudiants"));
    }

    public function profile()
    {
        AccountController::redirectIfNotLoggedIn();

        $user = User::readOnebyId($this->route_params['id']);

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

        $id_student = $this->route_params["id"];
        User::delete($id_student);
        Router::redirect("/students");
    }

    public function wishlistIndex()
    {
        AccountController::redirectIfNotLoggedIn();

        //TODO : wishlist gestion etc 
        view::render('Wishlist.html');
    }

    public function wishlistAdd()
    {
        $id = $this->route_params['to_add'];
    }

    public function wishlistDelete()
    {
        $id = $this->route_params['to_delete'];
    }

    public function applications()
    {
        AccountController::blockIfNotLoggedIn();

        //TODO : student application
        View::render('Student_Applications.php');
    }
}
