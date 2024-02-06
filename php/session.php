<!-- // SESSION -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM session";
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
                    foreach ($resultsSessionPedagogie as $value) {
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
                    foreach ($resultsFormations as $value) {
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
                    foreach ($resultsCentres as $value) {
                        echo '<option value="' . $value['id_centre'] .  '">' . $value['id_centre'] . ' - ' . $value['ville_centre'] . '</option>';
                    }
                    ?>
                </select>
                <br>
                <input type="submit" name="submitSession" value="Ajouter">
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
                echo '<input type="hidden" name="hiddenSession" value="' . $item['id_session'] . '">';
                echo '<td><a href="?page=session&type=modifier&id=' . $item['id_session'] . '"><button>Modifier</button></a></td>';
                echo '<td><a href="?page=session&type=supprimer&id=' . $item['id_session'] . '"><button>Supprimer</button></>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <?php
    if (isset($_GET['type']) && $_GET['type'] == "modifier") {

        $id = $_GET["id"];
        $sqlId = "SELECT * FROM session WHERE id_session = $id";
        $requeteId = $bdd->query($sqlId);
        $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
    ?>
        <form method="POST">
            <input type="hidden" name="updateIdSession" value="<?php echo $resultsId['id_session']; ?>">
            <input type="text" name="updateNomSession" value="<?php echo $resultsId['nom_session']; ?>">
            <input type="text" name="updateDateDebut" value="<?php echo $resultsId['date_debut']; ?>">
            <input type="text" name="updateIdPedagogie" value="<?php echo $resultsId['id_pedagogie']; ?>">
            <input type="text" name="updateIdFormation" value="<?php echo $resultsId['id_formation']; ?>">
            <input type="text" name="updateIdCentre" value="<?php echo $resultsId['id_centre']; ?>">
            <input type="submit" name="updateSession" value="updateSession">
        </form>
        <?php
        if (isset($_POST["updateSession"])) {
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


    if (isset($_GET['type']) && $_GET['type'] == "supprimer") {

        $id = $_GET["id"];
        $sqlId = "SELECT * FROM session WHERE id_session = $id";
        $requeteId = $bdd->query($sqlId);
        $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
        ?>
        <form method="POST">
            <input type="hidden" name="deleteIdSession" value="<?php echo $resultsId['id_session']; ?>">
            <input type="submit" name="deleteSession" value="deleteSession">
        </form>
<?php
        if (isset($_POST["deleteSession"])) {
            $deleteIdSession = $_POST["deleteIdSession"];
            // $updateNomRole = $_POST["updateNomRole"];
            $sqlDelete = "DELETE FROM `session` WHERE id_session = $deleteIdSession";

            $bdd->query($sqlDelete);
            echo "Données modifiées";
        }
    }

    if (isset($_POST['submitSession'])) {
        $nomSession = $_POST['nomSession'];
        $dateDebutSession = $_POST['dateDebutSession'];
        $idPedagogie = $_POST['idSession'];
        $idFormation = $_POST['idSession'];
        $idCentre = $_POST['idSession'];

        $sql = "INSERT INTO `session`(`nom_session`, `date_debut`, `id_pedagogie`, `id_formation`, `id_centre`) VALUES ('$nomSession', '$dateDebutSession','$idPedagogie','$idFormation', '$idCentre')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";
    }
}
?>