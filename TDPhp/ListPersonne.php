<!DOCTYPE html>
<html>
    <head>
        <title>Liste Personne</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="tableau.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form action="datePicker.php" method="post">
            <select name="nomP" id="nomP" >
                <?php
                require_once './fonction.php';
                genererListePersonne();       
                
                ?> 
            </select>
            <input type="submit"/>
        </form>

    </body>
</html>