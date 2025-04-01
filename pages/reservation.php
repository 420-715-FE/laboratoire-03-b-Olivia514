<?php
  $provinces = [
    'AB' => 'Alberta',
    'BC' => 'Colombie-Britannique',
    'PE' => 'Île-du-Prince-Édouard',
    'MB' => 'Manitoba',
    'NB' => 'Nouveau-Brunswick',
    'QC' => 'Québec',
    'NS' => 'Nouvelle-Écosse',
    'NU' => 'Nunavut',
    'ON' => 'Ontario',
    'SK' => 'Saskatchewan',
    'NL' => 'Terre-Neuve-et-Labrador',
    'NT' => 'Territoires du Nord-Ouest',
    'YT' => 'Yukon'
  ];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <link rel="stylesheet" href="../water.css">
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>              
    <h1>Formulaire de réservation</h1>

   <?php
    $aujourdhui = time();
    $erreur = false;

    if(
        //Regarder si toutes les valeurs ont été mises
        isset($_POST["prenom"]) AND 
        isset($_POST["nom"]) AND 
        isset($_POST["adresse"]) AND 
        isset($_POST["ville"]) AND 
        isset($_POST["province"]) AND 
        isset($_POST["codePostal"]) AND 
        isset($_POST["telephone"]) AND 
        isset($_POST["courriel"]) AND 
        isset($_POST["typeChambre"]) AND 
        isset($_POST["adultes"]) AND 
        isset($_POST["enfants"]) AND 
        isset($_POST["dateArrivee"]) AND
        isset($_POST["nombreNuits"]) AND
        isset($_POST["submit"]) 
    ){
            //Enlever les menances possibles
            $prenom = strip_tags($_POST["prenom"]);
            $nom = strip_tags($_POST["nom"]);
            $adresse = strip_tags($_POST["adresse"]);
            $ville = strip_tags($_POST["ville"]);
            $province = strip_tags($_POST["province"]);
            $codePostal = strip_tags($_POST["codePostal"]);
            $telephone = strip_tags($_POST["telephone"]);
            $telephone = preg_replace('/[^0-9]/', '', $telephone);
            $courriel = strip_tags($_POST["courriel"]);
            $typeChambre = strip_tags($_POST["typeChambre"]);
            $submit = strip_tags($_POST["submit"]);

            //Définir le jour, date et mois de la réservation
            $dateArrivee = strip_tags($_POST["dateArrivee"]);
            $dateArrivee2 = strtotime($dateArrivee);
            $jour = date("d", $dateArrivee2);
            $mois = date("m", $dateArrivee2);
            $annee = date("Y", $dateArrivee2);
            
            if (
                //Validation des données
                strlen($prenom) <= 50 AND
                strlen($nom) <= 50 AND
                strlen($adresse) <= 50 AND
                strlen($ville) <= 50 AND
                array_key_exists($province, $provinces) == 1 AND 
                strlen($codePostal) == 6 AND 
                strlen($telephone) == 10 AND is_numeric($telephone) AND
                ($typeChambre == "1 lit double" OR $typeChambre == "2 lits doubles" OR $typeChambre == "1 lit Queen" OR $typeChambre == "2 lits Queen" OR $typeChambre == "1 lit King") AND 
                $adultes >= 1 AND $adultes <= 4 AND
                $enfants <= 4 AND $adultes + $enfants <= 5 AND
                //valider que la date de réservation soit aujourdhuit ou plus tard et quelle existe
                $dateArrivee2 && $dateArrivee2 >= $aujourdhui AND 
                checkdate($mois, $jour, $annee) AND
                //reserver avant l'annee 2100
                $annee <= 2100 AND 
                $nombreNuits >= 0 AND $nombreNuits <= 90
                ){
                    //affiche la confirmation de réservation
                    echo "<h1>Confirmation</h1> <br> 
                    Votre réservation a été effectuée avec succès. <br><br><br>
                    <b>Date d'arrivée : </b>", $dateArrivee, "<br><br>
                    <b>Nombre de nuits : </b>", $nombreNuits, "<br><br>
                    <b>Type de chambre : </b>", $typeChambre, "<br><br>
                    <b>Nombre d'adultes : </b>", $adultes, "<br><br>
                    <b>Nombre d'enfants : </b>", $enfants, "<br><br>";

                    ?><a href="/laboratoire-03-b-Olivia514/pages/reservation.php?">Faire une nouvelle réservation</a><?php
                    return;
                }
            else {
                //retourner le formulaire avec une mention d'erreur
                $erreur = true;
                functionAfficherFormulaire($erreur, $provinces);
                return;
            }  
        }
        else{
            //afficher le formulaire
            functionAfficherFormulaire($erreur, $provinces);
            return;
        }

        function functionAfficherFormulaire($erreur, $provinces){

            if($erreur == true){echo 'il a une erreur dans votre formulaure'; }

            ?>
            <form action="" method="POST">
            <fieldset class="groupe-champs-textes">
            <legend>Informations personnelles</legend>
        
            <label for="prenom-input">Prénom:</label>
            <input type="text" id="prenom-input" name="prenom" required />
    
            <label for="nom-input">Nom:</label>
            <input type="text" id="nom-input" name="nom" required />
        
            <label for="adresse-input">Adresse:</label>
            <input type="text" id="adresse-input" name="adresse" required />
        
            <label for="ville-input">Ville:</label>
            <input type="text" id="ville-input" name="ville" required />
        
            <label for="province-select">Province / Territoire:</label>
            <select id="province-select" name="province">
            <option value="">Sélectionner une province</option>
            <?php
                foreach ($provinces as $code => $nomProvince) {
                echo "<option value=\"$code\">$nomProvince</option>";
                }
            ?>
            </select>
    
            <label for="code-postal-input">Code postal:</label>
            <input type="text" id="code-postal-input" name="codePostal" required />
    
            <label for="telephone-input">Numéro de téléphone:</label>
            <input type="tel" id="telephone-input" name="telephone" placeholder="123-456-7890" required />
        
            <label for="courriel-input">Adresse courriel:</label>
            <input type="text" id="courriel-input" name="courriel" required />
                                                                                                    
            </fieldset>
            <fieldset>
            <legend>Type de chambre</legend>
            
            <input type="radio" id="type-chambre-1-input" name="typeChambre" value="1 lit double" required />
            <label for="type-chambre-1-input">1 lit double</label>
    
            <input type="radio" id="type-chambre-2-input" name="typeChambre" value="2 lits doubles" required />
            <label for="type-chambre-2-input">2 lits doubles</label>
    
            <input type="radio" id="type-chambre-3-input" name="typeChambre" value="1 lit Queen" required />
            <label for="type-chambre-3-input">1 lit Queen</label>
    
            <input type="radio" id="type-chambre-4-input" name="typeChambre" value="2 lits Queen" required />
            <label for="type-chambre-4-input">2 lits Queen</label>
            
            <input type="radio" id="type-chambre-5-input" name="typeChambre" value="1 lit King" required />
            <label for="type-chambre-5-input">1 lit King</label>            
            </fieldset>
            <fieldset class="groupe-champs-textes">
            <legend>Invités</legend>
    
            <label for="nombre-adultes-input">Nombre d'adultes: </label>
            <input type="number" id="nombre-adultes-input" name="adultes" value="0" />
    
            <label for="nombre-enfants-input">Nombre d'enfants: </label>
            <input type="number" id="nombre-enfants-input" name="enfants" value="0" />
            </fieldset>
            <fieldset class="groupe-champs-textes">
            <legend>Dates</legend>
    
            <label for="date-arrivee-input">Date d'arrivée (JJ/MM/AAAA): </label>
            <input type="text" id="date-arrivee-input" name="dateArrivee" required />
    
            <label for="nombre-nuits-input">Nombre de nuits: </label>
            <input type="number" id="nombre-nuits-input" name="nombreNuits" value="1" />
            </fieldset>          
    
            <fieldset class="groupe-reserver">
            <input type="submit" name="submit" value="Réserver" />
            </fieldset>
        </form>
        <?php
    }
?>
</body>
</html>
