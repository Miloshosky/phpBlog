<?php 
require('includes/config.php'); 
require('includes/config.php'); 
require('includes/displayErrors.php');
require('includes/html.php');
require('includes/header.php');
require('includes/footer.php');

$selPost = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$selPost->execute(array(':postID' => $_GET['id']));
$row = $selPost->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
	<div id="wrapper">

		<p><a href="./index.php">Blog Index</a></p>

		
		<?php	
			echo '<div>';
				echo '<h2>'.$row['postTitle'].'</h2>';
				echo '<p>Posted on <span class="postDate">'.date('jS M Y', strtotime($row['postDate'])).'</span></p>';
				echo '<p>'.$row['postCont'].'</p>';				
			echo '</div>';
		?>

	</div>