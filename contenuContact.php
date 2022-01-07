<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/general.css">
	<link rel="stylesheet" href="../style/specifique_apropos.css">
<style>
 .tabs i {
   margin-right: 0.4em;
 }
 
 .tabs {
  left: 50%;
  width: 80%;
  transform: translateX(-50%);
  position: relative;
  background: white;
  padding: 1.2em;
  min-width: 240px;
}
.tabs input[name="tab-control"] {
  display: none;
}
.tabs .content section h2,
.tabs ul li label {
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif !important; 
  letter-spacing: 2px;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 18px;
  color: #003a73;
}
.tabs ul {
  list-style-type: none;
  padding-left: 0;
  display: flex;
  flex-direction: row;
  margin-bottom: 10px;
  justify-content: space-between;
  align-items: flex-end;
  flex-wrap: wrap;
}
.tabs ul li {
  box-sizing: border-box;
  flex: 1;
  width: 25%;
  padding: 0 10px;
  text-align: center;
}
.tabs ul li label {
  transition: all 0.3s ease-in-out;
  color: #333333;
  padding: 5px auto;
  overflow: hidden;
  text-overflow: ellipsis;
  display: block;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  white-space: nowrap;
  -webkit-touch-callout: none;
}
.tabs ul li label br {
  display: none;
}
.tabs ul li label:hover,
.tabs ul li label:focus,
.tabs ul li label:active {
  outline: 0;
  color: #a3a3a3;
}

.tabs .slider {
  position: relative;
  width: 25%;
  transition: all 0.33s cubic-bezier(0.38, 0.8, 0.32, 1.07);
}
.tabs .slider .indicator {
  position: relative;
  width: 50px;
  max-width: 100%;
  margin: 0 auto;
  height: 4px;
  background: #003a73;
  border-radius: 1px;
}

.tabs .content section {
  display: none;
  animation-name: content;
  animation-direction: normal;
  animation-duration: 0.3s;
  animation-timing-function: ease-in-out;
  animation-iteration-count: 1;
  line-height: 1.4;
  margin-top: 3em;
}
.tabs .content section h2 {
  color: #003a73;
  display: none;
}
.tabs .content section h2::after {
  content: "";
  position: relative;
  display: block;
  width: 30px;
  height: 3px;
  background: #003a73;
  margin-top: 5px;
  left: 1px;
}
.tabs
  input[name="tab-control"]:nth-of-type(1):checked
  ~ ul
  > li:nth-child(1)
  > label {
  cursor: default;
  color: #003a73;
}

.tabs .content section h5 {
  color: #003a73 ;
}

@media (max-width: 600px) {
  .tabs
    input[name="tab-control"]:nth-of-type(1):checked
    ~ ul
    > li:nth-child(1)
    > label {
    background: rgba(0, 0, 0, 0.08);
  }
}
.tabs input[name="tab-control"]:nth-of-type(1):checked ~ .slider {
  transform: translateX(0%);
}
.tabs
  input[name="tab-control"]:nth-of-type(1):checked
  ~ .content
  > section:nth-child(1) {
  display: block;
}
.tabs
  input[name="tab-control"]:nth-of-type(2):checked
  ~ ul
  > li:nth-child(2)
  > label {
  cursor: default;
  color: #003a73;
}


@media (max-width: 600px) {
  .tabs
    input[name="tab-control"]:nth-of-type(2):checked
    ~ ul
    > li:nth-child(2)
    > label {
    background: rgba(0, 0, 0, 0.08);
  }
}
.tabs input[name="tab-control"]:nth-of-type(2):checked ~ .slider {
  transform: translateX(100%);
}
.tabs
  input[name="tab-control"]:nth-of-type(2):checked
  ~ .content
  > section:nth-child(2) {
  display: block;
}
.tabs
  input[name="tab-control"]:nth-of-type(3):checked
  ~ ul
  > li:nth-child(3)
  > label {
  cursor: default;
  color: #003a73;
}


@media (max-width: 600px) {
  .tabs
    input[name="tab-control"]:nth-of-type(3):checked
    ~ ul
    > li:nth-child(3)
    > label {
    background: rgba(0, 0, 0, 0.08);
  }
}
.tabs input[name="tab-control"]:nth-of-type(3):checked ~ .slider {
  transform: translateX(200%);
}
.tabs
  input[name="tab-control"]:nth-of-type(3):checked
  ~ .content
  > section:nth-child(3) {
  display: block;
}
.tabs
  input[name="tab-control"]:nth-of-type(4):checked
  ~ ul
  > li:nth-child(4)
  > label {
  cursor: default;
  color: #003a73;
}

