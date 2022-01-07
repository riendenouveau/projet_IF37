<?php
session_start();
    //Si l'utilisateur est n'est pas connecté, on souhaite qu'il ne puisse pas acceder à la page --> on le renvoie sur connexion
    if(!isset($_SESSION["user"])){
        header("Location: connexion.php");
        exit;
    }
    //on traite le formulaire quand la page s'actualise après l'envoi du formulaire
    if(!empty($_POST)){
        //POST n'est pas vide, on vérifie que toutes les données sont présentes
        if(isset($_POST["nomE"], $_POST["adresse"])
            && !empty($_POST["nomE"]) && !empty($_POST["adresse"]) && !empty($_POST["ville"]) && !empty($_POST["cp"]) && !empty($_POST["lat"]) && !empty($_POST["lon"])){
                $images = array();
                //on récupère les données en les protégeant (failles XSS)
                $nomE = strip_tags($_POST["nomE"]);
                $adresse = strip_tags($_POST["adresse"]);
                $codepostal = strip_tags($_POST["cp"]);
                $ville = strip_tags($_POST["ville"]);
                $lat = strip_tags($_POST["lat"]);
                $lon = strip_tags($_POST["lon"]);


                if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'][0])){
                    $correct = true;
                    foreach($_FILES["image"]["error"] as $error){
                        if(!($error === 0)){
                            $correct=false;
                        }
                    }
                    if($correct===true){
                        //on effectue les vérification
                        //on verifie l'extension et le type MINE
                        $allowed = [
                            "jpg" => "image/jpeg",
                            "jpeg" => "image/jpeg",
                            "png" => "image/png"
                        ];

                        foreach($_FILES["image"]["name"] as $filename){
                            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // ex : brouette.png --> on recupere png
                            if(!array_key_exists($extension, $allowed)){
                                die("Erreur : format de fichier incorrect");
                            }
                        }
                        foreach($_FILES["image"]["type"] as $filetype){
                            if(!in_array($filetype, $allowed)){
                                die("Erreur : format de fichier incorrect");
                            }
                        }
                        //Ici le type est correct
                        //on limite a 1Mo
                        foreach($_FILES["image"]["size"] as $filesize){
                            if($filesize>1024*1024){
                                die("Erreur : fichier(s) trop volumineux");
                            }
                        }

                        foreach($_FILES["image"]["name"] as $key => $filename){
                            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // ex : brouette.png --> on recupere png
                             // on genere un nom unique
                            $newname = md5(uniqid());
                            //on genere le chemin complet  --------- __DIR__ permet de prendre  le chemin complet vers le dossier dans lequel on est
                            $newfilename = "uploads/$newname.$extension";
                            
                            // on le recupere dans le dossier temporaire et on le place dans notre dossier
                            if(!move_uploaded_file($_FILES["image"]["tmp_name"][$key], $newfilename)){
                                die("L'upload a échoué");
                            }

                            chmod($newfilename, 0644); //on a le droit de lecture et de modification mais les visiteurs ont seulement le droit de lire
                            
                            $images[]= $newfilename;

                        }
                       

                    }else{
                        die("Une erreur est survenue lors du chargement d'un fichier");
                    }
                }
                //on enregistre les données
                //connexion a la DB
                require_once "includes/connect.php";
                $sql = "INSERT INTO `etablissements`(`nomE`, `adresse`, `codepostal`, `ville`, `lat`, `lon`, `user`,`verif`) VALUES(:nomE, :adresse, :cp, :ville, :lat, :lon, :user, 0)";
                $query = $db->prepare($sql);
                $query->bindValue(":nomE", $nomE, PDO::PARAM_STR);
                $query->bindValue(":adresse", $adresse, PDO::PARAM_STR);
                $query->bindValue(":cp", $codepostal, PDO::PARAM_STR);
                $query->bindValue(":ville", $ville, PDO::PARAM_STR);
                $query->bindValue(":lat", $lat, PDO::PARAM_STR);
                $query->bindValue(":lon", $lon, PDO::PARAM_STR);
                $query->bindValue(":user", $_SESSION["user"]["id"], PDO::PARAM_INT);
                if(!$query->execute()){
                    die("Une erreur est survenue lors de l'enregistrement de l'établissement");
                }
            
                //on récupère l'id de l'article
                $id = $db->lastInsertId();

                // On enregistre la(les ) catégorie(s) de l'établissement 
                $sql = "SELECT `nomC` FROM `categorieetablissement`";
                $query = $db->prepare($sql);
                $query->execute();
                $categories = $query->fetchAll();
                foreach($categories as $categorie){
                    if(isset($_POST[$categorie['nomC']])){
                        $nomCategorie = $categorie['nomC'];
                        $sql = "INSERT INTO `estun`(`etablissement`, `categorie`) VALUES($id, '$nomCategorie')";
                        $query = $db->prepare($sql);
                        if(!$query->execute()){
                            die("Un problème est survenue lors du chargement de la catégorie de l'établissement");
                        }
                    }
                }

                



                //On enregistre les données dans aménagements
                $rampe = ((isset($_POST['rampe'])) ? 'true' : 'false');
                $toilettes = ((isset($_POST['toilettes'])) ? 'true' : 'false');   
                $ascenseur = ((isset($_POST['ascenseur'])) ? 'true' : 'false'); 
                $douche = ((isset($_POST['douche'])) ? 'true' : 'false');
                $lavabo = ((isset($_POST['lavabo'])) ? 'true' : 'false'); 
                $comptoir = ((isset($_POST['comptoir'])) ? 'true' : 'false');
                $parking = ((isset($_POST['parking'])) ? 'true' : 'false');
                $sql = "INSERT INTO `amenagements`(`etablissement`, `rampe`, `parking`, `toilettes`, `ascenseur`, `douche`, `lavabo`, `comptoir`) VALUES($id, $rampe ,$parking, $toilettes, $ascenseur, $douche, $lavabo, $comptoir)";
                $query = $db->prepare($sql);
                if(!$query->execute()){
                    die("Une erreur est survenue lors de l'enregistrement des aménagements de l'établissement");
                }

                //On enregistre les données dans accessibilite
                $fauteil = $_POST['q1'];
                $visuel = $_POST['q2'];
                $moteur = $_POST['q3'];
                $sql = "INSERT INTO `accessibilite`(`etablissement`,`fauteuil`, `visuel`, `moteur`) VALUES($id, '$fauteil', '$visuel', '$moteur')";
                $query = $db->prepare($sql);
                if(!$query->execute()){
                    die("Une erreur est survenue lors de l'enregistrement des notations d'accessibilité de l'établissement");
                }

                //On insert les images dans la table
                if(!empty($images)){
                    foreach($images as $image){
                        $sql = "INSERT INTO `imagesetablissements`(`nom`, `etablissement`) VALUES ('$image',$id)";
                        $query = $db->prepare($sql);
                        if(!$query->execute()){
                            die("Une erreur est survenue lors du chargement des images dans la base de données.");
                        }
                    }
                }

                die("Etablissement ajouté sous le numero $id");

            }else{
                die("Le formulaire est incomplet");
            }
    }

    //avant de déclarer le header je donne le titre qui sera utilisé dans header.php
   $titre = "Ajouter des données";

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>
<!-----------------------HEADER BIS------------------------------------->
<!---------FICHIER CSS---------->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
    <link rel="stylesheet" href="style/ajouter.css">


    <!---------------------BODY BIS--------------------------------------------->
    <div class="contenu" style = "margin-bottom:20px;">
    <h2>Ajouter un établissement :</h2>
    </div>
