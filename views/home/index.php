<?php
/**
 * @var array $nouveautes
 * @var array $top
 */
?>

<section style="text-align: center; padding: 60px 20px; background: #ecf0f1; border-radius: 8px; margin-bottom: 40px;">
    <h1 style="color:#2c3e50; font-size: 2.5em; margin-bottom: 10px;">Bienvenue sur E-Library</h1>
    <p style="font-size: 1.2em; color: #7f8c8d;">Votre médiathèque numérique préférée : Livres, Films et plus encore.</p>
    <a href="index.php?action=ressources" class="btn" style="margin-top: 20px;">Voir tout le catalogue</a>
</section>

<h2 class="section-title">🔥 Nouveautés</h2>
<div class="grid-4" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px;">
    <?php foreach($nouveautes as $res): ?>
        <div class="card">
            <img src="<?= !empty($res['image']) ? htmlspecialchars($res['image']) : 'https://via.placeholder.com/300x450?text=Cover' ?>"
                 alt="Cover" style="width: 100%; height: 250px; object-fit: cover;">

            <div class="card-body" style="padding: 15px;">
                <h3 style="margin: 0 0 10px 0; font-size: 1.1em;"><?= htmlspecialchars($res['titre']) ?></h3>
                <p style="color: #7f8c8d; font-size: 0.9em;"><?= htmlspecialchars($res['genre'] ?? 'Divers') ?></p>
                <a href="index.php?action=detail&id=<?= $res['id'] ?>" class="btn" style="padding: 5px 10px; font-size: 0.9em;">Voir</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<h2 class="section-title" style="margin-top: 50px;">⭐ Les Mieux Notés</h2>
<div class="grid-4" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px;">
    <?php foreach($top as $res): ?>
        <div class="card">
            <img src="<?= !empty($res['image']) ? htmlspecialchars($res['image']) : 'https://via.placeholder.com/300x450?text=Cover' ?>"
                 alt="Cover" style="width: 100%; height: 250px; object-fit: cover;">

            <div class="card-body" style="padding: 15px;">
                <h3 style="margin: 0 0 10px 0; font-size: 1.1em;"><?= htmlspecialchars($res['titre']) ?></h3>

                <div style="color:#e67e22; font-weight:bold; margin-bottom: 10px;">
                    <?= isset($res['moy']) && $res['moy'] > 0 ? round($res['moy'], 1) . '/5 ★' : 'Pas encore noté' ?>
                </div>

                <a href="index.php?action=detail&id=<?= $res['id'] ?>" class="btn" style="padding: 5px 10px; font-size: 0.9em;">Voir</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>