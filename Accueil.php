<?php
include_once('Chatsystem.php');


if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
  exit;
}
$suiteposts=array_slice($posts,5);
$posts=array_slice($posts,0,5)
?>
<!doctype html>
<html lang="fr">
	<head>
		<title>Ecogram</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <link rel="stylesheet"href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
		<script type="text/javascript">
      </script>
      <link href="style.css" rel="stylesheet" media="all" type="text/css"> 
      
    </head>
    <body>
      
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              
                    <i id="logo" class="fa fa-pagelines fa-3x" aria-hidden="true"></i>
                    <a class="navbar-brand col-2" ><?=$_SESSION['pseudo']?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse col-10" id="navbarNavDropdown">
                      <ul class="navbar-nav col-12">
                        <li class="nav-item active col-2">
                          <a class="nav-link " href="Accueil.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown col-3 ">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Mes Evenements
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#Creer_events">Créer mes évenements</a>
                                        <a class="dropdown-item" href="Listes_events.php">Listes de mes évenements</a>
                                        <a class="dropdown-item" href="Recherche_event.php">Rechercher un évenement</a>
                                      </div>
                                    </li>
                        <li class="nav-item col-3">
                          <a class="nav-link" href="Annonceur.php">Annonceur suivi</a>
                        </li>
                        <li class="nav-item col-2">
                            <a class="nav-link" href="Profil.php">Mon Profil</a>
                          </li>
                          <li class="nav-item col-3">
                          <a class="nav-link" href="Deconnexion.php"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
                          </li>
                          </ul>
    </div>
  </nav>

  <form  id="commentaires" enctype="multipart/form-data" action="Commentary.php" method="post" >
  <input type="text" name="contenu" id="contenu" placeholder="Entrer votre commentaire" size="55" minlength="1" />
  <label for="file" class="label-file">Publier une image ou une video</label>
  <input type="file" id="file" name="file" class="input-file" accept="image/*,.mp4,.doc">
  <input class="ecobutton" type="submit" value="Publier">
  </form>
  <div class="posts-wrapper">
   <?php foreach ($posts as $post): ?>
    
   	<div class="post">
     <div class="auteur">
     <?php 
     $info=info($post['id_annonceur']);
     echo '<img src="'.$info['image'].'">';
     echo "Ecrit par ".$info['pseudonyme']." le ".$post['dateA']." à ".$post['heureA']." : ";?>
    </div>
      <?php if ($post['image']!=NULL){

        echo '<img class="com" src="image/'.$post['image'].'" height="200" width="200" align="center">';
        
      }
      if ($post['video']!=NULL){
        echo '<video controls width="250">
        <source src="video/'.$post['video'].'"
                type="video/mp4">
    
        Vous ne pouvez pas lire ces vidéos.
    </video>';
      }
      echo '<div class="com">'.$post['contenue'].'</div>';
      ?>
      <div class="post-info">
	    <!-- if user likes post, style button differently -->
      	<i <?php if (userLiked($post['id_actualite'])): ?>
      		  class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post['id_actualite'] ?>"></i>
      	<span class="likes"><?php echo getLikes($post['id_actualite']); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes post, style button differently -->
      	<i 
      	  <?php if (userDisliked($post['id_actualite'])): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post['id_actualite'] ?>"></i>
      	<span class="dislikes"><?php echo getDislikes($post['id_actualite']); ?></span>
      </div>
     </div>
   <?php endforeach ?>
  </div>
  <div class="posts-wrapper">
   <?php foreach ($suiteposts as $post): ?>
    
   	<div class="post" id="suite">
     <div class="auteur">
     <?php 
     $info=info($post['id_annonceur']);
     echo '<img src="'.$info['image'].'">';
     echo "Ecrit par ".$info['pseudonyme']." le ".$post['dateA']." à ".$post['heureA']." : ";?>
    </div>
      <?php if ($post['image']!=NULL){

        echo '<img class="com" src="image/'.$post['image'].'" height="200" width="200" align="center">';
        
      }
      if ($post['video']!=NULL){
        echo '<video controls width="250">
        <source src="video/'.$post['video'].'"
                type="video/mp4">
    
        Vous ne pouvez pas lire ces vidéos.
    </video>';
      }
      echo '<div class="com">'.$post['contenue'].'</div>';
      ?>
      <div class="post-info">
	    <!-- if user likes post, style button differently -->
      	<i <?php if (userLiked($post['id_actualite'])): ?>
      		  class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post['id_actualite'] ?>"></i>
      	<span class="likes"><?php echo getLikes($post['id_actualite']); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes post, style button differently -->
      	<i 
      	  <?php if (userDisliked($post['id_actualite'])): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post['id_actualite'] ?>"></i>
      	<span class="dislikes"><?php echo getDislikes($post['id_actualite']); ?></span>
      </div>
     </div>
   <?php endforeach ?>
  </div>
  <button onclick="myFunction()" id="myBtn">Voir des commentaires plus anciens</button>
  <script src="script.js"></script>
  <script> 
$('.input-file').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('.input-file')[0].files[0].name;
  $(this).prev('label').text(file);
});

function myFunction() {
  var suite = document.getElementById("suite");
  var btnText = document.getElementById("myBtn");

  if (suite.style.display === "block") {
    btnText.innerHTML = "Voir des commentaires plus anciens";
    suite.style.display = "none";
  } else {
    btnText.innerHTML = "Ne Voir que les commentaires récents";
    suite.style.display = "block";
  }
} 
</script>
</body>
</html>