<?php 
include_once 'connectDB.php';
if (!isset($_SESSION['islog'])) {
	header('Location: Login.html');
	exit;
}

$user_id = $_SESSION['id'];



if (isset($_POST['action'])) {
  $post_id = $_POST['post_id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO likes_dislikes (id_annonc, id_post, action) 
         	   VALUES ($user_id, $post_id, 'like') 
         	   ON DUPLICATE KEY UPDATE action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO likes_dislikes (id_annonc, id_post, action) 
               VALUES ($user_id, $post_id, 'dislike') 
         	   ON DUPLICATE KEY UPDATE action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM likes_dislikes WHERE id_annonc=$user_id AND id_post=$post_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM likes_dislikes WHERE id_annonc=$user_id AND id_post=$post_id";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($con, $sql);
  echo getRating($post_id);
  exit(0);
}

// Get total number of likes for a particular post
function getLikes($id)
{
  global $con;
  $sql = "SELECT COUNT(*) FROM likes_dislikes 
  		  WHERE id_post = $id AND action='like'";
  $rs = mysqli_query($con, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $con;
  $sql = "SELECT COUNT(*) FROM likes_dislikes 
  		  WHERE id_post = $id AND action='dislike'";
  $rs = mysqli_query($con, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $con;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM likes_dislikes WHERE id_post = $id AND action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM likes_dislikes 
		  			WHERE id_post = $id AND action='dislike'";
  $likes_rs = mysqli_query($con, $likes_query);
  $dislikes_rs = mysqli_query($con, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($post_id)
{
  global $con;
  global $user_id;
  $sql = "SELECT * FROM likes_dislikes WHERE id_annonc=$user_id 
  		  AND id_post=$post_id AND action='like'";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  global $con;
  global $user_id;
  $sql = "SELECT * FROM likes_dislikes WHERE id_annonc=$user_id 
  		  AND id_post=$post_id AND action='dislike'";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

$sql = "SELECT * FROM Actualite";
$result = mysqli_query($con, $sql);
// fetch all posts from database
// return them as an associative array called $posts
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);