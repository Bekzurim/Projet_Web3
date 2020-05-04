<?php
include_once 'connectDB.php';
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}

$id=$_POST["id_event"];

$query="SELECT * FROM Evenement WHERE id_evenement=".$id;
$result = mysqli_query($con, $query);
$event = $result->fetch_array();

$query2="SELECT pseudonyme FROM Annonceur WHERE id_annonceur=".$event["id_annonceur"];
$result = mysqli_query($con, $query2);
$createur = $result->fetch_array();

$query3="SELECT libelle FROM TypeEvent WHERE id_type=".$event["id_type"];
$result = mysqli_query($con, $query3);
$typeevent = $result->fetch_array();




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

<div class="container">
	<div class="row">
		<div class="col" >
            <img src="https://pixabay.com/get/55e0d64a4352ad14f6d1867dda35367b1d37d8e55650794a_1920.jpg" height="300" width="500" style="float:left">
        <div>
            <div class="col">
			<h2> <?php echo $event["nom_event"]; ?> </h2>
					<p><strong>Adresse evenement :</strong> <?php echo "".$event["code_postal_event"]." ". $event["adresse_event"]." ". $event["ville_event"]; ?> </p>
                    <p><strong>Horaire :</strong> <?php echo "le ".$event["DateE"]." de ".$event["heure_debut"]."h à ".$event["heure_fin"]."h"; ?> </p>
                    <p><strong>Description :</strong> <?php echo $event["description_event"]; ?> </p>
                    <p><strong>Crée par :</strong> <?php echo $createur[0]; ?> </p>
                    <p><strong>Genre de l'évenement :</strong> <?php echo $typeevent[0]; ?> </p>
		</div>
    </div>
</div>