@media (max-width: 600px) {
  .tabs
    input[name="tab-control"]:nth-of-type(4):checked
    ~ ul
    > li:nth-child(4)
    > label {
    background: rgba(0, 0, 0, 0.08);
  }
}
.tabs input[name="tab-control"]:nth-of-type(4):checked ~ .slider {
  transform: translateX(300%);
}
.tabs
  input[name="tab-control"]:nth-of-type(4):checked
  ~ .content
  > section:nth-child(4) {
  display: block;
}


@keyframes content {
  from {
    opacity: 0;
    transform: translateY(5%);
  }
  to {
    opacity: 1;
    transform: translateY(0%);
  }
}

@media (max-width: 1000px) {
  .tabs ul li label {
    white-space: initial;
  }
  .tabs ul li label br {
    display: initial;
  }

}
@media (max-width: 600px) {
  .tabs ul li label {
    padding: 5px;
    border-radius: 5px;
  }
  .tabs ul li label span {
    display: none;
  }
  .tabs .slider {
    display: none;
  }
  .tabs .content {
    margin-top: 20px;
  }
  .tabs .content section h2 {
    display: block;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif !important; 
    font-size: 30px;
    letter-spacing: 5px;
    text-transform: uppercase;
    padding-bottom: 2em;
  }
}
/** ****************************************************
 *                Section bloc 'CONTACT'
 ***************************************************** */
form {
   padding: 1em;
   box-sizing: content-box;
 }

 .contact fieldset {
   padding: 0 2em 4em 2em;
   border: 2px double #ddd;
 }

 .contact label {
  display: block;
  margin-top: 1.4em;
 }
 .contact legend {
  font-size: 20px;
  padding: 0.8em;
  color: #333333;
 }

.contact input, 
.contact textarea,
.contact select {
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
	background-color: #fff;
	background-image: none;
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        	box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
	-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
	     -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
	        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
 }

.contact input {
  display: block;
  height:14px;
  width: 90%;
}
.contact textarea {
  width: 90%;
}

.contact input:focus,
.contact textarea:focus,
.contact select:focus {
	border-color: #66afe9;
	outline: 0;
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
	        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6)
}

.tabs .content  ul {
  list-style-type:square !important;
  display: block !important;
  padding-left: 2em;
  width: 100% !important;
}

.tabs .content ul  li {
  text-align: left !important;
  color: #333;
  font-weight: 300;
  width: 100% !important;
}



/** ****************************************************
 *                Section bloc 'CREDITS'
 ***************************************************** */
  .equipe {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
  }  

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: 2em;
  text-align: center;
}
.card:hover {
  box-shadow: 0 4px 8px 0  rgba(0, 0, 0, 0.4);
}
.card_info_equipe h1 {
  color: rgb(0, 0, 0);
  font-size: 20px;
  text-transform: none;
  letter-spacing: 0px;
  font-weight: 500;
}

.card p{
  font-weight: 350;
}

.card button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #333333;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.card button:hover {
  background-color: #003a73;
}

.card a {
  text-decoration: none;
  font-size: 18px;
  color: rgb(255, 255, 255);
}

.card_info_equipe{
  padding: 1.5em 0em;
}


/** ****************************************************
 *            Section bloc 'REFERENCES'
 ***************************************************** */

 .references_bloc{
   padding-bottom: 3em;
 }
 .references_bloc a {
    text-decoration : none;
    color :#da2127;
 }
 .references_bloc a:hover{
     text-decoration : none;
     color :#da2127;
 }
/** ****************************************************
 *            Section bloc 'CHARTE GRAPHIQUE'
 ***************************************************** */
 .ux {
   text-align: center;
 }
 .t1{
  text-align: center;
  margin: 0 auto;
}
h4 {
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; 
  font-size: 1.2em;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin: 40px 0px 20px 0px;
}
hr{
  height: 0.2px;
  background-color: #333333;
  color: #333333;
}
 .mockup {
   width: 90%;
   height: 90%;
   padding-bottom: 4em;
 }

 .ux_bloc_color,
 .ux_bloc_typo{
   display: flex;
   flex-direction: row;
   flex-wrap: wrap;
   justify-content: space-around;
   align-items: center;
   padding-bottom: 2em;
 }

.ux_color {
  max-width: 300px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  font-size: 0.8em;
  text-align: center;
  margin: 1.2em 0;
}

.ux_color_rect {
  width: 180px;
  height: 48px;
  border-top-left-radius: 18px;
  border-bottom-right-radius: 18px;
}

.ux_color_code {
  color: #666;
}

.clr_primaire{
  background-color: #003a73;
}

.clr_secondaire{
  background-color: #da2127;
}

