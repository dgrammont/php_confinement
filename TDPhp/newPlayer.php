<!DOCTYPE html>
<!--
troisieme  fichier de la  création  de perssonne 
-->
<html>
    <head>
        <title>Liste Personne</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="tableau.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form action="ListPersonne.php" method="post">
            <?php
            require_once './fonction.php';
            $nomNew = $_POST['nom'];
            $prenomNew = $_POST['prenom'];
            $dateNew = $_POST['ddn'];
            newPlayer($nomNew, $prenomNew, $dateNew);
            ?>
            <label>La création a bien été prise en compte </label>
            <input type="submit"/>
        </form>

    </body>
</html>

