<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médiathèque Numérique</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php?action=home">Accueil</a></li>
            <li><a href="index.php?action=ressources">Catalogue</a></li>
            <?php if (isset($_SESSION['user'])) : ?>
                <li><span>Bonjour, <?= htmlspecialchars($_SESSION['user']['prenom']) ?></span></li>
                <li><a href="index.php?action=deconnexion" style="color: red;">Se déconnecter</a></li>
            <?php else: ?>
                <li><a href="index.php?action=connexion">Connexion</a></li>
                <li><a href="index.php?action=inscription">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<?php
if (isset($_SESSION['success'])) : ?>
<div style="background-color: #d4edda; color: #155724; padding: 10px; text-align: center; border: 1px solid #c3e6cb; margin-bottom: 15px;">
    <?php
    echo $_SESSION['success'];
    unset($_SESSION['success']);
    ?>
</div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center; border: 1px solid #f5c6cb; margin-bottom: 15px;">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
    </div>
<?php endif; ?>

<main>