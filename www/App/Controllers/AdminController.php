<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\View;

/**
 * Admin controller
 *
 * PHP version 7.0
 */
class AdminController extends Controller
{

    /**
     * Show the admin page
     *
     * @return void
     */
    public function dashboard()
    {
        // TODO: create page for admin
        View::render('Admin_page.php');
    }
}
