<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * User model
 */
class User extends Model {
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
     * Get user role by id
     * @param int $id User's id
     * @return array|false User's data or false if user not found
     */
    public static function readRoleById(int $id) {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT id_role FROM users WHERE id_user = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn();
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

        // get permission from database
        $stmt = $db->prepare("SELECT is_enabled FROM user_permission LEFT JOIN permissions USING (id_permission)
                                    WHERE user_permission.id_user = :id_user AND permissions.nom_permission = :permission");
        $stmt->bindValue(':id_user', $id_user);
        $stmt->bindValue(':permission', $permission);
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
