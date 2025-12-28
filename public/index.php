<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
        $controller->login();
        break;

    case 'inscription':
        $controller = new UserController();
        $controller->register();
        break;

    case 'deconnexion':
        $controller = new UserController();
        $controller->logout();
        break;

    default:
        // Page 404 ou redirection vers home
        $controller = new HomeController();
        $controller->index();
        break;
}