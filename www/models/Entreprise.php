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
        if ($secteurActivite->getId())
            $secteurActivite->setId($this->db->execute("INSERT INTO `secteurs_activite` (nom_secteur_activite) VALUES (?)", $secteurActivite->getName()));

        if ($localite->getId())
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

    public function read($filter = []) {
        $query = "SELECT nom_entreprise FROM entreprises WHERE NOT hidden";
        $params = array();
        if (array_key_exists("nom",$filter)) {
            $query .= " AND nom_entreprise like '%?%'";
            $params[0] = $filter["nom"];
        }

        $this->db->query($query, ...$params);
    }

    public function update(MapEntreprise $entreprise) {

    }

    public function delete(MapEntreprise $entreprise) {

    }
}