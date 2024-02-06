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

// $sql = "SELECT * FROM role";
// $requete = $bdd->query($sql);
// $results = $requete->fetchAll(PDO::FETCH_ASSOC);

// foreach( $results as $value ){
// foreach($value as $data){
//     echo $data;
//     echo "<br>";
// }
//     echo "<br>";
// }

if (isset($_GET["page"]) && $_GET["page"] == "role") {
        $sql = "SELECT * FROM role";
        $requete = $bdd->query($sql);
        $resultsRole = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        ?>
        <div class="centerDiv">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom Rôle</th>
                    <th>modifier</th>
                    <th>supprimer</th>
                </tr>
                <form method="POST">
                    <label for="">Ajouter un role</label>
                    <br>
                    <input type="text" name="nomRole" placeholder="nom du rôle">
                    <br>
                    <input type="submit" name="submitRole" value="Ajouter">
                </form>
                <?php
                echo '<table border="1">';
                echo "  <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                        </tr>"; // Ajoutez les en-têtes appropriés
                foreach ($resultsRole as $item) {
                    echo '<tr>';
                    echo '<td>' . $item['id_role'] . '</td>';
                    echo '<td>' . $item['nom_role'] . '</td>';
                    echo '<input type="hidden" name="hiddenRole" value="'. $item['id_role'] . '">';
                    echo '<td><a href="?page=role&type=modifier&id=' . $item['id_role'] . '"><button>Modifier</button></a></td>';
                    echo '<td><a href="?page=role&type=supprimer&id=' . $item['id_role'] . '"><button>Supprimer</button></>';
                    // echo '<td><button>Supprimer</button></td>';
                    echo '</tr>';
                }
                ?>
            </table>
            
        </div>
    <?php


            if (isset($_GET['type']) && $_GET['type'] == "modifier"){

                $id = $_GET["id"];
                $sqlId = "SELECT * FROM role WHERE id_role = $id";
                $requeteId = $bdd->query($sqlId);
                $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
                ?>
                <form method="POST">
                    <input type="hidden" name="updateIdRole" value="<?php  echo $resultsId['id_role']; ?>">
                    <input type="text" name="updateNomRole" value="<?php  echo $resultsId['nom_role']; ?>">
                    <input type="submit" name="updateRole" value="updateRole">
                </form>
                <?php
                if (isset($_POST["updateRole"])){
                    $updateIdRole = $_POST["updateIdRole"];
                    $updateNomRole = $_POST["updateNomRole"];
                    $sqlUpdate = "UPDATE `role` SET `nom_role`='$updateNomRole' WHERE id_role = $updateIdRole";

                    $bdd->query($sqlUpdate);
                    echo "Données modifiées";
                }
            }
    }

    if (isset($_GET['type']) && $_GET['type'] == "supprimer"){

        $id = $_GET["id"];
        $sqlId = "SELECT * FROM role WHERE id_role = $id";
        $requeteId = $bdd->query($sqlId);
        $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
        ?>
        <form method="POST">
            <input type="hidden" name="deleteIdRole" value="<?php  echo $resultsId['id_role']; ?>">
            <!-- <input type="text" name="updateNomRole" value="<?php  echo $resultsId['nom_role']; ?>"> -->
            <input type="submit" name="deleteRole" value="deleteRole">
        </form>
        <?php
        if (isset($_POST["deleteRole"])){
            $deleteIdRole = $_POST["deleteIdRole"];
            // $updateNomRole = $_POST["updateNomRole"];
            $sqlDelete = "DELETE FROM `role` WHERE id_role = $deleteIdRole";

            $bdd->query($sqlDelete);
            echo "Données modifiées";
        }
    }

    
    if (isset($_POST['submitRole'])) {
        
        $nomRole = $_POST['nomRole'];

        $sql = "INSERT INTO `role`(`nom_role`) VALUES ('$nomRole')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";
    }

     // CENTRE -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM centres";
// $requete = $bdd->query($sql);
// $results = $requete->fetchAll(PDO::FETCH_ASSOC);

// foreach( $results as $value ){
// foreach($value as $data){
//     echo $data;
//     echo "<br>";
// }
//     echo "<br>";
// }

