<?php

$pages = [
    'Villes et régions' => 'pages/villes_regions.php',
    'Page secrète' => 'pages/page_secrete.php',
    'Formulaire de réservation' => 'pages/reservation.php',
    'Tic Tac Toe' => 'pages/tic_tac_toe.php',
];

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratoire 03-B</title>
    <link rel="stylesheet" href="water.css">
</head>
<body>
    <h1>Laboratoire 03-B</h1>
    <nav>
        <ul>
            <?php
            foreach ($pages as $titre => $url) {
                echo "<li><a href='{$url}'>{$titre}</a></li>";
            }
            ?>
        </ul>
    </nav>
</body>
</html>
