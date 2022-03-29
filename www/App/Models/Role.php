<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Role Model
 */
class Role extends Model
{
    /**
     * Admin role id
     * @var int
     */
    const ADMIN_ROLE_ID = 0;

    /**
     * Tuteur role id
     * @var int
     */
    const TUTOR_ROLE_ID = 1;

    /**
     * Délégué role id
     * @var int
     */
    const DELEGATE_ROLE_ID = 2;

    /**
     * Etudiant role id
     * @var int
     */
    const STUDENT_ROLE_ID = 3;

    /**
     * Get one role by id
     * @param  int $id
     * @return array|false
     */
    public static function readOneById(int $id)
    {
        $sql = "SELECT * FROM roles WHERE id_role = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get one role by name
     * @param  string $name
     * @return array|false
     */
    public static function readOneByName(string $name)
    {
        $sql = 'SELECT * FROM roles WHERE nom_role = :name';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all roles
     * @return array|false
     */
    public static function readAll()
    {
        $pdo = static::getDB();
        $stmt = $pdo->query("SELECT * FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new role
     * @param  string $name
     * @return int
     */
    public static function create(string $name): int
    {
        $sql = "INSERT INTO roles (nom_role) VALUES (:name)";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $pdo->lastInsertId();
    }

    /**
     * Updates a role
     * @param int $id
     * @param string $name
     * @return void
     */
    public static function update(int $id, string $name): void
    {
        $sql = "UPDATE roles SET nom_role = :name WHERE id_role = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
    }

    /**
     * Deletes a role
     * @param  int $id
     * @return void
     */
    public static function delete(int $id): void
    {
        $sql = "DELETE FROM roles WHERE id_role = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}