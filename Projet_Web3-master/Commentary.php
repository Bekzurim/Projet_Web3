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
echo print_r($_FILES["file"]);

if ($_FILES["file"]["type"]=="image/jpg" || $_FILES["file"]["type"]=="image/png" || $_FILES["file"]["type"]=="image/gif"){
	$img=$_FILES["file"]["name"];
}
else {
	$video=$_FILES["file"]["name"];
}
$id=$_SESSION['id'];
if ($img==""){
	if ($video==""){
		$query='INSERT INTO Actualite(id_actualite,dateA,heureA,contenue,id_annonceur) VALUES("","'.$date.'","'.$heure.'","'.$contenu.'","'.$id.'")';
	} else {
		$query='INSERT INTO Actualite(id_actualite,dateA,heureA,contenue,video,id_annonceur) VALUES("","'.$date.'","'.$heure.'","'.$contenu.'","'.$video.'","'.$id.'")';
}} else {
		$query='INSERT INTO Actualite(id_actualite,dateA,heureA,contenue,image,id_annonceur) VALUES("","'.$date.'","'.$heure.'","'.$contenu.'","'.$img.'","'.$id.'")';
	
}
//printf("%s\n", $query);
$con->query($query);
$con->close();
header('Location: Accueil.php');
exit;