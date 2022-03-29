<?php

namespace App\Controllers;

use App\Models\Permission;
use App\Models\User;
use Core\Controller;
use Core\Router;
use Core\View;

/**
 * Accounts controller
 */
class AccountController extends Controller
{
    public function login() {
        if (array_key_exists('loggedin', $_SESSION) && $_SESSION['loggedin'] == true) {
            Router::redirect('/student');
        }

        if (empty($_POST)) {
            View::render("Login_page.html");
        }
        else {
            if (self::checkForLogin($_POST['Email'], $_POST['password'])) {
                // Login successful
                print_r($_SESSION);
                Router::redirect('/student');
            }
            else {
                // Login failed
                View::render("Login_page.html");
            }
        }
    }

    public function logout() {
        session_destroy();
        Router::redirect('/login');
    }

    protected static function checkForLogin(string $username, string $password): bool {
        $hash = hash('sha256', $password);
        $user = User::readOneByLogin($username, $hash);
        if ($user) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id_user'] = $user['id_user'];
            return true;
        }
        return false;
    }

    public static function isLoggedIn(): bool
    {
        if ($_SESSION['loggedin'] == true) {
            return true;
        }
        return false;
    }

    public static function getUserPermission($permission): int
    {
        $user_id = $_SESSION['id_user'];
        // TODO: fetch permission from database
    }
}
