<?php

namespace App\Models;

use PDO;

/**
 * Localite Model
 */
class Localite extends \Core\Model
{
    /**
     * Get one localite by id
     * @param int $id id localite
     * @return array
     */
    public static function readOneById(int $id): array
    {
        $sql = "SELECT * FROM localites WHERE id_localite = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get one localite by name
     * @param string $name name localite
     * @return array
     */
    public static function readOneByName(string $name): array
    {
        $sql = "SELECT * FROM localites WHERE nom_localite = :name";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get all localites
     *
     * @return array
     */
    public static function readAll(): array
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
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
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
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
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