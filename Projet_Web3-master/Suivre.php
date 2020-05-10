<?php
include_once 'connectDB.php';
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}

$id1=$_POST["id1"];
$id2=$_POST["id2"];
$action=$_POST["id3"];
if ($action=="follow"){

$sql = "INSERT INTO Suivre (id_annonceur1, id_annonceur2)
VALUES (".$id1.",".$id2.")";
mysqli_query($con, $sql);
mysqli_close($con);
header('Location: Annonceur.php');
exit;
}
elseif ($action=="unfollow"){
    $sql = "DELETE FROM Suivre WHERE id_annonceur1=".$id1." AND id_annonceur2=".$id2;
    mysqli_query($con, $sql);
    mysqli_close($con);
    header('Location: Annonceur.php');
    exit; 
}
?>