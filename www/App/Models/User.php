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
        $sql = 'SELECT FIRST_VALUE(nom_promo) OVER (PARTITION BY nom_promo) AS nom_promo, users.* FROM users LEFT JOIN user_promo USING (id_user) LEFT JOIN promotions USING (id_promo) WHERE id_role = :id_role GROUP BY id_user';
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

    /**
     * Create user
     * @param string $username User's email
     * @param string $hash User's hash
     * @param string $nom_user User's name
     * @param string $prenom_user User's first name
     * @param int $id_role User's role
     * @return int|false User's id or false if user not created
     */
    public static function create(string $username, string $hash, string $nom_user, string $prenom_user, int $id_role): int
    {
        $db = static::getDB();
        $sql = 'INSERT INTO users (username, hash, nom_user, prenom_user, id_role) VALUES (:username, :hash, :nom_user, :prenom_user, :id_role)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':hash', $hash);
        $stmt->bindValue(':nom_user', $nom_user);
        $stmt->bindValue(':prenom_user', $prenom_user);
        $stmt->bindValue(':id_role', $id_role);
        $stmt->execute();
        return $db->lastInsertId();
    }

    /**
     * Update user
     * @param int $id_user User's id
     * @param string $username User's email
     * @param string $hash User's hash
     * @param string $nom_user User's name
     * @param string $prenom_user User's first name
     * @param int $id_role User's role
     * @return void
     */
    public static function update(int $id_user, string $username, string $hash, string $nom_user, string $prenom_user, int $id_role)
    {
        $db = static::getDB();
        $sql = 'UPDATE users SET username = :username, hash = :hash, nom_user = :nom_user, prenom_user = :prenom_user, id_role = :id_role WHERE id_user = :id_user';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_user', $id_user);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':hash', $hash);
        $stmt->bindValue(':nom_user', $nom_user);
        $stmt->bindValue(':prenom_user', $prenom_user);
        $stmt->bindValue(':id_role', $id_role);
        $stmt->execute();
        
    }

    /**
     * Delete user
     * @param int $id_user User's id
     * @return void
     */
    public static function delete(int $id_user)
    {
        $db = static::getDB();

        // delete linked centres
        $stmt = $db->prepare("DELETE FROM user_centre WHERE id_user = :id_user");
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();

        // delete linked permissions
        $stmt = $db->prepare("DELETE FROM user_permission WHERE id_user = :id_user");
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();

        // delete linked promotions
        $stmt = $db->prepare("DELETE FROM user_promo WHERE id_user = :id_user");
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();

        // delete user
        $sql = 'DELETE FROM users WHERE id_user = :id_user';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();
    }
}
