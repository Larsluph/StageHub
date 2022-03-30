<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Competence Model
 */
class Competence extends Model
{
    /**
     * Get one competence by id
     * @param int $id id competence
     * @return array|false
     */
    public static function readOneById(int $id)
    {
        $sql = "SELECT * FROM competences WHERE id_competence = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get competence id by name
     * @param string $name name competence
     * @return int|false
     */
    public static function getIdByName(string $name)
    {
        $sql = "SELECT id_competence FROM competences WHERE nom_competence = :name";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Get all competences
     *
     * @return array|false
     */
    public static function readAll()
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
        $stmt->bindValue(':name', $name);
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
        $stmt->bindValue(':name', $name);
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