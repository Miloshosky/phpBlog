<?php 
require('includes/config.php'); 
require('includes/displayErrors.php');
require('includes/html.php');
require('includes/header.php');
require('includes/perPageDropdown.php');
require('includes/scripts/javascript.php');


?>



<div id="wrapper">
		<?php
			try 
			{
				$_perPage = isset($_GET['_perPage']) ? $_GET['_perPage'] : 3;

				$pages = new Paginator($_perPage,'p');
				
				$selPosts = $db->query('SELECT postID FROM blog_posts');
				$pages->set_total($selPosts->rowCount());
				$selPosts = $db->query('SELECT postID, postTitle, postDesc, postDate, postTags FROM blog_posts ORDER BY postID DESC '.$pages->get_limit());
				while($row = $selPosts->fetch())
				{
					echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
					echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
					echo '<p class="cpd">'.$row['postDesc'].'</p>';				
					echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p><hr>';
				}
			echo $pages->page_links();
			} 
			catch(PDOException $e) 
			{
	    		echo $e->getMessage();
			}
		?>

<?php

require('includes/footer.php');

?>

<!-- DA SE NAPRAVI TAGS INPUT SO BOOTSTRAP, DA SE SREDI IZGLEDOT KAKO SHTO E ZAMISLEN I DA SE FINISHIRA POTPOLNO SO SITE DODATOCI DA E SPREMNO ZA PREZENTACIJA -->