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
    public function student_page()
    {
        $notifications = array();
        $offres = Candidature::readAllByUser(1);

        View::render('Student_page.php', compact("notifications", "offres"));
    }

    public function student_profile()
    {
        $user = User::readOnebyId($_SESSION['id_user']);

        View::render('Profile_student_view.php', compact('user'));
    }

    public function student_update()
    {
        //TODO
    }

    public function wishlist()
    {
        //TODO
    }
}
