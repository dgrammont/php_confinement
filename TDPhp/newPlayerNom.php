
<!DOCTYPE html>
<!--
deuxieme fichier de la  création  de perssonne 
-->
<html>
    <head>
        <title>Liste Personne</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="tableau.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form action="newPlayer.php" method="post">
            <input type="text" name="nom" placeholder="Donnez votre nom">
            <input type="text" name="prenom" placeholder="Donnez votre prenom">
            <?php
            require_once './fonction.php';
            $dateNew = $_POST['ddn'];
            echo '<input name="ddn" type="hidden" value="' . $dateNew . '"/>';
            echo $dateNew;
           
            ?>
            <input type="submit"/>
        </form>

    </body>
</html>