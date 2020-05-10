<?php
include_once 'connectDB.php';
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}


$result = mysqli_query($con, $sql);
while($don = $result->fetch_array())
{
$dons[] = $don;
}
$marker="[";
$cpt=0;
foreach($dons as $don){
    $marker.=( $cpt !== count( $dons ) -1 ) ? "{id :".$don["id_evenement"].", lat:".$don["latitude"].", lng:".$don["longitude"].", name:'".$don["nom_event"]."'}," : "{id :".$don["id_evenement"].", lat:".$don["latitude"].", lng:".$don["longitude"].", name:'".$don["nom_event"]."'}";
    $cpt=$cpt+1;

}
$marker.="]";

header('Location: Recherche_event.php');
exit;
?>

