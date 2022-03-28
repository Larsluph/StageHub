<?php

namespace App\Controllers;

use App\Models\Candidature;
use Core\Controller;
use Core\View;

/**
 * Company controller
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
    public function view()
    {
        $notifications = array();
        $offres = Candidature::readAllByUser(1);

        View::render('Student_page.php', compact("notifications", "offres"));
    }
}
