<?php

define("SERVEURBD", "195.221.61.190");
define("LOGIN", "snir");
define("MOTDEPASSE", "snir");
define("NOMDELABASE", "france2015");

function connexionBdd() {
    try {
        $pdo0ptions = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO('mysql:host=' . SERVEURBD . ';dbname=' . NOMDELABASE, LOGIN, MOTDEPASSE, $pdo0ptions);
        $bdd->exec("set names utf8");
        return $bdd;
    } catch (PDOException $ex) {
        print"Erreur : " . $ex->getMessage() . "</br>";
        die();
    }
}

function getNomDepartementFromVille($ville){
    try {
        $bdd= connexionBdd();
        $requete=$bdd->prepare("select departement_nom from villes, departements where departements.departement_id=villes.ville_departement_id and ville_nom like :laville ;");
        $requete->bindParam(":laville",$ville);
        $requete->execute() or die (print_r($requete->errorInfo()));

        $nbLigne=$requete->rowCount();
        if($nbLigne==0){
            $nomDep="pas de departement correspondant";
        }
        if ($nbLigne==1){
            $nomDep=$requete->fetchColumn(0);
        }
        if($nbLigne>1){
            $nomDep="";
            while ($ligne=$requete->fetch()){
                $nomDep=$nomDep."<br/>".$ligne['departement_nom'];
            }
        }
        $requete->closeCursor();
        return $nomDep;
    } catch (PDOException $ex) {
        print"Erreur : " . $ex->getMessage() . "</br>";
        die();
    }
}
