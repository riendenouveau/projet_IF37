<?php
@session_start();

    //Si l'utilisateur est n'est pas connecté, on souhaite qu'il ne puisse pas acceder à la page --> on le renvoie sur connexion
    if(!isset($_SESSION["user"])){
        header("Location: connexion.php");
        exit;
    }
//supprimer une variable
unset($_SESSION["user"]);

header("Location: accueil.php");