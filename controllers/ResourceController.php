<?php
require_once __DIR__ . '/../models/ResourceModel.php';

class ResourceController {
    public function list() {
        $model = new ResourceModel();
        // Définit la variable attendue par views/resource/index.php
        $resources = $model->getAll();

        include __DIR__ . '/../views/resource/index.php';
    }

    public function detail($id) {
        $model = new ResourceModel();
        $resource = $model->getById($id);
        include __DIR__ . '/../views/resource/detail.php';
    }

    public function search($term, $genre = null) {
        $sql = "SELECT * FROM ressource WHERE titre LIKE :term";
        $params = ['term' => "%$term%"];

        if ($genre) {
            $sql .= " AND genre = :genre";
            $params['genre'] = $genre;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}