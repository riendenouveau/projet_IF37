
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

<p>Ici, nous réalisons la video 11 du cours Youtube.<br/>
Nous cherchons de manière sécurisée un utilisateur : 
en évitant les injections SQL qui pourrait remettre en question la sécuritée des données.</p>

<?php

    $username = "mathieuletreust";
    $password = "secret";

    //on utilise des ? par sécurité contre les injections SQL
    $sql = "SELECT * FROM users WHERE username=:username AND pass=:pass"; 

    //On prépare la requete
    $requete = $db->prepare($sql);

    //on injecte les valeurs "bindValue"
    $requete->bindValue(":username", $username, PDO::PARAM_STR);
    $requete->bindValue(":pass", $password, PDO::PARAM_STR);

    //on exécute
    $requete->execute();

    $user = $requete->fetchAll();

    echo "<pre>";
    var_dump($user);
    echo "</pre>";
?>

<p>Ici, nous réalisons la video 12 du cours Youtube.<br/>
Nous allons affihcer des données provenant de la base MySQL.</p>

<?php
    //on écrit la requete
    $sql = "SELECT id,username FROM users ORDER BY id DESC";

    //on execute la requete
    $requete = $db->query($sql);

    //on récupère les données
    $users = $requete->fetchAll();

?>

<p>j'affiche les utilisateurs:</p>

<?php foreach($users as $user):?>
    
<section>
    <article><!--element independant d'une page web-->
        <h1><a href="profiltest.php?id=<?= $user["id"] ?>"><?= strip_tags($user["username"]) ?></a></h1> <!--strip_tags permet de ne pas autoriser le contenu html dans la le string-->
        <p>Numéro dans la base de données : <?= $user["id"] ?></p>
    </article>

<?php endforeach;
?>
</section><!--ATTENTION A BIEN FERMER LA SECTION APRES LE END

<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>