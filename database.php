<?php

/**
 * DSN : Data Source Name
 * Informations requises pour la connexion à la base de données
 */

$host     = "localhost";
$dbname   = "pdo";
$charset  = "utf8";

/**
 * Paramètre de connexion à la base de données
 */

$dsn      = "mysql:host=$host;dbname=$dbname;charset=$charset";
$username = "root";
$password = "";

/**
 * Tentative de connexion
 * Fonctionne → connexion réussie
 * Rate → Exception déclenchée et attrapée par le "catch" puis traitée
 */

 $state = false;

try {
    // Connexion à une base de données
    $pdo = new PDO($dsn, $username, $password);
    $state = true;
} catch (PDOException $e) {
    echo "<p>Erreur : {$e->getMessage()}</p>";
}

echo "État de connexion : " . ($state ? 'Connecté' : 'Déconnecté');