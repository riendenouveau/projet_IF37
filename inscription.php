<?php
@session_start();
    //Si l'utilisateur est déja connecté, on souhaite qu'il ne puisse pas acceder à la page
    if(isset($_SESSION["user"])){
        header("Location: profil.php");
        exit;
    }

    //on verifie si le formulaire a ete envoyé
    if(!empty($_POST)){
        // le formulaire a ete evnoyé
        //on vérifie que tout les champs obligatoires sont remplis
        if(isset($_POST["username"], $_POST["email"], $_POST["pass"])
        && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){
            //Le formulaire est complet, on protège les données
            $pseudo = strip_tags($_POST["username"]);
            
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                die("L'adresse email est incorrecte");
            }

            //on va hasher le mot de passe
            $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);

            //-------------------Ajouter ici tout les controles souhaités


            //-----------------------

            //On ajoute les données à la bdd
            require_once "includes/connect.php";

            $sql = "INSERT INTO `users`(username, email, pass, roles) VALUES (:pseudo, :email, '$pass', '[\"ROLE_USER\"]' )";
            $query = $db->prepare($sql);
            $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->execute();

            //On récupère l'id du nouvel utilisateur
            $id = $db->lastInsertId();

            //On connecte l'utilisateur
            //on stock dans la session les informations de l'utilisateur
            $_SESSION["user"] = [
                "id" => $id,
                "pseudo" => $pseudo,
                "email" => $_POST["email"],
                "roles" => ["ROLE_USER"]
            ];

            //On peut rediriger vers la page de profil
            header("Location: profil.php");

        } else{
            die("Le formulaire est incomplet");
        }
    }
    //avant de déclarer le header je donne le titre qui sera utilisé dans header.php
    $titre = "Inscription";

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>
<div class="contenu">
<h1 style="margin-top:120px">Inscription</h1>

<form method="post" style="margin-top: 30px; margin-bottom:100px;">
    <div class="formulaire">
        <label for="pseudo">Pseudo : </label>
        <input type="text" name="username" id="pseudo">
    </div>
    <div class="formulaire">
        <label for="email">Email : </label>
        <input type="email" name="email" id="email">
    </div>
    <div class="formulaire">
        <label for="pass">Mot de passe :</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit" class="formulaire">M'inscrire</button>
</form>
</div>


<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>