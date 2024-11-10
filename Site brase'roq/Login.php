<?php
session_start();
include 'php/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && $user['password'] === $password) {
        // Utilisateur authentifié
        $_SESSION['logged_in'] = true;
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['admin'] == 1 ? 'admin' : 'client';

        header("Location: php/mon_compte.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/print.css" media="print">
</head>
<body>
    <header>
        <h1>Connexion</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="Produits.php">Produits</a>
            <a href="Contact.php">Contact</a>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="mon_compte.php">Mon Compte</a>
                <a href="logout.php">Déconnexion</a>
            <?php else : ?>
                <a href="Login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <h2>Connectez-vous</h2>
        <?php if (!empty($error_message)) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="Login.php" method="post">
            <label for="email">Adresse email :</label>
            <input type="email" name="email" required><br>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required><br>
            <label>
                <input type="checkbox" name="remember_me"> Se souvenir de moi
            </label><br>
            <input type="submit" value="Se connecter">
        </form>
    </main>

    <footer>
        <p>© 2024 Mécha Technologie | <a href="Contact.php">Contact</a></p>
    </footer>
</body>
</html>
