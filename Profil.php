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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <i id="logo" class="fa fa-pagelines fa-3x"  aria-hidden="true"></i>
    <a class="navbar-brand col-2" ><?=$_SESSION['pseudo']?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse col-10" id="navbarNavDropdown">
      <ul class="navbar-nav col-12">
        <li class="nav-item active col-3">
          <a class="nav-link " href="Accueil.php">Accueil </a>
        </li>
        <li class="nav-item dropdown col-3 ">
                <a class="nav-link dropdown-toggle" href="#Mes_evenements" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <li class="nav-item col-3">
            <a class="nav-link" href="Profil.php">Mon Profil</a>
          </li>

          
      </ul>
    </div>
  </nav>	  
<div class="container">
	<div class="row">
		<div class=".col-6 .col-md-4">
			<img src="https://cdn.pixabay.com/photo/2019/08/11/11/28/man-4398724_960_720.jpg" height="300" width="200">
		</div>
		<div class="col-xs-12 col-sm-8">
			<h2>Jean Jacques</h2>
                    <p><strong>Pseudo :</strong> Jacqouille </p>
					<p><strong>Mon adresse :</strong> 25 rue des jackouil 42420 GoldmanLand </p>
                    <p><strong>E-mail :</strong> Jacques@gmail.com </p>
                    <form>
						<div class="form-group">
							<label for="exampleFormControlInput1"><strong>Description :</strong></label>
							<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Quelques mots sur moi">
						</div>
					</form>
		</div>
	</div>
	<div class="row mt-3">
		<br>
		<div class="col">
			<div class="col-xs-12 col-sm-4 emphasis">
				<h2><strong> 20,7K </strong></h2>                    
                <p><small>Followers</small></p>
                <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Follow </button>
			</div>
		</div>
		<div class="col">
			<div class="col-xs-12 col-sm-4 emphasis">
				<h2><strong>245</strong></h2>                    
                <p><small align="">Following</small></p>
                <button class="btn btn-info btn-block"><span class="fa fa-user"></span> View Profile </button>
            </div>
		</div>
		<div class="col">
			<div class="col-xs-12 col-sm-4 emphasis"> 
				<h2><strong>245</strong></h2>                    
                <p><small>Ché pas</small></p>
                <button class="btn btn-info btn-block"><span class="fa fa-user"></span> ZerZer </button>
            </div>
		</div>
</div>
</body>
</html>