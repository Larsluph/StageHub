<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Promotion Model
 */
class Promotion extends Model
{
    /**
     * Get one promotion by id
     * @param  int $id
     * @return array
     */
    public static function readOneById(int $id): array
    {
        $sql = "SELECT * FROM promotions WHERE id_promo = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get one promotion by name
     * @param  string $name
     * @return array
     */
    public static function readOneByName(string $name): array
    {
        $sql = 'SELECT * FROM promotions WHERE nom_promo = :name';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all promotions
     * @return array
     */
    public static function readAll(): array
    {
        $pdo = static::getDB();
        $stmt = $pdo->query("SELECT * FROM promotions");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new promotion
     * @param  string $name
     * @return int
     */
    public static function create(string $name): int
    {
        $sql = "INSERT INTO promotions (nom_promo) VALUES (:name)";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $pdo->lastInsertId();
    }

    /**
     * Updates a promotion
     * @param int $id
     * @param string $name
     * @return void
     */
    public static function update(int $id, string $name): void
    {
        $sql = "UPDATE promotions SET nom_promo = :name WHERE id_promo = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
    }

    /**
     * Deletes a promotion
     * @param  int $id
     * @return void
     */
    public static function delete(int $id): void
    {
        $sql = "DELETE FROM promotions WHERE id_promo = :id";
        $pdo = static::getDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}