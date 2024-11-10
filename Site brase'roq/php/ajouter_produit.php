<?php
session_start();
include 'connexion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Début du script"; 

// Connexion à la base de données
require_once 'connexion.php'; 

echo "Connexion établie";

// Reste du code pour l'upload et l'insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    echo "Fichier reçu"; 
    
    $image = $_FILES['image'];
    $nom_image = "../img/" . basename($image['name']);
    
    if (move_uploaded_file($image['tmp_name'], $nom_image)) {
        echo "Fichier déplacé avec succès"; 
        
        $description = $_POST['description'];
        $typeProduit = $_POST['typeProduit'];
        
        $stmt = $pdo->prepare("INSERT INTO images (url, description, TypeProduit) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $nom_image, PDO::PARAM_STR);
        $stmt->bindValue(2, $description, PDO::PARAM_STR);
        $stmt->bindValue(3, $typeProduit, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Produit ajouté avec succès";
            // Redirection vers la page des produits
            header("Location: ../Produits.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout du produit : " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Erreur lors de l'upload de l'image.";
    }
} else {
    echo "Aucun fichier reçu ou erreur d'upload.";
}
?>
