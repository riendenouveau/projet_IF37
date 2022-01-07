<?php
session_start();
    //connexion a la DB
     require_once "includes/connect.php";

    //On récupère les information de l'utilisateur
    $pseudo = $_SESSION['user']['pseudo'];
    $idU = $_SESSION['user']['id'];

    //----On récupère le numéro de l'établissement à évaluer dans la base de données-------
    $idE = $_GET['idE'];
    
    //on récupère les données sur l'établissement
    @include_once "getDonnees.php";
    $etablissement = getDonnees($idE)['etablissement'][0];
    $nom = $etablissement['nomE'];
    $adresse = ($etablissement['adresse'] . ' , ' . $etablissement['codepostal'] . ' ' . $etablissement['ville']);

    ///*********************************************************************************************************************
    //******************************TRAITEMENT DU FORMULAIRE APRES ACUTALISATION DE LA PAGE******************************* */

    if(!empty($_POST)){
        if(isset($_POST['note'])){
            
            $titre = strip_tags($_POST['titre']);
            $commentaire = strip_tags($_POST['message']);
            $date = date('Y-m-d');

            $sql = "INSERT INTO `avisetablissement`(`user`, `etablissement`, `titre`, `note`, `commentaire`, `date`) VALUES(:user, :etablissement, :titre, :note, :commentaire, '$date')";
            $query = $db->prepare($sql);
            $query->bindValue(":titre", $titre, PDO::PARAM_STR);
            $query->bindValue(":commentaire", $commentaire, PDO::PARAM_STR);
            $query->bindValue(":user", $_SESSION["user"]["id"], PDO::PARAM_INT);
            $query->bindValue(":note", $_POST['note'], PDO::PARAM_INT);
            $query->bindValue(":etablissement", $idE, PDO::PARAM_INT);
            if(!$query->execute()){
                die("Une erreur est survenue lors de l'enregistrement de l'établissement");
            }else{
                die("Avis ajouté. Merci !");
            }
        } else{
            die("Erreur: vous n'avez pas donné de note.");
        }
        
    }

    /*********************************FIN TRAITEMENT DU FORMULAIRE*************************************** */
    /*********************************************************************************************************************** */

    //avant de déclarer le header je donne le titre qui sera utilisé dans header.php
    $titre = "Accueil";

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>

<div class="contenu">

	<fieldset>	
        <h2>Rédiger un avis :</h2>
        <p>Établissement concerné : <?= $nom ?></p>
		<form method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<label for="titre">Titre :</label>
			<input type="text" name="titre" maxlength="200" placeholder="Titre"  required>

            <section class="question">
            <label for="note">Note :</label>
            <section id="rate" class="rating">
                <!-- FIFTH STAR -->
                <input type="radio" id="star_5" name="note" value="5" />
                <label for="star_5" title="Five">&#9733;</label>
                <!-- FOURTH STAR -->
                <input type="radio" id="star_4" name="note" value="4" />
                <label for="star_4" title="Four">&#9733;</label>
                <!-- THIRD STAR -->
                <input type="radio" id="star_3" name="note" value="3" />
                <label for="star_3" title="Three">&#9733;</label>
                <!-- SECOND STAR -->
                <input type="radio" id="star_2" name="note" value="2" />
                <label for="star_2" title="Two">&#9733;</label>
                <!-- FIRST STAR -->
                <input type="radio" id="star_1" name="note" value="1" />
                <label for="star_1" title="One">&#9733;</label>
            </section>
            </section>


			<label for="message">Votre message :</label><br/>
			<textarea id="message" name="message" rows="6" cols="100" required>...</textarea>
	
			<br/><br/>
            <div id="boutton">
			    <button type="submit" class="bouton" value="Envoyer">Envoyer</button>
            </div>
		</form>
	</fieldset>
        
</div>



<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>


<style>
    #boutton {
    height : 120px;
    position : relative;
}

#boutton button {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    border-radius: 10px;
}

fieldset {
    margin: 100px 10%;
   padding: 20px 2em 0em 2em;
   border: 2px double #ddd;
   border-radius : 15px;
 }

 fieldset textarea {
     max-width : 100%;
 }

.question {
    margin : 0px 0px;
    display: flex;
    flex-direction: row;
    justify-content: normal;
    align-items: center;
    flex-wrap: wrap;
}

.rating {
  padding: 0px 10px;
  width : 225px;
  display: block;
  overflow: hidden;
  margin : 10px 30px;
  font-size : 2em;
  
}
.rating:not(:checked) > input {
  display: none;
}

.rating label {
    width : 20%;
    text-align : center;
}

#rate:not(:checked) > label {
  cursor:pointer;
  float: right;
  display: block;
  
  color: rgba(0, 135, 211, .4);
}
#rate:not(:checked) > label:hover,
#rate:not(:checked) > label:hover ~ label {
  color: rgba(0, 135, 211, .6);
}
#rate > input:checked + label:hover,
#rate > input:checked + label:hover ~ label,
#rate > input:checked ~ label:hover,
#rate > input:checked ~ label:hover ~ label,
#rate > label:hover ~ input:checked ~ label {
  color: rgba(0, 135, 211, .8);
}
#rate > input:checked ~ label {
  color: rgb(0, 135, 211);
}

</style>
