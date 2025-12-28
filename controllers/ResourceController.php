<?php
require_once __DIR__ . '/../models/ResourceModel.php';

class ResourceController {
    public function list() {
        $model = new ResourceModel();
        // Définit la variable attendue par views/resource/index.php
        $resources = $model->getAll();

        include __DIR__ . '/../views/resource/index.php';
    }
}