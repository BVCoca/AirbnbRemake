<?php

// Connexion à la base de données

$dbHost = 'esilxl0nthgloe1y.chr7pe7iynqr.eu-west-1.rds.amazonaws.com'; // Adresse de l'hôte de la base de données
$dbName = 'pngrvw381ed6xm3f'; // Nom de la base de données
$dbUser = 'o540c7o9je747qia'; // Nom d'utilisateur de la base de données
$dbPassword = 'qidovnjlnee9lwdz'; // Mot de passe de la base de données

try {
    $db = new PDO(
        "mysql:host=$dbHost;dbname=$dbName",
        $dbUser,
        $dbPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]
    );
} catch (PDOException $e) {
    die('Erreur lors de la connexion : ' . $e->getMessage());
}