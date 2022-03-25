<?php

namespace App\Models;

use Core\Model;
use DateTime;
use PDO;

/**
 * OffreStage Model
 */
class OffreStage extends Model
{
    /**
     * Get one offreStage by id
     * @param int $id id offreStage
     * @return array offreStage
     */
    public static function readOneById(int $id): array
    {
        $sql = "SELECT
                    offres_stage.*,
                    GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                    GROUP_CONCAT(DISTINCT competences.nom_competence SEPARATOR '|') AS competences
                FROM
                    offres_stage
                    LEFT JOIN offre_loc USING (id_offre)
                    LEFT JOIN localites USING (id_localite)
                    LEFT JOIN offre_competence USING (id_offre)
                    LEFT JOIN competences USING (id_competence)
                WHERE id_offre = :id
                GROUP BY id_offre";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get one offreStage by id_entreprise
     * @param int $id id entreprise
     * @return array offreStage
     */
    public static function readAllByEntreprise(int $id): array
    {
        $sql = "SELECT
                    offres_stage.*,
                    GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                    GROUP_CONCAT(DISTINCT competences.nom_competence SEPARATOR '|') AS competences
                FROM
                    offres_stage
                    LEFT JOIN offre_loc USING (id_offre)
                    LEFT JOIN localites USING (id_localite)
                    LEFT JOIN offre_competence USING (id_offre)
                    LEFT JOIN competences USING (id_competence)
                WHERE id_entreprise = :id
                GROUP BY id_offre";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get all offreStage
     * @return array offreStage
     */
    public static function readAll(): array
    {
        $sql = "SELECT
                    offres_stage.*,
                    GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                    GROUP_CONCAT(DISTINCT competences.nom_competence SEPARATOR '|') AS competences
                FROM
                    offres_stage
                    LEFT JOIN offre_loc USING (id_offre)
                    LEFT JOIN localites USING (id_localite)
                    LEFT JOIN offre_competence USING (id_offre)
                    LEFT JOIN competences USING (id_competence)
                GROUP BY id_offre";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Creates a new offreStage
     * @param string $nom_poste nom du poste à pourvoir
     * @param int $duree_stage duree du stage (en mois)
     * @param float $base_remuneration base de remuneration
     * @param DateTime $date_stage date de debut du stage
     * @param int $nbr_places nombre de places disponibles
     * @param int $id_entreprise id de l'entreprise
     * @param array $localites liste des localites
     * @param array $competences liste des compétences
     * @return int id offreStage
     */
    public static function create(
        string $nom_poste,
        int $duree_stage,
        float $base_remuneration,
        DateTime $date_stage,
        int $nbr_places,
        int $id_entreprise,
        array $localites,
        array $competences): int
    {
        // fetch db connection
        $db = static::getDB();

        // create offreStage
        $sql = "INSERT INTO offres_stage (nom_poste_offre, duree_stage, base_remuneration, date_stage, nbr_places_offre, id_entreprise)
                VALUES (:nom_poste, :duree_stage, :base_remuneration, :date_stage, :nbr_places, :id_entreprise)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':nom_poste', $nom_poste);
        $stmt->bindValue(':duree_stage', $duree_stage, PDO::PARAM_INT);
        $stmt->bindValue(':base_remuneration', $base_remuneration, PDO::PARAM_INT);
        $stmt->bindValue(':date_stage', $date_stage->format('Y-m-d'));
        $stmt->bindValue(':nbr_places', $nbr_places, PDO::PARAM_INT);
        $stmt->bindValue(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
        $stmt->execute();
        $id_offre = $db->lastInsertId();

        // bind localites
        self::bindLocalites($db, $id_offre, $localites);

        // bind competences
        self::bindCompetences($db, $id_offre, $competences);

        return $id_offre;
    }

    /**
     * Bind localites to offreStage
     * @param PDO $db db connection
     * @param int $id_offre id offreStage
     * @param array $localites liste des localites
     */
    protected static function bindLocalites(PDO $db, int $id_offre, array $localites): void
    {
        foreach ($localites as $localite) {
            // check if localite exists
            $id_localite = Localite::readOneByName($localite);
            // if not, create it
            if (!$id_localite) {
                // create localite
                $id_localite = Localite::create($localite);
            }
            // bind localite to offreStage
            $stmt = $db->prepare("INSERT INTO offre_loc (id_offre, id_localite) VALUES (:id_offre, :id_localite)");
            $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
            $stmt->bindValue(':id_localite', $id_localite, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    /**
     * Bind competences to offreStage
     * @param PDO $db db connection
     * @param int $id_offre id offreStage
     * @param array $competences liste des competences
     */
    protected static function bindCompetences(PDO $db, int $id_offre, array $competences): void
    {
        foreach ($competences as $competence) {
            // check if competence exists
            $id_competence = Competence::readOneByName($competence);
            // if not, create it
            if (!$id_competence) {
                // create competence
                $id_competence = Competence::create($competence);
            }
            // bind competence to offreStage
            $stmt = $db->prepare("INSERT INTO offre_competence (id_offre, id_competence) VALUES (:id_offre, :id_competence)");
            $stmt->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);
            $stmt->bindValue(':id_competence', $id_competence, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}