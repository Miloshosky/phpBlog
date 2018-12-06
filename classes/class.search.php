<?php 
require('../includes/config.php'); 
require('../includes/displayErrors.php');
require('../includes/html.php');
require('../includes/header.php');
require('../includes/footer.php');
	

	$conn = mysqli_connect('localhost', 'root', '', 'blog')  or die("Connecting to database failed");
?>

	<div id="wrapper">
		
	<?php

		$querySearch = $_GET['querySearch'];

		$minLength = 3;
		
		if (strlen($querySearch) >= $minLength)
		{
			$querySearch = htmlspecialchars($querySearch);


			$querySearch = mysqli_real_escape_string($conn, $querySearch);

			$query = mysqli_query($conn, "SELECT * FROM blog_posts WHERE postTitle LIKE '% $querySearch %' OR postTitle LIKE '%$querySearch %'"); 
			
			$count = mysqli_num_rows($query);

			if($count != 0)
			{	
				while ($row = mysqli_fetch_array($query))
				{
					$output = '';
					$title = $row['postTitle'];
					$description = $row['postDesc'];
					$output .= '<h2>'.$title.'</h2>';
					$output .= '<p>'.$description.'</p>';
					$output .= '<p><a href="../viewpost.php?id='.$row['postID'].'">Read More</a></p><hr>'; 	
					echo $output;
				}
			} 
			else
			{
				echo 'There is no matching results';
			}
		}

		else {
			echo 'Minimum length is: '.$minLength.'!';
		}
	?>

</div>
