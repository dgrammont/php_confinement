<html>
    <head>
        <title>Formulaire ville -> département</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="tableau.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require_once './fonction.php';
        $codePostal=$_POST['Cp'];
        afficherVillesFromCp($codePostal);
        afficherCompteVillesFromCp($codePostal);
        
        ?>

    </body>
</html>