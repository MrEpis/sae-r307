<?php if (!$resource): ?>
    <p>Ressource introuvable.</p>
<?php else: ?>
    <h1><?php echo htmlspecialchars($resource['titre']); ?></h1>

    <div class="detail-container">
        <img src="<?php echo htmlspecialchars($resource['image_path']); ?>" alt="Couverture ou Affiche">

        <div class="infos-communes">
            <p><strong>Genre :</strong> <?php echo htmlspecialchars($resource['genre']); ?></p>
            <p><strong>Thème :</strong> <?php echo htmlspecialchars($resource['theme']); ?></p>
            <p><strong>Langue :</strong> <?php echo htmlspecialchars($resource['langue']); ?></p>
            <p><strong>Pays d'origine :</strong> <?php echo htmlspecialchars($resource['pays_origine']); ?></p>
        </div>

        <?php if ($resource['type_ressource'] === 'film'): ?>
            <div class="infos-specifiques">
                <h2>Détails du film</h2>
                <p><strong>Réalisateur :</strong> <?php echo htmlspecialchars($resource['realisateur']); ?></p>
                <p><strong>Durée :</strong> <?php echo htmlspecialchars($resource['duree']); ?> minutes</p>
                <p><strong>Année de production :</strong> <?php echo htmlspecialchars($resource['annee_production']); ?></p>
                <p><strong>Casting :</strong> <?php echo htmlspecialchars($resource['casting']); ?></p>
                <h3>Synopsis</h3>
                <p><?php echo nl2br(htmlspecialchars($resource['synopsis'])); ?></p>
            </div>

        <?php elseif ($resource['type_ressource'] === 'livre'): ?>
            <div class="infos-specifiques">
                <h2>Détails du livre</h2>
                <p><strong>Auteur :</strong> <?php echo htmlspecialchars($resource['auteur']); ?></p>
                <p><strong>Éditeur :</strong> <?php echo htmlspecialchars($resource['editeur']); ?></p>
                <p><strong>Année de publication :</strong> <?php echo htmlspecialchars($resource['annee_publication']); ?></p>
                <p><strong>ISBN :</strong> <?php echo htmlspecialchars($resource['isbn']); ?></p>
                <p><strong>Nombre de pages :</strong> <?php echo htmlspecialchars($resource['nb_pages']); ?></p>
                <p><strong>Prix :</strong> <?php echo htmlspecialchars($resource['prix']); ?> €</p>
            </div>
        <?php endif; ?>
    </div>


    <p><a href="index.php?action=ressources">Retour au catalogue</a></p>
<?php endif; ?>
<?php include __DIR__ . '/../partials/bloc_avis.php'; ?>
