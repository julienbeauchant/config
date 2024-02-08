<!-- // PEDAGOGIE -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM pedagogie";
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
                <select name="idPedagogieRole" id="">
                    <?php
                    $sql = "SELECT * FROM role";
                    $requete = $bdd->query($sql);
                    $resultsRole = $requete->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($resultsRole as $value) {
                        echo '<option value="' . $value['id_role'] .  '">' . $value['id_role'] . ' - ' . $value['nom_role'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="submitPedagogie" value="Ajouter">
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
                echo '<input type="hidden" name="hiddenPedagogie" value="' . $item['id_pedagogie'] . '">';
                echo '<td><a href="?page=pedagogie&type=modifier&id=' . $item['id_pedagogie'] . '"><button>Modifier</button></a></td>';
                echo '<td><a href="?page=pedagogie&type=supprimer&id=' . $item['id_pedagogie'] . '"><button>Supprimer</button></>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <?php
    if (isset($_GET['type']) && $_GET['type'] == "modifier") {

        $id = $_GET["id"];
        $sqlId = "SELECT * FROM pedagogie WHERE id_pedagogie = $id";
        $requeteId = $bdd->query($sqlId);
        $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
    ?>
        <form method="POST">
            <input type="hidden" name="updateIdPedagogie" value="<?php echo $resultsId['id_pedagogie']; ?>">
            <input type="text" name="updateNomPedagogie" value="<?php echo $resultsId['nom_pedagogie']; ?>">
            <input type="text" name="updatePrenomPedagogie" value="<?php echo $resultsId['prenom_pedagogie']; ?>">
            <input type="text" name="updateMailPedagogie" value="<?php echo $resultsId['mail_pedagogie']; ?>">
            <input type="text" name="updateNumPedagogie" value="<?php echo $resultsId['num_pedagogie']; ?>">
            <input type="text" name="updateIdRole" value="<?php echo $resultsId['id_role']; ?>">
            <input type="submit" name="updatePedagogie" value="updatePedagogie">
        </form>
        <?php
        if (isset($_POST["updatePedagogie"])) {
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


    if (isset($_GET['type']) && $_GET['type'] == "supprimer") {

        $id = $_GET["id"];
        $sqlId = "SELECT * FROM pedagogie WHERE id_pedagogie = $id";
        $requeteId = $bdd->query($sqlId);
        $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
        ?>
        <form method="POST">
            <input type="hidden" name="deleteIdPedagogie" value="<?php echo $resultsId['id_pedagogie']; ?>">
            <input type="submit" name="deletePedagogie" value="deletePedagogie">
        </form>
<?php
        if (isset($_POST["deletePedagogie"])) {
            $deleteIdPedagogie = $_POST["deleteIdPedagogie"];
            // $updateNomRole = $_POST["updateNomRole"];
            $sqlDelete = "DELETE FROM `pedagogie` WHERE id_pedagogie = $deleteIdPedagogie";

            $bdd->query($sqlDelete);
            echo "Données modifiées";
        }
    }

    if (isset($_POST['submitPedagogie'])) {

        $sql = "INSERT INTO `pedagogie`(`nom_pedagogie`, `prenom_pedagogie`, `mail_pedagogie`, `num_pedagogie`, `id_role`) VALUES (:nomPedagogie, :prenomPedagogie,:mailPedagogie, :numPedagogie, :idRole)";

        $requete = $bdd->prepare($sql);

        $nomPedagogie = $_POST['nomPedagogie'];
        $prenomPedagogie = $_POST['prenomPedagogie'];
        $mailPedagogie = $_POST['mailPedagogie'];
        $numPedagogie = $_POST['numPedagogie'];
        $idRole = $_POST['idPedagogieRole'];


        $requete->bindParam(':nomPedagogie', $nomPedagogie);
        $requete->bindParam(':prenomPedagogie', $prenomPedagogie);
        $requete->bindParam(':mailPedagogie', $mailPedagogie);
        $requete->bindParam(':numPedagogie', $numPedagogie);
        $requete->bindParam(':idRole', $idRole);

        $requete->execute();

        echo "les data ajoutée dans la bdd";
    }
}
?>