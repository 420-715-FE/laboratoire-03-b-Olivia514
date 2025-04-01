<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <link rel="stylesheet" href="../water.css">
    <style>
        h2{
            font-size: 40px;
        }
        .ticTacToe {
            border-collapse: collapse;
            width: auto;
        }

        .ticTacToe tr {
            background-color:rgba(254, 254, 254, 0.57) !important;
        }

        .ticTacToe td {
            border: 1px solid black;
            width: 75px;
            height: 75px;
            text-align: center;
            vertical-align: middle;
            color: black;
            font-size: 2em;
        }

        .ticTacToe a {
            color: darkblue;
        }
    </style>
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Tic Tac Toe</h1>

        <?php
            if (isset($_GET["deconnection"]) AND $_GET["deconnection"] == "oui"){
                session_unset();
            }

//définir c'est au tour à qui à jouer
if(!isset($_SESSION["tour"])){$_SESSION["tour"] = 'X'; $tour = 'X'; echo "c'est au tour au O à jouer";}
else if($_SESSION["tour"] == 'O'){$_SESSION["tour"] = 'X'; echo "c'est au tour au O à jouer";}
else{$_SESSION["tour"] = 'O'; echo "c'est au tour au X à jouer";}
$tour = $_SESSION["tour"];


$grille = [
            ["()", "()", "()"],
            ["()", "()", "()"],
            ["()", "()", "()"]
        ];

//grille à jour
$nbTour = 0;
for($i = 0; $i <= 2; $i++){
    for($j = 0; $j <= 2; $j++){
        if(!isset($_SESSION['case'.$i. $j])){$grille[$i][$j] = "()";}
        else{$grille[$i][$j] = $_SESSION['case'.$i. $j];$nbTour++;}
    }
}


//Ajouter la case qui vient de se faire jouer et vérifier si elle n'a pas déjà été jouée
function grille($tour, $grille, $nbTour){
    if(!isset($_GET['case'])){
        afficherGrille($grille);
    }
    else{
        $page = $_GET['case'];
        switch($page){
            case 'case00' : if(!isset($_SESSION['case00'])){$_SESSION['case00'] = $tour; $grille[0][0] = $tour;}; break;
            case 'case01' : if(!isset($_SESSION['case01'])){$_SESSION['case01'] = $tour; $grille[0][1] = $tour;}; break;
            case 'case02' : if(!isset($_SESSION['case02'])){$_SESSION['case02'] = $tour; $grille[0][2] = $tour;}; break;
            case 'case10' : if(!isset($_SESSION['case10'])){$_SESSION['case10'] = $tour; $grille[1][0] = $tour;}; break;
            case 'case11' : if(!isset($_SESSION['case11'])){$_SESSION['case11'] = $tour; $grille[1][1] = $tour;}; break;
            case 'case12' : if(!isset($_SESSION['case12'])){$_SESSION['case12'] = $tour; $grille[1][2] = $tour;}; break;
            case 'case20' : if(!isset($_SESSION['case20'])){$_SESSION['case20'] = $tour; $grille[2][0] = $tour;}; break;
            case 'case21' : if(!isset($_SESSION['case21'])){$_SESSION['case21'] = $tour; $grille[2][1] = $tour;}; break;
            case 'case22' : if(!isset($_SESSION['case22'])){$_SESSION['case22'] = $tour; $grille[2][2] = $tour;}; break;
            default : echo 'ERREUR' ; break;
        }


        //regarder s'il a un gagnant
        $gagnant = false;
        for($i = 0; $i <= 2; $i++){
            //gagnant vertical
            if(($grille[$i][0] == $grille[$i][1] AND $grille[$i][0] == $grille[$i][2]) AND isset($_SESSION['case'.$i. '0']) AND isset($_SESSION['case'.$i. '1']) AND isset($_SESSION['case'.$i. '2'])){echo '<h2>Les ' . $tour . ' gagnent</h2>'; $gagnant = true; break;}
            //gagnant horizaontal
            else if(($grille[0][$i] == $grille[1][$i] AND $grille[0][$i] == $grille[2][$i]) AND isset($_SESSION['case0'.$i]) AND isset($_SESSION['case1'. $i]) AND isset($_SESSION['case2'.$i])){echo '<h2>Les ' . $tour . ' gagnent</h2>'; $gagnant = true; break;}
        }
        //gangnant diago 1
        if($gagnant == true){}
        else if(($grille[0][0] == $grille[1][1] AND $grille[0][0] == $grille[2][2]) AND isset($_SESSION['case00']) AND isset($_SESSION['case11']) AND isset($_SESSION['case22'])){echo '<h2>Les ' . $tour . ' gagnent</h2>', '?><h2><?php';}
        //gangnant diago 2
        else if(($grille[0][2] == $grille[1][1] AND $grille[0][2] == $grille[2][0]) AND isset($_SESSION['case02']) AND isset($_SESSION['case11']) AND isset($_SESSION['case20'])){echo '<h2>Les ' . $tour . ' gagnent</h2>', '?><h2><?php';}
        //match null
        else if($nbTour >= 9){echo '<h2>Match null</h2>';}

        //changer le joueur
        if($_SESSION["tour"] == 'O'){$_SESSION["tour"] == 'X';}
        else{$_SESSION["tour"] == 'O';}
        
        $tour = $_SESSION["tour"];
        afficherGrille($grille);
    }
}

grille($_SESSION["tour"], $grille, $nbTour);


function afficherGrille($grille){
    ?>
    <table class="ticTacToe">
        <tr>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case00"><?php echo $grille[0][0] ?></a></td>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case01"><?php echo $grille[0][1] ?></a></td>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case02"><?php echo $grille[0][2] ?></a></td>
        </tr>
        <tr>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case10"><?php echo $grille[1][0] ?></a></td>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case11"><?php echo $grille[1][1] ?></a></td>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case12"><?php echo $grille[1][2] ?></a></td>
        </tr>
        <tr>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case20"><?php echo $grille[2][0] ?></a></td>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case21"><?php echo $grille[2][1] ?></a></td>
            <td><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?case=case22"><?php echo $grille[2][2] ?></a></td>
        </tr>
    </table>
    <?php
}








  
   ?><a href="/laboratoire-03-b-Olivia514/pages/tic_tac_toe.php?deconnection=oui">Réinitialiser</a>
</body>
</html>