if (isset($_GET["page"]) && $_GET["page"] == "centre") {
        $sql = "SELECT * FROM centres";
        $requete = $bdd->query($sql);
        $resultsCentre = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        ?>
        <div class="centerDiv">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Ville</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>modifier</th>
                    <th>supprimer</th>
                </tr>
                <form method="POST">
                    <label for="">Ajouter un centre de formation</label>
                    <br>
                    <input type="text" name="villeCentre" placeholder="ville du Centre">
                    <br>
                    <input type="text" name="adresseCentre" placeholder="adresse du Centre">
                    <br>
                    <input type="text" name="codePostalCentre" placeholder="code postal du Centre">
                    <br>
                    <input type="submit" name="submitCentre" value="Ajouter">
                </form>
                <?php
                    echo '<table border="1">';
                    echo "  <tr>
                            <th>ID</th>
                            <th>Ville</th>
                            <th>Adresse</th>
                            <th>Code postal</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                            </tr>"; // Ajoutez les en-têtes appropriés
                foreach ($resultsCentre as $item) {
                    echo '<tr>';
                    echo '<td>' . $item['id_centre'] . '</td>';
                    echo '<td>' . $item['ville_centre'] . '</td>';
                    echo '<td>' . $item['adresse_centre'] . '</td>';
                    echo '<td>' . $item['code_postal_centre'] . '</td>';
                    echo '<input type="hidden" name="hiddenCentre" value="'. $item['id_centre'] . '">';
                    echo '<td><a href="?page=centre&type=modifier&id=' . $item['id_centre'] . '"><button>Modifier</button></a></td>';
                    echo '<td><button>Supprimer</button></td>';
                    echo '</tr>';
                }
                ?>
            </table>
            
        </div>
    <?php


            if (isset($_GET['type']) && $_GET['type'] == "modifier"){

                $id = $_GET["id"];
                $sqlId = "SELECT * FROM centres WHERE id_centre = $id";
                $requeteId = $bdd->query($sqlId);
                $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
                ?>
                <form method="POST">
                    <input type="hidden" name="updateIdCentre" value="<?php  echo $resultsId['id_centre']; ?>">
                    <input type="text" name="updateVilleCentre" value="<?php  echo $resultsId['ville_centre']; ?>">
                    <input type="text" name="updateAdresseCentre" value="<?php  echo $resultsId['adresse_centre']; ?>">
                    <input type="text" name="updateCodePostalCentre" value="<?php  echo $resultsId['code_postal_centre']; ?>">
                    <input type="submit" name="updateCentre" value="updateCentre">
                </form>
                <?php
                if (isset($_POST["updateCentre"])){
                    $updateIdCentre = $_POST["updateIdCentre"];
                    $updateVilleCentre = $_POST["updateVilleCentre"];
                    $updateAdresseCentre = $_POST["updateAdresseCentre"];
                    $updateCodePostalCentre = $_POST["updateCodePostalCentre"];
                    $sqlUpdate = "UPDATE `centres` SET `ville_centre` = '$updateVilleCentre', `adresse_centre` = '$updateAdresseCentre', `code_postal_centre` = '$updateCodePostalCentre' WHERE `id_centre` = '$updateIdCentre'";
                    $bdd->query($sqlUpdate);
                    echo "Données modifiées";
                }
            }
    }

    if (isset($_POST['submitCentre'])){
        $villeCentre = $_POST['villeCentre'];
        $adresseCentre = $_POST['adresseCentre'];
        $codePostalCentre = $_POST['codePostalCentre'];

        $sql = "INSERT INTO `centres`(`ville_centre`, `adresse_centre`, `code_postal_centre`) VALUES ('$villeCentre','$adresseCentre','$codePostalCentre')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";
    }

    // FORMATION -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM formations";
// $requete = $bdd->query($sql);
// $results = $requete->fetchAll(PDO::FETCH_ASSOC);

// foreach( $results as $value ){
// foreach($value as $data){
//     echo $data;
//     echo "<br>";
// }
//     echo "<br>";
// }

