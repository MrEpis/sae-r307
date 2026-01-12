<link rel="stylesheet" href="css/detail.css">

<?php if (!$resource): ?>
    <p>Ressource introuvable.</p>
<?php else: ?>
    <div class="detail-container">
        <img src="<?= htmlspecialchars($resource['image_path']); ?>" alt="Affiche">

        <div class="detail-info-content">
            <span class="badge-type"><?= $resource['type_ressource'] ?></span>
            <h1><?= htmlspecialchars($resource['titre']); ?></h1>

            <div class="infos-communes">
                <p><strong>Genre :</strong> <?= htmlspecialchars($resource['genre']); ?></p>
                <p><strong>Thème :</strong> <?= htmlspecialchars($resource['theme']); ?></p>
                <p><strong>Langue :</strong> <?= htmlspecialchars($resource['langue']); ?> (<?= htmlspecialchars($resource['pays_origine']); ?>)</p>
            </div>

            <?php if ($resource['type_ressource'] === 'film'): ?>
                <div class="infos-specifiques">
                    <p><strong>Réalisateur :</strong> <?= htmlspecialchars($resource['realisateur']); ?></p>
                    <p><strong>Durée :</strong> <?= htmlspecialchars($resource['duree']); ?> minutes</p>
                    <p><strong>Année :</strong> <?= htmlspecialchars($resource['annee_production']); ?></p>
                    <p><strong>Casting :</strong> <?= htmlspecialchars($resource['casting']); ?></p>

                    <div class="description-text">
                        <strong>Synopsis :</strong><br>
                        <?= nl2br(htmlspecialchars($resource['synopsis'])); ?>
                    </div>
                </div>

            <?php elseif ($resource['type_ressource'] === 'livre'): ?>
                <div class="infos-specifiques">
                    <p><strong>Auteur :</strong> <?= htmlspecialchars($resource['auteur']); ?></p>
                    <p><strong>Éditeur :</strong> <?= htmlspecialchars($resource['editeur']); ?></p>
                    <p><strong>Pages :</strong> <?= htmlspecialchars($resource['nb_pages']); ?></p>
                    <p><strong>ISBN :</strong> <?= htmlspecialchars($resource['isbn']); ?></p>

                    <div class="description-text">
                        <strong>Résumé :</strong><br>
                        <?= nl2br(htmlspecialchars($resource['resume'])); ?>
                    </div>
                    <div class="emprunt-section">
                        <?php if ($idEmprunteur === null): ?>
                            <form action="index.php?action=add_emprunt" method="POST">
                                <input type="hidden" name="id_ressource" value="<?= $resource['id'] ?>">
                                <button type="submit" class="btn">Emprunter ce livre</button>
                            </form>
                        <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['id'] == $idEmprunteur): ?>
                            <p class="msg-emprunt success">Vous avez déjà emprunté ce livre.</p>
                        <?php else: ?>
                            <p class="msg-emprunt error">Ce livre n'est pas disponible actuellement.</p>
                        <?php endif; ?>
                    </div>

            <?php endif; ?>
        </div>
    </div>
    </div>

    <?php if ($resource['type_ressource'] === 'film' && !empty($resource['lien_bande_annonce'])): ?>
        <div class="trailer-section">
            <h2>Bande-annonce</h2>
            <div class="trailer-wrapper">
                <iframe src="<?= str_replace("watch?v=", "embed/", $resource['lien_bande_annonce']); ?>"
                        allowfullscreen>
                </iframe>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?php include __DIR__ . '/../partials/bloc_avis.php'; ?>