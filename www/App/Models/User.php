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
    public static function readOneByLogin(string $username, string $hash): array
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
     * @return array User's data or false if user not found
     */
    public static function readOneById(int $id): array {
        $sql = 'SELECT * FROM users WHERE id_user = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
