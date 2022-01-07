<?php
@session_start();
    //Si l'utilisateur est déja connecté, on souhaite qu'il ne puisse pas acceder à la page
    if(isset($_SESSION["user"])){
        header("Location: profil.php");
        exit;
    }
    
    //on verifie si le formulaire a ete envoyé
    if(!empty($_POST)){
        if(isset($_POST["email"], $_POST["pass"])
        && !empty($_POST["email"]) && !empty($_POST["pass"])){
            // on verifie que l'email en est  un
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                die("L'adresse email est incorrecte");
            }

            // on se connecte à la db
            require_once "includes/connect.php";
            $sql = "SELECT * FROM users WHERE email=:email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();
            
            if(!$user){
                die("L'utilisateur et/ou le mot de passe est incorrect");
            }

            //On a un utilisateur existant
            //On verifie le mdp
            if(!password_verify($_POST["pass"], $user["pass"])){
                die("L'utilisateur et/ou le mot de passe est incorrect");
            }

            //Ici l'utilisateur et le mot de passe sont corrects
            //On va pouvoir connecter l'utilisateur 
            //on stock dans la session les informations de l'utilisateur
            $_SESSION["user"] = [
                "id" => $user["id"],
                "pseudo" => $user["username"],
                "email" => $user["email"],
                "roles" => $user["roles"]
            ];

            //On peut rediriger vers la page de profil
            header("Location: profil.php");
        }
    }
    //avant de déclarer le header je donne le titre qui sera utilisé dans header.php
    $titre = "Connexion";

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>
<div class="contenu">
<h1 style="margin-top:120px">Connexion</h1>

<form method="post" style="margin-top: 30px; margin-bottom:100px;">
    <div>
        <label for="email">Email : </label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass">Mot de passe :</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">Me connecter</button>
</form>
</div>

<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>