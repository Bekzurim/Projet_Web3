<?php
include_once 'connectDB.php';

if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}
$d=strtotime("now");
$date=date( "Y-m-d", $d );
$heure=date("H:i:s",$d);
$contenu=$_POST['contenu'];
$id=$_SESSION['id'];
$query='INSERT INTO Actualite VALUES("","'.$date.'","'.$heure.'","'.$contenu.'","'.$id.'")';

//printf("%s\n", $query);
$con->query($query);
$con->close();
header('Location: Accueil.php');
exit;