if (isset($_GET["page"]) && $_GET["page"] == "formation") {
    $sql = "SELECT * FROM formations";
    $requete = $bdd->query($sql);
    $resultsFormation = $requete->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <div class="centerDiv">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Durée</th>
                <th>Niveau de sortie</th>
                <th>Description</th>
                <th>modifier</th>
                <th>supprimer</th>
            </tr>
            <form method="POST">
                <label for="">Ajouter une formation</label>
                <br>
                <input type="text" name="nomFormation" placeholder="nom de la Formation">
                <br>
                <input type="text" name="dureeFormation" placeholder="durée de la Formation">
                <br>
                <input type="text" name="niveauSortieFormation" placeholder="niveau de sortie de la Formation">
                <br>
                <input type="text" name="descriptionFormation" placeholder="description de la Formation">
                <br>
                <input type="submit" name="submitFormation" value="Ajouter">
            </form>
            <?php
            echo '<table border="1">';
            echo "<tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Durée</th>
                    <th>Niveau de sortie</th>
                    <th>Description</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    </tr>"; // Ajoutez les en-têtes appropriés
            foreach ($resultsFormation as $item) {
                echo '<tr>';
                echo '<td>' . $item['id_formation'] . '</td>';
                echo '<td>' . $item['nom_formation'] . '</td>';
                echo '<td>' . $item['duree_formation'] . '</td>';
                echo '<td>' . $item['niveau_sortie_formation'] . '</td>';
                echo '<td>' . $item['description'] . '</td>';
                echo '<input type="hidden" name="hiddenFormation" value="'. $item['id_formation'] . '">';
                echo '<td><a href="?page=formation&type=modifier&id=' . $item['id_formation'] . '"><button>Modifier</button></a></td>';
                echo '<td><button>Supprimer</button></td>';
                echo '</tr>';
            }
            ?>
        </table>
        
    </div>
<?php


        if (isset($_GET['type']) && $_GET['type'] == "modifier"){

            $id = $_GET["id"];
            $sqlId = "SELECT * FROM formations WHERE id_formation = $id";
            $requeteId = $bdd->query($sqlId);
            $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
            ?>
            <form method="POST">
                <input type="hidden" name="updateIdFormation" value="<?php  echo $resultsId['id_formation']; ?>">
                <input type="text" name="updateNomFormation" value="<?php  echo $resultsId['nom_formation']; ?>">
                <input type="text" name="updateDureeFormation" value="<?php  echo $resultsId['duree_formation']; ?>">
                <input type="text" name="updateNiveauSortieFormation" value="<?php  echo $resultsId['niveau_sortie_formation']; ?>">
                <input type="text" name="updateDescrition" value="<?php  echo $resultsId['description']; ?>">
                <input type="submit" name="updateFormation" value="updateFormations">
            </form>
            <?php
            if (isset($_POST["updateFormation"])){
                $updateIdFormation = $_POST["updateIdFormation"];
                $updateNomFormation = $_POST["updateNomFormation"];
                $updateDureeFormation = $_POST["updateDureeFormation"];
                $updateNiveauSortieFormation = $_POST["updateNiveauSortieFormation"];
                $updateDescrition = $_POST["updateDescrition"];
                $sqlUpdate = "UPDATE `formations` SET `nom_formation`='$updateNomFormation', `duree_formation`='$updateDureeFormation', `niveau_sortie_formation`='$updateNiveauSortieFormation', `description`='$updateDescrition' WHERE id_formation = $updateIdFormation";

                $bdd->query($sqlUpdate);
                echo "Données modifiées";
            }
        }
}

    if (isset($_POST['submitFormation'])){
        $nomFormation = $_POST['nomFormation'];
        $dureeFormation = $_POST['dureeFormation'];
        $niveauSortieFormation = $_POST['niveauSortieFormation'];
        $descriptionFormation = $_POST['descriptionFormation'];

        $sql = "INSERT INTO `formations`(`nom_formation`, `duree_formation`, `niveau_sortie_formation`, `description`) VALUES ('$nomFormation','$dureeFormation','$niveauSortieFormation','$descriptionFormation')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";
    }

    // PEDAGOGIE -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM pedagogie";
