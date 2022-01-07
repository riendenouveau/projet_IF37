//on initialise la carte au dessus de troyes
var carte = L.map('carteEtablissement').setView([46.87458105392677,2.3181863633945143], 6);

//on charge les "tuiles"
L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',{
    attribution : 'données OpenStreetMap France',
    minZoom:1,
    maxZoom:20
}).addTo(carte)

var marqueurs = L.markerClusterGroup();

 // On crée le tableau qui permettra de stocker les marqueurs
 var tableauMarqueurs = [];

//On récupère les données des établissements de la base de données 
let xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = () =>{
    //la transaction est terminée ? 
    if(xmlhttp.readyState ==4){
        // si la transaction est un succès 
        if(xmlhttp.status == 200){
            //On traite les données recu
            let donnees = JSON.parse(xmlhttp.responseText);
            
            // on boucle sur les données (ES8)
            Object.entries(donnees.etablissement).forEach(etab => {
                // Ici j'ai un seul établissement
                //on crée un marqueur pour l'agence
                var marqueur = L.marker([etab[1].lat, etab[1].lon],
                    {icon: icone});
                marqueur.bindPopup("<p>" + etab[1].nomE + "</br></p>");
                marqueur.on('mouseover', function (e) {
                    this.openPopup();
                });
                marqueur.on('mouseout', function (e) {
                    this.closePopup();
                });
                marqueur.on('click', function(event){
                    console.log("<p>" + etab[1].nomE + "</br></p>");
                    console.log("<p>" + etab[1].id + "</br></p>");
                    refreshDiv(etab[1].id);
                });
                marqueurs.addLayer(marqueur);
                tableauMarqueurs.push(marqueur);
            })
        } else{
            console.log(xmlhttp.statusText);
        }
    }
}


xmlhttp.open("GET", "http://localhost/formationOpenClassRoom/HandiMov/donnees.php");

xmlhttp.send(null);

//modifier le marqueur (la balise)
var icone = L.icon({
    iconUrl: "image/point2.png",
    iconSize: [15,15] //pour changer le point d'ancrage, on utilise iconAnchor
})

 //on regroupe les marqueurs dans un groupe Leaflet
 var group = new L.featureGroup(tableauMarqueurs);

 carte.addLayer(marqueurs);

 function refreshDiv($idE){
     $("#refresh").load(window.location.href + " #refresh", {idE:$idE});
 }
