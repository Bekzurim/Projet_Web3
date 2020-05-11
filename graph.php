<?php
include_once('connectDB.php');
$sql = "SELECT DISTINCT DateA FROM Actualite WHERE id_annonceur=".$_SESSION['id'];


$result = mysqli_query($con, $sql);

if(!$result) print_r($con->error);
while($don = $result->fetch_array())
{
$dons[] = $don;
}

$marker="[";
$cpt=0;
foreach($dons as $don){
    $query="SELECT COUNT(dateA) FROM Actualite WHERE dateA ='".$don['DateA']."' AND id_annonceur=".$_SESSION['id'];
    
    $result = mysqli_query($con, $query);
    $count = $result->fetch_array();



    $marker.=( $cpt !== count( $dons ) -1 ) ? "{x : new Date('".$don["DateA"]."'), y:".$count["COUNT(dateA)"]."}," : "{x :new Date('".$don["DateA"]."'), y:".$count["COUNT(dateA)"]."}";
    $cpt=$cpt+1;

}
$marker.="]";

?>