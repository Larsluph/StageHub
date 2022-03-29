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
     * Default Role Permissions
     * @var array
     */
    static public array $defaultPerms = [
        Role::TUTOR_ROLE_ID => [
            'auth' => true,
            'entreprise_search' => true,
            'entreprise_add' => true,
            'entreprise_edit' => true,
            'entreprise_rate' => true,
            'entreprise_delete' => true,
            'entreprise_stats' => true,
            'offre_search' => true,
            'offre_add' => true,
            'offre_edit' => true,
            'offre_delete' => true,
            'offre_stats' => true,
            'pilote_search' => false,
            'pilote_add' => false,
            'pilote_edit' => false,
            'pilote_delete' => false,
            'delegue_search' => true,
            'delegue_add' => true,
            'delegue_edit' => true,
            'delegue_delete' => true,
            'delegue_assign' => true,
            'etudiant_search' => true,
            'etudiant_add' => true,
            'etudiant_edit' => true,
            'etudiant_delete' => true,
            'etudiant_stats' => true,
            'wishlist_add' => false,
            'wishlist_delete' => false,
            'offre_apply' => false,
            'notify_step1' => false,
            'notify_step2' => false,
            'notify_step3' => true,
            'notify_step4' => true,
            'notify_step5' => false
        ],
        Role::DELEGATE_ROLE_ID => [
            'auth' => true,
            'entreprise_search' => false,
            'entreprise_add' => false,
            'entreprise_edit' => false,
            'entreprise_rate' => false,
            'entreprise_delete' => false,
            'entreprise_stats' => false,
            'offre_search' => false,
            'offre_add' => false,
            'offre_edit' => false,
            'offre_delete' => false,
            'offre_stats' => false,
            'pilote_search' => false,
            'pilote_add' => false,
            'pilote_edit' => false,
            'pilote_delete' => false,
            'delegue_search' => false,
            'delegue_add' => false,
            'delegue_edit' => false,
            'delegue_delete' => false,
            'delegue_stats' => false,
            'etudiant_search' => false,
            'etudiant_add' => false,
            'etudiant_edit' => false,
            'etudiant_delete' => false,
            'etudiant_stats' => false,
            'wishlist_add' => false,
            'wishlist_delete' => false,
            'offre_apply' => false,
            'notify_step1' => false,
            'notify_step2' => false,
            'notify_step3' => false,
            'notify_step4' => false,
            'notify_step5' => false,
        ],
        Role::STUDENT_ROLE_ID => [
            'auth' => true,
            'entreprise_search' => true,
            'entreprise_add' => false,
            'entreprise_edit' => false,
            'entreprise_rate' => true,
            'entreprise_delete' => false,
            'entreprise_stats' => true,
            'offre_search' => true,
            'offre_add' => false,
            'offre_edit' => false,
            'offre_delete' => false,
            'offre_stats' => true,
            'pilote_search' => false,
            'pilote_add' => false,
            'pilote_edit' => false,
            'pilote_delete' => false,
            'delegue_search' => false,
            'delegue_add' => false,
            'delegue_edit' => false,
            'delegue_delete' => false,
            'delegue_stats' => false,
            'etudiant_search' => false,
            'etudiant_add' => false,
            'etudiant_edit' => false,
            'etudiant_delete' => false,
            'etudiant_stats' => false,
            'wishlist_add' => true,
            'wishlist_delete' => true,
            'offre_apply' => true,
            'notify_step1' => true,
            'notify_step2' => true,
            'notify_step3' => false,
            'notify_step4' => false,
            'notify_step5' => true
        ]
    ];

    /**
     * Get one permission by id
     * @param int $id id permission
     * @return array|false
     */
    public static function readOneById(int $id)
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
     * @return array|false
     */
    public static function readOneByName(string $name)
    {
        $sql = "SELECT * FROM permissions WHERE nom_permission = :name";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get all permissions
     *
     * @return array|false
     */
    public static function readAll()
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