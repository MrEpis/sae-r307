<?php
/**
 * @var array $nouveautes
 * @var array $top
 */
?>

<section>
    <h1>Bienvenue sur E-Library</h1>
    <p>Votre médiathèque numérique préférée : Livres, Films et plus encore.</p>
    <a href="index.php?action=ressources" class="btn">Voir tout le catalogue</a>
</section>

<h2 class="section-title">🔥 Nouveautés</h2>
<div class="grid-4">
    <?php foreach($nouveautes as $res): ?>
        <div class="card">
            <a href="index.php?action=detail&id=<?= $res['id'] ?>">
            <img src="<?= !empty($res['image_path']) ? htmlspecialchars($res['image_path']) : 'https://via.placeholder.com/300x450?text=Cover' ?>"
                 alt="Cover">
            </a>
            <div class="card-body">
                <h3><?= htmlspecialchars($res['titre']) ?></h3>
                <p><?= htmlspecialchars($res['genre'] ?? 'Divers') ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<h2 class="section-title">⭐ Les Mieux Notés</h2>
<div class="grid-4">
    <?php foreach($top as $res): ?>
        <div class="card">
            <a href="index.php?action=detail&id=<?= $res['id'] ?>">
            <img src="<?= !empty($res['image_path']) ? htmlspecialchars($res['image_path']) : 'https://via.placeholder.com/300x450?text=Cover' ?>"
                 alt="Cover">
            </a>

            <div class="card-body">
                <h3><?= htmlspecialchars($res['titre']) ?></h3>

                <div>
                    <?= isset($res['moy']) && $res['moy'] > 0 ? round($res['moy'], 1) . '/5 ★' : 'Pas encore noté' ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>