<?php

/**
 * include vs include_once : (pareil pour require vs require_once)
 * Il n'y a qu'une seule différence entre include() et include_once(). 
 * Si le code d'un fichier a déjà été inclus, il ne sera pas inclus à nouveau si nous utilisons include_once()
 * 
 * include vs require : 
 * si include() n'est pas en mesure de trouver un fichier spécifié sur l'emplacement à ce moment-là, 
 * il lancera un avertissement, mais il n'arrêtera pas l'exécution du script. 
 * Pour le même scénario, require() lancera une erreur fatale et arrêtera l'exécution du script.
 */

// Inclure la connexion à la base de données
include_once 'database.php';

/**
 * Logique de récupération des données
 */

 // Variables globales
$table_data = null;

if (isset($pdo)) {

    // Requête SQL pour récupérer toutes les boissons
    $statement = "SELECT * FROM drink";

    // Prépare et exécute une requête SQL sans marque substitutive
    /**
     * @param {string} $statement - La requête à exécuter
     * @param {int} $fetchMode - Le mode de récupération (défault: PDO::FETCH_BOTH)
     * @return {PDOStatement | false} - Objet PDO contenant les données ou faux en cas d'échec de récupération 
     */
    $object = $pdo->query($statement);

    // fetch peut prendre plusieurs paramètres :
    // PDO::FETCH_BOTH  → Permet d'indexer les données par rapport à leur nom de colonne et index (numérique) => Par défaut
    // PDO::FETCH_ASSOC → Permet d'indexer les données par rapport à leur nom de colonne
    // PDO::FETCH_NUM   → Permet d'indexer les données par rapport à leur index
    // $boisson1 = $object->fetch();
    $boisson1 = $object->fetch(PDO::FETCH_BOTH);

    print_r("<p>Id: $boisson1[0]</p>");
    print_r("<p>Name: $boisson1[1]</p>");
    print_r("<p>Id: $boisson1[id]</p>");
    print_r("<p>Name: $boisson1[name]</p>");
    print_r($boisson1["name"]);
    print_r($boisson1);

    // $boisson2 = $object->fetch();

    // print_r("<p>Id: $boisson2[0]</p>");
    // print_r("<p>Name: $boisson2[1]</p>");

    // fetchAll peut prendre plusieurs paramètres :
    // PDO::FETCH_BOTH  → Permet d'indexer les données par rapport à leur nom de colonne et index (numérique) => Par défaut
    // PDO::FETCH_ASSOC → Permet d'indexer les données par rapport à leur nom de colonne
    // PDO::FETCH_NUM   → Permet d'indexer les données par rapport à leur index
    $drinks = $object->fetchAll();
    // print_r($drinks);

    foreach ($drinks as $index => $drink) {
        // print_r($drink);
        // print_r("<p>Index: $index - Id: $drink[0] - Name: $drink[1]</p>");

        list($id, $name) = $drink;

        $table_data .= "<tr><td>$id</td><td>$name</td></tr>";
    }
}

/**
 * Vue
 */

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Read - Récupération</title>

    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            width: 150px;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php include_once 'nav.php'; ?>

    <h1>CRUD - Read : Récupération</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <!-- Généré par PHP -->
            <?= $table_data; ?>
        </tbody>
    </table>

</body>

</html>