<!-- Depart : 48.30046081542969,4.078283786773682          Arrivée : 48.269078,4.0664959      -->
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    
    <script>
        L_NO_TOUCH = false;
        L_DISABLE_3D = false;
    </script>
<style>#map {position:absolute;top:0;bottom:0;right:0;left:0;}</style>
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.6.0/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.6.0/dist/leaflet.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/python-visualization/folium/folium/templates/leaflet.awesome.rotate.min.css"/>

        <meta name="viewport" content="width=device-width,
            initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <style>
            #map_9b5dd77c2ee649e0a5cc643255e95d7b {
                position: relative;
                width: 100.0%;
                height: 100.0%;
                left: 0.0%;
                top: 0.0%;
            }
        </style>
<?php
@session_start();
    //connexion a la DB
     require_once "includes/connect.php";

    //avant de déclarer le header je donne le titre qui sera utilisé dans header.php
   $titre = "Itineraire";

    //@ permet de ne pas afficher le message d'erreur si une erreur est levee
    // _once permet de n
    @include_once "includes/header.php"; 
    @include_once "includes/navbar.php";

    //-----------------On écrit le contenu de la page----------------
?>

<div class="contenu" style="margin-top=80px;margin-bottom:0;">
    
<form method="post" enctype="multipart/form-data" class="form">
        <div>
            <label for="depart">Adresse de depart :</label>
            <input type="text" name="depart" id="depart">
        </div>
        <div>
            <label for="adresse">Adresse d'arrivée :</label>
            <input type="text" name="arrivee" id="arrivee">
        </div>
        <section id="boutton">
            <button type="button" id="button">Afficher</button>
        </section>
    </form>

</div >
    <!--<div class="folium-map" id="map_9b5dd77c2ee649e0a5cc643255e95d7b" ></div>-->
    <div id="map" style="height: 70vh;position:static;border-top:solid 2px black;"></div>



    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="js/itineraire.js"></script>
<?php
    //on inclut le pied de page
    @include_once "includes/footer.php";
?>

