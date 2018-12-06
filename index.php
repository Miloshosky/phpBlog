<?php 
require('includes/config.php'); 
require('includes/displayErrors.php');
require('includes/html.php');
require('includes/header.php');
require('includes/footer.php');


?>
<div id="wrapper">
		<?php
			try {
				$pages = new Paginator('5','p'); //PAGINATION NOT WORKING YET 

				$selPosts = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID ASC '); //.$pages->get_limit()

				$pages->set_total($selPosts->rowCount());


				while($row = $selPosts->fetch()){
					
					echo '<div>';
						echo '<h2><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h2>';
						echo '<p>Posted on <span class="postDate">'.date('jS M Y', strtotime($row['postDate'])).'</span></p>';
						echo '<p>'.$row['postDesc'].'</p>';				
						echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';
						echo '<hr>';				
					echo '</div>';
				
				}

				echo $pages->page_links();

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		?>
</div>