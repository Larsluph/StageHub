<?php

namespace App\Models\Services;

use App\Models\Components\DatabaseConnection;
use App\Models\Maps\MapEntreprise;
use App\Models\Maps\MapLocalite;
use App\Models\Maps\MapSecteurActivite;

class Entreprise
{
    private DatabaseConnection $db;

    public function __construct() {
        $this->db = new DatabaseConnection(DatabaseConnection::new_connection());
    }

    public function create(MapEntreprise $entreprise, MapSecteurActivite $secteurActivite, MapLocalite $localite): bool
    {
        if (!$secteurActivite->getId())
            $secteurActivite->setId($this->db->execute("INSERT INTO `secteurs_activite` (nom_secteur_activite) VALUES (?)", $secteurActivite->getName()));

        if (!$localite->getId())
            $localite->setId($this->db->execute("INSERT INTO `localites` (`nom_localite`) VALUES (?)", $localite->getName()));

        $this->db->execute(
            "INSERT INTO `entreprises` (`nom_entreprise`, `hidden`) VALUES (?, ?);",
            $entreprise->getName(),
            $entreprise->getHidden()
        );

        $this->db->execute("INSERT INTO `entreprise_secteur` (`id_entreprise`, `id_secteur_activite`) VALUES (?, ?)", $entreprise->getId(), $secteurActivite->getId());
        $this->db->execute("INSERT INTO `entreprise_loc` (`id_entreprise`, `id_localite`) VALUES (?, ?)", $entreprise->getId(), $localite->getId());

        return true;
    }

    public function readOne(int $id): MapEntreprise {
        $row = $this->db->query("SELECT id_entreprise, nom_entreprise, hidden FROM entreprises WHERE id_entreprise=? LIMIT 1", $id)[0];
        $mapEntreprise = new MapEntreprise();
        $mapEntreprise->setId((int)$row["id_entrperise"]);
        $mapEntreprise->setName($row["nom_entreprise"]);
        $mapEntreprise->setHidden((bool)$row["hidden"]);
        return $mapEntreprise;
    }

    public function readAll($filter = []) {
        $base_query = "SELECT nom_entreprise ";
        $tables = "FROM entreprises ";
        $conditions = "WHERE NOT hidden";

        $params = array();

        if (array_key_exists("nom",$filter)) {
            $conditions .= " AND nom_entreprise like '%?%'";
            $params[0] = $filter["nom"];
        }

        $this->db->query($base_query.$tables.$conditions, ...$params);
    }

    public function update(MapEntreprise $entreprise): bool
    {
        $this->db->execute(
            "UPDATE `entreprises` SET nom_entreprise=?, hidden=? WHERE id_entreprise=?",
            $entreprise->getName(),
            $entreprise->getHidden(),
            $entreprise->getId()
        );
        return true;
    }

    public function delete(MapEntreprise $entreprise) {
        $this->db->execute("DELETE FROM `entreprise_loc` WHERE id_entreprise=?", $entreprise->getId());
        $this->db->execute("DELETE FROM `entreprise_secteur` WHERE id_entreprise=?", $entreprise->getId());
        $this->db->execute("DELETE FROM `entreprises` WHERE id_entreprise=?", $entreprise->getId());
    }
}