<?php

  $id = .$_SESSION['id'];
  // do some validation here to ensure id is safe

  $link = mysqli_connect('localhost','root','','ecogram');
  mysql_select_db("ecogram");
  $sql = "SELECT image FROM annonceur WHERE id_annonceur=$id";
  $result = mysql_query("$sql");
  $row = mysql_fetch_assoc($result);
  mysql_close($link);

  header("Content-type: image/jpeg");
  echo $row['image'];
?>