<!-- // ROLE -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM role";
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
                ?>