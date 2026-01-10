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
        // Ajout de l.annee_publication dans la liste des colonnes SELECT
        $sql = "SELECT r.*, l.auteur, l.isbn, l.editeur, l.annee_publication, l.nb_pages, l.resume, 
               f.realisateur, f.synopsis, f.casting, f.duree, f.annee_production, f.lien_bande_annonce
        FROM ressource r 
        LEFT JOIN livre l ON r.id = l.id_ressource 
        LEFT JOIN film f ON r.id = f.id_ressource 
        WHERE r.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function countAll() {
        $sql = "SELECT COUNT(*) as total FROM ressource";
        return $this->db->query($sql)->fetch()['total']; // Récupère le nombre total de ressources
    }

    public function getPaginated($limit, $offset) {
        // Requête avec LIMIT et OFFSET pour la pagination
        $sql = "SELECT r.*, l.auteur, l.nb_pages, f.realisateur, f.duree 
        FROM ressource r 
        LEFT JOIN livre l ON r.id = l.id_ressource 
        LEFT JOIN film f ON r.id = f.id_ressource 
        LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function searchResources($filters) {
        // Base de la requête avec les jointures pour avoir accès à l'auteur et au réalisateur
        $sql = "SELECT r.*, l.auteur, f.realisateur 
            FROM ressource r 
            LEFT JOIN livre l ON r.id = l.id_ressource 
            LEFT JOIN film f ON r.id = f.id_ressource 
            WHERE 1=1";
        $params = [];

        // Ajout dynamique des conditions selon les filtres présents
        if (!empty($filters['titre'])) {
            $sql .= " AND r.titre LIKE :titre";
            $params['titre'] = '%' . $filters['titre'] . '%';
        }
        if (!empty($filters['genre'])) {
            $sql .= " AND r.genre = :genre";
            $params['genre'] = $filters['genre'];
        }
        if (!empty($filters['auteur'])) {
            $sql .= " AND (l.auteur LIKE :auteur OR f.realisateur LIKE :auteur)";
            $params['auteur'] = '%' . $filters['auteur'] . '%';
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // Compte le nombre de ressources correspondant aux filtres
    public function countFiltered($filters) {
        $sql = "SELECT COUNT(*) as total FROM ressource r 
                LEFT JOIN livre l ON r.id = l.id_ressource 
                LEFT JOIN film f ON r.id = f.id_ressource WHERE 1=1";
        $params = [];

        if (!empty($filters['titre'])) {
            $sql .= " AND r.titre LIKE :titre";
            $params['titre'] = '%' . $filters['titre'] . '%';
        }

        if (!empty($filters['genre'])) {
            $sql .= " AND r.genre LIKE :genre";
            $params['genre'] = '%' . $filters['genre'] . '%';
        }

        if (!empty($filters['auteur'])) {
            $sql .= " AND (l.auteur LIKE :auteur OR f.realisateur LIKE :auteur)";
            $params['auteur'] = '%' . $filters['auteur'] . '%';
        }

        if (!empty($filters['type'])) {
            $sql .= " AND r.type_ressource = :type";
            $params['type'] = $filters['type'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch()['total'];
    }

    // Récupère les ressources filtrées avec pagination
    public function searchPaginated($filters, $limit, $offset) {
        $sql = "SELECT r.*, l.auteur, l.nb_pages, f.realisateur, f.duree 
            FROM ressource r 
            LEFT JOIN livre l ON r.id = l.id_ressource 
            LEFT JOIN film f ON r.id = f.id_ressource 
            WHERE 1=1";
        $params = [];

        if (!empty($filters['titre'])) {
            $sql .= " AND r.titre LIKE :titre";
            $params['titre'] = '%' . $filters['titre'] . '%';
        }

        if (!empty($filters['genre'])) {
            $sql .= " AND r.genre LIKE :genre";
            $params['genre'] = '%' . $filters['genre'] . '%';
        }

        if (!empty($filters['auteur'])) {
            $sql .= " AND (l.auteur LIKE :auteur OR f.realisateur LIKE :auteur)";
            $params['auteur'] = '%' . $filters['auteur'] . '%';
        }

        if (!empty($filters['type'])) {
            $sql .= " AND r.type_ressource = :type";
            $params['type'] = $filters['type'];
        }

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) $stmt->bindValue($key, $val);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    // Récupère les 4 dernières ressources ajoutées
    public function getNouveautes($limit = 4): array
    {
        // On trie par ID décroissant (suppose que les derniers ID sont les plus récents)
        $sql = "SELECT * FROM ressource ORDER BY id DESC LIMIT :lim";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupère les ressources les mieux notées (Top)
    public function getTop($limit = 4): array
    {
        // Jointure avec la table avis pour calculer la moyenne
        $sql = "SELECT r.*, AVG(a.note) as moy 
                FROM ressource r 
                LEFT JOIN avis a ON r.id = a.id_ressource 
                GROUP BY r.id 
                ORDER BY moy DESC 
                LIMIT :lim";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}