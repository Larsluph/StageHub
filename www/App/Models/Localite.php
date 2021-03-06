<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Localite Model
 */
class Localite extends Model
{
    /**
     * Get one localite by id
     * @param int $id id localite
     * @return array|false
     */
    public static function readOneById(int $id)
    {
        $sql = "SELECT * FROM localites WHERE id_localite = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get one localite by name
     * @param string $name name localite
     * @return int|false
     */
    public static function getIdByName(string $name)
    {
        $sql = "SELECT id_localite FROM localites WHERE nom_localite = :name";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Get all localites
     *
     * @return array|false
     */
    public static function readAll()
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM localites");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new localite
     * @param string $name name localite
     * @return int
     */
    public static function create(string $name): int
    {
        $sql = "INSERT INTO localites (nom_localite) VALUES (:name)";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $db->lastInsertId();
    }

    /**
     * Updates a localite
     * @param int $id id localite
     * @param string $name name localite
     * @return void
     */
    public static function update(int $id, string $name): void
    {
        $sql = "UPDATE localites SET nom_localite = :name WHERE id_localite = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
    }

    /**
     * Deletes a localite
     * @param  int $id id localite
     * @return void
     */
    public static function delete(int $id): void
    {
        $sql = "DELETE FROM localites WHERE id_localite = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}