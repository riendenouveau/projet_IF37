<?php
@session_start();
    $idE = 2;
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

<!---------------------------HEADER--------------------------------------------------->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <!--CSS-->
    <link rel="stylesheet" href="style/etablissements.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">


<!---------------------------BODY-------------------------------------------------------->

 

<div id = "pageEtablissement">
    <div class="contenu" style = "margin-bottom:20px;">
        <h2>Rechercher un établissement</h2>
    </div>
        <div id="conteneur">  

        <!-- ------------CARTE DES ETABLISSEMENTS------------------------>
        <div id="carteEtablissement"></div>
        <!-- ------------INFORMATIONS SUR ETABLISSEMENTS----------------->
        <div id="infoEtablissement">
            <div id="refresh">
            <button onclick="closeDiv()" id="croix">&#x2716;</button>
            <?php
           if(isset($_POST['idE']) && !empty($_POST['idE'])){
                $_GET['idE'] = $_POST['idE'];
                @include "style/etablissementInfo.php";
                @include "infoEtablissement.php";
                echo ('
                    <script>showDivs(1);</script>
                ');
            } else{
                @include "style/etablissementSansInfo.php";
                echo "<h2>Sélectionner un établissement</h2>";
            }
            ?>
            </div>
            
        </div>
    </div>
</div>

<!-----------------CSS DE LA PLAGE ETABLISSEMENT-------------------->



<script>
    function closeDiv(){
        console.log("on est bon");
        <?php
            unset($_POST);
        ?>
        $("#refresh").load(window.location.href + " #refresh");
    }
</script>

<!-----------------------SCRIPT UTILE POUR LAFFICHAGE DES IMAGES ----------------->
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



<!--------------------------FOOTER------------------------------------------------------->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script src="js/etablissements.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>
