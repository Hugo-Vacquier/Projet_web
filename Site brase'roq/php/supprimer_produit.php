<?php
session_start();
include 'connexion.php';
require 'connexion.php';

if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    echo "ID de produit reçu : " . $product_id . "<br>";

    try {
        // Suppression des enregistrements associés dans la table `renseignements`
        $stmt = $pdo->prepare("DELETE FROM renseignements WHERE product_id = ?");
        $stmt->execute([$product_id]);
        echo "Enregistrements associés supprimés.<br>";

        // Suppression du produit dans la table `images`
        $stmt = $pdo->prepare("DELETE FROM images WHERE id = ?");
        $stmt->execute([$product_id]);
        echo "Produit supprimé avec succès.<br>";
        header("Location: ../Produits.php");
            exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "ID de produit invalide ou non reçu.";
}

echo "<br>Fin du script";
?>