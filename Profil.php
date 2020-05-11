<?php
session_start();
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon Profil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet" media="all" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
  <script src="https://d3js.org/d3.v5.min.js"></script>
  <script src="https://d3js.org/d3.v3.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
              
                    <i id="logo" class="fa fa-pagelines fa-3x" aria-hidden="true"></i>
                    <a class="navbar-brand col-2" ><?=$_SESSION['pseudo']?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse col-10" id="navbarNavDropdown">
                      <ul class="navbar-nav col-12">
                        <li class="nav-item active col-2">
                          <a class="nav-link " href="Accueil.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown col-3 ">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Mes Evenements
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#Creer_events">Créer mes évenements</a>
                                        <a class="dropdown-item" href="Listes_events.php">Listes de mes évenements</a>
                                        <a class="dropdown-item" href="Recherche_event.php">Rechercher un évenement</a>
                                      </div>
                                    </li>
                        <li class="nav-item col-3">
                          <a class="nav-link" href="Annonceur.php">Annonceur suivi</a>
                        </li>
                        <li class="nav-item col-2">
                            <a class="nav-link" href="Profil.php">Mon Profil</a>
                          </li>
                          <li class="nav-item col-3">
                          <a class="nav-link" href="Deconnexion.php"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
                          </li>
                          </ul>
    </div>
  </nav>
<?php 
$con = mysqli_connect('localhost','root','','ecogram');
$con2 = mysqli_connect('localhost','root','','ecogram');
$id = $_SESSION['id'];

$stmt = $con->prepare("SELECT nom,prenom,pseudonyme,adresse,code_postal,ville,date_naissance,adresse_mail,description,image FROM annonceur WHERE id_annonceur = ?");
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($nom,$prenom,$pseudonyme,$adresse,$code_postal,$ville,$date_naissance,$adresse_mail,$description,$image);
$stmt->fetch();
$stmt->store_result();
$stmt->close();

$stmt2 = $con->prepare("SELECT COUNT(id_annonceur1) FROM Suivre WHERE id_annonceur2 = ?");
$stmt2->bind_param('i', $_SESSION['id']);
$stmt2->execute();
$stmt2->bind_result($followers);
$stmt2->fetch();
$stmt2->store_result();
$stmt2->close();

