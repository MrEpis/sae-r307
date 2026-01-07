</main>
<footer>
    <div class="footer-container">
        <div class="footer-column">
            <h3>Aide & Contact</h3>
            <ul>
                <li><a href="#">Foire aux questions (FAQ)</a></li>
                <li><a href="#">Contactez-nous</a></li>
                <li><a href="#">Plan du site</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>E-Library</h3>
            <p>Votre portail numérique de référence pour accéder à des films et livres en ligne.</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> E-Library - SAE R307 - Tous droits réservés.</p>
    </div>
</footer>
<script>
    // Fonction pour la navbar
    document.addEventListener("DOMContentLoaded", function() {
        const header = document.querySelector("header");
        const sentinel = document.getElementById("sticky-sentinel");

        const observer = new IntersectionObserver((entries) => {
            // Si la sentinelle n'est plus visible, c'est qu'elle est au-dessus de l'écran
            // Donc on ajoute la classe "stuck"
            if (!entries[0].isIntersecting) {
                header.classList.add("stuck");
            } else {
                header.classList.remove("stuck");
            }
        })
        observer.observe(sentinel);
    })
</script>
</body>
</html>