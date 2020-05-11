<?php
session_start();
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}
?>
<?php

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ecogram';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <link rel="stylesheet"href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
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
                                        <a class="dropdown-item" href="Creation_event.php">Créer mes évenements</a>
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
  	  		<h1 align="center"><font color="white">Création d'un évenement :</font></h1>
			
			<form action="AjoutEvent.php" method="post">
				<div class="row justify-content-around">
					<div class="col-4" >
							<label id="lNom" for="Nom" class="mr-sm-2" >Nom de l'évenement:</label>
							<input name="Nom" class="form-control " type="text" placeholder="Nom ..." required>
							<label id="lVille" for="Ville" class="mr-sm-2" >Ville de l'évenement:</label>
							<input name="Ville" class="form-control " type="text" placeholder="Ville ..." >
							<label id="lcdpost" for="cdpost" class="mr-sm-2 ">Code Postal de l'évenement:</label>
							<input name="cdpost" class="form-control " type="text" placeholder="Code Postal ..." >
							<label id="ladr" for="adr" class="mr-sm-2" >Adresse de l'évenement:</label>
							<input name="adr" class="form-control " type="text" placeholder="Adresse ...">
							<label id="lDateE" for="adr" class="mr-sm-2" >Date de l'évenement:</label>
							<input name="DateE" class="form-control " type="date" required>
					</div>
					<div class="col-4" >
							<label id="lHeureD" for="adr" class="mr-sm-2" >Heure de début de l'évenement:</label>
							<input name="HeureD" class="form-control " type="time" >
							<label id="lHeureF" for="adr" class="mr-sm-2" >Heure de fin de l'évenement:</label>
							<input name="HeureF" class="form-control " type="time" >
							<label id="lLatitude" for="adr" class="mr-sm-2" >Latitude:</label>
							<input name="Latitude" class="form-control " type="number" step=0.01 >
							<label id="lLongitude" for="adr" class="mr-sm-2" >Longitude:</label>
							<input name="Longitude" class="form-control " type="number" step=0.01>
							<label id="lDescription" for="adr" class="mr-sm-2" >Description de l'évenement:</label>
							<textarea name="Description" class="form-control " ></textarea>
							<label id="lType" for="adr" class="mr-sm-2" >Type d'évenement:</label>
							<select name="Type" name="Type">
							<?php
							$reponse = mysqli_query($con,'SELECT libelle,id_type FROM TypeEvent'); 
							while ($donnees = $reponse->fetch_assoc())
							{
							?>
									   <option id ="<?php echo $donnees['libelle']; ?>" value=<?php echo $donnees['id_type']; ?>> <?php echo $donnees['libelle']; ?></option>
							<?php
							}
							?>
							</select>
							
					</div>
					
				</div>
				<div class="row justify-content-around">
				<div class="col-4" >
				<button class="btn btn-primary float-right" type="submit" Value = "Valider">Valider</button>
				</div>
				</div>
			</form>
						
                    

  <script src="script.js"></script>
</body>
</html>