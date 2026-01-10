<?php
require_once __DIR__ . '/../models/ResourceModel.php';

class ResourceController {
    public function list() {
        $model = new ResourceModel();
        $limit = 48;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $filters = [
            'titre' => $_GET['titre'] ?? '',
            'genre' => $_GET['genre'] ?? '',
            'auteur' => $_GET['auteur'] ?? '',
            'type' => $_GET['type'] ?? '' // Récupération du type
        ];

        $totalItems = $model->countFiltered($filters);
        $totalPages = ceil($totalItems / $limit);
        $resources = $model->searchPaginated($filters, $limit, $offset);

        require __DIR__ . '/../views/layouts/header.php';
        include __DIR__ . '/../views/resource/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function detail($id) {
        $model = new ResourceModel();
        $resource = $model->getById($id); // Récupère toutes les infos de la ressource

        require __DIR__ . '/../views/layouts/header.php';
        include __DIR__ . '/../views/resource/detail.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}