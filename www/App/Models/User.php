<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * User model
 */
class User extends Model {
    /**
     * Get user by id
     * @param int $id User's id
     * @return array|false User's data or false if user not found
     */
    public static function readOneById(int $id) {
        $sql = 'SELECT * FROM users WHERE id_user = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get user by email and password
     * @param string $username User's email
     * @param string $hash User's hash
     * @return array|false User's data or false if user not found
     */
    public static function readOneByLogin(string $username, string $hash)
    {
        $sql = 'SELECT * FROM users WHERE username = :username AND hash = :hash';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':hash', $hash);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get user role by id
     * @param int $id User's id
     * @return array|false User's data or false if user not found
     */
    public static function getUserRole(int $id) {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT id_role FROM users WHERE id_user = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Get all users by role
     * @param int $id_role User's role
     * @return array|false Users' data or false if user not found
     */
    public static function readAllByRole(int $id_role) {
        $db = static::getDB();
        $sql = 'SELECT nom_promo, users.* FROM users LEFT JOIN user_promo USING (id_user) LEFT JOIN promotions USING (id_promo) WHERE id_role = :id_role';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_role', $id_role);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Checks if user has permission
     * @param int $id_user User's id
     * @param string $permission Permission to check
     * @return bool True if user has permission, false otherwise
     */
    public static function hasPermission(int $id_user, string $permission): bool
    {
        // if root user, grant all permissions
        if ($id_user == 0) {
            return true;
        }

        $db = static::getDB();

        $permission_id = Permission::getIdByName($permission);

        // get permission from database
        $sql = "SELECT is_enabled FROM user_permission WHERE user_permission.id_user = :id_user AND user_permission.id_permission = :id_permission";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_user', $id_user);
        $stmt->bindValue(':id_permission', $permission_id);
        $stmt->execute();
        $is_enabled = $stmt->fetchColumn();

        // if override is found in the database, return it
        if ($is_enabled !== false)
            return (bool)$is_enabled;

        // else check if user has permission in the role
        $stmt = $db->prepare("SELECT id_role FROM users WHERE id_user = :id_user");
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();
        $id_role = $stmt->fetchColumn();

        return $id_role == Role::ADMIN_ROLE_ID || Permission::$defaultPerms[$id_role][$permission];
    }
}
