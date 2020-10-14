<?php

define("SERVEURBD", "195.221.61.190");
define("LOGIN", "snir");
define("MOTDEPASSE", "snir");
define("NOMDELABASE", "france2015");

function connexionBdd() {
    try {
        $pdoOptions = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO('mysql:host=' . SERVEURBD . ';dbname=' . NOMDELABASE, LOGIN, MOTDEPASSE, $pdoOptions);
        $bdd->exec("set names utf8");
        return $bdd;
    } catch (PDOException $ex) {
        print "Erreur!: " . $ex->getMessage() . "<br/>";
        die();
    }
}

function afficherPersonne() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("select nom, prenom, dateNaissance, ville_nom, "
                . "ville_code_postal, departement_nom, "
                . "region_nom from utilisateurs, villes, "
                . "departements, regions where utilisateurs.ville_id = villes.ville_id and "
                . "villes.ville_departement_id = departements.departement_id "
                . "and departements.departement_region_id = regions.regions_id");
        $requete->execute() or die(print_r($requete->errorInfo()));
        echo '<table>';
        echo"<th>";
        echo 'nom';
        echo"</th>";
        echo"<th>";
        echo 'prenom';
        echo"</th>";
        echo"<th>";
        echo 'Date de naissance';
        echo"</th>";
        echo"<th>";
        echo 'ville';
        echo"</th>";
        echo"<th>";
        echo 'code postal';
        echo"</th>";
        echo"<th>";
        echo 'nom du Département';
        echo"</th>";
        echo"<th>";
        echo 'nom de la region';
        echo"</th>";

        while ($ligne = $requete->fetch()) {
            echo "<tr>";
            echo "<td>";
            echo $ligne['nom'];
            echo "</td>";
            echo "<td>";
            echo $ligne['prenom'];
            echo "</td>";
            echo "<td>";
            echo $ligne['dateNaissance'];
            echo "</td>";
            echo "<td>";
            echo $ligne['ville_nom'];
            echo "</td>";
            echo "<td>";
            echo $ligne['ville_code_postal'];
            echo "</td>";
            echo "<td>";
            echo $ligne['departement_nom'];
            echo "</td>";
            echo "<td>";
            echo $ligne['region_nom'];
            echo "</td>";
            echo "</tr>";
        }
        $requete->closeCursor();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function afficherTous() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select   nom , prenom ,dateNaissance from utilisateurs ")
                or die(print_r($requete->errorInfo()));

        $nbLigne = $requete->rowCount();


        echo "<table>";
        echo"<th>";
        echo 'nom';
        echo"</th>";
        echo"<th>";
        echo 'prenom';
        echo"</th>";
        echo"<th>";
        echo 'Date de naissance';
        echo"</th>";

        while ($ligne = $requete->fetch()) {
            echo "<tr>";
            echo "<td>";
            echo $ligne['nom'];
            echo "</td>";
            echo "<td>";
            echo $ligne['prenom'];
            echo "</td>";
            echo "<td>";
            echo $ligne['dateNaissance'];
            echo "</td>";

            echo "</tr>";
        }

        $requete = $bdd->query("select   ville_nom ,ville_code_postal ,departement_nom ,region_nom from regions , departements , villes where regions.regions_id=departements.departement_region_id and departements.departement_region_id=villes.ville_departement_id order by ville_nom; ")
                or die(print_r($requete->errorInfo()));

        $nbLigne = $requete->rowCount();



        echo"<th>";
        echo 'ville';
        echo"</th>";
        echo"<th>";
        echo 'code postal';
        echo"</th>";
        echo"<th>";
        echo 'nom du Département';
        echo"</th>";
        echo"<th>";
        echo 'nom de la region';
        echo"</th>";


        while ($ligne = $requete->fetch()) {
            echo "<tr>";
            echo "<td>";
            echo $ligne['ville_nom'];
            echo "</td>";
            echo "<td>";
            echo $ligne['ville_code_postal'];
            echo "</td>";
            echo "<td>";
            echo $ligne['departement_nom'];
            echo "</td>";
            echo "<td>";
            echo $ligne['region_nom'];
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $ex) {
        print "Erreur!: " . $ex->getMessage() . "<br/>";
        die();
    }
}

