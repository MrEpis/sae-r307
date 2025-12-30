<div class="avis-block" style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ccc;">
    <h3>Avis des utilisateurs</h3>

    <?php
    require_once __DIR__ . '/../../models/AvisModel.php';
    $avisModel = new AvisModel();
    // $resource['id'] doit être disponible depuis la page parente
    $moyenne = $avisModel->getMoyenne($resource['id']);
    ?>

    <div style="margin-bottom:15px; font-size:1.1em;">
        <strong>Note moyenne : </strong>
        <span style="color:#e67e22; font-weight:bold;">
            <?= $moyenne ? $moyenne . '/5' : 'Pas encore noté' ?>
        </span>
    </div>

    <?php if (!empty($avisList)): ?>
        <?php foreach($avisList as $avis): ?>
            <div class="avis-item" style="background: #f9f9f9; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
                <div class="avis-header" style="display:flex; justify-content:space-between; font-weight:bold;">
                    <span><?= htmlspecialchars($avis['prenom'] . ' ' . $avis['nom']) ?></span>
                    <span style="color:#e67e22;"><?= $avis['note'] ?>/5 ★</span>
                </div>
                <p style="margin: 5px 0;"><?= nl2br(htmlspecialchars($avis['commentaire'])) ?></p>
                <small style="color:#888;">Le <?= date('d/m/Y', strtotime($avis['date_publication'])) ?></small>
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

                <div style="margin-bottom: 10px;">
                    <label>Note :</label>
                    <select name="note" required style="padding: 5px;">
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Très bon</option>
                        <option value="3">3 - Moyen</option>
                        <option value="2">2 - Bof</option>
                        <option value="1">1 - Mauvais</option>
                    </select>
                </div>

                <textarea name="commentaire" placeholder="Votre commentaire..." required style="width:100%; height:80px; margin-bottom:10px;"></textarea>
                <button type="submit" class="btn" style="background:#e67e22; color:white; border:none; padding:10px 15px; cursor:pointer;">Publier</button>
            </form>
        <?php else: ?>
            <p style="color:green; font-weight:bold; margin-top:20px;">✓ Vous avez déjà noté cette ressource.</p>
        <?php endif; ?>
    <?php else: ?>
        <p style="margin-top:20px;"><a href="index.php?action=connexion" style="color:#e67e22;">Connectez-vous</a> pour laisser un avis.</p>
    <?php endif; ?>
</div>