<?php
/**
 * @var array $nouveautes
 * @var array $top
 */
?>
<section style="text-align: center; margin: 40px 0;">
    <h1>Bienvenue sur E-Library</h1>
    <p>Le meilleur du streaming et de la lecture</p>
</section>

<h2 class="section-title">Nouveautés</h2>

<div class="carousel-wrapper">
    <button class="scroll-btn btn-left" onclick="scrollContainer('nouveautes', -600)">&#8249;</button>

    <div class="horizontal-scroll" id="nouveautes">
        <?php foreach($nouveautes as $res): ?>
            <article class="card">
                <div class="card-img-wrapper">
                    <span class="badge"><?= htmlspecialchars($res['type_ressource'] ?? 'Média') ?></span>
                    <a href="index.php?action=detail&id=<?= $res['id'] ?>">
                        <img src="<?= !empty($res['image_path']) ? htmlspecialchars($res['image_path']) : 'public/img/default.jpg' ?>" alt="Cover">
                    </a>
                </div>
                <div class="card-body">
                    <h3 class="card-title"><?= htmlspecialchars($res['titre']) ?></h3>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <button class="scroll-btn btn-right" onclick="scrollContainer('nouveautes', 600)">&#8250;</button>
</div>


<h2 class="section-title">Les Mieux Notés</h2>

<div class="carousel-wrapper">
    <button class="scroll-btn btn-left" onclick="scrollContainer('top', -600)">&#8249;</button>

    <div class="horizontal-scroll" id="top">
        <?php foreach($top as $res): ?>
            <article class="card">
                <div class="card-img-wrapper">
                    <span class="badge"><?= htmlspecialchars($res['type_ressource'] ?? 'Média') ?></span>
                    <a href="index.php?action=detail&id=<?= $res['id'] ?>">
                        <img src="<?= !empty($res['image_path']) ? htmlspecialchars($res['image_path']) : 'public/img/default.jpg' ?>" alt="Cover">
                    </a>
                </div>
                <div class="card-body">
                    <h3 class="card-title"><?= htmlspecialchars($res['titre']) ?></h3>
                    <small style="color: var(--accent-color)">
                        <?= isset($res['moy']) ? round($res['moy'], 1) . '/5 ★' : '' ?>
                    </small>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <button class="scroll-btn btn-right" onclick="scrollContainer('top', 600)">&#8250;</button>
</div>
