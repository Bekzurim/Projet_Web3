<?php
include_once 'connectDB.php';
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}

$id1=$_POST["id1"];
$id2=$_POST["id2"];
$id3=$_POST["id3"];
$action=$_POST["id4"];
if ($action=="participe"){

$sql = "INSERT INTO Participer (id_annonceur, id_evenement,id_type)
VALUES (".$id1.",".$id2.",".$id3.")";
mysqli_query($con, $sql);
mysqli_close($con);
header('Location: Listes_events.php');
exit;
}
elseif ($action=="unparticipe"){
    $sql = "DELETE FROM Participer WHERE id_annonceur=".$id1." AND id_evenement=".$id2;
    mysqli_query($con, $sql);
    mysqli_close($con);
    header('Location: Listes_events.php');
    exit; 
}
?>