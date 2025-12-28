<?php
require_once __DIR__ . '/../config/Database.php';

class ResourceModel {
    private $db;

    public function __construct() {
        // Utilise l'instance PDO définie dans config/DataBase.php
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

    public function getById($id) {
        $sql = "SELECT r.*, l.auteur, l.isbn, l.editeur, l.nb_pages, l.prix, 
                   f.realisateur, f.synopsis, f.casting, f.duree, f.annee_production 
            FROM ressource r 
            LEFT JOIN livre l ON r.id = l.id_ressource 
            LEFT JOIN film f ON r.id = f.id_ressource 
            WHERE r.id = :id";
        $stmt = $this->db->prepare($sql); // Utilisation de prepare pour PDO
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}