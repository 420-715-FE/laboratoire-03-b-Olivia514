<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page secrète</title>
    <link rel="stylesheet" href="../water.css">
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Page secrète</h1>

    <?php 
    $utilisateurMdp = [
        'jaja72'=> 'lapin',
        'petitefleur145' => 'chat',
        'bob' => 'poisson'
    ];

    $nomreel = [
        "jaja72"=> "Jacynthe Laplante",
        "petitefleur145" => "Rose Lafleur",
        "bob" => "Bob L'/ponge"
    ];

    if (isset($_GET["deconnection"]) AND $_GET["deconnection"] == "oui"){
        session_unset();
    }
    

    if (!isset($_POST["nom"]) AND !isset($_SESSION["mdp"])){
        ?>
        <form action = "/laboratoire-03-b-Olivia514/pages/page_secrete.php" method = "post">
            <label for="nom">Nom d'utilisateur : </label><br>
            <input type = "text" name = "nom" id="nom"><br>
            <label for="mdp">Mot de passe : </label><br>
            <input type = "password" name = "mdp" id="mdp">
            <button type="submit">Envoyer</button>
        </form>
        <?php       
    } 

    else if(isset($_SESSION["nom"]) AND array_key_exists($_SESSION["nom"], $utilisateurMdp)){
        $nom = $nomreel[$_SESSION["nom"]]; 
        echo "<p>Bonjour <b>", $nom, "</b> ! Bienvenue sur la page secrète !</p>";                 
        ?>
        <a href="/laboratoire-03-b-Olivia514/pages/page_secrete.php?deconnection=oui">Se déconnecter</a>
        <?php
    }

    else if(array_key_exists($_POST["nom"], $utilisateurMdp)){
            if($utilisateurMdp[$_POST["nom"]] == $_POST["mdp"]){
                $_SESSION["nom"] = $_POST["nom"]; 
                $_SESSION["mdp"] = $_POST["mdp"]; 
                $nom = $nomreel[$_POST["nom"]];        
                echo "<p>Bonjour <b>", $nom, "</b> ! Bienvenue sur la page secrète !</p>";                
                ?><a href="/laboratoire-03-b-Olivia514/pages/page_secrete.php?deconnection=oui">Se déconnecter</a><?php
            }
            else{
                ?>
                <form action = "/laboratoire-03-b-Olivia514/pages/page_secrete.php" method = "post">
                    <label for="nom">Nom d'utilisateur : </label><br>
                    <input type = "text" name = "nom" id="nom"><br>
                    <label for="mdp">Mot de passe : </label><br>
                    <input type = "password" name = "mdp" id="mdp">
                    <button type="submit">Envoyer</button>
                </form><?php
             echo "<p>Mot de passe ou nom d'utilisateur incorrect.</p>";
            }
    }    
        
    else{
        ?>
        <form action = "/laboratoire-03-b-Olivia514/pages/page_secrete.php" method = "post">
            <label for="nom">Nom d'utilisateur : </label><br>
            <input type = "text" name = "nom" id="nom"><br>
            <label for="mdp">Mot de passe : </label><br>
            <input type = "password" name = "mdp" id="mdp">
            <button type="submit">Envoyer</button>
        </form>
        <?php
        echo "<p>Mot de passe ou nom d'utilisateur incorrect.</p>";
    }
    ?>
</body>
</html>
