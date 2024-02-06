<!-- // APPRENANT -------------------------------------------------------------------------------------- 

// $sql = "SELECT * FROM apprenants";
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
                    foreach ($resultsRole as $value) {
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
                    foreach ($resultsSession as $value) {
                        echo '<option value="' . $value['id_session'] .  '">' . $value['id_session'] . ' - ' . $value['nom_session'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="submitApprenant" value="Ajouter">
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
                echo '<td>' . $item['num_PE_apprenant'] . '</td>';
                echo '<td>' . $item['num_secu_apprenant'] . '</td>';
                echo '<td>' . $item['rib_apprenant'] . '</td>';
                echo '<td>' . $item['id_role'] . '</td>';
                echo '<td>' . $item['id_session'] . '</td>';
                echo '<input type="hidden" name="hiddenApprenant" value="' . $item['id_apprenant'] . '">';
                echo '<td><a href="?page=apprenant&type=modifier&id=' . $item['id_apprenant'] . '"><button>Modifier</button></a></td>';
                echo '<td><a href="?page=apprenant&type=supprimer&id=' . $item['id_apprenant'] . '"><button>Supprimer</button></>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <?php
    if (isset($_GET['type']) && $_GET['type'] == "modifier") {

        $id = $_GET["id"];
        $sqlId = "SELECT * FROM apprenants WHERE id_apprenant = $id";
        $requeteId = $bdd->query($sqlId);
        $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
    ?>
        <form method="POST">
            <input type="hidden" name="updateIdApprenant" value="<?php echo $resultsId['id_apprenant']; ?>">
            <input type="text" name="updateNomApprenant" value="<?php echo $resultsId['nom_apprenant']; ?>">
            <input type="text" name="updatePrenomApprenant" value="<?php echo $resultsId['prenom_apprenant']; ?>">
            <input type="text" name="updateMailApprenant" value="<?php echo $resultsId['mail_apprenant']; ?>">
            <input type="text" name="updateAdresseApprenant" value="<?php echo $resultsId['adresse_apprenant']; ?>">
            <input type="text" name="updateVilleApprenant" value="<?php echo $resultsId['ville_apprenant']; ?>">
            <input type="text" name="updateCodePostalApprenant" value="<?php echo $resultsId['code_postal_apprenant']; ?>">
            <input type="text" name="updateTelApprenant" value="<?php echo $resultsId['tel_apprenant']; ?>">
            <input type="text" name="updateDateNaissanceApprenant" value="<?php echo $resultsId['date_naissance_apprenant']; ?>">
            <input type="text" name="updateNiveauApprenant" value="<?php echo $resultsId['niveau_apprenant']; ?>">
            <input type="text" name="updateNumPeApprenant" value="<?php echo $resultsId['num_pe_apprenant']; ?>">
            <input type="text" name="updateNumSecuApprenant" value="<?php echo $resultsId['num_secu_apprenant']; ?>">
            <input type="text" name="updateRibApprenant" value="<?php echo $resultsId['rib_apprenant']; ?>">
            <input type="text" name="updateIdRole" value="<?php echo $resultsId['id_role']; ?>">
            <input type="text" name="updateIdSession" value="<?php echo $resultsId['id_session']; ?>">
            <input type="submit" name="updateApprenant" value="updateApprenant">
        </form>
        <?php
        if (isset($_POST["updateApprenant"])) {
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

    if (isset($_GET['type']) && $_GET['type'] == "supprimer") {

        $id = $_GET["id"];
        $sqlId = "SELECT * FROM apprenants WHERE id_apprenant = $id";
        $requeteId = $bdd->query($sqlId);
        $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
        ?>
        <form method="POST">
            <input type="hidden" name="deleteIdApprenant" value="<?php echo $resultsId['id_apprenant']; ?>">
            <input type="submit" name="deleteApprenant" value="deleteApprenant">
        </form>
<?php
        if (isset($_POST["deleteApprenant"])) {
            $deleteIdApprenant = $_POST["deleteIdApprenant"];
            // $updateNomRole = $_POST["updateNomRole"];
            $sqlDelete = "DELETE FROM `apprenants` WHERE id_apprenant = $deleteIdApprenant";

            $bdd->query($sqlDelete);
            echo "Données modifiées";
        }
    }

    if (isset($_POST['submitApprenant'])) {
        $nomApprenant = $_POST['nomApprenant'];
        $prenomApprenant = $_POST['prenomApprenant'];
        $mailApprenant = $_POST['mailApprenant'];
        $adresseApprenant = $_POST['adresseApprenant'];
        $villeApprenant = $_POST['villeApprenant'];
        $codePostalApprenant = $_POST['codePostalApprenant'];
        $telApprenant = $_POST['telApprenant'];
        $dateNaissanceApprenant = $_POST['dateNaissanceApprenant'];
        $niveauApprenant = $_POST['niveauApprenant'];
        $numPeApprenant = $_POST['numPeApprenant'];
        $numSecuApprenant = $_POST['numSecuApprenant'];
        $ribApprenant = $_POST['ribApprenant'];
        $idRole = $_POST['idApprenant'];
        $idSession = $_POST['idApprenant'];

        $sql = "INSERT INTO `apprenants`(`nom_apprenant`, `prenom_apprenant`, `mail_apprenant`, `adresse_apprenant`, `ville_apprenant`, `code_postal_apprenant`, `tel_apprenant`, `date_naissance_apprenant`, `niveau_apprenant`, `num_PE_apprenant`, `num_secu_apprenant`, `rib_apprenant`, `id_role`, `id_session`) VALUES ('$nomApprenant', '$prenomApprenant','$mailApprenant','$adresseApprenant', '$villeApprenant', '$codePostalApprenant', '$telApprenant', '$dateNaissanceApprenant', '$niveauApprenant', '$numPeApprenant', '$numSecuApprenant', '$ribApprenant', '$idRole', '$idSession')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";
    }
}
?>