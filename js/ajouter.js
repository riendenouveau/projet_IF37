let mymap, marqueur // Variable pour la carte

window.onload = () => {
    mymap = L.map("detailsMap").setView([48.2971626,4.0746257], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',{
        attribution : 'données OpenStreetMap France',
        minZoom:1,
        maxZoom:20
    }).addTo(mymap)
    mymap.on("click", mapClickListen)
    document.querySelector("#ville").addEventListener("blur", getCity)
}

function mapClickListen(e){ //e correspond a l'évènement récupéré
    //on recupere les coordonées du clic
    let pos = e.latlng

    //on ajoute le marqueur
    addMarker(pos);

    //On affiche les coordonées dans le formulaire
    document.querySelector("#lat").value = pos.lat
    document.querySelector("#lon").value = pos.lng
}

function addMarker(pos){
    //On verifie si un marqueur existe
    if(marqueur != undefined){
        mymap.removeLayer(marqueur)
    }
    marqueur = L.marker(pos,{
        //on rend le marqueur deplacable
        draggable : true
    })

    //On ecoute le glisser/deposer sur le marqueur
    marqueur.on("dragend", function(e){
        pos = e.target.getLatLng()
        document.querySelector("#lat").value = pos.lat
        document.querySelector("#lon").value = pos.lng
    })

    marqueur.addTo(mymap)
}


function getCity(){
    //On fabrique l'adresse
    let adresse = document.querySelector("#adresse").value + ", " + document.querySelector("#cp").value + " " + document.querySelector("#ville").value
    
    //On initialise une requete Ajax
    const xmlhttp = new XMLHttpRequest

    xmlhttp.onreadystatechange = () => {
        // si la requête est terminée
        if(xmlhttp.readyState == 4){
            //si on a une reponse
            if(xmlhttp.status == 200){
                // on recupère la reponse
                let response = JSON.parse(xmlhttp.response)
                console.log(response)

                let lat = response[0]["lat"]
                let lon = response[0]["lon"]
                document.querySelector("#lat").value = lat
                document.querySelector("#lon").value = lon

                let pos = [lat, lon]
                addMarker(pos)
                mymap.setView(pos,15)
            }
        }
    }

    xmlhttp.open("get", `https://nominatim.openstreetmap.org/search?q=${adresse}&format=json&addressdetails=1&limit=1&polygon_svg=1`)

    xmlhttp.send()
}