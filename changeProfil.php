<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Modification du Profil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
  <link rel="stylesheet"href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
  <link href="style.css" rel="stylesheet" media="all" type="text/css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
  <script src="https://d3js.org/d3.v5.min.js"></script>
  <script src="https://d3js.org/d3.v3.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>

	<?php
		include_once 'connectDB.php';
        $con = mysqli_connect('localhost','root','','ecogram');
        $stmt = $con->prepare("SELECT nom,prenom,pseudonyme,adresse,code_postal,ville,date_naissance,adresse_mail,description,image,password FROM annonceur WHERE id_annonceur = ?");
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
		$stmt->bind_result($nom,$prenom,$pseudo,$adresse,$code_postal,$ville,$date_naissance,$adresse_mail,$description,$image,$pwd);
        $stmt->fetch();
        $stmt->store_result();
		$stmt->close();  
    ?>
	<form method="post" action="updateBD.php">
	<div class="container">
		<div class="row">
			<div class="col">
			<br>
			<br>
				<span class="req-input valid">
					<p style="color:white"><strong>Changer le nom : </strong><input style="background-color:green; border:none; color:white" type="text" data-min-length="15" placeholder="Mon nom" value="<?php echo $nom; ?>" name="nom"></p>
				</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Changer le prénom : </strong><input style="background-color:green; border:none; color:white" type="text" data-min-length="15" placeholder="Mon prénom" value="<?php echo $prenom; ?>" name="prenom"></p>
				</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Changer le pseudo : </strong><input style="background-color:green; border:none; color:white" type="text" data-min-length="15" placeholder="Mon pseudo" value="<?php echo $pseudo; ?>" name="pseudo"></p>
				</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Changer le mot de passe : </strong><input style="background-color:green; border:none; color:white" type="password" data-min-length="15" placeholder="Mot de passe" value="<?php echo $pwd; ?>" id="pwd" name="pwd"> <input type="checkbox" onclick="showPWD()"> Montrer mon mot de passe</p>
				</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Changer ma date de naissance : </strong><input style="background-color:green; border:none; color:white" vertical-align: middle;" type="text" data-min-length="15" placeholder="Pour avoir des cadeaux" value="<?php echo $date_naissance; ?>" name="anniv"></p>
				</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Changer ma rue : </strong><input style="background-color:green; border:none; color:white" type="text" data-min-length="15" placeholder="Ma rue ?" value="<?php echo $adresse; ?>" name="adresse"></p>
				</span>
			</div>
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Mon code postal : </strong><input style="background-color:green; border:none; color:white" type="text" data-min-length="10" placeholder="Mon code postal" value="<?php echo $code_postal; ?>" name="codeP"></p>
				</span>
			</div>
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Ma ville : </strong><input style="background-color:green; border:none; color:white" type="text" data-min-length="15" placeholder="Ma ville ?" value="<?php echo $ville; ?>" name="ville"></p>
				</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Changer d'e-mail : </strong><input style="background-color:green; border:none; color:white" type="text" data-min-length="15" placeholder="Pour reçevoir plein de newsletter" value="<?php echo $adresse_mail; ?>" name="mail"></p>
				</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Changer ma description : </strong><input style="background-color:green; border:none; color:white" type="text" size = "100" placeholder="Quelques mots sur moi" value="<?php echo $description; ?>" name="descr"></p>
				</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<span class="req-input valid">
					<p style="color:white"><strong>Changer de photos de profil : </strong><input style="background-color:green; border:none; color:white" type="file" accept="image/png,image/jpg" value="<?php echo $image?>" name="photo"></p>
				</span>
			</div>
		</div>
		<br>
		<div class="row submit-row">
			<input  type="submit"  style="border:solid; color:white" class="btn btn-block submit-form valid" value="Changer et revenir au profil" ></button>
		</div>
	</div>
	</form>
	
	<script>
		function showPWD(){
			var x = document.getElementById("pwd");
			if (x.type === "password") {
				x.type = "text";
			} 
			else {
				x.type = "password";
			}
		}
	</script>
	
</body>
</html>