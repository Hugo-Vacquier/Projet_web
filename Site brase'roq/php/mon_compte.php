<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Vérification du rôle
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

require 'connexion.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Mécha Technologie</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/print.css" media="print">
</head>
<body>
    <header>
        <h1>Mécha Technologie</h1>
        <nav>
            <a href="../index.php">Accueil</a>
            <a href="../Produits.php">Produits</a>
            <a href="../Contact.php">Contact</a>
            <a href="mon_compte.php">Mon Compte</a>
            <a href="logout.php">Déconnexion</a>
        </nav>
    </header>

    <main>
        <h2>Bienvenue, <?= htmlspecialchars($_SESSION['user_email']) ?> !</h2>

        <?php if ($is_admin): ?>
            <!-- Partie Administrateur -->
            <section>
                <h3>Gestion des Produits (Admin)</h3>
                
                <!-- Formulaire pour ajouter un produit -->
                <form action="ajouter_produit.php" method="POST" enctype="multipart/form-data">
                    <label for="typeProduit">Type de produit :</label>
                    <select name="typeProduit" id="typeProduit" required>
                        <option value="brasero">Brasero</option>
                        <option value="garde-corp">Garde-Corp</option>
                        <option value="escalier">Escalier</option>
                    </select>
                    <label for="description">Description :</label>
                    <input type="text" name="description" id="description" required>
                    <label for="image">Image :</label>
                    <input type="file" name="image" id="image" required>
                    <button type="submit">Ajouter le produit</button>
                </form>

                <!-- Formulaire pour supprimer un produit -->
                <form action="supprimer_produit.php" method="POST">
                    <label for="product_id">ID du produit à supprimer :</label>
                    <input type="number" name="product_id" id="product_id" required>
                    <button type="submit">Supprimer le produit</button>
                </form>
            </section>

        <?php else: ?>
            <!-- Partie Client -->
            <section>
                <h3>Vos demandes de renseignement</h3>
                <?php
                // Récupération des demandes de renseignement de l'utilisateur
                $stmt = $pdo->prepare("SELECT r.id, p.description AS produit, r.message FROM renseignements r INNER JOIN images p ON r.product_id = p.product_id WHERE r.user_id = ?");
                $stmt->execute([$_SESSION['user_id']]);
                $renseignements = $stmt->fetchAll();

                if ($renseignements):
                    foreach ($renseignements as $renseignement): ?>
                        <div class="renseignement">
                            <p><strong>Produit :</strong> <?= htmlspecialchars($renseignement['produit']) ?></p>
                            <p><strong>Message :</strong> <?= htmlspecialchars($renseignement['message']) ?></p>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p>Vous n'avez fait aucune demande de renseignement pour le moment.</p>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Mécha Technologie | <a href="../Contact.php">Contact</a></p>
    </footer>
</body>
</html>
