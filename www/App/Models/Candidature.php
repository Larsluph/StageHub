<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Candidature Model
 */
class Candidature extends Model
{
    /**
     * Get one candidature by ids
     * @param int $id_offre id offre
     * @param int $id_user id user
     * @return array
     */
    public static function readOne(int $id_offre, int $id_user): array
    {
        $sql = "SELECT
                    offres_stage.*,
                    candidatures.is_in_wishlist,
                    candidatures.statut_reponse,
                    GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                    GROUP_CONCAT(DISTINCT competences.nom_competence SEPARATOR '|') AS competences
                FROM
                    candidatures
                    LEFT JOIN offres_stage USING (id_offre)
                    LEFT JOIN offre_loc USING (id_offre)
                    LEFT JOIN localites USING (id_localite)
                    LEFT JOIN offre_competence USING (id_offre)
                    LEFT JOIN competences USING (id_competence)
                WHERE id_offre = :id_offre AND id_user = :id_user
                GROUP BY id_offre, id_user
                LIMIT 1";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all candidatures from a user as an associative array
     * @param int $id_user id user
     * @return array
     */
    public static function readAllByUser(int $id_user): array
    {
        $sql = "SELECT
                    offres_stage.*,
                    candidatures.is_in_wishlist,
                    candidatures.statut_reponse,
                    GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                    GROUP_CONCAT(DISTINCT competences.nom_competence SEPARATOR '|') AS competences
                FROM
                    candidatures
                    LEFT JOIN offres_stage USING (id_offre)
                    LEFT JOIN offre_loc USING (id_offre)
                    LEFT JOIN localites USING (id_localite)
                    LEFT JOIN offre_competence USING (id_offre)
                    LEFT JOIN competences USING (id_competence)
                WHERE id_user = :id_user
                GROUP BY id_offre, id_user";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all candidatures from an offre as an associative array
     * @param int $id_offre id offre
     * @return array
     */
    public static function readAllByOffre(int $id_offre): array
    {
        $sql = "SELECT
                    offres_stage.*,
                    candidatures.is_in_wishlist,
                    candidatures.statut_reponse,
                    GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                    GROUP_CONCAT(DISTINCT competences.nom_competence SEPARATOR '|') AS competences
                FROM
                    candidatures
                    LEFT JOIN offres_stage USING (id_offre)
                    LEFT JOIN offre_loc USING (id_offre)
                    LEFT JOIN localites USING (id_localite)
                    LEFT JOIN offre_competence USING (id_offre)
                    LEFT JOIN competences USING (id_competence)
                WHERE id_offre = :id_offre
                GROUP BY id_offre, id_user";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
     * @param bool|null $is_in_wishlist
     * @param int|null $statut_reponse
     * @param int|null $evaluation
     * @param string|null $cv
     * @param string|null $lettre_motivation
     * @param string|null $fiche_validation
     * @param string|null $convention_stage
     * @return void
     */
    public static function update(int $id_offre, int $id_user, bool $is_in_wishlist = null, int $statut_reponse = null, int $evaluation = null, string $cv = null, string $lettre_motivation = null, string $fiche_validation = null, string $convention_stage = null): void
    {
        $sql_args = [];
        $sql_args_bind = [
            'id_offre' => array($id_offre, PDO::PARAM_INT),
            'id_user' => array($id_user, PDO::PARAM_INT)];
        if ($is_in_wishlist !== null) {
            $sql_args[] = "is_in_wishlist = :is_in_wishlist";
            $sql_args_bind[':is_in_wishlist'] = array($is_in_wishlist, PDO::PARAM_BOOL);
        }
        if ($statut_reponse !== null) {
            $sql_args[] = "statut_reponse = :statut_reponse";
            $sql_args_bind[':statut_reponse'] = array($statut_reponse, PDO::PARAM_INT);
        }
        if ($evaluation !== null) {
            $sql_args[] = "evaluation = :evaluation";
            $sql_args_bind[':evaluation'] = array($evaluation, PDO::PARAM_INT);
        }
        if ($cv !== null) {
            $sql_args[] = "cv = :cv";
            $sql_args_bind[':cv'] = array(fopen($cv, 'rb'), PDO::PARAM_LOB);
        }
        if ($lettre_motivation !== null) {
            $sql_args[] = "lettre_motivation = :lettre_motivation";
            $sql_args_bind[':lettre_motivation'] = array(fopen($lettre_motivation, 'rb'), PDO::PARAM_LOB);
        }
        if ($fiche_validation !== null) {
            $sql_args[] = "fiche_validation = :fiche_validation";
            $sql_args_bind[':fiche_validation'] = array(fopen($fiche_validation, 'rb'), PDO::PARAM_LOB);
        }
        if ($convention_stage !== null) {
            $sql_args[] = "convention_stage = :convention_stage";
            $sql_args_bind[':convention_stage'] = array(fopen($convention_stage, 'rb'), PDO::PARAM_LOB);
        }
        $sql = "UPDATE candidatures SET " . implode(', ', $sql_args) . " WHERE id_offre = :id_offre AND id_user = :id_user";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        foreach ($sql_args_bind as $key => $value) {
            $stmt->bindValue($key, ...$value);
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