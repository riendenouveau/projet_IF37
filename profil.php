<?php
    @session_start();
    //avant de déclarer le header je donne le titre qui sera utilisé dans header.php
    $titre = $_SESSION["user"]["pseudo"];

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>
<div class="contenu">

<h1>Profil de <?= $_SESSION["user"]["pseudo"] ?></h1>

<p>Pseudo : <?= $_SESSION["user"]["pseudo"] ?></p>
<p>Email : <?= $_SESSION["user"]["email"] ?></p>

</div>

<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>