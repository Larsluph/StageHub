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
    /**
     * Returns 403 to the user if he doesn't have permission to access the page
     * @param int|null $required_role
     * @param string|null $required_permission
     * @return void
     */
    public static function blockIfNotLoggedIn(int $required_role = null, string $required_permission = null): void
    {
        // if user isn't logged in or doesn't have required permission
        if (!self::isLoggedIn() || !User::hasPermission($_SESSION['id_user'], $required_permission)) {
            Router::redirect('/403');
        }
    }

    /**
     * Redirects the user if he doesn't have permission to access the page
     * @param int|null $required_role
     * @param string|null $required_permission
     * @return void
     */
    public static function redirectIfNotLoggedIn(int $required_role = null, string $required_permission = null): void
    {
        // if user isn't logged in or doesn't have required permission
        if (!self::isLoggedIn() || !User::hasPermission($_SESSION['id_user'], $required_permission)) {
            Router::redirect('/login');
        }
    }

    public function login() {
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
        return (array_key_exists('loggedin', $_SESSION) && $_SESSION['loggedin'] == true);
    }

    /**
     * Alias for User::hasPermission
     * @param string $permission
     * @return bool
     */
    public static function checkForPermission(string $permission): bool
    {
        if (self::isLoggedIn()) {
            return User::hasPermission($_SESSION['id_user'], $permission);
        }
        else return false;
    }
}
