<?php 
session_start(); 
if (isset($_POST['mail'])){
				$mail = $_POST['mail'];
			 	$username = $_POST['username'];
				$password = $_POST['password'];
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$adresse = $_POST['adresse']; 
				$cp  = $_POST['cp'];
				$ville = $_POST['ville'];
				$ddn = $_POST['ddn'];
				
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
				
				
		        if ($reponse = mysqli_prepare($con,'INSERT INTO annonceur(pseudonyme,nom,prenom,adresse,code_postal,ville, date_naissance, adresse_mail,password)
		        	VALUES ( ?, ?, ?, ?, ?, ?,?,?, ?)')){
		        mysqli_stmt_bind_param($reponse, 'sssssssss', $username,$nom, $prenom, $adresse, $cp, $ville, $ddn, $mail, $password);
				mysqli_stmt_execute($reponse);
				echo "<script>alert(\"Compte créer\")</script>";
				header('Location: Login.html');
				} else {
					echo "Error updating record: " . mysqli_error($con);
				}
					 } 

					 ?>