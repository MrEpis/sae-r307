<?php
// Affichage des erreurs pour le développement
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../controllers/ResourceController.php';

$controller = new ResourceController();
$controller->list();