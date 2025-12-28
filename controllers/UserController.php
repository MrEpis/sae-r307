<?php

use JetBrains\PhpStorm\NoReturn;

require_once '../models/UserModel.php';
class UserController {

    public function login(): void
    {
        // Si formulaire soumis (avec POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Appel au modèle pour obtenir l'utilisateur
            $userModel = new UserModel();
            $user = $userModel->dbFindUser($email);

            // Vérification du mot de passe
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                // Succès : enregistrement du login dans la session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['nom'] . ' ' . $user['prenom'],
                    'role' => $user['role'] ?? 'user'
                ];
                // Redirection vers la page d'accueil
                header('Location: index.php?action=home');
                exit;
            } else {
                $error = 'Identifiants incorrects';
            }
        }

        // Affichage de la vue
        require '../views/layouts/header.php';
        require '../views/auth/login.php';
        require '../views/layouts/footer.php';
    }

    public function register(): void
    {
        // Si formulaire soumis (avec POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = [];

            // Vérification de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Adresse email invalide.';
            }

            // Vérification du mot de passe
            if (strlen($password) < 8) {
                $errors[] = 'Mot de passe trop court (8 caracères minimum).';
            }
            if (!preg_match('/[0-9]/', $password)) {
                $errors[] = 'Mot de passe doit contenir au moins un chiffre.';
            }
            if (!preg_match('/[A-Z]/', $password)) {
                $errors[] = 'Mot de passe doit contenir au moins une majuscule.';
            }
            if (!preg_match('/[a-z]/', $password)) {
                $errors[] = 'Mot de passe doit contenir au moins une minuscule.';
            }

            // Si pas d'erreurs, on inscrit l'utilisateur
            if (empty($errors)) {
                $userModel = new UserModel();
                // Vérification de l'existence de l'utilisateur
                if ($userModel->dbFindUser($email)) {
                    $errors[] = "Cet email est déjà utilisé.";
                } else {
                    // Hashage du mot de passe
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    // Appel au modèle pour enregistrer l'utilisateur
                    if ($userModel->dbCreateUser($email, $passwordHash, $nom, $prenom)) {
                        header('Location: index.php?action=connexion');
                        exit;
                    } else {
                        $errors[] = "Une erreur est survenue lors de l'enregistrement.";
                    }
                }
            }
        }

        // Affichage de la vue
        require '../views/layouts/header.php';
        require '../views/auth/register.php';
        require '../views/layouts/footer.php';
    }

    #[NoReturn]
    public function logout(): void
    {
        session_destroy();
        header('Location: index.php?action=home');
        exit;
    }
}