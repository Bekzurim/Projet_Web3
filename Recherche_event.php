<?php
include_once 'recup_event.php';
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}

?>
<!doctype html>
<html lang="fr">
	<head>
		<title>Ecogram</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
	<script type="application/javascript" src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
		<script type="text/javascript">
      </script>
      <link href="style.css" rel="stylesheet" media="all" type="text/css"> 
      
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
                  
                  
                  <div class="d-inline col-12" >
                    <fieldset >
                      <legend style="text-align:center">Carte des évenements :</legend>
                    <div id="macarte"></div>
                  </fieldset>
                </div>
                  <script>
                      var mymap = L.map('macarte').setView([46.3630104, 2.9846608], 6);
                      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
  }).addTo(mymap);  
  

  var clusterLayer = L.markerClusterGroup();
		
    var popup = L.popup();
    var markers=<?php echo $marker?>;
      for (m in markers) {
		marker = L.marker([markers[m].lat, markers[m].lng], {
			id: markers[m].id
		})
		.addTo(clusterLayer)

		marker.bindPopup('<form method="post" action="pageEvent.php" class="inline"><input type="hidden" name="extra_submit_param" value="extra_submit_value"><button type="submit" name="id_event" value="'+markers[m].id+'" class="link-button">'+markers[m].name+'</button></form>');
		marker.on('click', function (e) {
			this.openPopup();
		});
	}	
		
	mymap.addLayer(clusterLayer);
     
  </script>
                    




	</body>
</html> 