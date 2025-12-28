<?php
require_once __DIR__ . '/../config/db.php';

class ResourceModel {
    private $db;

    public function __construct() {
        // Utilise l'instance PDO définie dans config/db.php
        $this->db = Database::getInstance();
    }

    public function getAll() {
        // Jointure avec les tables filles pour avoir tous les détails
        $sql = "SELECT r.*, l.auteur, l.isbn, l.prix, f.realisateur, f.synopsis 
                FROM ressource r 
                LEFT JOIN livre l ON r.id = l.id_ressource 
                LEFT JOIN film f ON r.id = f.id_ressource";
        return $this->db->query($sql)->fetchAll();
    }
}