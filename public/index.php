<?php
// Démarrage de la session
session_start();

// Autoload ou inclusion manuelle des fichiers nécessaires
require_once '../config/Database.php';
require_once '../controllers/HomeController.php';
require_once '../controllers/ResourceController.php';
require_once '../controllers/UserController.php';
// Ajoutez les modèles si nécessaire ici ou via un autoloader
require_once '../models/ResourceModel.php';
require_once '../models/UserModel.php';

// Récupération de l'action demandée via l'URL (ex: index.php?action=ressources)
$action = $_GET['action'] ?? 'home';

// Routage simple
switch ($action) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'ressources':
        $controller = new ResourceController();
        // Exemple : $controller->index();
        break;

    case 'connexion':
        $controller = new UserController();
        // Exemple : $controller->login();
        break;

    default:
        // Page 404 ou redirection vers home
        $controller = new HomeController();
        $controller->index();
        break;
}