// $requete = $bdd->query($sql);
// $results = $requete->fetchAll(PDO::FETCH_ASSOC);

// foreach( $results as $value ){
// foreach($value as $data){
//     echo $data;
//     echo "<br>";
// }
//     echo "<br>";
// }

if (isset($_GET["page"]) && $_GET["page"] == "pedagogie") {
    $sql = "SELECT * FROM pedagogie";
    $requete = $bdd->query($sql);
    $resultsPedagogie = $requete->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <div class="centerDiv">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Num</th>
                <th>Rôle</th>
                <th>modifier</th>
                <th>supprimer</th>
            </tr>
            <form method="POST">
            <label>Ajout dans Pédagogie</label>
            <br>
                    <input type="text" name="nomPedagogie" placeholder="nom personnel Pedagogie">
                    <br>
                    <input type="text" name="prenomPedagogie" placeholder="prénom personnel Pedagogie">
                    <br>
                    <input type="text" name="mailPedagogie" placeholder="mail personnel Pedagogie">
                    <br>
                    <input type="text" name="numPedagogie" placeholder="numéro personnel Pedagogie">
                    <br>
                    <select name="idPedagogie" id="">
                        <?php 
                                $sql = "SELECT * FROM role";
                                $requete = $bdd->query($sql);
                                $resultsRole = $requete->fetchAll(PDO::FETCH_ASSOC);
                            foreach( $resultsRole as $value ){             
                                echo '<option value="' . $value['id_role'] .  '">' . $value['id_role'] . ' - ' . $value['nom_role'] . '</option>'; 
                            }
                        ?>
                    </select>
                    <input type="submit" name="submitPedagogie" value = "Ajouter">
            </form>
            <?php
            echo '<table border="1">';
            echo "<tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Equipe pédagogique</th>
                    <th>Formation</th>
                    <th>Rôle</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    </tr>"; // Ajoutez les en-têtes appropriés
            foreach ($resultsPedagogie as $item) {
                echo '<tr>';
                echo '<td>' . $item['id_pedagogie'] . '</td>';
                echo '<td>' . $item['nom_pedagogie'] . '</td>';
                echo '<td>' . $item['prenom_pedagogie'] . '</td>';
                echo '<td>' . $item['mail_pedagogie'] . '</td>';
                echo '<td>' . $item['num_pedagogie'] . '</td>';
                echo '<td>' . $item['id_role'] . '</td>';
                echo '<input type="hidden" name="hiddenPedagogie" value="'. $item['id_pedagogie'] . '">';
                echo '<td><a href="?page=pedagogie&type=modifier&id=' . $item['id_pedagogie'] . '"><button>Modifier</button></a></td>';
                echo '<td><button>Supprimer</button></td>';
                echo '</tr>';
            }
            ?>
        </table>
        
    </div>
<?php


        if (isset($_GET['type']) && $_GET['type'] == "modifier"){

            $id = $_GET["id"];
            $sqlId = "SELECT * FROM pedagogie WHERE id_pedagogie = $id";
            $requeteId = $bdd->query($sqlId);
            $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
            ?>
            <form method="POST">
                <input type="hidden" name="updateIdPedagogie" value="<?php  echo $resultsId['id_pedagogie']; ?>">
                <input type="text" name="updateNomPedagogie" value="<?php  echo $resultsId['nom_pedagogie']; ?>">
                <input type="text" name="updatePrenomPedagogie" value="<?php  echo $resultsId['prenom_pedagogie']; ?>">
                <input type="text" name="updateMailPedagogie" value="<?php  echo $resultsId['mail_pedagogie']; ?>">
                <input type="text" name="updateNumPedagogie" value="<?php  echo $resultsId['num_pedagogie']; ?>">
                <input type="text" name="updateIdRole" value="<?php  echo $resultsId['id_role']; ?>">
                <input type="submit" name="updatePedagogie" value="updatePedagogie">
            </form>
            <?php
            if (isset($_POST["updatePedagogie"])){
                $updateIdPedagogie = $_POST["updateIdPedagogie"];
                $updateNomPedagogie = $_POST["updateNomPedagogie"];
                $updatePrenomPedagogie = $_POST["updatePrenomPedagogie"];
                $updateMailPedagogie = $_POST["updateMailPedagogie"];
                $updateNumPedagogie = $_POST["updateNumPedagogie"];
                $updateIdRole = $_POST["updateIdRole"];
                $sqlUpdate = "UPDATE `pedagogie` SET `nom_pedagogie`='$updateNomPedagogie', `prenom_pedagogie`='$updatePrenomPedagogie', `mail_pedagogie`='$updateMailPedagogie', `num_pedagogie`='$updateNumPedagogie', `id_role`='$updateIdRole' WHERE id_pedagogie = $updateIdPedagogie";

                $bdd->query($sqlUpdate);
                echo "Données modifiées";
            }
        }
}

    if (isset($_POST['submitPedagogie'])){
        $nomPedagogie = $_POST['nomPedagogie'];
        $prenomPedagogie = $_POST['prenomPedagogie'];
        $mailPedagogie = $_POST['mailPedagogie'];
        $numPedagogie = $_POST['numPedagogie'];
        $idRole = $_POST['idPedagogie'];

        $sql = "INSERT INTO `pedagogie`(`nom_pedagogie`, `prenom_pedagogie`, `mail_pedagogie`, `num_pedagogie`, `id_role`) VALUES ('$nomPedagogie','$prenomPedagogie','$mailPedagogie','$numPedagogie','$idRole')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";
    }

    // SESSION -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM session";
