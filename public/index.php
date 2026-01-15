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
        $controller->list(); // Appelle la méthode pour charger les données et la vue
        break;

    case 'detail':
        $controller = new ResourceController();
        $id = $_GET['id'] ?? null; // Récupère l'ID depuis l'URL
        if ($id) {
            $controller->detail($id);
        } else {
            header('Location: index.php?action=ressources');
        }
        break;

    case 'add_avis':
        require_once '../controllers/AvisController.php';
        $controller = new AvisController();
        $controller->add();
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

    case 'profile':
        $controller = new UserController();
        $controller->profile();
        break;

    case 'add_emprunt':
        require_once '../controllers/EmpruntController.php';
        $controller = new EmpruntController();
        $controller->add();
        break;

    case 'delete_user':
        require_once '../controllers/UserController.php';
        $id = $_GET['id'] ?? null;
        $controller = new UserController();
        $controller->deleteUser($id);
        break;


    default:
        // Page 404 ou redirection vers home
        $controller = new HomeController();
        $controller->index();
        break;


}
