<?php

namespace App\Models;

use PDO;

/**
 * Entreprise Model
 */
class Entreprise extends \Core\Model
{
    /**
     * Get one entreprise by id
     *
     * @param int $id
     * @return array
     */
    public static function readOne(int $id): array
    {
        $sql = "SELECT
                    nom_entreprise,
                    GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                    GROUP_CONCAT(DISTINCT secteurs_activite.nom_secteur_activite SEPARATOR '|') AS secteurs_activite
                FROM entreprises
                    LEFT JOIN entreprise_loc USING (id_entreprise)
                    LEFT JOIN localites USING (id_localite)
                    LEFT JOIN entreprise_secteur USING (id_entreprise)
                    LEFT JOIN secteurs_activite USING (id_secteur_activite)
                WHERE id_entreprise = :id
                GROUP BY id_entreprise
                LIMIT 1";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get all the entreprises as an associative array
     *
     * @return array
     */
    public static function readAll(): array
    {
        $query = "SELECT
                      nom_entreprise,
                      GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                      GROUP_CONCAT(DISTINCT secteurs_activite.nom_secteur_activite SEPARATOR '|') AS secteurs_activite
                  FROM entreprises
                      LEFT JOIN entreprise_loc USING (id_entreprise)
                      LEFT JOIN localites USING (id_localite)
                      LEFT JOIN entreprise_secteur USING (id_entreprise)
                      LEFT JOIN secteurs_activite USING (id_secteur_activite)
                  GROUP BY id_entreprise";
        $db = static::getDB();
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Filters entreprise with the given parameters
     * @param array $params
     * @return array
     */
    public static function filterBy(...$params): array
    {
        $filters = [];
        foreach ($params as $k => $v) {
            $filters[] = "$k LIKE '%:$k%'";
        }
        $formatted_params = join(" AND ", $filters);
        $sql = "SELECT
                    nom_entreprise,
                    GROUP_CONCAT(DISTINCT localites.nom_localite SEPARATOR '|') AS localites,
                    GROUP_CONCAT(DISTINCT secteurs_activite.nom_secteur_activite SEPARATOR '|') AS secteurs_activite
                FROM entreprises
                    LEFT JOIN entreprise_loc USING (id_entreprise)
                    LEFT JOIN localites USING (id_localite)
                    LEFT JOIN entreprise_secteur USING (id_entreprise)
                    LEFT JOIN secteurs_activite USING (id_secteur_activite)
                WHERE $formatted_params
                GROUP BY id_entreprise";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue(":$k", $v);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new entreprise
     * @param string $nom_entreprise
     * @param array $localites
     * @param array $secteurs_activite
     * @return int
     */
    public static function create(string $nom_entreprise, array $localites, array $secteurs_activite): int
    {
        // fetch db connection
        $db = static::getDB();

        // create entreprise
        $stmt = $db->prepare("INSERT INTO entreprises (nom_entreprise, hidden) VALUES (:nom_entreprise, FALSE)");
        $stmt->bindValue(':nom_entreprise', $nom_entreprise);
        $stmt->execute();
        $id_entreprise = $db->lastInsertId();

        // bind localites
        self::bindLocalites($db, $localites, $id_entreprise);

        // bind secteurs d'activite
        self::bindSecteurs($db, $secteurs_activite, $id_entreprise);

        return $id_entreprise;
    }

    /**
     * Updates an entreprise
     * @param $id
     * @param $nom_entreprise
     * @param $localites
     * @param $secteurs_activite
     * @return void
     */
    public static function update($id, $nom_entreprise, $localites, $secteurs_activite)
    {
        // fetch db connection
        $db = static::getDB();

        // update entreprise
        $stmt = $db->prepare("UPDATE entreprises SET nom_entreprise = :nom_entreprise WHERE id_entreprise = :id");
        $stmt->bindValue(':nom_entreprise', $nom_entreprise);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // delete localites
        $stmt = $db->prepare("DELETE FROM entreprise_loc WHERE id_entreprise = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // bind localites
        self::bindLocalites($db, $localites, $id);

        // delete secteurs d'activite
        $stmt = $db->prepare("DELETE FROM entreprise_secteur WHERE id_entreprise = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // bind secteurs d'activite
        self::bindSecteurs($db, $secteurs_activite, $id);
    }

    /**
     * @param PDO $db
     * @param array $localites
     * @param int $id_entreprise
     * @return void
     */
    public static function bindLocalites(PDO $db, array $localites, int $id_entreprise)
    {
        foreach ($localites as $localite) {
            // check if localite exists
            $stmt = $db->prepare("SELECT id_localite FROM localites WHERE nom_localite = :nom_localite");
            $stmt->bindValue(':nom_localite', $localite);
            $stmt->execute();
            $id_localite = $stmt->fetchColumn();
            // if not, create it
            if (!$id_localite) {
                $stmt = $db->prepare("INSERT INTO localites (nom_localite) VALUES (:nom_localite)");
                $stmt->bindValue(':nom_localite', $localite);
                $stmt->execute();
                $id_localite = $db->lastInsertId();
            }
            // bind localite to entreprise
            $stmt = $db->prepare("INSERT INTO entreprise_loc (id_entreprise, id_localite) VALUES (:id_entreprise, :id_localite)");
            $stmt->bindValue(':id_entreprise', $id_entreprise);
            $stmt->bindValue(':id_localite', $id_localite);
            $stmt->execute();
        }
    }

    /**
     * @param PDO $db
     * @param array $secteurs_activite
     * @param int $id
     * @return void
     */
    public static function bindSecteurs(PDO $db, array $secteurs_activite, int $id): void
    {
        foreach ($secteurs_activite as $secteur_activite) {
            // check if secteur d'activite exists
            $stmt = $db->prepare("SELECT id_secteur_activite FROM secteurs_activite WHERE nom_secteur_activite = :nom_secteur_activite");
            $stmt->bindValue(':nom_secteur_activite', $secteur_activite);
            $stmt->execute();
            $id_secteur_activite = $stmt->fetchColumn();
            // if not, create it
            if (!$id_secteur_activite) {
                $stmt = $db->prepare("INSERT INTO secteurs_activite (nom_secteur_activite) VALUES (:nom_secteur_activite)");
                $stmt->bindValue(':nom_secteur_activite', $secteur_activite);
                $stmt->execute();
                $id_secteur_activite = $db->lastInsertId();
            }
            // bind secteur d'activite to entreprise
            $stmt = $db->prepare("INSERT INTO entreprise_secteur (id_entreprise, id_secteur_activite) VALUES (:id_entreprise, :id_secteur_activite)");
            $stmt->bindValue(':id_entreprise', $id);
            $stmt->bindValue(':id_secteur_activite', $id_secteur_activite);
            $stmt->execute();
        }
    }

    /**
     * Deletes an entreprise
     *
     * @param int $id
     * @return void
     */
    public static function delete(int $id) {
        // fetch db connection
        $db = static::getDB();

        // delete entreprise
        $stmt = $db->prepare("DELETE FROM entreprises WHERE id_entreprise = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // delete localites
        $stmt = $db->prepare("DELETE FROM entreprise_loc WHERE id_entreprise = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // delete secteurs d'activite
        $stmt = $db->prepare("DELETE FROM entreprise_secteur WHERE id_entreprise = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}