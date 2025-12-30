<?php
require_once __DIR__ . '/../config/Database.php';

class AvisModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Récupérer les avis d'une ressource
    public function getByRessource($id_ressource) {
        $sql = "SELECT a.*, u.prenom, u.nom 
                FROM avis a 
                JOIN utilisateur u ON a.id_utilisateur = u.id 
                WHERE a.id_ressource = :id 
                ORDER BY a.date_publication DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id_ressource]);
        return $stmt->fetchAll();
    }

    // Calculer la moyenne (ex: 4.5)
    public function getMoyenne($id_ressource) {
        $stmt = $this->db->prepare("SELECT AVG(note) as moy FROM avis WHERE id_ressource = ?");
        $stmt->execute([$id_ressource]);
        $res = $stmt->fetch();
        return $res['moy'] ? round($res['moy'], 1) : null;
    }

    // Vérifier si l'utilisateur a déjà voté
    public function aDejaVote($id_user, $id_ressource) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM avis WHERE id_utilisateur = ? AND id_ressource = ?");
        $stmt->execute([$id_user, $id_ressource]);
        return $stmt->fetchColumn() > 0;
    }

    // Ajouter un avis
    public function create($id_user, $id_ressource, $note, $commentaire) {
        if ($this->aDejaVote($id_user, $id_ressource)) {
            return false;
        }
        $sql = "INSERT INTO avis (id_utilisateur, id_ressource, note, commentaire) 
                VALUES (:user, :res, :note, :com)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'user' => $id_user,
            'res' => $id_ressource,
            'note' => $note,
            'com' => htmlspecialchars($commentaire)
        ]);
    }
}