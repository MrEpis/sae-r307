<h2>Inscription</h2>
<?php
if (isset($errors))
foreach ($errors as $error) {
    echo "<p style='color: red;'>$error</p>";
}
?>
<form method="post">
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>

