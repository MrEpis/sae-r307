<div class="profile-container">
    <h1>Mon Espace</h1>

    <div class="user-info">
        <h2>Bonjour, <?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></h2>
        <p>Email : <?= htmlspecialchars($_SESSION['user']['email'] ?? 'Non renseigné') ?></p>
        <span class="badge"><?= $isAdmin ? 'Administrateur' : 'Membre' ?></span>
    </div>

    <?php if ($isAdmin) : ?>
    <h2>Administration</h2>

    <div class="admin-section">
        <h3>Gestion des utilisateurs</h3>
        <table>
            <thead>
            <tr>
                <th>ID</th><th>Nom</th><th>Email</th><th>Rôle</th><th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($usersList as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['prenom'].' '.$u['nom']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['role'] ?? 'membre') ?></td>
                <td>
                    <a href="index.php?action=delete_user&id=<?= $u['id'] ?>" onclick="return confirm('Supprimer ?')">❌</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php else : ?>
        <h2>Mes emprunts en cours</h2>

        <?php if (empty($mesEmprunts)) : ?>
        <p>Vous n'avez aucun emprunt en cours.</p>
        <a href="index.php?action=ressources" class="btn">Parcourir le catalogue</a>
        <?php else: ?>
        <div class="grid-4">
            <?php foreach ($mesEmprunts as $emprunt): ?>
            <div class = "card">
                <img src="<?= $emprunt['image_path'] ?>" alt="Cover" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h4><?= htmlspecialchars($emprunt['titre']) ?></h4>
                    <small>Emprunté le : <?= date('d/m/Y', strtotime($emprunt['date_emprunt'])) ?></small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>