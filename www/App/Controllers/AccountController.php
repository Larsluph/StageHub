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
     * @param string|null $required_permission
     * @param int|null $required_role
     * @return void
     */
    public static function blockIfNotLoggedIn(?string $required_permission = null, ?int $required_role = null): void
    {
        // if user isn't logged in or doesn't have required permission
        if (!self::isLoggedIn() || !User::hasPermission($_COOKIE['id_user'], $required_permission)) {
            ErrorController::forbidden();
        }
    }

    /**
     * Redirects the user if he doesn't have permission to access the page
     * @param string|null $required_permission
     * @param int|null $required_role
     * @return void
     */
    public static function redirectIfNotLoggedIn(?string $required_permission = null, ?int $required_role = null): void
    {
        // if user isn't logged in or doesn't have required permission
        if (!self::isLoggedIn() || !User::hasPermission($_COOKIE['id_user'], $required_permission)) {
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
                Router::redirect('/student');
            }
            else {
                // Login failed
                View::render("Login_page.html");
            }
        }
    }

    public function logout() {
        setcookie('loggedin', false, time() - 3600);
        setcookie('id_user', '', time() - 3600);
        Router::redirect('/login');
    }

    protected static function checkForLogin(string $username, string $password): bool {
        $hash = hash('sha256', $password);
        $user = User::readOneByLogin($username, $hash);
        if ($user) {
            setcookie("loggedin", "true", time() + (86400 * 30), "/");
            setcookie("id_user", $user['id_user'], time() + (86400 * 30), "/");
            return true;
        }
        return false;
    }

    public static function isLoggedIn(): bool
    {
        return (array_key_exists('loggedin', $_COOKIE) && $_COOKIE['loggedin'] == true);
    }

    /**
     * Alias for User::hasPermission
     * @param string $permission
     * @return bool
     */
    public static function checkForPermission(string $permission): bool
    {
        if (self::isLoggedIn()) {
            return User::hasPermission($_COOKIE['id_user'], $permission);
        }
        else return false;
    }
}
