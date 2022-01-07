<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
</style>
<style>
    #amenagements{
        list-style-type: "-";
    }

    .blueStar, .otherStar{
        font-size: 2em;
    }

    .blueStar {
        color: rgba(0, 135, 211, .8)
    }

    .part {
        padding : 25px 5%;
    }
</style>

<?php
    @include_once "getDonnees.php";
    $etablissements = getDonnees()['etablissement'];
    $id = $_GET['idE'];
    foreach($etablissements as $etablissementTemp){
        if($etablissementTemp['id']==$id){
            $etablissement = $etablissementTemp;
        }
    }
    $nomE = $etablissement['nomE'];
    $adresse = $etablissement['adresse'];
    $codepostal = $etablissement['codepostal'];
    $ville = $etablissement['ville'];
    $noteMoyenne = $etablissement['noteMoyenne'];
    

    //On recupère les immages associés à l'établissement
    $images = getImages($id)['images'];
?>

<!----------------------CONTENU DE LA SECTION INFORMATION SUR LES ETABLISSEMENTS------------------------------>

<section class="titre">
<div class="catEtoile">
    <h2><?= "$nomE" ?></h2>
    <?php
        printCategorie($id);
        echo('</div><div class="centre">');
        printMoyenne($noteMoyenne,$id);
        echo('</div>')
    ?>

</section>
    <section class="part clair">
        <p><span style="color : rgb(125,125,125);">Adresse</span><br/><?= "$adresse , $codepostal $ville" ?></p>

        <?php
            if(count($images)>0){
                include "imagesEtablissement.php";
            }
        ?>
    </section>

    <section class="part">
        <h3>Aménagements dont dispose l'établissement :</h3>
        <ol id="amenagements">
            <?php
                getAmenagements($id);
            ?>
        </ol>
    </section>

    <section class="part clair">
        <h3>Notation de l'accessibilité : </h3>
        <?php
            getAccessibilite($id);
        ?>
    </section>

    <section class="part">
        <div class = titrelien>
            <h3 >Notes et Avis :</h3>
            <?php
                if(isset($_SESSION["user"])){
                    echo('<a href="avis.php?idE=' . $id . '">+ rédiger un avis</a>');
                }
            ?>
        </div>
        <?php
            getAvis($id);
        ?>
    </section>



<!-----------CSS POUR LA PAGE INFORMATION ETABLISSEMENTS--------->
<style>


    .centre .moyenne{
        margin-top: 20px;
    }


    .titrelien{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-flow: wrap;
    }

    .titrelien a {
        margin : 10px 0px;
        color : #003a73;
    }

    .titrelien a:hover {
        text-decoration: underline;
    }

    h3, p , li{
        font-family: 'louis_george_caferegular';
    }
    

    #infoEtablissements{
        padding : 20px 20px;
    }

    .titre h2 {
        font-family: 'louis_george_cafebold';
        margin :0px;
        margin-top:10px;
    }

    .titre{
        padding : 20px 15px 10px 15px;
        display: flex;
    flex-direction: row;
    justify-content: space-between;
    flex-flow: wrap;
    }

    .titre .moyenne {
        padding-left : 5px;
    }

    .titre .blueStar,
    .titre .otherStar{
        font-size : 1.6em;
    }


    /***********CSS POUR LES AVIS************************** */
.avis {
    border : solid  1px rgba(51, 51, 51, 0.1);
    padding: 0px 10px;
    border-radius: 30px;
    background: rgb(250,250,250);
    display: block;
    overflow: hidden;
    margin : 30px 0px;;
    font-size : 2em;
    

    
    box-shadow: 0 1px #CCC,
                0 5px #DDD,
                0 9px 6px -3px #999;
}

    .avisheader{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-flow: wrap;
        padding : 10px 5px;
    }

    .avisheader .infoAvis{
    }

    .avisheader .titreNote h4 {
        font-size : 0.7em;
        margin:0;
        font-family: 'louis_george_caferegular';
        width: 100%;
    }

    .avisheader .titreNote {
        display: flex;
        flex-direction: row;
        justify-content: start;
        flex-flow: wrap;
        padding-left:5px;
    }

    .avisheader .date {
        font-size : 0.5em;
        margin : 0px;
        text-align : right;
        padding:0;
        margin-right:5px;
        font-family: 'louis_george_caferegular';
    }
    .avisheader h5 {
        margin : 0px;
    }


    .avis .blueStar,
    .avis .otherStar {
        font-size:0.5em;
        margin : 0;
    }

    .avis .username {
        font-size : 15px;
        margin-right : 5px;
        text-align : right;
    }

    .avis p {
        font-family: 'louis_george_caferegular';
        font-size : 15px;
        text-align : justify;
        padding : 0px 10px;
    }
</style>


<!---------------SCRIPT JAVA UTILE POUR LES PHOTOS--------------->
<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function currentDiv(n) {
    showDivs(slideIndex = n);
    }

    function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-white", "");
    }
    x[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " w3-white";
    }
</script>

    