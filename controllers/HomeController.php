<?php
require_once __DIR__ . '/../models/ResourceModel.php';

class HomeController {

    public function index() {
        // 1. Instancier le modèle
        $model = new ResourceModel();

        // 2. Récupérer les listes
        $nouveautes = $model->getNouveautes(25);
        $top = $model->getTop(25);

        // 3. Envoyer à la vue (Affichage)
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/home/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}