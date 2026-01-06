<h1>Catalogue</h1>

<form action="index.php" method="GET">
    <input type="hidden" name="action" value="ressources">

    <select name="type">
        <option value="">Tous les types</option>
        <option value="livre" <?php echo (isset($_GET['type']) && $_GET['type'] == 'livre') ? 'selected' : ''; ?>>Livres</option>
        <option value="film" <?php echo (isset($_GET['type']) && $_GET['type'] == 'film') ? 'selected' : ''; ?>>Films</option>
    </select>

    <input type="text" name="titre" placeholder="Titre..." value="<?php echo htmlspecialchars($_GET['titre'] ?? ''); ?>">

    <input type="text" name="genre" placeholder="Genre (ex: Action)..." value="<?php echo htmlspecialchars($_GET['genre'] ?? ''); ?>">

    <input type="text" name="auteur" placeholder="Auteur/Réalisateur..." value="<?php echo htmlspecialchars($_GET['auteur'] ?? ''); ?>">

    <button type="submit">Rechercher</button>
</form>

<?php
$queryString = "&titre=" . urlencode($filters['titre']) . "&genre=" . urlencode($filters['genre']) . "&auteur=" . urlencode($filters['auteur']) . "&type=" . urlencode($filters['type']);
?>

<div class="resource-grid">
    <?php foreach ($resources as $res): ?>
        <a href="index.php?action=detail&id=<?php echo $res['id']; ?>">
            <img src="<?php echo htmlspecialchars($res['image_path']); ?>"
                 alt="<?php echo htmlspecialchars($res['titre']); ?>"
            >
        </a>
    <?php endforeach; ?>
</div>

<div class="pagination">
    <p>Page <?php echo $page; ?> sur <?php echo $totalPages; ?> (Total : <?php echo $totalItems; ?> ressources)</p>

    <?php if ($page > 1): ?>
        <a href="index.php?action=ressources&page=1<?php echo $queryString; ?>">Première</a>
        <a href="index.php?action=ressources&page=<?php echo $page - 1 . $queryString; ?>">Précédente</a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="index.php?action=ressources&page=<?php echo $page + 1 . $queryString; ?>">Suivante</a>
        <a href="index.php?action=ressources&page=<?php echo $totalPages . $queryString; ?>">Dernière</a>
    <?php endif; ?>
</div>