<!--<script>    
    
            var map_9b5dd77c2ee649e0a5cc643255e95d7b = L.map(
                "map_9b5dd77c2ee649e0a5cc643255e95d7b",
                {
                    center: [48.2973451, 4.0744009],
                    crs: L.CRS.EPSG3857,
                    zoom: 14,
                    zoomControl: true,
                    preferCanvas: false,
                }
            );

            

        
    
            var tile_layer_aee25e92211a48a68912c29dc612623d = L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                {"attribution": "Data by \u0026copy; \u003ca href=\"http://openstreetmap.org\"\u003eOpenStreetMap\u003c/a\u003e, under \u003ca href=\"http://www.openstreetmap.org/copyright\"\u003eODbL\u003c/a\u003e.", "detectRetina": false, "maxNativeZoom": 18, "maxZoom": 18, "minZoom": 0, "noWrap": false, "opacity": 1, "subdomains": "abc", "tms": false}
            ).addTo(map_9b5dd77c2ee649e0a5cc643255e95d7b);
        
    
            var marker_4910fdfa2d4941e690bdf63cbcb47cf2 = L.marker(
                [48.300418, 4.078149],
                {}
            ).addTo(map_9b5dd77c2ee649e0a5cc643255e95d7b);
        
    
        var popup_676a007feced4ab1959c2354ff98d13d = L.popup({"maxWidth": "100%"});

        
            var html_14dba61043ab40f593b555a7b881069c = $(`<div id="html_14dba61043ab40f593b555a7b881069c" style="width: 100.0%; height: 100.0%;"><i>Départ</i></div>`)[0];
            popup_676a007feced4ab1959c2354ff98d13d.setContent(html_14dba61043ab40f593b555a7b881069c);
        

        marker_4910fdfa2d4941e690bdf63cbcb47cf2.bindPopup(popup_676a007feced4ab1959c2354ff98d13d)
        ;

        
    
    
            var marker_54016f99e161442eb10e501c45440f73 = L.marker(
                [48.291131, 4.064502],
                {}
            ).addTo(map_9b5dd77c2ee649e0a5cc643255e95d7b);
        
    
        var popup_c41e08652dfe48d09489b71ddff9e72e = L.popup({"maxWidth": "100%"});

        
            var html_858a95b9ad784c95bbc4f32c1e14be0b = $(`<div id="html_858a95b9ad784c95bbc4f32c1e14be0b" style="width: 100.0%; height: 100.0%;"><i>Arrivée</i></div>`)[0];
            popup_c41e08652dfe48d09489b71ddff9e72e.setContent(html_858a95b9ad784c95bbc4f32c1e14be0b);
        

        marker_54016f99e161442eb10e501c45440f73.bindPopup(popup_c41e08652dfe48d09489b71ddff9e72e)
        ;

        
    
    
            var poly_line_f5ec4020c4aa4def9d9d564cb7d10506 = L.polyline(
                [[48.300613, 4.078559], [48.300602, 4.07857], [48.300597, 4.078591], [48.300583, 4.078615], [48.300561, 4.078646], [48.300547, 4.078638], [48.300241, 4.078961], [48.299996, 4.079186], [48.299963, 4.079247], [48.299831, 4.079382], [48.299809, 4.079395], [48.299798, 4.07937], [48.299788, 4.079348], [48.299769, 4.079346], [48.299619, 4.078984], [48.299598, 4.078934], [48.299554, 4.078826], [48.299327, 4.078376], [48.299273, 4.078272], [48.299221, 4.078189], [48.29909, 4.077949], [48.299083, 4.077936], [48.299073, 4.077913], [48.299062, 4.077928], [48.29904, 4.077887], [48.298935, 4.077697], [48.298945, 4.077684], [48.298933, 4.077645], [48.298912, 4.077575], [48.298895, 4.077576], [48.298848, 4.077463], [48.298516, 4.07662], [48.298417, 4.076405], [48.298124, 4.075799], [48.298071, 4.075682], [48.298016, 4.075568], [48.297584, 4.074767], [48.297577, 4.07474], [48.297537, 4.074776], [48.297517, 4.074819], [48.297493, 4.074831], [48.297473, 4.074857], [48.297253, 4.075133], [48.297243, 4.07516], [48.297243, 4.075194], [48.297216, 4.075227], [48.297197, 4.07525], [48.297182, 4.075224], [48.296892, 4.075609], [48.296872, 4.075632], [48.296838, 4.07557], [48.296797, 4.075495], [48.296785, 4.075472], [48.296662, 4.075241], [48.296478, 4.074851], [48.296314, 4.074477], [48.29621, 4.074242], [48.29614, 4.074054], [48.296108, 4.073969], [48.295941, 4.073554], [48.295779, 4.073207], [48.295753, 4.073151], [48.295665, 4.072963], [48.295562, 4.072744], [48.295498, 4.072607], [48.295339, 4.072267], [48.295302, 4.072188], [48.295189, 4.071842], [48.295145, 4.071707], [48.295111, 4.071598], [48.294998, 4.071277], [48.294883, 4.07091], [48.294685, 4.070167], [48.294633, 4.069972], [48.294629, 4.069863], [48.294643, 4.069742], [48.294628, 4.069697], [48.294625, 4.069687], [48.294568, 4.069525], [48.294512, 4.069331], [48.294437, 4.069071], [48.294152, 4.069067], [48.293963, 4.069036], [48.293938, 4.069032], [48.29393, 4.069041], [48.293806, 4.069181], [48.293797, 4.069161], [48.29378, 4.069127], [48.293729, 4.069025], [48.293654, 4.068895], [48.293605, 4.068797], [48.293586, 4.068755], [48.293538, 4.068659], [48.293508, 4.068602], [48.293445, 4.068676], [48.293439, 4.068681], [48.293396, 4.068732], [48.293364, 4.068776], [48.293366, 4.068789], [48.293362, 4.068801], [48.29332, 4.068851], [48.293217, 4.068977], [48.292994, 4.069257], [48.29183, 4.070329], [48.291814, 4.070325], [48.291768, 4.070365], [48.291729, 4.070399], [48.291726, 4.070422], [48.291487, 4.070665], [48.291463, 4.070686], [48.291435, 4.070691], [48.291354, 4.070667], [48.291314, 4.070626], [48.29129, 4.070587], [48.291238, 4.070459], [48.291213, 4.070332], [48.291096, 4.070067], [48.291042, 4.070017], [48.290308, 4.06828], [48.290228, 4.067934], [48.290133, 4.067764], [48.290046, 4.067832], [48.290002, 4.067866], [48.28998, 4.067887], [48.289957, 4.067956], [48.28994, 4.067995], [48.289918, 4.068029], [48.289863, 4.068033], [48.289712, 4.068059], [48.289673, 4.068041], [48.289645, 4.068011], [48.289587, 4.067965], [48.289556, 4.067968], [48.289537, 4.06789], [48.289472, 4.067763], [48.289399, 4.067532], [48.28937, 4.067497], [48.289371, 4.067432], [48.289375, 4.067363], [48.289384, 4.067299], [48.289409, 4.067201], [48.289463, 4.067112], [48.289485, 4.067075], [48.289511, 4.067038], [48.289517, 4.067022], [48.289557, 4.066942], [48.289595, 4.066886], [48.289622, 4.066871], [48.289644, 4.066866], [48.289687, 4.066857], [48.289781, 4.066944], [48.28981, 4.066756], [48.289808, 4.066634], [48.289791, 4.065979], [48.28984, 4.065959], [48.289834, 4.065499], [48.289871, 4.065246], [48.289871, 4.064899], [48.289902, 4.064894], [48.289947, 4.064879], [48.290131, 4.064819], [48.290212, 4.064793]],
                {"bubblingMouseEvents": true, "color": "#3388ff", "dashArray": null, "dashOffset": null, "fill": false, "fillColor": "#3388ff", "fillOpacity": 0.2, "fillRule": "evenodd", "lineCap": "round", "lineJoin": "round", "noClip": false, "opacity": 1.0, "smoothFactor": 1.0, "stroke": true, "weight": 3}
            ).addTo(map_9b5dd77c2ee649e0a5cc643255e95d7b);
        
</script>-->