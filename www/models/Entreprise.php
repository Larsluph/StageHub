<?php

namespace App\Models\Services;

use App\Models\Components\DatabaseConnection;
use App\Models\Maps\MapEntreprise;

class Entreprise
{
    private DatabaseConnection $db;

    public function __construct() {
        $this->db = new DatabaseConnection(DatabaseConnection::new_connection());
    }

    public function create(MapEntreprise $entreprise): bool
    {
        $this->db->execute(
            "INSERT INTO `entreprises` (`nom_entreprise`, `hidden`) VALUES ('?', '?');",
            $entreprise->getName(),
            $entreprise->getHidden()
        );
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