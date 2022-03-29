<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\View;

/**
 * Profile Student controller
 *
 * PHP version 7.0
 */
class ProfStudentController extends Controller
{

    /**
     * Show the company page
     *
     * @return void
     */
    public function view()
    {
        $user = User::readOnebyId($_SESSION['id_user']);

        View::render('Profile_student_view.php', compact('user'));
    }
}
