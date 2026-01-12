<?php
require_once __DIR__ . '/../models/EmpruntModel.php';

class EmpruntController {
    public function add() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }

        $id_res = $_POST['id_ressource'];
        $model = new EmpruntModel();

        if ($model->getEmprunteurActuel($id_res) === null) {
            $model->create($_SESSION['user']['id'], $id_res);
            $_SESSION['success'] = "Emprunt réussi.";
        }

        header("Location: index.php?action=detail&id=" . $id_res);
        exit;
    }
}