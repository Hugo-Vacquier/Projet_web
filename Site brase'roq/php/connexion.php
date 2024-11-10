<?php 
$host = 'mysql-mechatechnologie.alwaysdata.net';
$username = "381465";
$password = "sasmt12";
$dbname = "mechatechnologie_siteweb";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
