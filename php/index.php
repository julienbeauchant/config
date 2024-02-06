<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>AFCI - gestion des centres - BDD</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="?page=role">Rôle</a></li>
                <li><a href="?page=centre">Centre</a></li>
                <li><a href="?page=formation">Formation</a></li>
                <li><a href="?page=pedagogie">Pédagogie</a></li>
                <li><a href="?page=session">Session</a></li>
                <li><a href="?page=apprenant">Apprenant</a></li>
            </ul>
        </nav>
    </header>
    <?php
    $host = "mysql"; // Nom du service du conteneur MySQL dans Docker

    $port = "3306"; // Le port exposé par le conteneur MySQL dans Docker
    $dbname = "afci"; // Remplacez par le nom de votre base de données
    $user = "admin"; // Remplacez par votre nom d'utilisateur
    $pass = "admin"; // Remplacez par votre mot de passe


    // Création d'une nouvelle instance de la classe PDO
    $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);

    // echo "Connexion réussie !";

    // Lire des données dans la BDD
    // $sql = "SELECT * FROM apprenants";
    // $requete = $bdd->query($sql);
    // $results = $requete->fetchAll(PDO::FETCH_ASSOC);


    // foreach( $results as $value ){
    //     foreach($value as $data){
    //         echo $data;
    //         echo "<br>";

    //     }
    //     echo "<br>";
    // }

    // foreach( $results as $value ){
    //     echo "<h2>" . $value["nom_apprenant"] . "</h2>";
    //     echo "<br>";
    // }


    // Insérer des données dans la BDD

    // ROLE -------------------------------------------------------------------------------------- 

    include "role.php";

    // CENTRE -------------------------------------------------------------------------------------- 

    include "centres.php";

    // FORMATION -------------------------------------------------------------------------------------- 

    include "formations.php";

    // PEDAGOGIE -------------------------------------------------------------------------------------- 

    include "pedagogie.php";

    // SESSION -------------------------------------------------------------------------------------- 

    include "session.php";

    // APPRENANT -------------------------------------------------------------------------------------- 

    include "apprenants.php";

    ?>