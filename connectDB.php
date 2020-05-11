<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ecogram';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
function info($id)
{
  global $con;
  $sql = "SELECT * FROM annonceur 
  		  WHERE id_annonceur = $id" ;
  $rs = mysqli_query($con, $sql);
  $result = mysqli_fetch_array($rs,MYSQLI_ASSOC);
  return $result;
}


?>