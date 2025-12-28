<?php

class HomeController
{
    public function index()
    {
        // On peut passer des données à la vue ici si besoin

        // Affichage de la vue
        // Le chemin est relatif à public/index.php
        require '../views/layouts/header.php';
        require '../views/home/index.php';
        require '../views/layouts/footer.php';
    }
}