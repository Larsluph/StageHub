<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function readAll(): array
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id_user, username FROM users ORDER BY id_user');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