// $requete = $bdd->query($sql);
// $results = $requete->fetchAll(PDO::FETCH_ASSOC);

// foreach( $results as $value ){
// foreach($value as $data){
//     echo $data;
//     echo "<br>";
// }
//     echo "<br>";
// }

if (isset($_GET["page"]) && $_GET["page"] == "session") {
    $sql = "SELECT * FROM session";
    $requete = $bdd->query($sql);
    $resultsSession = $requete->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <div class="centerDiv">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date début</th>
                <th>Equipe pédagogique</th>
                <th>Session</th>
                <th>Centre</th>
                <th>modifier</th>
                <th>supprimer</th>
            </tr>
            <form method="POST">
                <h1>Ajout dans Session</h1>
                    <input type="text" name="nomSession" placeholder="nom de la Session">
                    <br>
                    <input type="text" name="dateDebutSession" placeholder="début de la Session">
                    <br>
                    <!-- <input type="text" name="idPedagogie" placeholder="idPedagogie">
                    <input type="text" name="idFormation" placeholder="idFormation"> -->
                        <select name="idSession" id="">
                            <!-- <option value="idrole">id - nom role</option> -->
                            <?php 
                                    $sql = "SELECT * FROM pedagogie";
                                    $requete = $bdd->query($sql);
                                    $resultsSessionPedagogie = $requete->fetchAll(PDO::FETCH_ASSOC);
                            foreach( $resultsSessionPedagogie as $value ){             
                                    echo '<option value="' . $value['id_pedagogie'] .  '">' . $value['id_pedagogie'] . ' - ' . $value['nom_pedagogie'] . '</option>'; 
                            }
                            ?>
                            </select>

                            <select name="idSession" id="">
                            <!-- <option value="idrole">id - nom role</option> -->
                            <?php 
                                    $sql = "SELECT * FROM formations";
                                    $requete = $bdd->query($sql);
                                    $resultsFormations = $requete->fetchAll(PDO::FETCH_ASSOC);
                            foreach( $resultsFormations as $value ){             
                                echo '<option value="' . $value['id_formation'] .  '">' . $value['id_formation'] . ' - ' . $value['nom_formation'] . '</option>';    
                            }
                            ?>
                        </select>

                        <select name="idSession" id="">
                            <!-- <option value="idrole">id - nom role</option> -->
                            <?php 
                                    $sql = "SELECT * FROM centres";
                                    $requete = $bdd->query($sql);
                                    $resultsCentres = $requete->fetchAll(PDO::FETCH_ASSOC);
                            foreach( $resultsCentres as $value ){             
                                    echo '<option value="' . $value['id_centre'] .  '">' . $value['id_centre'] . ' - ' . $value['ville_centre'] . '</option>'; 
                            }
                            ?>
                            </select>
                            <br>
                    <input type="submit" name="submitSession" value = "Ajouter">
            </form>
            <?php
            echo '<table border="1">';
            echo "<tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date de début</th>
                    <th>Equipe pédagogique</th>
                    <th>Formation</th>
                    <th>Centre</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    </tr>"; // Ajoutez les en-têtes appropriés
            foreach ($resultsSession as $item) {
                echo '<tr>';
                echo '<td>' . $item['id_session'] . '</td>';
                echo '<td>' . $item['nom_session'] . '</td>';
                echo '<td>' . $item['date_debut'] . '</td>';
                echo '<td>' . $item['id_pedagogie'] . '</td>';
                echo '<td>' . $item['id_formation'] . '</td>';
                echo '<td>' . $item['id_centre'] . '</td>';
                echo '<input type="hidden" name="hiddenSession" value="'. $item['id_session'] . '">';
                echo '<td><a href="?page=session&type=modifier&id=' . $item['id_session'] . '"><button>Modifier</button></a></td>';
                echo '<td><button>Supprimer</button></td>';
                echo '</tr>';
            }
            ?>
        </table>
        
    </div>
<?php


        if (isset($_GET['type']) && $_GET['type'] == "modifier"){

            $id = $_GET["id"];
            $sqlId = "SELECT * FROM session WHERE id_session = $id";
            $requeteId = $bdd->query($sqlId);
            $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
            ?>
            <form method="POST">
                <input type="hidden" name="updateIdSession" value="<?php  echo $resultsId['id_session']; ?>">
                <input type="text" name="updateNomSession" value="<?php  echo $resultsId['nom_session']; ?>">
                <input type="text" name="updateDateDebut" value="<?php  echo $resultsId['date_debut']; ?>">
                <input type="text" name="updateIdPedagogie" value="<?php  echo $resultsId['id_pedagogie']; ?>">
                <input type="text" name="updateIdFormation" value="<?php  echo $resultsId['id_formation']; ?>">
                <input type="text" name="updateIdCentre" value="<?php  echo $resultsId['id_centre']; ?>">
                <input type="submit" name="updateSession" value="updateSession">
            </form>
            <?php
            if (isset($_POST["updateSession"])){
                $updateIdSession = $_POST["updateIdSession"];
                $updateNomSession = $_POST["updateNomSession"];
                $updateDateDebut = $_POST["updateDateDebut"];
                $updateIdPedagogie = $_POST["updateIdPedagogie"];
                $updateIdFormation = $_POST["updateIdFormation"];
                $updateIdCentre = $_POST["updateIdCentre"];
                $sqlUpdate = "UPDATE `session` SET `nom_session`='$updateNomSession', `date_debut`='$updateDateDebut', `id_pedagogie`='$updateIdPedagogie', `id_formation`='$updateIdFormation', `id_centre`='$updateIdCentre' WHERE id_session = $updateIdSession";

                $bdd->query($sqlUpdate);
                echo "Données modifiées";
            }
        }
}

    if (isset($_POST['submitSession'])){
        $nomSession = $_POST['nomSession'];
        $dateDebutSession = $_POST['dateDebutSession'];
        $idPedagogie = $_POST['idSession'];
        $idFormation = $_POST['idSession'];
        $idCentre = $_POST['idSession'];

        $sql = "INSERT INTO `session`(`nom_session`, `date_debut`, `id_pedagogie`, `id_formation`, `id_centre`) VALUES ('$nomSession', '$dateDebutSession','$idPedagogie','$idFormation', '$idCentre')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";
    }

    // APPRENANT -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM apprenants";
