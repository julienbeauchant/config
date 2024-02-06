<!-- // FORMATION -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM formations";
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
            ?>