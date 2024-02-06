<!-- // CENTRE -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM centres";
// $requete = $bdd->query($sql);
// $results = $requete->fetchAll(PDO::FETCH_ASSOC);

// foreach( $results as $value ){
// foreach($value as $data){
//     echo $data;
//     echo "<br>";
// }
//     echo "<br>";
// } -->

<?php
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
                ?>