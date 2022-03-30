<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Entreprise Model
 */
class Entreprise extends Model
{
    /**
     * Get one entreprise by id
     *
     * @param int $id
     * @return array|false
     */
    public static function readOne(int $id)
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
                GROUP BY id_entreprise";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);
        static::replaceLocalitesAndSecteursActivite($entreprise);
        return $entreprise;
    }

  /**
   * Get entreprise id by name
   * @param string $nom_entreprise
   * @return int|false
   */
  public static function getIdByName(string $nom_entreprise)
  {
    $db = static::getDB();
    $stmt = $db->prepare("SELECT id_entreprise FROM entreprises WHERE nom_entreprise = :nom_entreprise");
    $stmt->bindValue(':nom_entreprise', $nom_entreprise, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

    /**
     * Get all the entreprises as an associative array
     *
     * @return array|false
     */
    public static function readAll()
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
        $entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($entreprises as &$entreprise) {
            static::replaceLocalitesAndSecteursActivite($entreprise);
        }
        return $entreprises;
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
        $entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($entreprises as &$entreprise) {
            static::replaceLocalitesAndSecteursActivite($entreprise);
        }
        return $entreprises;
    }

    /**
     * replaces the localites and secteurs_activite of the given entreprise
     */
    protected static function replaceLocalitesAndSecteursActivite(array &$entreprise): void
    {
        $entreprise['localites'] = explode('|', $entreprise['localites']);
        $entreprise['secteurs_activite'] = explode('|', $entreprise['secteurs_activite']);
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
     * @param int $id
     * @param string|null $nom_entreprise
     * @param array|null $localites
     * @param array|null $secteurs_activite
     * @return void
     */
    public static function update(int $id, string $nom_entreprise = null, array $localites = null, array $secteurs_activite = null)
    {
        // fetch db connection
        $db = static::getDB();

        if ($nom_entreprise !== null) {
            // update entreprise
            $stmt = $db->prepare("UPDATE entreprises SET nom_entreprise = :nom_entreprise WHERE id_entreprise = :id");
            $stmt->bindValue(':nom_entreprise', $nom_entreprise);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }

        if ($localites !== null) {
            // delete localites
            $stmt = $db->prepare("DELETE FROM entreprise_loc WHERE id_entreprise = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // bind localites
            self::bindLocalites($db, $localites, $id);
        }

        if ($secteurs_activite !== null) {
            // delete secteurs d'activite
            $stmt = $db->prepare("DELETE FROM entreprise_secteur WHERE id_entreprise = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // bind secteurs d'activite
            self::bindSecteurs($db, $secteurs_activite, $id);
        }
    }

    /**
     * Deletes an entreprise
     *
     * @param int $id
     * @return void
     */
    public static function delete(int $id)
    {
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

    /**
     * Toggles hidden flag for an entreprise
     * @param int $id
     * @return void
     */
    public static function toggleHidden(int $id)
    {
        // fetch db connection
        $db = static::getDB();

        // toggle hidden flag
        $stmt = $db->prepare("UPDATE entreprises SET hidden = NOT hidden WHERE id_entreprise = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    /**
     * Binds localites to an entreprise
     * @param PDO $db
     * @param array $localites
     * @param int $id_entreprise
     * @return void
     */
    protected static function bindLocalites(PDO $db, array $localites, int $id_entreprise)
    {
        foreach ($localites as $localite) {
            // check if localite exists
            $id_localite = Localite::getIdByName($localite);
            // if not, create it
            if (!$id_localite) {
                $id_localite = Localite::create($localite);
            }
            // bind localite to entreprise
            $stmt = $db->prepare("INSERT INTO entreprise_loc (id_entreprise, id_localite) VALUES (:id_entreprise, :id_localite)");
            $stmt->bindValue(':id_entreprise', $id_entreprise);
            $stmt->bindValue(':id_localite', $id_localite);
            $stmt->execute();
        }
    }

    /**
     * Binds secteurs d'activite to an entreprise
     * @param PDO $db
     * @param array $secteurs_activite
     * @param int $id
     * @return void
     */
    protected static function bindSecteurs(PDO $db, array $secteurs_activite, int $id): void
    {
        foreach ($secteurs_activite as $secteur_activite) {
            // check if secteur d'activite exists
            $id_secteur_activite = SecteurActivite::readOneByName($secteur_activite);
            // if not, create it
            if (!$id_secteur_activite) {
                $id_secteur_activite = SecteurActivite::create($secteur_activite);
            }
            // bind secteur d'activite to entreprise
            $stmt = $db->prepare("INSERT INTO entreprise_secteur (id_entreprise, id_secteur_activite) VALUES (:id_entreprise, :id_secteur_activite)");
            $stmt->bindValue(':id_entreprise', $id);
            $stmt->bindValue(':id_secteur_activite', $id_secteur_activite);
            $stmt->execute();
        }
    }
}