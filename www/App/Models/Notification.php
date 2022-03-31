<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Notification Model
 */
class Notification extends Model
{
    /**
     * Get all notifications of a user
     * @param int $id_user User ID
     * @return array Array of notifications
     */
    public static function readNotifFromUser(int $id_user): array
    {
        $db = static::getDB();
        $sql = 'SELECT * FROM candidatures WHERE id_user = :id_user AND notif_etu = 1';
        $pdoStmt = $db->prepare($sql);
        $pdoStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $pdoStmt->execute();
        return $pdoStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all notifications of a company
     * @param int $id_entreprise Company ID
     * @return array Array of notifications
     */
    public static function readNotifFromCompany(int $id_entreprise): array
    {
        $db = static::getDB();
        $sql = 'SELECT offres_stage.id_entreprise, offres_stage.nom_poste_offre, candidatures.* FROM candidatures LEFT JOIN offres_stage USING (id_offre) WHERE id_entreprise = :id_entreprise AND notif_entr = 1';
        $pdoStmt = $db->prepare($sql);
        $pdoStmt->bindValue(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
        $pdoStmt->execute();
        return $pdoStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}