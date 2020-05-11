<?php 
session_start(); 
if (isset($_POST['Nom'])
			 AND isset($_POST['DateE']) ){
			 	$nom = $_POST['Nom'];
				$ville = $_POST['Ville'];
				$cd = $_POST['cdpost'];
				$adresse = $_POST['adr'];
				$DateE = $_POST['DateE']; 
				$HeureD  = $_POST['HeureD'];
				$HeureF = $_POST['HeureF'];
				$Latitude = $_POST['Latitude'];
				$Longitude = $_POST['Longitude'];
				$Description = $_POST['Description'];
				$Type = $_POST['Type'];
				
				$Annonceur = $_SESSION['pseudo'];
				// Param
				$DATABASE_HOST = 'localhost';
				$DATABASE_USER = 'root';
				$DATABASE_PASS = '';
				$DATABASE_NAME = 'ecogram';
				// Connexion
				$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
				if ( mysqli_connect_errno() ) {
					// If there is an error with the connection, stop the script and display the error.
					exit('Failed to connect to MySQL: ' . mysqli_connect_error());
				}
				
				global $Annonceur ;
				$sql = 'SELECT id_annonceur FROM annonceur Where pseudonyme = ?';
				if ($requete = mysqli_prepare($con, $sql)){
					mysqli_stmt_bind_param($requete, 's', $Annonceur);
					mysqli_stmt_execute($requete);
					$requete->store_result();
					$requete->bind_result($id);
					mysqli_stmt_fetch($requete);
				
					mysqli_stmt_close($requete);
				}	
				 else {
					echo "Error updating record: " . mysqli_error($con);
				}
				
		        if ($reponse = mysqli_prepare($con,'INSERT INTO Evenement(nom_event,ville_event,code_postal_event,adresse_event,DateE,heure_debut, heure_fin, longitude,latitude ,description_event,id_type,id_annonceur)
		        	VALUES ( ?, ?, ?, ?, ?, ?,?,?, ?, ?, ?,?)')){
		        mysqli_stmt_bind_param($reponse, 'sssssssddsii', $nom,$ville, $cd, $adresse, $DateE, $HeureD, $HeureF, $Longitude,$Latitude, $Description, $Type, $id);
				mysqli_stmt_execute($reponse);
				$countLogin = mysqli_stmt_num_rows($reponse);
				 header('Location: Creation_event.php');
				} else {
					echo "Error updating record: " . mysqli_error($con);
				}
					 } 

					 ?>