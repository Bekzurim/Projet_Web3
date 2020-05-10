<?php
session_start();
include_once 'connectDB.php';
if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Veuillez remplir les deux champs');
}
if ($stmt = $con->prepare("SELECT id_annonceur,pseudonyme,password FROM annonceur WHERE pseudonyme = ?")) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id,$pseudo,$password);
		$stmt->fetch();
		if ($_POST['password'] === $password) {
			session_regenerate_id();
			$_SESSION['islog'] = TRUE;
			$_SESSION['id'] = $id;
			$_SESSION['pseudo'] = $pseudo;
			
			header('Location: Accueil.php');
		} else {
			header('Location: Login.html');
		}
	} else {
		header('Location: Login.html');
	}

	$stmt->close();
}
?>