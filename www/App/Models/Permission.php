<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Permission Model
 */
class Permission extends Model
{
    /**
     * Get one permission by id
     * @param int $id id permission
     * @return array
     */
    public static function readOneById(int $id): array
    {
        $sql = "SELECT * FROM permissions WHERE id_permission = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get one permission by name
     * @param string $name name permission
     * @return array
     */
    public static function readOneByName(string $name): array
    {
        $sql = "SELECT * FROM permissions WHERE nom_permission = :name";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get all permissions
     *
     * @return array
     */
    public static function readAll(): array
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM permissions");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new permission
     * @param string $name name permission
     * @return int
     */
    public static function create(string $name): int
    {
        $sql = "INSERT INTO permissions (nom_permission) VALUES (:name)";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $db->lastInsertId();
    }

    /**
     * Updates a permission
     * @param int $id id permission
     * @param string $name name permission
     * @return void
     */
    public static function update(int $id, string $name): void
    {
        $sql = "UPDATE permissions SET nom_permission = :name WHERE id_permission = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
    }

    /**
     * Deletes a permission
     * @param  int $id id permission
     * @return void
     */
    public static function delete(int $id): void
    {
        $sql = "DELETE FROM permissions WHERE id_permission = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}