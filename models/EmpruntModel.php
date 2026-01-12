<?php
require_once __DIR__ . '/../config/Database.php';

class EmpruntModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Retourne l'ID de l'utilisateur qui a le livre, ou null si libre
    public function getEmprunteurActuel($id_ressource) {
        $sql = "SELECT id_utilisateur FROM emprunt 
                WHERE id_ressource = :res AND date_retour IS NULL 
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['res' => $id_ressource]);
        $result = $stmt->fetch();
        return $result ? (int)$result['id_utilisateur'] : null;
    }

    public function create($id_utilisateur, $id_ressource) {
        $sql = "INSERT INTO emprunt (id_utilisateur, id_ressource, date_emprunt) 
                VALUES (:user, :res, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['user' => $id_utilisateur, 'res' => $id_ressource]);
    }
}