function afficherVillesFromCp($codePostal) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("select ville_nom from villes where ville_code_postal like :CP ");
        $requete->bindParam(":CP", $codePostal);
        $requete->execute() or die(print_r($requete->errorInfo()));

        while ($ligne = $requete->fetch()) {
            echo $ligne['ville_nom'];
            echo '<br/>';
        }

        $requete->closeCursor();
    } catch (PDOException $ex) {
        print "Erreur!: " . $ex->getMessage() . "<br/>";
        die();
    }
}

function afficherCompteVillesFromCp($codePostal) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("select ville_nom from villes where ville_code_postal like :CP ");
        $requete->bindParam(":CP", $codePostal);
        $requete->execute() or die(print_r($requete->errorInfo()));


        $nbLigne = $requete->rowCount();
        if ($nbLigne == 0) {
            echo"Il n'y pas de ville ";
        }
        if ($nbLigne == 1) {
            echo"Il y que une ville ";
        }
        if ($nbLigne > 1) {
            echo 'Il y a :' . $nbLigne . ' villes';
        }

        $requete->closeCursor();
    } catch (PDOException $ex) {
        print "Erreur!: " . $ex->getMessage() . "<br/>";
        die();
    }
}

function afficherPopulationParDepartement() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select departement_nom,count(ville_id) from villes ,departements where departements.departement_id=villes.ville_departement_id group by departement_nom ")
                or die(print_r($requete->errorInfo()));

        while ($ligne = $requete->fetch()) {
            echo'Le departement : ' . $ligne['departement_nom'] . ' contient : ' . $ligne['count(ville_id)'] . ' de villes';
            echo '<br/>';
        }
        $requete->closeCursor();
    } catch (PDOException $ex) {
        print "Erreur!: " . $ex->getMessage() . "<br/>";
        die();
    }
}

function afficherNomDate() {
    try {
        $bdd = connexionBdd();
        $bdd->query("SET lc_time_names = 'fr_FR';");
        $requete = $bdd->query("SELECT DATE_FORMAT(dateNaissance, '%W %D %M %Y'),nom from utilisateurs  ")
                or die(print_r($requete->errorInfo()));

        while ($ligne = $requete->fetch()) {
            echo"L'utilisateur : " . $ligne['nom'] . " est né le : " . $ligne["DATE_FORMAT(dateNaissance, '%W %D %M %Y')"];
            echo '<br/>';
        }
        $requete->closeCursor();
    } catch (PDOException $ex) {
        print "Erreur!: " . $ex->getMessage() . "<br/>";
        die();
    }
}

function genererListePersonne() {
    try {
        $bdd = connexionBdd();
        $bdd->query("SET lc_time_names = 'fr_FR';");
        $requete = $bdd->prepare("select utilisateur_id,prenom , nom ,DATE_FORMAT(dateNaissance, '%W %D %M %Y') from utilisateurs ");
        $requete->execute() or die(print_r($requete->errorInfo()));

        while ($ligne = $requete->fetch()) {
            echo '<option value="' . $ligne['utilisateur_id'] . '" >' . $ligne['prenom'] . '&nbsp;' . $ligne['nom'] . '&nbsp;' . $ligne["DATE_FORMAT(dateNaissance, '%W %D %M %Y')"] . '</option>';
        }

        $requete->closeCursor();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function modifierDate($dateNew, $idUse) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("update utilisateurs set dateNaissance = STR_TO_DATE(:date, '%d/%m/%Y') where utilisateur_id like :id ");
        $requete->bindParam(":date", $dateNew);
        $requete->bindParam(":id", $idUse);
        $requete->execute() or die(print_r($requete->errorInfo()));

        echo $requete;
        $requete->closeCursor();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function newPlayer($nom, $prenom, $date) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("insert into utilisateurs(nom, prenom, dateNaissance) values(:nom, :prenom, str_to_date( :date, '%d/%m/%Y'))");
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':date', $date);
        $requete->execute() or die(print_r($requete->errorInfo()));
        $requete->closeCursor();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
