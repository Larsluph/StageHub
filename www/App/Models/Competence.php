<?php

namespace App\Models;

use PDO;

/**
 * Localite Model
 */
class Competence extends \Core\Model
{
    /**
     * Get one competence by id
     * @param int $id id competence
     * @return array
     */
    public static function readOneById(int $id): array
    {
        $sql = "SELECT * FROM competences WHERE id_competence = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get one competence by name
     * @param string $name name competence
     * @return array
     */
    public static function readOneByName(string $name): array
    {
        $sql = "SELECT * FROM competences WHERE nom_competence = :name";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get all competences
     *
     * @return array
     */
    public static function readAll(): array
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM competences");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new competence
     * @param string $name name competence
     * @return int
     */
    public static function create(string $name): int
    {
        $sql = "INSERT INTO competences (nom_competence) VALUES (:name)";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $db->lastInsertId();
    }

    /**
     * Updates a competence
     * @param int $id id competence
     * @param string $name name competence
     * @return void
     */
    public static function update(int $id, string $name): void
    {
        $sql = "UPDATE competences SET nom_competence = :name WHERE id_competence = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * Deletes a competence
     * @param  int $id id competence
     * @return void
     */
    public static function delete(int $id): void
    {
        $sql = "DELETE FROM competences WHERE id_competence = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}