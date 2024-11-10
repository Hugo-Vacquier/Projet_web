<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Mécha Technologie">
    <title>Contact - Mécha Technologie</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/print.css" media="print">
</head>
<body>
    <header>
        <h1>Contact Mécha Technologie</h1>
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
        <h2>Nous contacter</h2>
        <form action="Contact.php" method="POST">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>
            
            <button type="submit">Envoyer</button>
        </form>
    </section>

    <footer>
        <p>© 2024 Mécha Technologie | <a href="Contact.php">Contact</a></p>
    </footer>
</body>
</html>
