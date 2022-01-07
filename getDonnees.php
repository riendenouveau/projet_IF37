<?php

function getDonnees(){
    //connexion a la DB
 @require "includes/connect.php";

 $sql = "SELECT * FROM `etablissements`";
 $query = $db->prepare($sql);
 $query->execute();

 while($row = $query->fetch(PDO::FETCH_ASSOC)){
     extract($row);

     $etablissement = [
         "id" => $id,
         "nomE"=> $nomE,
         "adresse"=> $adresse,
         "codepostal"=> $codepostal,
         "ville"=> $ville,
         "lat" => $lat,
         "lon"=> $lon,
         "noteMoyenne" => $noteMoyenne
     ];

     $tableauEtablissements['etablissement'][] = $etablissement;
 }

    return $tableauEtablissements;
}

function getImages($input){
    @require "includes/connect.php";
    $sql = "SELECT * FROM `imagesetablissements` WHERE `etablissement`='$input'";
    $query = $db->prepare($sql);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $image = [
            "nom" => $nom,
            "etablissement" => $etablissement
        ];

        $tableauImages['images'][] = $image;
    }

    return $tableauImages;

}


function getAmenagements($input){
    @require "includes/connect.php";
    $sql = "SELECT * FROM `amenagements` WHERE `etablissement`='$input' LIMIT 1";
    $query = $db->prepare($sql);
    $query->execute();

    $amenagements = $query->fetch();
    //On vérifie chacun des aménagements et on les affiches
    if($amenagements['rampe']=='1'){
       echo('<li>rampe d\'accès pour personne en situation de handicap');
    }
    if($amenagements['parking']=='1'){
        echo('<li>place(s) de parking pour personne en situation de handicap</li>');
    }
    if($amenagements['toilettes']=='1'){
        echo('<li>toilette handicapé</li>');
    }
    if($amenagements['ascenseur']=='1'){
        echo('<li>ascenseur</li>');
    }
    if($amenagements['douche']=='1'){
        echo('<li>douche handicapé</li>');
    }
    if($amenagements['lavabo']=='1'){
        echo('<li>lavabo suspendu</li>');
    }
    if($amenagements['comptoir']=='1'){
        echo('<li>comptoir accessible aux fauteils roulants</li>');
    }
}

function getAccessibilite($input){
    @require "includes/connect.php";
    $sql = "SELECT * FROM `accessibilite` WHERE `etablissement`='$input'";
    $query = $db->prepare($sql);
    $query->execute();

    $accessibilite = $query->fetch();
    echo ('<p>Accessibilité aux personnes en fauteil roulant : ');
    echo(printStars($accessibilite['fauteuil']) . "<br/></p>");
    echo ('<p>Accessibilité aux personnes à handicap visuel : ');
    echo(printStars($accessibilite['visuel']) . "<br/></p>");
    echo ('<p>Accessibilité aux personnes à handicap moteur : ');
    echo(printStars($accessibilite['moteur']) . "<br/></p>");
}

function printStars($input){
    echo('<span class="blueStar">');
    for($i=0; $i<$input; $i++){
        echo('&#9733;');
    }
    echo('</span>');
    echo('<span class="otherStar" style="">');
    for($i=0; $i<(5-$input); $i++){
        echo('&#9733;');
    }
    echo('</span>');
}

function getAvis($input){
    @require "includes/connect.php";
    $sql = "SELECT * FROM `avisetablissement` WHERE `etablissement`='$input'";
    $query = $db->prepare($sql);
    $query->execute();
    $listeAvis = $query->fetchAll();
    foreach($listeAvis as $avis){
        $idU = $avis['user'];
        $titre = $avis['titre'];
        $note = $avis['note'];
        $commentaire = $avis['commentaire'];
        $date = $avis['date'];

        //On récupère le nom de l'utilisateur
        $sql = "SELECT `username` FROM `users` WHERE `id`='$idU'";
        $query = $db->prepare($sql);
        $query->execute();
        $username = $query->fetch()['username'];
        echo ('<section class="avis">');
        echo('<div class = "avisheader">');
        echo('<div class="titreNote">');
        echo('<h4>' . $titre . '</h4>');
        printStars($note);
        echo ('</div>');
        echo('<div class="infoAvis">');
        echo ('<p class="date" style="color : rgb(125,125,125);">' . $date . '</p>');
        echo ('<h5 class="username">' . $username .'</h5>');
        echo ('</div>');
        echo ('</div>');
        echo('<p>' . $commentaire . '</p>');
        echo ('</section>');
    }
}


function printMoyenne($moyenne, $idE){
    //On récupère le nombre d'avis
    @require "includes/connect.php";
    $sql = "SELECT COUNT(*) as nombreAvis FROM `avisetablissement` WHERE `etablissement`='$idE'";
    $query = $db->prepare($sql);
    $query->execute();
    $nombreAvis = $query->fetch()['nombreAvis'];
    if($nombreAvis>0){
        echo('<div class="moyenne">');
        printStars($moyenne);
        echo(' (' . $nombreAvis . ' avis)');
        echo('</div>');
    }

}

function printCategorie($input){
    @require "includes/connect.php";
    $sql = "SELECT `categorie` FROM `estun` WHERE `etablissement`='$input'";
    $query = $db->prepare($sql);
    $query->execute();
    $categories = $query->fetchAll();
    echo ('<p>');
    foreach($categories as $key => $categorie){
        if($key>0){
            echo(', ');
        }
        echo($categorie['categorie']);
    }
}


?>

