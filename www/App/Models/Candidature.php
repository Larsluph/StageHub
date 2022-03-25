<?php

namespace App\Models;

use PDO;

/**
 * Candidature Model
 */
class Candidature extends \Core\Model
{
    /**
     * Get one candidature by id
     * @param int $id_offre id offre
     * @param int $id_user id user
     * @return array
     */
    public static function readOne(int $id_offre, int $id_user): array
    {
        $sql = "SELECT * FROM candidatures WHERE id_offre = :id_offre AND id_user = :id_user";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get all candidatures from a user as an associative array
     * @param int $id_user id user
     * @return array
     */
    public static function readAllByUser(int $id_user): array
    {
        $sql = "SELECT * FROM candidatures WHERE id_user = :id_user";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get all candidatures from an offre as an associative array
     * @param int $id_offre id offre
     * @return array
     */
    public static function readAllByOffre(int $id_offre): array
    {
        $sql = "SELECT * FROM candidatures WHERE id_offre = :id_offre";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Filters a list of candidatures by statut_reponse
     * @param array $candidatures
     * @param int $statut_reponse
     * @return array
     */
    public static function filterByStatut(array $candidatures, int $statut_reponse): array
    {
        $filtered = [];
        foreach ($candidatures as $candidature) {
            if ($candidature['statut_reponse'] >= $statut_reponse) {
                $filtered[] = $candidature;
            }
        }
        return $filtered;
    }

    /**
     * Create a new candidature
     * @param int $id_offre id offre
     * @param int $id_user id user
     * @param bool $is_in_wishlist
     * @param int $statut_reponse
     * @return void
     */
    public static function create(int $id_offre, int $id_user, bool $is_in_wishlist, int $statut_reponse): void
    {
        $sql = "INSERT INTO candidatures (id_offre, id_user, is_in_wishlist, statut_reponse) VALUES (:id_offre, :id_user, :is_in_wishlist, :statut_reponse)";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindValue(':is_in_wishlist', $is_in_wishlist, PDO::PARAM_BOOL);
        $stmt->bindValue(':statut_reponse', $statut_reponse, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Update a candidature
     * @param int $id_offre id offre
     * @param int $id_user id user
     * @param bool $is_in_wishlist
     * @param int $statut_reponse
     * @param int|null $evaluation
     * @param string|null $cv
     * @param string|null $lettre_motivation
     * @param string|null $fiche_validation
     * @param string|null $convention_stage
     * @return void
     */
    public static function update(int $id_offre, int $id_user, bool $is_in_wishlist, int $statut_reponse, int $evaluation = null, string $cv = null, string $lettre_motivation = null, string $fiche_validation = null, string $convention_stage = null): void
    {
        $sql = "UPDATE candidatures
                SET
                    is_in_wishlist = :is_in_wishlist,
                    statut_reponse = :statut_reponse";
        if ($evaluation !== null) {
            $sql .= ", evaluation = :evaluation";
        }
        if ($cv !== null) {
            $sql .= ", cv = :cv";
        }
        if ($lettre_motivation !== null) {
            $sql .= ", lettre_motivation = :lettre_motivation";
        }
        if ($fiche_validation !== null) {
            $sql .= ", fiche_validation = :fiche_validation";
        }
        if ($convention_stage !== null) {
            $sql .= ", convention_stage = :convention_stage";
        }
        $cond = "WHERE id_offre = :id_offre AND id_user = :id_user";
        $db = static::getDB();
        $stmt = $db->prepare($sql.$cond);
        $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindValue(':is_in_wishlist', $is_in_wishlist, PDO::PARAM_BOOL);
        $stmt->bindValue(':statut_reponse', $statut_reponse, PDO::PARAM_INT);
        if ($evaluation !== null) {
            $stmt->bindValue(':evaluation', $evaluation, PDO::PARAM_INT);
        }
        if ($cv !== null) {
            $stmt->bindValue(':cv', fopen($cv, 'rb'), PDO::PARAM_LOB);
        }
        if ($lettre_motivation !== null) {
            $stmt->bindValue(':lettre_motivation', fopen($lettre_motivation, 'rb'), PDO::PARAM_LOB);
        }
        if ($fiche_validation !== null) {
            $stmt->bindValue(':fiche_validation', fopen($fiche_validation, 'rb'), PDO::PARAM_LOB);
        }
        if ($convention_stage !== null) {
            $stmt->bindValue(':convention_stage', fopen($convention_stage, 'rb'), PDO::PARAM_LOB);
        }
        $stmt->execute();
    }

    /**
     * Delete a candidature
     * @param int $id_offre id offre
     * @param int $id_user id user
     * @return void
     */
    public static function delete(int $id_offre, int $id_user): void
    {
        $sql = "DELETE FROM candidatures WHERE id_offre = :id_offre AND id_user = :id_user";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
    }
}