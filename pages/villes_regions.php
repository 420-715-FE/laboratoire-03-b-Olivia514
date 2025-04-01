<?php session_start(); ?>
<!DOCTYPE html>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Villes et régions</title>
    <link rel="stylesheet" href="../water.css">
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Villes et régions</h1>

    <?php 

    $villeCode = [
        'Montreal'=> 'Montreal',
        'Québec' => 'Québec',
        'Laval' => 'Laval',
        'Gatineau' => 'Outaouais',
        'Longueuil' => 'Montérégie',
        'Sherbrooke' => 'Estrie',
        'Magog' => 'Estrie',
        'Coaticook' => 'Estrie',
        'Trois-Rivières' => 'Mauricie',
        'Drummondville' => 'Centre-du-Québec'
    ];


    if (!isset($_POST["ville"])){
        ?>
        <form action = "/laboratoire-03-b-Olivia514/pages/villes_regions.php?" method = "post">
            <label for="ville">Entrez le nom d'une ville : </label><br>
            <input type = "text" name = "ville" id="ville">
            <button type="submit">Soumettre</button>
        </form>
        <?php       
    } 

    else{
        if (!array_key_exists($_POST["ville"], $villeCode)) {
            $_POST["ville"] = htmlspecialchars($_POST["ville"]);
            echo "<p>La région administrative correspondant à la ville de ", $_POST["ville"], " est inconnue.</p>";
        }
        else{
            $_POST["ville"] = htmlspecialchars($_POST["ville"]);
            echo "<p>La ville de ", $_POST["ville"], " est dans la region administrative de '", $villeCode[$_POST["ville"]],"'.</p>";
        }

        session_unset();

        ?>
        <a href="/laboratoire-03-b-Olivia514/pages/villes_regions.php?">Entrer une autre ville</a>
        <?php
    }
    
    ?>

</body>
</html>
