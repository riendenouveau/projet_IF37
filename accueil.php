


<?php
session_start();
    //connexion a la DB
     require_once "includes/connect.php";

    //avant de déclarer le header je donne le titre qui sera utilisé dans header.php
    $titre = "Accueil";

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>

<div class="accueil">
<img src="image/imageAccueil.png" alt="" >
</div>


<style>
    .accueil{
        margin-top : 80px;
    }

    .accueil img {
        height : auto;
        max-width : 100%;
    }
</style>


<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>
