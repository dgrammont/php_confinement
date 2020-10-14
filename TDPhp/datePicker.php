<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>date Picker</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/libs/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="js/libs/datepicker/datepicker.min.js" type="text/javascript"></script>
        <script src="js/libs/datepicker/i18n/datepicker.fr-FR.min.js" type="text/javascript"></script>
        <link href="js/libs/datepicker/datepicker.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/formpicker.js" type="text/javascript"></script>
    </head>
    <body>
        <div>
            <form action="modifDate.php" method="post">
                <label for="ddn">Nouvelle date de naissance : </label>
                <input type="text" id="ddn" name="ddn" readonly="readonly" />
                <?php
                require_once './fonction.php';
                $nomChoisi = $_POST['nomP'];
                echo '<input name="adan" type="hidden" value="' . $nomChoisi . '"/>';
                    
                ?>
                <input type="submit"/>
            </form>
        </div>
    </body>
</html>