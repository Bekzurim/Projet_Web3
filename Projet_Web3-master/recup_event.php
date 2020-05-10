<?php
include_once 'connectDB.php';
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}
if (!empty($_POST['recherche'])){
    if (!empty($_POST['Nom']))
{
    if (!empty($_POST['Ville']))
    { 
        if (!empty($_POST['cdpost']))
        { 
            if (!empty($_POST['adr']))
            { 
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE nom_event='".$_POST['Nom']."' AND ville_event='".$_POST['Ville']."' AND code_postal_event=".$_POST['cdpost']." AND adresse_event='".$_POST['adr']."'";
            } else {
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE nom_event='".$_POST['Nom']."' AND ville_event='".$_POST['Ville']."' AND code_postal_event=".$_POST['cdpost'];
            }
        } else {
            if (!empty($_POST['adr'])){
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE nom_event='".$_POST['Nom']."' AND ville_event='".$_POST['Ville']."' AND adresse_event='".$_POST['adr']."'";
            } else {
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE nom_event='".$_POST['Nom']."' AND ville_event='".$_POST['Ville']."'";
            }
        }
    }else {
        if (!empty($_POST['cdpost'])){
            if (!empty($_POST['adr'])){
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE nom_event='".$_POST['Nom']."' AND code_postal_event=".$_POST['cdpost']." AND adresse_event='".$_POST['adr']."'";
            } else {
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE nom_event='".$_POST['Nom']."' AND code_postal_event=".$_POST['cdpost'];
            }
        } else {
            if (!empty($_POST['adr'])){
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE nom_event='".$_POST['Nom']."' AND adresse_event='".$_POST['adr']."'";
            } else {
                
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE nom_event='".$_POST['Nom']."'";
            }
        }
    }
}
else {
    if (!empty($_POST['Ville'])){
        if (!empty($_POST['cdpost'])){
            if (!empty($_POST['adr'])){
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE ville_event='".$_POST['Ville']."' AND code_postal_event=".$_POST['cdpost']." AND adresse_event='".$_POST['adr']."'";
            } else {
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE ville_event='".$_POST['Ville']."' AND code_postal_event=".$_POST['cdpost'];
            }
        } else {
            if (!empty($_POST['adr'])){
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE ville_event='".$_POST['Ville']."' AND adresse_event='".$_POST['adr']."'";
            } else {
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE  ville_event='".$_POST['Ville']."'";
            }
        }
    }else {
        if (!empty($_POST['cdpost'])){
            if (!empty($_POST['adr'])){
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE code_postal_event=".$_POST['cdpost']." AND adresse_event='".$_POST['adr']."'";
            } else {
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE code_postal_event=".$_POST['cdpost'];
            }
        } else {
            if (!empty($_POST['adr'])){
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement WHERE adresse_event='".$_POST['adr']."'";
            } else {
                $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement ";
	exit;
            }
        }
    }
}

$recherche=true;
}else { $sql = "SELECT id_evenement,nom_event,longitude,latitude FROM Evenement ";
$recherche=false;}


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
$_SESSION['marker']=$marker;
$_SESSION['recherche']=$recherche;

if ($recherche){
header('Location: Recherche_event.php');
exit;}
?>

