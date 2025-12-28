<h2>Connexion</h2>
<?php if (isset($error)) echo "<p style='color: red;'>$error</p>" ?>
<form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
</form>
