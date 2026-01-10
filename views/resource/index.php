<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ressource.css">
    <title>Médiathèque Numérique</title>
</head>

<h1>Catalogue</h1>

<div class="search-section">
    <form action="index.php" method="GET" class="search-form">
        <input type="hidden" name="action" value="ressources">

        <div class="search-main">
            <input type="text" name="titre" placeholder="Rechercher un titre..."
                   value="<?php echo htmlspecialchars($_GET['titre'] ?? ''); ?>">
            <button type="submit" class="btn">Rechercher</button>
        </div>

        <details class="search-filters">
            <summary>Filtres avancés</summary>
            <div class="filters-content">
                <div class="filter-group">
                    <label>Type</label>
                    <select name="type">
                        <option value="">Tous</option>
                        <option value="livre" <?php echo (isset($_GET['type']) && $_GET['type'] == 'livre') ? 'selected' : ''; ?>>Livres</option>
                        <option value="film" <?php echo (isset($_GET['type']) && $_GET['type'] == 'film') ? 'selected' : ''; ?>>Films</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Genre</label>
                    <input type="text" name="genre" placeholder="Ex: Action..."
                           value="<?php echo htmlspecialchars($_GET['genre'] ?? ''); ?>">
                </div>

                <div class="filter-group">
                    <label>Auteur / Réalisateur</label>
                    <input type="text" name="auteur" placeholder="Nom..."
                           value="<?php echo htmlspecialchars($_GET['auteur'] ?? ''); ?>">
                </div>
            </div>
        </details>
    </form>
</div>

<?php
$queryString = "&titre=" . urlencode($filters['titre']) . "&genre=" . urlencode($filters['genre']) . "&auteur=" . urlencode($filters['auteur']) . "&type=" . urlencode($filters['type']);
?>

<div class="resource-grid">
    <?php foreach ($resources as $res): ?>
        <a href="index.php?action=detail&id=<?php echo $res['id']; ?>" class="film-card">
            <img src="<?php echo htmlspecialchars($res['image_path']); ?>"
                 alt="<?php echo htmlspecialchars($res['titre']); ?>">

            <div class="film-info-overlay">
                <h3 class="film-title"><?php echo htmlspecialchars($res['titre']); ?></h3>
                <p class="film-duration">
                    <?php
                    if ($res['type_ressource'] == 'film') {
                        echo $res['duree'] . " min";
                    } else {
                        echo $res['nb_pages'] . " pages";
                    }
                    ?>
                </p>
            </div>
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