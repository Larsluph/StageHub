<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Centre Model
 */
class Centre extends Model
{
    /**
     * Get one centre by id
     * @param  int $id
     * @return array|false
     */
    public static function readOneById(int $id)
    {
        $sql = "SELECT * FROM centres WHERE id_centre = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get one centre by name
     * @param  string $name
     * @return array|false
     */
    public static function readOneByName(string $name)
    {
        $sql = 'SELECT * FROM centres WHERE nom_centre = :name';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all centres
     * @return array|false
     */
    public static function readAll()
    {
        $pdo = static::getDB();
        $stmt = $pdo->query("SELECT * FROM centres");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new centre
     * @param  string $name
     * @return int
     */
    public static function create(string $name): int
    {
        $sql = "INSERT INTO centres (nom_centre) VALUES (:name)";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $pdo->lastInsertId();
    }

    /**
     * Updates a centre
     * @param int $id
     * @param string $name
     * @return void
     */
    public static function update(int $id, string $name): void
    {
        $sql = "UPDATE centres SET nom_centre = :name WHERE id_centre = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
    }

    /**
     * Deletes a centre
     * @param  int $id
     * @return void
     */
    public static function delete(int $id): void
    {
        $sql = "DELETE FROM centres WHERE id_centre = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}