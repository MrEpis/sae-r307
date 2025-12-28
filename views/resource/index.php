<h1>Catalogue</h1>
<div class="resource-grid">
    <?php foreach ($resources as $res): ?>
        <div>
            <h3><?php echo htmlspecialchars($res['titre']); ?></h3>
            <p>Genre : <?php echo htmlspecialchars($res['genre']); ?></p>
            <?php if ($res['type_ressource'] == 'livre'): ?>
                <p>Auteur : <?php echo htmlspecialchars($res['auteur']); ?></p>
            <?php else: ?>
                <p>Réalisateur : <?php echo htmlspecialchars($res['realisateur']); ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>