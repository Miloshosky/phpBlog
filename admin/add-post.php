<?php 
require_once('../includes/config.php');


if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add Post</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="./">Blog Admin Index</a></p>

	<h2>Add Post</h2>

	<?php

	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		
		extract($_POST);

	
		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}
		if($postTags == ''){
			$error[] = 'Please enter tags (comma separated)';
		}

		if(!isset($error)){

			try {

				$selPosts = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate, postTags) VALUES (:postTitle, :postDesc, :postCont, :postDate, :postTags)') ;
				$selPosts->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postDate' => date('Y-m-d'),
					':postTags' => $postTags
				));

			
				header('Location: index.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}


	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p> <label>Title</label><br />
		<input type='text' name='postTitle' class='wideInput' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

		<div class="tooltip">
		<p><label>Tags (comma separated)</label><span class="tooltiptext"> Use keywords from your title </span><br />
		<input type="text" name="postTags" class='wideInput' value='<?php if (isset($error)){ echo $_POST['postTags'];}?>'></input></p>

		</div>
		<p><input type='submit' name='submit' value='Submit'></p>

	</form>

</div>
