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

            <?php
            require_once './fonction.php';
            $dateNew = $_POST['ddn'];
            $nomChoisi = $_POST['adan'];          
            
            modifierDate($dateNew , $nomChoisi)
                  
            ?> 
            <input type="submit"/>
        </form>

    </body>
</html>