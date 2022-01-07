<?php
@session_start();
    //On vérifie si on a un id
    if(!isset($_GET["id"]) || empty($_GET["id"])){
        //Je n'ai pas d'id
        header("Location: accueil.php");
        exit;
    }
    
    //Je recupère l'id
    $id = $_GET["id"];

    //connexion a la DB
    require_once "includes/connect.php";
    //On va chercher l'article dans la base
    $sql = "SELECT * FROM users WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindValue(":id", $id, PDO::PARAM_INT);
    $requete->execute();
    $user = $requete->fetch();

    //on vérifie si article est vide 
    if(!$user){
        http_response_code(404);
        echo "User inexistant";
        exit;
    }

    //Ici on a un artcile
    $titre = strip_tags($user["username"]);

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>
    
    <article><!--element independant d'une page web-->
        <h1><?= strip_tags($user["username"]) ?></h1> <!--strip_tags permet de ne pas autoriser le contenu html dans la le string-->
        <p>Numéro dans la base de données : <?= $user["id"] ?></p>
    </article>


<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>