.clr_defaut_txt{
  background-color: #333333;
}

.clr_bg_bleu_clair{
  background-color: #dde7f0;
}


.ux_typo_font {
  font-size: 1.2em;
  padding-bottom: 1em;
}

.ux_typo_fira_sans,
.ux_typo_trebuchet {
  padding: 1em;
}

.ux_typo_taille{
  border-top: 1px solid #dedede;
  font-size: 0.65;
  font-weight: 300;
}

.font1_100,
.font1_800, 
.font1_400i  {
  font-family: 'Fira Sans', sans-serif;
  font-size: 16px;
}
.font2_100,
.font2_800, 
.font2_400i  {
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif !important; 
  /* text-transform: uppercase; */
  font-size: 16px;
}
  
.font1_100, 
.font2_100 {
  font-weight: 100;
}

.font1_800, 
.font2_800  {
  font-weight: 800;
}
.font1_400i, 
.font2_400i{
  font-weight: 400;
  font-style: italic;
}

@media screen and (max-width: 960px) {
  .equipe {
    flex-direction: column;
  }
  .footer  {
    position: inherit;
    bottom:0;
  }
}



</style>


<div class="tabs">
				<!-- noms des sections -->
				<input type="radio" id="tab1" name="tab-control" checked>
				<input type="radio" id="tab2" name="tab-control">
				<input type="radio" id="tab3" name="tab-control">
				<input type="radio" id="tab4" name="tab-control">
				<ul>
					<li><label for="tab1" role="button">
						<i class="fa fa-comments-o"></i><br><span>Votre avis</span></label>
					</li>
					<li><label for="tab2" role="button">
					  <i class="fa fa-user"></i><br><span>L'équipe</span></label>
					</li>
					<li><label for="tab3" role="button">
						<i class="fa fa-info"></i><br><span>Références</span></label>
					</li>
					<li><label for="tab4" role="button">
						<i class="fa fa-cogs"></i><br><span>Contexte</span></label>
					</li>
				</ul>
			  
				<div class="slider">
				  <div class="indicator"></div>
				</div>
	
				<div class="content">

					<!-- section "contact" -->
					<section class="contact">
						<h2>Votre avis</h2>
						<fieldset>
							<legend>Votre avis nous intéresse</legend> 
						
							<form action="mailto:theo.le_vot@utt.fr" method="post" accept-charset="utf-8">
								<label for="nom">Nom complet:</label>
								<input type="text" name="nom" maxlength="25" placeholder="NOM Prénom"  required>
							
								<label for="mail">Adresse e-mail :</label>
								<input type="text" name="mail" placeholder="prénom.nom@utt.fr" required>
	
								<label for="age">Age</label>
								<input type="number" name="age" value="19" min="19" max="100" required>
	
								<label for="statut">Vous êtes ?</label>
								<select name="statut" id="statut" required>
									<option value="handicap" selected="selected">En situation de handicap</option>
									<option value="nonHandicap">Pas en situation de handicap</option>
									<option value="Autre">Autre</option>
								</select>
	
								<label for="message">Votre message :</label>
								<textarea id="message" name="message" rows="6" cols="100" required>...</textarea>
	
								<br/><br/>
								<button type="submit" class="bouton" value="Envoyer">Envoyer</button>
							</form>
						</fieldset>
					</section>

					<!-- section "équipe" -->
					<section>
						<h2>L'équipe</h2>
						<div class="equipe">
							<div class="card">
								<img src="image/theo.png" alt="Theo" style="width:100%">
								<div class="card_info_equipe">
									<h1>Théo LE VOT</h1>
									<p>Étudiant à l'UTT (ISI1)</p>
								</div>
								<p><button>
									<a href="mailto:theo.le_vot@utt.fr"><i class="fa fa-envelope"></i>theo.le_vot@utt.fr</a>
								</button></p>
							</div>
	
							<div class="card">
								<img src="image/mathieu.png" alt="Mathieu" style="width:100%">
								<div class="card_info_equipe">
									<h1>Mathieu LE TREUST</h1>
									<p>Étudiante à l'UTT (ISI1)</p>
								</div>
								<p><button>
									<a href="mailto:mathieu.le_treust@utt.fr"><i class="fa fa-envelope"></i>mathieu.le_treust@utt.fr</a>
								</button></p>
							</div>

                            <div class="card">
								<img src="image/yann.png" alt="Yann" style="width:100%">
								<div class="card_info_equipe">
									<h1>Yann DAUVE</h1>
									<p>Étudiant à l'UTT (ISI1)</p>
								</div>
								<p><button>
									<a href="mailto:yann.dauve@utt.fr"><i class="fa fa-envelope"></i>yann.dauve@utt.fr</a>
								</button></p>
							</div>
						</div>  
					</section>
	
					<!-- section "références" -->
					<section>
						<h2>Références</h2>
						<div class="references_bloc">
							Ci-dessous, sources qui ont permis de mener à bien ce projet.<br/><br/>
							Tutoriels vidéos pour apprendre le PHP: <br><br>
							<ul>
								<li><a target="_blank" href="https://www.lequipe.fr/">1 - Débuter en PHP - Les bases (PHP8)</a></li>
								<li><a target="_blank" href="https://youtu.be/GTlWnub31SQ">2 - Débuter en PHP - Manipuler les chaînes de caractères (PHP8))</a></li>
								<li><a target="_blank" href="https://youtu.be/TsOFRKrHBI8">3 - Débuter en PHP - Manipuler les nombres (PHP8)</a></li>
								<li><a target="_blank" href="https://youtu.be/lZ2iQzjtcFM">4 - Débuter en PHP - Utiliser les tableaux (PHP8)</a></li>
								<li><a target="_blank" href="https://youtu.be/h2Edgd7QSoc">5 - Débuter en PHP - Utiliser les formulaires en méthode GET (PHP8)</a></li>
								<li><a target="_blank" href="https://youtu.be/iRVcXRhKW3U">6 - Débuter en PHP - Utiliser les fonctions (PHP8)</a></li>
								<li><a target="_blank" href="https://youtu.be/axjWjmHKwOs">7 - Débuter en PHP - Conditions et opérateurs de comparaison (PHP8)</a></li>
								<li><a target="_blank" href="https://youtu.be/STBmuYTsFMk">8 - Débuter en PHP - Les boucles for et foreach (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/2YWZZOMSPws">9 - Débuter en PHP - PDO et CRUD - MySQL (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/-_CKbVev_qA">10 - Débuter en PHP - Diviser le code avec include et require (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/SdFANLAbsOc">11 - Débuter en PHP - Les requêtes préparées - PDO (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/dKnu9sdVfsA">12 - Débuter en PHP - Afficher des données venant de la base MySQL (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/2mYZOt0zFuc">13 - Débuter en PHP - Enregistrer les données d'un formulaire dans la base MySQL (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/wyC5wVeFQNk">14 - Débuter en PHP - Inscription et authentification des utilisateur (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/hStHizOJZ8Y">15 - Débuter en PHP - Envoyer des fichiers depuis un formulaire (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/jJiAFwOU6g0">16 - Débuter en PHP - La session PHP (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/yFbYcgIUdqU">17 - Débuter en PHP - Manipuler les images (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/SXKzTjxXW88">18 - Débuter en PHP - Envoyer des emails (PHP8)</a></li>
                                <li><a target="_blank" href="https://youtu.be/-GIa7-rLOMY">19 - Débuter en PHP - Générer des fichiers PDF (PHP8)</a></li>
							</ul>        
							Documention (sources, lib...) pour les développements WEB: <br><br>
							<ul>    
								<li><a target="_blank" href="https://www.w3schools.com/howto/" target="_blank">W3school</a> (navbar, slideshow, flip-card, profile-card, parallax...)</li>
								<li><a target="_blank" href="https://github.com/CodyHouse/vertical-timelineL" target="_blank">Github</a> (vertical timeline, animate on Scroll library)</li>
							</ul>
						</div>
					</section>
					

					<!-- section "ux/ui design" -->
					<section class="ux">
						<h2 style="text-align:left;">Contexte</h2>
                        <h3>Handi'Mov, c'est quoi ?</h3>
						<p>Handi'Mov est un site destiné à aider les personnes à mobilité réduite (PMR) dans leur déplacement quotidient.<br/>
                            Ainsi, il offre plusieurs fonctionnalités à ses utilisateurs leur permettant de rechercher un itinéraire ou un établissement adaptés à leur mobilité.</p>
                        <h3>Pourquoi Handi'Mov ?</h3>
                        <p>Handi'Mov a été développé dans le cadre d'un projet étudiant au sein de l'Université de Techonologie de Troyes (UTT). 
                            <br/>En effet, dans le cadre de l'Unité d'Enseignement IF37 ('Conception Responsable de Systèmes Interactifs'), nous devions répondre à un problème sur le thème que l'inclusivité.
                        Notre choix s'est alors dirigé vers les personnes à mobilité réduite qui regroupent un nombre important d'individus.<br/>
                    Handi'Mov s'adresse donc à un public varié : personnes âgées, femmes enceintes, personnes en situation de handicap moteur, handicap visuel, etc. <br/></p>
					</section>
				  
	
				  </div>
			  </div>