<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site vitrine de Méca Technologie, expert en métallerie">
    <title>Mecha Technologie</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/print.css" media="print">

</head>
<body>
    <header class="navbar">
        <h1>Méca Technologie</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="Produits.php">Produits</a>
            <a href="Contact.php">Contact</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="php/mon_compte.php">Mon Compte</a>
                <a href="php/logout.php">Déconnexion</a>
            <?php else: ?>
            <a href="Login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <section>
        <h2>Bienvenue sur Méca Technologie</h2>
        <p>Nous sommes spécialisés dans la métallerie, la construction de garde-corps, d'escaliers, et plus encore. Découvrez nos deux marques phares : <strong>Brase'ROQ</strong> et <strong>Compost'ROQ</strong>.</p>
        
    <!-- Viewer d'images avec AJAX -->
    <div id="img-viewer">
        <button id="prev-btn" class="nav-btn">❮</button>
        <img src="" alt="Aperçu du produit" id="main-img">
        <button id="next-btn" class="nav-btn">❯</button>
    </div>
    <p id="product-description">Description du produit affiché ici.</p>

    <section class="company-highlights">
        <h2>Pourquoi choisir Méca Technologie ?</h2>
        <div class="highlights-container">
            <div class="highlight">
                <img src="img/experience_icon.jpg" alt="Expérience">
                <h3>20 ans d'expérience</h3>
                <p>Expertise dans la métallerie sur mesure et des projets uniques.</p>
            </div>
            <div class="highlight">
                <img src="img/quality_icon.jpg" alt="Qualité">
                <h3>Qualité supérieure</h3>
                <p>Des matériaux durables et un savoir-faire reconnu.</p>
            </div>
            <div class="highlight">
                <img src="img/innovation_icon.jpg" alt="Innovation">
                <h3>Innovation continue</h3>
                <p>Des designs modernes et des solutions sur mesure.</p>
            </div>
        </div>
    </section>
    
    <section class="newsletter">
        <h2>Restez informé de nos nouveautés</h2>
        <form action="index.php" method="POST">
            <input type="email" name="email" placeholder="Votre email" required>
            <button type="submit">S'inscrire</button>
        </form>
    </section>    

    <footer>
        <p>© 2024 Méca Technologie | <a href="Contact.php">Contact</a></p>
        <div class="social-icons">
            <a href="#"><img src="img/facebook_icon.png" alt="Facebook"></a>
            <a href="#"><img src="img/twitter_icon.png" alt="Twitter"></a>
            <a href="#"><img src="img/linkedin_icon.png" alt="LinkedIn"></a>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html> 