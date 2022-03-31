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
     * @return array|false offreStage
     */
    public static function readOneById(int $id)
    {
        $sql = "SELECT
                    (SELECT nom_entreprise FROM entreprises WHERE entreprises.id_entreprise = offres_stage.id_entreprise) AS nom_entreprise,
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
                GROUP BY id_offre
                LIMIT 1";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get one offreStage by id_entreprise
     * @param int $id id entreprise
     * @return array|false offreStage
     */
    public static function readAllByEntreprise(int $id)
    {
        $sql = "SELECT
                    (SELECT nom_entreprise FROM entreprises WHERE entreprises.id_entreprise = offres_stage.id_entreprise) AS nom_entreprise,
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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all offreStage
     * @return array|false offreStage
     */
    public static function readAll()
    {
        $sql = "SELECT
                    id_entreprise,
                    (SELECT nom_entreprise FROM entreprises WHERE entreprises.id_entreprise = offres_stage.id_entreprise) AS nom_entreprise,
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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
     * Updates an offreStage
     * @param int $id_offre id offreStage
     * @param string|null $nom_poste nom du poste à pourvoir
     * @param int|null $duree_stage duree du stage (en mois)
     * @param float|null $base_remuneration base de remuneration
     * @param DateTime|null $date_stage date de debut du stage
     * @param int|null $nbr_places nombre de places disponibles
     * @param int|null $id_entreprise id de l'entreprise
     * @param array|null $localites liste des localites
     * @param array|null $competences liste des compétences
     * @return void
     */
    public static function update(
        int $id_offre,
        ?string $nom_poste = null,
        ?int $duree_stage = null,
        ?float $base_remuneration = null,
        ?DateTime $date_stage = null,
        ?int $nbr_places = null,
        ?int $id_entreprise = null,
        ?array $localites = null,
        ?array $competences = null): void
    {
        $sql_args = [];
        $sql_args_bind = ['id_offre' => $id_offre];
        if ($nom_poste !== null) {
            $sql_args[] = 'nom_poste_offre = :nom_poste';
            $sql_args_bind['nom_poste'] = $nom_poste;
        }
        if ($duree_stage !== null) {
            $sql_args[] = 'duree_stage = :duree_stage';
            $sql_args_bind['duree_stage'] = $duree_stage;
        }
        if ($base_remuneration !== null) {
            $sql_args[] = 'base_remuneration = :base_remuneration';
            $sql_args_bind['base_remuneration'] = $base_remuneration;
        }
        if ($date_stage !== null) {
            $sql_args[] = 'date_stage = :date_stage';
            $sql_args_bind['date_stage'] = $date_stage->format('Y-m-d');
        }
        if ($nbr_places !== null) {
            $sql_args[] = 'nbr_places_offre = :nbr_places';
            $sql_args_bind['nbr_places'] = $nbr_places;
        }
        if ($id_entreprise !== null) {
            $sql_args[] = 'id_entreprise = :id_entreprise';
            $sql_args_bind['id_entreprise'] = $id_entreprise;
        }
        $sql = 'UPDATE offres_stage SET ' . implode(', ', $sql_args) . ' WHERE id_offre = :id_offre';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        foreach ($sql_args_bind as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->execute();

        if ($localites !== null) {
            // delete old localites
            $stmt = $db->prepare('DELETE FROM offre_loc WHERE id_offre = :id_offre');
            $stmt->bindValue(':id_offre', $id_offre);
            $stmt->execute();

            // bind localites
            self::bindLocalites($db, $id_offre, $localites);
        }
        if ($competences !== null) {
            // delete old competences
            $stmt = $db->prepare('DELETE FROM offre_competence WHERE id_offre = :id_offre');
            $stmt->bindValue(':id_offre', $id_offre);
            $stmt->execute();

            // bind competences
            self::bindCompetences($db, $id_offre, $competences);
        }
    }

    /**
     * Delete an offreStage
     * @param int $id_offre id offreStage
     * @return void
     */
    public static function delete(int $id_offre): void
    {
        // fetch db connection
        $db = static::getDB();

        // delete localites
        $stmt = $db->prepare('DELETE FROM offre_loc WHERE id_offre = :id_offre');
        $stmt->bindValue(':id_offre', $id_offre);
        $stmt->execute();

        // delete competences
        $stmt = $db->prepare('DELETE FROM offre_competence WHERE id_offre = :id_offre');
        $stmt->bindValue(':id_offre', $id_offre);
        $stmt->execute();

        // delete offreStage
        $stmt = $db->prepare('DELETE FROM offres_stage WHERE id_offre = :id_offre');
        $stmt->bindValue(':id_offre', $id_offre);
        $stmt->execute();
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
            $id_localite = Localite::getIdByName($localite);
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
            $id_competence = Competence::getIdByName($competence);
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