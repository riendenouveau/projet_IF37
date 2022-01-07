
<?php
@session_start();
    //connexion a la DB
     require_once "includes/connect.php";

    //avant de déclarer le header je donne le titre qui sera utilisé dans header.php
   //$titre = "Accueil";

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>

<div class="contenu">

<?php
    @include_once "contenuContact.php";
?>

</div>


<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>