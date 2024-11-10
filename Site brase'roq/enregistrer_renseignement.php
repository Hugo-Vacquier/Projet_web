<?php session_start();
include 'php/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification de la connexion
    if (!$pdo) {
        die("Erreur de connexion à la base de données.");
    }

    // Récupération des données envoyées
    $product_id = $_POST['product_id'] ?? null;
    $message = $_POST['message'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null; // Assurez-vous que l'utilisateur est connecté

    // Validation des données
    if ($product_id && $message && $user_id) {
        $stmt = $pdo->prepare("INSERT INTO renseignements (user_id, product_id, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$user_id, $product_id, $message])) {
            echo "Insertion réussie";
        } else {
            echo "Erreur lors de l'insertion.";
        }
    } else {
        echo "Données manquantes ou utilisateur non connecté.";
    }
} else {
    echo "Méthode non autorisée.";
}