<form method="post" enctype="multipart/form-data">
    
    <!--------------------------PARTIE LOCALISATION------------------------------->
    <section class="partie clair">
    <h3>Localisation de l'établissement :</h3>
        <div>
            <label for="nomE">Nom de l'établissement* :</label>
            <input type="text" name="nomE" id="nomE">
        </div>
        <div>
            <label for="categorie">Catégorie de l'établissement :</label>
            <div style="margin-left:20px;margin-bottom:20px;">
            <?php
                @require "includes/connect.php";
                $sql = "SELECT `nomC` FROM `categorieetablissement` WHERE `nomC`!='Autre'";
                $query = $db->prepare($sql);
                $query->execute();
                $categories = $query->fetchAll();
                foreach($categories as $categorie){
                    echo('<div><input type="checkbox" id="' . $categorie['nomC']  . '" name="' . $categorie['nomC']  . '" value="' . $categorie['nomC'] . '">
                    <label for="' . $categorie['nomC']  . '"> ' . $categorie['nomC']  . '</label></div>');
                }
                echo('<div><input type="checkbox" id="Autre" name="Autre" value="Autre">
                    <label for="Autre"> Autre</label></div>');
            ?>
            </div>
        </div>
        <div>
            <label for="adresse">Adresse* :</label>
            <input type="text" name="adresse" id="adresse">
        </div>
        <div>
            <label for="cp">Code postal* :</label>
            <input type="text" name="cp" id="cp">
        </div>
        <div>
            <label for="ville">Ville* :</label>
            <input type="text" name="ville" id="ville">
        </div>
        <div>
            <label for="fichier">Photos de l'établissement :</label>
            <input type="file" name="image[]" id="fichier" multiple>
        </div>
        <div id="detailsMap"></div>
        <div >
            <label for="lat">Latitude : </label>
            <input type="text" name="lat" id="lat" readonly>
        </div>
        <div >
            <label for="lon">Longitude : </label>
            <input type="text" name="lon" id="lon" readonly>
        </div>
    </section>


    <!-- -------------------------PARTIE AMENAGEMENTS---------------------------->
    <section class="partie">
        <h3>Aménagements dont dispose l'établissement :</h3>
        <div>
            <input type="checkbox" id="rampe" name="rampe" value="rampe">
            <label for="rampe"> rampe fixe ou amovible</label>
        </div>
        <div>
            <input type="checkbox" id="parking" name="parking" value="parking">
            <label for="parking"> place(s) de parking pour personne en situation de handicap</label>
        </div>
        <div>
            <input type="checkbox" id="toilettes" name="toilettes" value=toilettes">
            <label for="toilettes"> toilette handicapé</label>
        </div>
        <div>
            <input type="checkbox" id="ascenseur" name="ascenseur" value="ascenseur">
            <label for="ascenseur"> ascenseur</label>
        </div>
        <div>
            <input type="checkbox" id="douche" name="douche" value="douche">
            <label for="douche"> douche handicapé</label>
        </div>
        <div>
            <input type="checkbox" id="lavabo" name="lavabo" value="lavabo">
            <label for="lavabo"> lavabo suspendu</label>
        </div>
        <div>
            <input type="checkbox" id="comptoir" name="comptoir" value="comptoir">
            <label for="comptoir"> comptoir accessible aux fauteils roulants</label>
        </div>
            <label for="autreAmenagement">Autre(s) :</label>
            <input type="text" name="autreAmenagement" id="autreAmenagement">
        </div>
    </section>


    <!-- -------------------------PARTIE ACCESSIBILITE---------------------------->
    <section class ="partie clair">
        <h3>Notation de l'accessibilité :</h3>
        <section class="question">
            <label for="q1">Accessibilité aux personnes en fauteuil roulant :</label>
            <section id="rate" class="rating">
                <!-- FIFTH STAR -->
                <input type="radio" id="star_5" name="q1" value="5" />
                <label for="star_5" title="Five">&#9733;</label>
                <!-- FOURTH STAR -->
                <input type="radio" id="star_4" name="q1" value="4" />
                <label for="star_4" title="Four">&#9733;</label>
                <!-- THIRD STAR -->
                <input type="radio" id="star_3" name="q1" value="3" />
                <label for="star_3" title="Three">&#9733;</label>
                <!-- SECOND STAR -->
                <input type="radio" id="star_2" name="q1" value="2" />
                <label for="star_2" title="Two">&#9733;</label>
                <!-- FIRST STAR -->
                <input type="radio" id="star_1" name="q1" value="1" />
                <label for="star_1" title="One">&#9733;</label>
            </section>
        </section>

        <section class="question">
        <label for="q2">Accessibilité aux personnes à handicap visuel :</label>
            <section id="rate" class="rating">
                <!-- FIFTH STAR -->
                <input type="radio" id="s5" name="q2" value="5" />
                <label for="s5" title="Five">&#9733;</label>
                <!-- FOURTH STAR -->
                <input type="radio" id="s4" name="q2" value="4" />
                <label for="s4" title="Four">&#9733;</label>
                <!-- THIRD STAR -->
                <input type="radio" id="s3" name="q2" value="3" />
                <label for="s3" title="Three">&#9733;</label>
                <!-- SECOND STAR -->
                <input type="radio" id="s2" name="q2" value="2" />
                <label for="s2" title="Two">&#9733;</label>
                <!-- FIRST STAR -->
                <input type="radio" id="s1" name="q2" value="1" />
                <label for="s1" title="One">&#9733;</label>
            </section>
        </section>

        
        <section class="question">
        <label for="q3">Accessibilité aux personnes à handicap moteur :</label>
            <section id="rate" class="rating">
                <!-- FIFTH STAR -->
                <input type="radio" id="e5" name="q3" value="5" />
                <label for="e5" title="Five">&#9733;</label>
                <!-- FOURTH STAR -->
                <input type="radio" id="e4" name="q3" value="4" />
                <label for="e4" title="Four">&#9733;</label>
                <!-- THIRD STAR -->
                <input type="radio" id="e3" name="q3" value="3" />
                <label for="e3" title="Three">&#9733;</label>
                <!-- SECOND STAR -->
                <input type="radio" id="e2" name="q3" value="2" />
                <label for="e2" title="Two">&#9733;</label>
                <!-- FIRST STAR -->
                <input type="radio" id="e1" name="q3" value="1" />
                <label for="e1" title="One">&#9733;</label>
            </section>
        </section>
    </section>

    <section id="boutton">
        <button type="submit">Enregistrer</button>
    </section>
</form>

<!-------------------------------FICHIER JS----------------------------------------------------------------->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="js/ajouter.js"></script>


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

.question {
    margin : 40px 0px;
    display: flex;
    flex-direction: row;
    justify-content: normal;
    align-items: center;
    flex-wrap: wrap;
}

.rating {
  padding: 0px 10px;
  width : 225px;
  border-radius: 30px;
  background: #FFF;
  display: block;
  overflow: hidden;
  margin : 10px 30px;
  font-size : 2em;
  
  box-shadow: 0 1px #CCC,
              0 5px #DDD,
              0 9px 6px -3px #999;
  
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