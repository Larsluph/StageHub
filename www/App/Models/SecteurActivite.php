<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Localite Model
 */
class SecteurActivite extends Model
{
    /**
     * Get one secteur activite by id
     * @param int $id id secteur activite
     * @return array
     */
    public static function readOneById(int $id): array
    {
        $sql = "SELECT * FROM secteurs_activite WHERE id_secteur_activite = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get one secteur activite by name
     * @param string $name name secteur activite
     * @return array
     */
    public static function readOneByName(string $name): array
    {
        $sql = "SELECT * FROM secteurs_activite WHERE nom_secteur_activite = :name";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get all secteurs activite
     *
     * @return array
     */
    public static function readAll(): array
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM secteurs_activite");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new secteur activite
     * @param string $name name secteur activite
     * @return int
     */
    public static function create(string $name): int
    {
        $sql = "INSERT INTO secteurs_activite (nom_secteur_activite) VALUES (:name)";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $db->lastInsertId();
    }

    /**
     * Updates a secteur activite
     * @param int $id id secteur activite
     * @param string $name name secteur activite
     * @return void
     */
    public static function update(int $id, string $name): void
    {
        $sql = "UPDATE secteurs_activite SET nom_secteur_activite = :name WHERE id_secteur_activite = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
    }

    /**
     * Deletes a secteur activite
     * @param  int $id id secteur activite
     * @return void
     */
    public static function delete(int $id): void
    {
        $sql = "DELETE FROM secteurs_activite WHERE id_secteur_activite = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}