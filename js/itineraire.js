    let macarte, marqueurDepart, marqueurArrivee, coorArrivee, coorDepart
    
    
    // On s'assure que la page est chagé
    window.onload = function(){
      macarte = L.map('map').setView([48.2973451, 	4.0744009], 14)
        // On charge les tuiles depuis un serveur au choix, ici OpenStreetMap France
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte)

      document.querySelector("#depart").addEventListener("blur", getDepart)
      document.querySelector("#arrivee").addEventListener("blur", getArrivee)
      document.querySelector("#button").addEventListener("click", getItineraire)
  
  
    }

    function addMarkerDepart(pos){
      //On verifie si un marqueur existe
      if(marqueurDepart != undefined){
          macarte.removeLayer(marqueurDepart)
      }
      marqueurDepart = L.marker(pos,{
          //on rend le marqueur deplacable
          draggable : true
      })
  
      //On ecoute le glisser/deposer sur le marqueur
      marqueurDepart.on("dragend", function(e){
          pos = e.target.getLatLng()
          document.querySelector("#lat").value = pos.lat
          document.querySelector("#lon").value = pos.lng
      })
  
      marqueurDepart.addTo(macarte)
  }

  function addMarkerArrivee(pos){
    //On verifie si un marqueur existe
    if(marqueurArrivee != undefined){
        macarte.removeLayer(marqueurArrivee)
    }
    marqueurArrivee = L.marker(pos,{
        //on rend le marqueur deplacable
        draggable : true
    })

    //On ecoute le glisser/deposer sur le marqueur
    marqueurArrivee.on("dragend", function(e){
        pos = e.target.getLatLng()
        document.querySelector("#lat").value = pos.lat
        document.querySelector("#lon").value = pos.lng
    })

    marqueurArrivee.addTo(macarte)

}



    function getDepart(){
      coorDepart=null
      //On fabrique l'adresse
    let adresse = document.querySelector("#depart").value

    console.log(adresse)
    
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

                let pos = [lat, lon]
                //coorDepart = lat + "," + lon
                coorDepart=[parseFloat(lon), parseFloat(lat)];
                addMarkerDepart(pos)
                macarte.setView(pos,15)
            }
        }
    }

    xmlhttp.open("get", `https://nominatim.openstreetmap.org/search?q=${adresse}&format=json&addressdetails=1&limit=1&polygon_svg=1`)

    xmlhttp.send()
    }

    function getArrivee(){
      coorArrivee=null
      //On fabrique l'adresse
    let adresse = document.querySelector("#arrivee").value

    console.log(adresse)
    
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

                posArrivee = [lat, lon]
                //coorArrivee = lat + "," + lon
                coorArrivee=[parseFloat(lon), parseFloat(lat)];
                addMarkerArrivee(posArrivee)
                macarte.setView(posArrivee,15)
            }
        }
    }

    xmlhttp.open("get", `https://nominatim.openstreetmap.org/search?q=${adresse}&format=json&addressdetails=1&limit=1&polygon_svg=1`)

    xmlhttp.send()
    }


    function getItineraire() {
      console.log("Itineraire : ")
      console.log(coorDepart==null)
      console.log(coorArrivee==null)

      if(coorDepart!=null && coorArrivee!=null){
        console.log(" dans boucle Itineraire")
        let request = new XMLHttpRequest();
    
        request.open('POST', "https://api.openrouteservice.org/v2/directions/wheelchair/geojson");
      
        request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');
        request.setRequestHeader('Content-Type', 'application/json');
        request.setRequestHeader('Authorization', '5b3ce3597851110001cf624844d1c16ea739408aadec4f2085bf8e50')
        request.onreadystatechange = function () {
          if (this.readyState === 4) {
            console.log('Status:', this.status);
            console.log('Headers:', this.getAllResponseHeaders());
            L.geoJSON(JSON.parse(this.responseText)).addTo(macarte)
          }
        };
        
        console.log( typeof coorDepart);
        const body1 = '{"coordinates":[[' + '4.07891,48.30071' + '],[' + '4.064233,48.290989' + ']]}';
        
        
        var depart = coorDepart
        var arrivee = coorArrivee
        var test = {"coordinates":[coorDepart,coorArrivee]}
        //var body = '{"coordinates":[' + depart + ',[' + '4.064233,48.290989' + ']]}';
        const body = JSON.stringify(test);
        console.log(body)
        console.log(body1)
        request.send(body);
      }
    }



