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
    public function studentPage()
    {
        $notifications = array(); // TODO: get notifications from database
        $offres = Candidature::readAllByUser(1); // FIXME: get correct user id

        View::render('Student_page.php', compact("notifications", "offres"));
    }

    public function studentProfile()
    {
        $user = User::readOnebyId($_SESSION['id_user']);

        View::render('Profile_student_view.php', compact('user'));
    }

    public function studentUpdate()
    {
        //TODO: update student profile
    }

    public function wishlist()
    {
        //TODO: show student wishlist
    }

    public function studentStage()
    {
        View::render('Stage_view.php');
    }
}
