<?php
require_once('../includes/config.php');
require('../includes/scripts/javascript.php');

if(!$user->is_logged_in()){ header('Location: login.php'); }

if(isset($_GET['delUsers'])){ 

	if($_GET['delUsers'] !='11'){

		$selMember = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID') ;
		$selMember->execute(array(':memberID' => $_GET['delUsers']));

		header('Location: users.php?action=deleted');
		exit;

	}
} 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Users</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script language="JavaScript" type="text/javascript">
  function delUsers(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'users.php?delUsers=' + id;
	  }
  }

  </script>
</head>
<body>

	<div id="wrapper">

	<?php include('menu.php');?>

	<?php 
	if(isset($_GET['action'])){ 
		echo '<h3>User '.$_GET['action'].'.</h3>'; 
	} 
	?>

	<table id="userTable">
	<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		try {

			$selMember = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY username');
			while($row = $selMember->fetch()){
				
						
				echo '<tr>';
				echo '<td>'.$row['username'].'</td>';
				echo '<td>'.$row['email'].'</td>';
				?>

				<td>
					
					<?php if($row['memberID'] != User::ADMIN_ID ){?>
						<a href="edit-user.php?id=<?php echo $row['memberID'];?>">Edit</a> 
						| <a href="javascript:delUsers('<?php echo $row['memberID'];?>','<?php echo $row['username'];?>')">Delete</a>

					<?php } ?>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</tbody>
	</table>

	<p><a href='add-user.php'>Add User</a></p>

</div>

</body>
</html>