// $requete = $bdd->query($sql);
// $results = $requete->fetchAll(PDO::FETCH_ASSOC);

// foreach( $results as $value ){
// foreach($value as $data){
//     echo $data;
//     echo "<br>";
// }
//     echo "<br>";
// }


if (isset($_GET["page"]) && $_GET["page"] == "apprenant") {
    $sql = "SELECT * FROM apprenants";
    $requete = $bdd->query($sql);
    $resultsApprenant = $requete->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <div class="centerDiv">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Code postal</th>
                <th>Téléphone</th>
                <th>Date de naissance</th>
                <th>Niveau</th>
                <th>Numéro PE</th>
                <th>Numéro SECU</th>
                <th>RIB</th>
                <th>modifier</th>
                <th>supprimer</th>
            </tr>
            <form method="POST">
                <label>Ajout dans Apprenant</label>
                <br>
                <input type="text" name="nomApprenant" placeholder="nom Apprenant">
                <br>
                <input type="text" name="prenomApprenant" placeholder="prénom Apprenant">
                <br>
                <input type="text" name="mailApprenant" placeholder="mail Apprenant">
                <br>
                <input type="text" name="adresseApprenant" placeholder="adresse Apprenant">
                <br>
                <input type="text" name="villeApprenant" placeholder="ville Apprenant">
                <br>
                <input type="text" name="codePostalApprenant" placeholder="code postal Apprenant">
                <br>
                <input type="text" name="telApprenant" placeholder="tel Apprenant">
                <br>
                <input type="text" name="dateNaissanceApprenant" placeholder="date de naissance Apprenant">
                <br>
                <input type="text" name="niveauApprenant" placeholder="niveau Apprenant">
                <br>
                <input type="text" name="numPeApprenant" placeholder="numéro PE Apprenant">
                <br>
                <input type="text" name="numSecuApprenant" placeholder="numéro sécu Apprenant">
                <br>
                <input type="text" name="ribApprenant" placeholder="RIB Apprenant">
                <br>
                <select name="idApprenant" id="">
                    <!-- <option value="idrole">id - nom role</option> -->
                    <?php 
                                    $sql = "SELECT * FROM role";
                                    $requete = $bdd->query($sql);
                                    $resultsRole = $requete->fetchAll(PDO::FETCH_ASSOC);
                                    foreach( $resultsRole as $value ){             
                                        echo '<option value="' . $value['id_role'] .  '">' . $value['id_role'] . ' - ' . $value['nom_role'] . '</option>'; 
                                    }
                                    ?>
                            </select>
                            
                            <select name="idApprenant" id="">
                                <!-- <option value="idrole">id - nom role</option> -->
                                <?php 
                                    $sql = "SELECT * FROM session";
                                    $requete = $bdd->query($sql);
                                    $resultsSession = $requete->fetchAll(PDO::FETCH_ASSOC);
                                    foreach( $resultsSession as $value ){             
                                        echo '<option value="' . $value['id_session'] .  '">' . $value['id_session'] . ' - ' . $value['nom_session'] . '</option>';    
                                    }
                                    ?>
                        </select>
                        <input type="submit" name="submitApprenant" value = "Ajouter">
                    </form>
                    <?php
            echo '<table border="1">';
            echo "<tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Code postal</th>
            <th>Téléphone</th>
            <th>Date de naissance</th>
            <th>Niveau</th>
            <th>Numéro de PE</th>
            <th>Numéro de SECU</th>
            <th>RIB</th>
            <th>Rôle</th>
            <th>Session</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            </tr>"; // Ajoutez les en-têtes appropriés
            foreach ($resultsApprenant as $item) {
                echo '<tr>';
                echo '<td>' . $item['id_apprenant'] . '</td>';
                echo '<td>' . $item['nom_apprenant'] . '</td>';
                echo '<td>' . $item['prenom_apprenant'] . '</td>';
                echo '<td>' . $item['mail_apprenant'] . '</td>';
                echo '<td>' . $item['adresse_apprenant'] . '</td>';
                echo '<td>' . $item['ville_apprenant'] . '</td>';
                echo '<td>' . $item['code_postal_apprenant'] . '</td>';
                echo '<td>' . $item['tel_apprenant'] . '</td>';
                echo '<td>' . $item['date_naissance_apprenant'] . '</td>';
                echo '<td>' . $item['niveau_apprenant'] . '</td>';
                echo '<td>' . $item['num_pe_apprenant'] . '</td>';
                echo '<td>' . $item['num_secu_apprenant'] . '</td>';
                echo '<td>' . $item['rib_apprenant'] . '</td>';
                echo '<td>' . $item['id_role'] . '</td>';
                echo '<td>' . $item['id_session'] . '</td>';
                echo '<input type="hidden" name="hiddenApprenant" value="'. $item['id_apprenant'] . '">';
                echo '<td><a href="?page=apprenant&type=modifier&id=' . $item['id_apprenant'] . '"><button>Modifier</button></a></td>';
                echo '<td><button>Supprimer</button></td>';
                echo '</tr>';
            }
            ?>
        </table>
        
    </div>
<?php


        if (isset($_GET['type']) && $_GET['type'] == "modifier"){

            $id = $_GET["id"];
            $sqlId = "SELECT * FROM apprenants WHERE id_apprenant = $id";
            $requeteId = $bdd->query($sqlId);
            $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
            ?>
            <form method="POST">
                <input type="hidden" name="updateIdApprenant" value="<?php  echo $resultsId['id_apprenant']; ?>">
                <input type="text" name="updateNomApprenant" value="<?php  echo $resultsId['nom_apprenant']; ?>">
                <input type="text" name="updatePrenomApprenant" value="<?php  echo $resultsId['prenom_apprenant']; ?>">
                <input type="text" name="updateMailApprenant" value="<?php  echo $resultsId['mail_apprenant']; ?>">
                <input type="text" name="updateAdresseApprenant" value="<?php  echo $resultsId['adresse_apprenant']; ?>">
                <input type="text" name="updateVilleApprenant" value="<?php  echo $resultsId['ville_apprenant']; ?>">
                <input type="text" name="updateCodePostalApprenant" value="<?php  echo $resultsId['code_postal_apprenant']; ?>">
                <input type="text" name="updateTelApprenant" value="<?php  echo $resultsId['tel_apprenant']; ?>">
                <input type="text" name="updateDateNaissanceApprenant" value="<?php  echo $resultsId['date_naissance_apprenant']; ?>">
                <input type="text" name="updateNiveauApprenant" value="<?php  echo $resultsId['niveau_apprenant']; ?>">
                <input type="text" name="updateNumPeApprenant" value="<?php  echo $resultsId['num_pe_apprenant']; ?>">
                <input type="text" name="updateNumSecuApprenant" value="<?php  echo $resultsId['num_secu_apprenant']; ?>">
                <input type="text" name="updateRibApprenant" value="<?php  echo $resultsId['rib_apprenant']; ?>">
                <input type="text" name="updateIdRole" value="<?php  echo $resultsId['id_role']; ?>">
                <input type="text" name="updateIdSession" value="<?php  echo $resultsId['id_session']; ?>">
                <input type="submit" name="updateApprenant" value="updateApprenant">
            </form>
            <?php
            if (isset($_POST["updateApprenant"])){
                $updateIdApprenant = $_POST["updateIdApprenant"];
                $updateNomApprenant = $_POST["updateNomApprenant"];
                $updatePrenomApprenant = $_POST["updatePrenomApprenant"];
                $updateMailApprenant = $_POST["updateMailApprenant"];
                $updateAdresseApprenant = $_POST["updateAdresseApprenant"];
                $updateVilleApprenant = $_POST["updateVilleApprenant"];
                $updateCodePostalApprenant = $_POST["updateCodePostalApprenant"];
                $updateTelApprenant = $_POST["updateTelApprenant"];
                $updateDateNaissanceApprenant = $_POST["updateDateNaissanceApprenant"];
                $updateNiveauApprenant = $_POST["updateNiveauApprenant"];
                $updateNumPeApprenant = $_POST["updateNumPeApprenant"];
                $updateNumSecuApprenant = $_POST["updateNumSecuApprenant"];
                $updateRibApprenant = $_POST["updateRibApprenant"];
                $updateIdRole = $_POST["updateIdRole"];
                $updateIdSession = $_POST["updateIdSession"];
                $sqlUpdate = "UPDATE `apprenants` SET `nom_apprenant`='$updateNomApprenant' WHERE id_apprenant = $updateIdApprenant";

                $bdd->query($sqlUpdate);
                echo "Données modifiées";
            }
        }
}