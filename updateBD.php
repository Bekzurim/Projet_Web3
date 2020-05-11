<?php
include_once('connectDB.php');
				$id = $_SESSION['id'];
				$sql = 'SELECT image FROM annonceur WHERE id_annonceur='.$id;
				$result=mysqli_query($con,$sql);
				$row = mysqli_fetch_row($result);
				

				$nNom = $_POST['nom'];
				$nPrenom = $_POST['prenom'];
				$nPseudo = $_POST['pseudo'];
				$nPWD = $_POST['pwd'];
				$nAnniv = $_POST['anniv'];
				$nAdresse = $_POST['adresse'];
				$nCode = $_POST['codeP'];
				$nVille = $_POST['ville'];
				$nMail = $_POST['mail'];
				$nDescr = $_POST['descr'];
				$nImage = $_POST['photo'];
				if ($nImage==""){
					$nImage=$row[0];
				} else {
				$nImage="image/".$nImage;}
			
				$sql = 'UPDATE annonceur SET pseudonyme = "'.$nPseudo.'", nom = "'.$nNom.'", prenom = "'.$nPrenom.'", adresse = "'.$nAdresse.'", code_postal = '.$nCode.', ville = "'.$nVille.'", date_naissance = "'.$nAnniv.'", adresse_mail = "'.$nMail.'", description = "'.$nDescr.'", image = "'.$nImage.'", password = '.$nPWD.' WHERE id_annonceur = '.$id;
				mysqli_query($con,$sql);
				header('Location: Profil.php');
				exit;

?>