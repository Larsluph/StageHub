<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

/**
 * Accounts controller
 */
class Accounts extends Controller
{
    public function login() {
        if (empty($_POST)) {
            View::render("Login_page.html");
        }
        else {
            if (self::checkForLogin($_POST['Email'], $_POST['password'])) {
                // Login successful
                View::render("Principal_page.html");
            }
            else {
                // Login failed
                View::render("Login_page.html");
            }
        }
    }

    protected static function checkForLogin(string $username, string $password): bool {
        $hash = hash('sha256', $password);
        return true;
    }
}