$stmt3 = $con->prepare("SELECT COUNT(id_annonceur2) FROM Suivre WHERE id_annonceur1 = ?");
$stmt3->bind_param('i', $_SESSION['id']);
$stmt3->execute();
$stmt3->bind_result($following);
$stmt3->fetch();
$stmt3->store_result();
$stmt3->close();
?>
<div class="container">
	<div class="row">
		<div class=".col-6 .col-md-4">
			<img src="getImage.php?id=<?php echo $id ?>" height="300" width="200">
		</div>
		<div class="col-xs-12 col-sm-8">
			<h2 style="color:white"> <?php echo "$nom $prenom"; ?> </h2>
                    <p style="color:white"><strong>Pseudo :</strong> <?php echo $pseudonyme; ?> </p>
					<p style="color:white"><strong>Anniversaire :</strong> <?php echo $date_naissance; ?> </p>
					<p style="color:white"><strong>Mon adresse :</strong> <?php echo "$adresse $code_postal $ville"; ?> </p>
                    <p style="color:white"><strong>E-mail :</strong> <?php echo $adresse_mail; ?> </p>
                    <p style="color:white"><strong>Description :</strong> <?php echo $description; ?> </p>
					
					<input type="button" name="changeProfil" value="Changer mes informations" onclick="self.location.href='changeProfil.php'" style="background-color:green; border:double; color:white">
		</div>
	</div>
	<div class="row mt-3">
		<br>
		<div class="col">
			<div class="col-xs-12 col-sm-4 emphasis">
				<h2 style="color:white"><center><strong> <?php echo "$followers" ?> </strong></center></h2>                    
                <p style="color:white"><center style="color:white">Followers</center></p>
                <button class="btn btn-success btn-block"><span class="fas fa-eye" data-toggle="modal" data-target="#myModal"></span> <br> Voir </button>
				<!-- Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
    
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" style="color:black">Liste des personnes qui me suivent</h4>
							</div>
							<div class="modal-body" style="color:black">
								<?php
									$query = "SELECT nom,prenom FROM annonceur INNER JOIN Suivre WHERE annonceur.id_annonceur = Suivre.id_annonceur1 AND Suivre.id_annonceur2=".$_SESSION['id'];
									if ($con->multi_query($query)) {
										do {
											if ($result = $con->use_result()) {
												while ($row = $result->fetch_row()) {
													echo "$row[0] $row[1] <br>";
													}
												$result->close();
												}
											if ($con->more_results()) {
												}
											} 
											while ($con->next_result());
												}
								?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="col-xs-12 col-sm-4 emphasis">
				<h2 style="color:white"><center><strong> <?php echo "$following" ?> </strong></center></h2>                    
                <p><center style="color:white">Suivi<center></p>
                <button class="btn btn-info btn-block"><span class="fas fa-eye" data-toggle="modal" data-target="#myModal2"></span> <br> Voir </button>
				<!-- Modal -->
				<div class="modal fade" id="myModal2" role="dialog">
					<div class="modal-dialog">
    
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" style="color:black">Liste des personnes que je suis</h4>
							</div>
							<div class="modal-body" style="color:black">
								<?php
									$query = "SELECT nom,prenom FROM annonceur INNER JOIN Suivre WHERE annonceur.id_annonceur = Suivre.id_annonceur2 AND Suivre.id_annonceur1=".$_SESSION['id'];
									if ($con->multi_query($query)) {
										do {
											if ($result = $con->use_result()) {
												while ($row = $result->fetch_row()) {
													echo "$row[0] $row[1] <br>";
													}
												$result->close();
												}
											if ($con->more_results()) {
												}
											} 
											while ($con->next_result());
												}
								?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
							</div>
						</div>
					</div>
				</div>
            </div>
		</div>
		<div class="col">
			<div class="col-xs-12 col-sm-4 emphasis">
                    <h2 style='visibility: hidden'> 2 </h2>                    
                    <p><center style="color:white"> Statistiques </center></p>
                    <div class="dropdown">
						<button class="btn btn-secondary btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="fas fa-eye"></span> <br> Voir 
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" data-toggle="modal" data-target="#myModalS1">Généralités sur les évenements</a>
							<a class="dropdown-item" data-toggle="modal" data-target="#myModalS2-lg">Mes participations</a>
							<a class="dropdown-item" data-toggle="modal" data-target="#myModalS3">Ratio Like / Dislike</a>
							<a class="dropdown-item" data-toggle="modal" data-target="#myModalS4-lg">Mon nombre de commentaire</a>
						</div>
					</div>
            </div>
				<!-- Modal -->
				<div class="modal" id="myModalS1" role="dialog">
					<div class="modal-dialog">
    
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Généralités sur les évenements</h4>
							</div>
							<div class="modal-body" id="Chart">
								<?php
									$a = $con->prepare("SELECT COUNT(nom_event) FROM Evenement WHERE id_type = 1");
									$a->execute();
									$a->bind_result($marche);
									$a->fetch();
									$a->store_result();
									$a->close();
									$b = $con->prepare("SELECT COUNT(nom_event) FROM Evenement WHERE id_type = 2");
									$b->execute();
									$b->bind_result($assemble);
									$b->fetch();
									$b->store_result();
									$b->close();
									$c = $con->prepare("SELECT COUNT(nom_event) FROM Evenement WHERE id_type = 3");
									$c->execute();
									$c->bind_result($manif);
									$c->fetch();
									$c->store_result();
									$c->close();
									$d = $con->prepare("SELECT COUNT(nom_event) FROM Evenement WHERE id_type = 4");
									$d->execute();
									$d->bind_result($journee);
									$d->fetch();
									$d->store_result();
									$d->close();
									$e = $con->prepare("SELECT COUNT(nom_event) FROM Evenement WHERE id_type = 5");
									$e->execute();
									$e->bind_result($rassemblement);
									$e->fetch();
									$e->store_result();
									$e->close();
								?>
								<script>
									var newData = 
									[
										{
											count: <?php echo (int)$marche; ?>,
											emote: "Marche verte"
										},
										{
											count: <?php echo (int)$assemble; ?>,
											emote: "Assemblée générale"
										}, 
										{
											count: <?php echo (int)$manif; ?>,
											emote: "Manifestation"
										},
										{
											count: <?php echo (int)$journee; ?>,
											emote: "Journée mondiale"
										},
										{
											count: <?php echo (int)$rassemblement; ?>,
											emote: "Rassemblement"
										}

									]

									// Define size & radius of donut pie chart
									var width = 450,
									  height = 300,
									  radius = Math.min(width, height) / 2;

									// Define arc colours
									var colour = d3.scale.category20();

									// Define arc ranges
									var arcText = d3.scale.ordinal()
									  .rangeRoundBands([0, width], .1, .3);

									// Determine size of arcs
									var arc = d3.svg.arc()
									  .innerRadius(radius - 130)
									  .outerRadius(radius - 10);

									// Create the donut pie chart layout
									var pie = d3.layout.pie()
									  .value(function(d) {
										return d.count;
									  })
									  .sort(null);

									// Append SVG attributes and append g to the SVG
									var mySvg = d3.select("#Chart").append("svg")
									  .attr("width", width)
									  .attr("height", height);

									var svg = mySvg
									  .append("g")
									  .attr("transform", "translate(" + radius + "," + radius + ")");

									var svgText = mySvg
									  .append("g")
									  .attr("transform", "translate(" + radius + "," + radius + ")");

									// Define inner circle
									svg.append("circle")
									  .attr("cx", 0)
									  .attr("cy", 0)
									  .attr("r", 100)
									  .attr("fill", "#fff");

									// Calculate SVG paths and fill in the colours
									var g = svg.selectAll(".arc")
									  .data(pie(newData))
									  .enter().append("g")
									  .attr("class", "arc");

									// Append the path to each g
									g.append("path")
									  .attr("d", arc)
									  //.attr("data-legend", function(d, i){ return parseInt(newData[i].count) + ' ' + newData[i].emote; })
									  .attr("fill", function(d, i) {
										return colour(i);
									  });

									var textG = svg.selectAll(".labels")
									  .data(pie(newData))
									  .enter().append("g")
									  .attr("class", "labels");

									/* Append text labels to each arc
									textG.append("text")
									  .attr("transform", function(d) {
										return "translate(" + arc.centroid(d) + ")";
									  })
									  .attr("dy", ".200em")
									  .style("text-anchor", "middle")
									  .attr("fill", "#fff")
									  .attr("width",10)
									  .attr("height",10)
									  .text(function(d, i) {
										return d.data.count > 0 ? d.data.emote : ''; 
									  }); */
									
									var legendG = mySvg.selectAll(".legend")
									  .data(pie(newData))
									  .enter().append("g")
									  .attr("transform", function(d,i){
										return "translate(" + (width - 110) + "," + (i * 15 + 20) + ")";
									  })
									  .attr("class", "legend");   
									
									legendG.append("rect")
									  .attr("width", 10)
									  .attr("height", 10)
									  .attr("fill", function(d, i) {
										return colour(i);
									  });
									
									legendG.append("text")
									  .text(function(d){
										return d.data.emote;
									  })
									  .style("font-size", 12)
									  .attr("y", 10)
									  .attr("x", 11);
								</script>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal" id="myModalS2-lg" role="dialog">
					<div class="modal-dialog modal-lg">
    
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Mes participations</h4>
							</div>
							<div class="modal-body" id="containerChart2">
								<?php
									$query="SELECT * FROM Participer WHERE id_annonceur=".$_SESSION['id'];
									$result = mysqli_query($con, $query);
								?>
								<script>
									$(document).ready(function () {
										var jsonData = [
											{ "Description": "Marche verte", "truc": "0" },
											{ "Description": "Assemblée générale", "truc": "0" },
											{ "Description": "Manifestation", "truc": "0" },
											{ "Description": "Journée mondiale", "truc": "0" },
											{ "Description": "Rassemblement", "truc": "0" }
										];
										
										<?php 
										$taille = 0;
										while($event = $result -> fetch_array()){
											if( $event[2] == '1'){
												$taille = $taille + 1;
												?>parseInt(jsonData[0].truc);
												jsonData[0].truc = jsonData[0].truc + 1;
												String(jsonData[0].truc);
												JSON.stringify(jsonData[0].truc);
												<?php
											}
											else if( $event[2] == '2'){
												$taille = $taille + 1;
												?>parseInt(jsonData[1].truc);
												jsonData[1].truc = jsonData[1].truc + 1;
												String(jsonData[1].truc);
												JSON.stringify(jsonData[1].truc);<?php
											}
											else if( $event[2] == '3'){
												$taille = $taille + 1;
												?>parseInt(jsonData[2].truc);
												jsonData[2].truc = jsonData[2].truc + 1;
												String(jsonData[2].truc);
												JSON.stringify(jsonData[2].truc);<?php
											}
											else if( $event[2] == '4'){
												$taille = $taille + 1;
												?>parseInt(jsonData[3].truc);
												jsonData[3].truc = jsonData[3].truc + 1;
												String(jsonData[3].truc);
												JSON.stringify(jsonData[3].truc);<?php
											}
											else if( $event[2] == '5'){
												$taille = $taille + 1;
												?>parseInt(jsonData[4].truc);
												jsonData[4].truc = jsonData[4].truc + 1;
												String(jsonData[4].truc);
												JSON.stringify(jsonData[4].truc);<?php
											}
											else{
												echo "Erreur";
											}
										};
										
										$result -> close(); ?>
										
								 
										var svgWidth = 750;
										var svgHeight = 400;
								 
										var heightPad = 50;
										var widthPad = 15;
								 
										var svg = d3.select("#containerChart2")
											.append("svg")
											.attr("width", svgWidth + (widthPad * 1.5))
											.attr("height", svgHeight + (heightPad * 1.5))
											.append("g")
											.attr("transform", "translate(" + widthPad + "," + heightPad + ")");
								 
										//Set up scales
										var xScale = d3.scale.ordinal()
											.domain(jsonData.map(function(d) { return d.Description; }))
											.rangeRoundBands([0, svgWidth], .1);
								 
									   var yScale = d3.scale.linear()
											.domain([0, <?php echo (int)$taille + 5; ?>])
											.range([svgHeight,0]);
								 
									   // Create bars
										svg.selectAll("rect")
											.data(jsonData)
											.enter().append("rect")
											.attr("x", function (d) { return xScale(d.Description) + widthPad; })
											.attr("y", function (d) { return yScale(d.truc); })
											.attr("height", function (d) { return svgHeight - yScale(d.truc); })
											.attr("width", xScale.rangeBand())
											.attr("fill", "blue");
								 
										// Y axis
										var yAxis = d3.svg.axis()
											.scale(yScale)
											.orient("left");
								 
										svg.append("g")
											.attr("class", "axis")
											.attr("transform", "translate(" + widthPad + ",0)")
											.call(yAxis)
										 .append("text")
											.attr("transform", "rotate(-90)")
											.attr("y", -50)
											.style("text-anchor", "end")
											.text( " ");
								 
										// X axis
										var xAxis = d3.svg.axis()
										.scale(xScale)
										.orient("bottom");
								 
										svg.append("g")
											.attr("class", "axis")
											.attr("transform", "translate(" + widthPad + "," + svgHeight + ")")
											.call(xAxis)
										 .append("text")
											.attr("x", svgWidth / 2 - widthPad)
											.attr("y", 50)
											.text(" ");
								 
									});
								</script>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal" id="myModalS3" role="dialog">
					<div class="modal-dialog">
    
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Ratio Like / Dislike</h4>
							</div>
							<div class="modal-body" id="containerChart">
								<?php
									$stmt4 = $con->prepare("SELECT COUNT(id_post) FROM likes_dislikes WHERE id_annonc = ? AND action = 'like'");
									$stmt4->bind_param('i', $_SESSION['id']);
									$stmt4->execute();
									$stmt4->bind_result($likeD);
									$stmt4->fetch();
									$stmt4->store_result();
									$stmt4->close();
									$stmt5 = $con->prepare("SELECT COUNT(id_post) FROM likes_dislikes WHERE id_annonc = ? AND action = 'dislike'");
									$stmt5->bind_param('i', $_SESSION['id']);
									$stmt5->execute();
									$stmt5->bind_result($dislikeD);
									$stmt5->fetch();
									$stmt5->store_result();
									$stmt5->close();
									
								?>
								<script>
									$(document).ready(function () {
										var jsonData = [
											{ "Description": "Like donné", "truc": <?php echo $likeD; ?> },
											{ "Description": "Dislike donné", "truc": <?php echo $dislikeD; ?> },
											{ "Description": "Like reçu", "truc": String(Math.ceil(Math.random() * 3)) },
											{ "Description": "Dislike reçu", "truc": String(Math.ceil(Math.random() * 3)) }
										];
								 
										var svgWidth = 450;
										var svgHeight = 300;
								 
										var heightPad = 50;
										var widthPad = 15;
								 
										var svg = d3.select("#containerChart")
											.append("svg")
											.attr("width", svgWidth + (widthPad * 1.5))
											.attr("height", svgHeight + (heightPad * 1.5))
											.append("g")
											.attr("transform", "translate(" + widthPad + "," + heightPad + ")");
								 
										//Set up scales
										var xScale = d3.scale.ordinal()
											.domain(jsonData.map(function(d) { return d.Description; }))
											.rangeRoundBands([0, svgWidth], .1);
								 
									   var yScale = d3.scale.linear()
											.domain([0, <?php echo (int)$likeD + (int)$dislikeD +6; ?>])
											.range([svgHeight,0]);
								 
									   // Create bars
										svg.selectAll("rect")
											.data(jsonData)
											.enter().append("rect")
											.attr("x", function (d) { return xScale(d.Description) + widthPad; })
											.attr("y", function (d) { return yScale(d.truc); })
											.attr("height", function (d) { return svgHeight - yScale(d.truc); })
											.attr("width", xScale.rangeBand())
											.attr("fill", "blue");
								 
										// Y axis
										var yAxis = d3.svg.axis()
											.scale(yScale)
											.orient("left");
								 
										svg.append("g")
											.attr("class", "axis")
											.attr("transform", "translate(" + widthPad + ",0)")
											.call(yAxis)
										 .append("text")
											.attr("transform", "rotate(-90)")
											.attr("y", -50)
											.style("text-anchor", "end")
											.text( " ");
								 
										// X axis
										var xAxis = d3.svg.axis()
										.scale(xScale)
										.orient("bottom");
								 
										svg.append("g")
											.attr("class", "axis")
											.attr("transform", "translate(" + widthPad + "," + svgHeight + ")")
											.call(xAxis)
										 .append("text")
											.attr("x", svgWidth / 2 - widthPad)
											.attr("y", 50)
											.text(" ");
								 
									});
								</script>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal" id="myModalS4-lg" role="dialog">
					<div class="modal-dialog modal-lg">
    
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Mon nombre de commentaire</h4>
							</div>
							<div class="modal-body" id="chartContainer2" style="height: 415px; width: 200%;">
								<?php
									include_once 'graph.php';
									
								?>
								<script type="text/javascript">
									var datagraph = <?php echo $marker ?>

									window.onload = function () {
										var chart = new CanvasJS.Chart("chartContainer2",
										{
										  title:{
											text: " "
										},
										axisX:{
											title: "Date",
											gridThickness: 2
										},
										axisY: {
											title: "Nombre de commentaire"
										},
										data: [
										{        
											type: "area",
											dataPoints: datagraph
										}
										]
									});

										chart.render();
									}
								</script>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
							</div>
						</div>
					</div>
				</div>
		</div>
</div>
</body>
</html>