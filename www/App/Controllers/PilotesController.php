<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use Core\Controller;
use Core\Router;
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
        AccountController::blockIfNotLoggedIn();
        
        $notifications = array(
            ["title"=> "Isla Stage", "content"=> "New offer !"]
        );

        if (array_key_exists('tutor_name', $_GET)) {
            $name_tutor = $_GET['tutor_name'];
            $pilotes = array();
            foreach (User::readAllByRole(Role::TUTOR_ROLE_ID) as $tutor) {
                $full_name = $tutor['nom_user'] . ' ' . $tutor['prenom_user'];
                if (strpos(strtolower($full_name), strtolower($name_tutor)) !== false) {
                    $pilotes[] = $tutor;
                }
            }
        }
        else {
            $pilotes = User::readAllByRole(Role::TUTOR_ROLE_ID);
        }
        View::render('Pilotes.php', compact("notifications","pilotes"));
    }
    
    public function create()
    {
        AccountController::blockIfNotLoggedIn('pilote_add');

        if (!empty($_POST)) {
            User::create(
                $_POST['username'],
                hash("sha256", $_POST['password']),
                $_POST['nom_user'],
                $_POST['prenom_user'],
                Role::TUTOR_ROLE_ID
            );
            Router::redirect('/pilotes');
        }
        View::render('Pilotes_Create.php');
    }

    public function update()
    {
        AccountController::blockIfNotLoggedIn('pilote_edit');

        $id_user = $this->route_params['id'];
        if (!empty($_POST)) {
            User::update(
                $id_user,
                $_POST['username'],
                hash("sha256", $_POST['password']),
                $_POST['nom_user'],
                $_POST['prenom_user'],
                Role::TUTOR_ROLE_ID
            );
            Router::redirect('/pilotes');
        }
        else
        {
            $user = User::readOneById($id_user);
            view::render('Pilotes_Update.php', compact("user"));
        }
    }

    public function delete() {
        AccountController::blockIfNotLoggedIn('pilote_delete');

        $id_user = $this->route_params['id'];
        User::delete($id_user);
        Router::redirect('/pilotes');
    }
}

