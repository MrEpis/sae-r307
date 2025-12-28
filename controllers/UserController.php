<?php

require_once '../models/UserModel.php';
class UserController {

    public function login()
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

    public function logout()
    {
        session_destroy();
        header('Location: index.php?action=home');
        exit;
    }
}