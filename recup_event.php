<?php
include_once 'connectDB.php';

$sql = "SELECT id_evenement,longitude,latitude FROM Evenement ";
$result = mysqli_query($con, $sql);
// fetch all posts from database
// return them as an associative array called $posts
while($don = $result->fetch_array())
{
$dons[] = $don;
}
$sql="SELECT COUNT(id_evenement) FROM Evenement";
$result = mysqli_query($con, $sql);
$num = mysqli_fetch_array($result);
$marker="[";
$cpt=0;
foreach($dons as $don){
    $marker.=( $cpt !== count( $dons ) -1 ) ? "{id :".$don["id_evenement"].", lat:".$don["latitude"].", lng:".$don["longitude"]."}," : "{id :".$don["id_evenement"].", lat:".$don["latitude"].", lng:".$don["longitude"]."}";
    $cpt=$cpt+1;

}
$marker.="]";
?>

