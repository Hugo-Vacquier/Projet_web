<?php session_start();
include('php/connexion.php');

// Vérification de la connexion utilisateur
$isLoggedIn = isset($_SESSION['user_id']);

// Récupérer les produits depuis la base de données
$sql = "SELECT * FROM images WHERE TypeProduit != 'autre'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - Mécha Technologie</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/print.css" media="print">
    <script src="js/produits.js" defer></script>
</head>
<body>
    <header>
        <h1>Mécha Technologie</h1>
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
        <h2>Découvrez Nos Produits</h2>
        <div id="product-filters">
            <button class="filter-btn" data-category="Tous">Tous</button>
            <button class="filter-btn" data-category="brasero">Braseros</button>
            <button class="filter-btn" data-category="Garde-Corp">Garde-Corps</button>
            <button class="filter-btn" data-category="Escalier">Escaliers</button>
        </div>
        
        <div class="product-gallery" id="carousel-images">
            <?php foreach ($products as $product): ?>
                <div class="product-item" data-category="<?= $product['TypeProduit'] ?>">
                    <img src="<?= $product['url'] ?>" alt="<?= $product['description'] ?>">
                    <h3><?= $product['description'] ?></h3>
                    <?php if ($isLoggedIn): ?>
                        <button class="info-btn" data-product-id="<?= $product['id'] ?>">Renseignement</button>
                    <?php else: ?>
                        <button onclick="window.location.href='Login.php'">Renseignement</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Mécha Technologie | <a href="Contact.php">Contact</a></p>
        <div class="social-icons">
            <a href="#"><img src="img/facebook_icon.png" alt="Facebook"></a>
            <a href="#"><img src="img/twitter_icon.png" alt="Twitter"></a>
            <a href="#"><img src="img/linkedin_icon.png" alt="LinkedIn"></a>
        </div>
    </footer>
</body>
</html>
