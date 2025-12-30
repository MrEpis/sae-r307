<?php
require_once __DIR__ . '/../models/AvisModel.php';

class AvisController {

    public function add() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // 1. Vérifier si connecté
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }

        // 2. Traiter le formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_SESSION['user']['id'];
            $id_ressource = $_POST['id_ressource'];
            $note = $_POST['note'];
            $commentaire = $_POST['commentaire'];

            $model = new AvisModel();

            // La méthode create() vérifie déjà les doublons, on l'appelle directement
            $model->create($id_user, $id_ressource, $note, $commentaire);

            // 3. Rediriger vers la page du produit
            header("Location: index.php?action=detail&id=" . $id_ressource);
            exit;
        }
    }
}