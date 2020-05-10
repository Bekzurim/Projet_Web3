<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ecogram</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
		<p class="text-center">
			<h1>Création de compte Ecogram</h1>
		</p>
			<form action="ajout_annonceur.php" method="post">
				<input type="text" name="mail" placeholder="E-mail" id="mail" required>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="text" name="nom" placeholder="Nom" id="nom" required>
				<input type="text" name="prenom" placeholder="Prénom" id="prenom" required>
				<input type="text" name="adresse" placeholder="Adresse" id="adresse" required>
				<input type="text" name="cp" placeholder="Code Postal" id="cp" required>
				<input type="text" name="ville" placeholder="Ville" id="ville" required>
				<input type="date" name="ddn" placeholder="Date" id="ddn" required></br>
				<a href="Login.html">Je possède déjà un compte</a>
				<input type="submit" value="Créer mon compte">
			</form>
		</div>
	</body>
</html>