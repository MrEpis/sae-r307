<div class="avis-block" >
    <h3>Avis des utilisateurs</h3>

    <?php
    require_once __DIR__ . '/../../models/AvisModel.php';
    $avisModel = new AvisModel();
    // $resource['id'] doit être disponible depuis la page parente
    $moyenne = $avisModel->getMoyenne($resource['id']);
    ?>

    <div>
        <strong>Note moyenne : </strong>
        <span>
            <?= $moyenne ? $moyenne . '/5' : 'Pas encore noté' ?>
        </span>
    </div>

    <?php if (!empty($avisList)): ?>
        <?php foreach($avisList as $avis): ?>
            <div class="avis-item">
                <div class="avis-header">
                    <span><?= htmlspecialchars($avis['prenom'] . ' ' . $avis['nom']) ?></span>
                    <span><?= $avis['note'] ?>/5 ★</span>
                </div>
                <p><?= nl2br(htmlspecialchars($avis['commentaire'])) ?></p>
                <small>Le <?= date('d/m/Y', strtotime($avis['date_publication'])) ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun avis pour le moment. Soyez le premier !</p>
    <?php endif; ?>

    <?php if(isset($_SESSION['user'])): ?>
        <?php if(!$avisModel->aDejaVote($_SESSION['user']['id'], $resource['id'])): ?>
            <hr>
            <h4>Donnez votre avis</h4>
            <form action="index.php?action=add_avis" method="POST">
                <input type="hidden" name="id_ressource" value="<?= $resource['id'] ?>">

                <div>
                    <label>Note :</label>
                    <select name="note" required>
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Très bon</option>
                        <option value="3">3 - Moyen</option>
                        <option value="2">2 - Bof</option>
                        <option value="1">1 - Mauvais</option>
                    </select>
                </div>

                <textarea name="commentaire" placeholder="Votre commentaire..." required></textarea>
                <button type="submit" class="btn">Publier</button>
            </form>
        <?php else: ?>
            <p>✓ Vous avez déjà noté cette ressource.</p>
        <?php endif; ?>
    <?php else: ?>
        <p><a href="index.php?action=connexion">Connectez-vous</a> pour laisser un avis.</p>
    <?php endif; ?>
</div>