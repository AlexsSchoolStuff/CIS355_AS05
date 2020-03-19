<?php
session_start();
echo $_SESSION['personTitle'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>List of Users</h3>
    		</div>
			<div class="row">
			<?php
			if ($_SESSION['personTitle']==1){
			echo '<p>
					<a href="person_create.php" class="btn btn-success">Add Person</a>
				</p>';
			}
			?>
				
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Name</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   require '../../database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM AS05_person ORDER BY personID DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['personName'] . '</td>';
								if ($_SESSION['personTitle']==1){
								
							   	echo '<td width=250>';
							   	echo '<a class="btn" href="person_read.php?id='.$row['personID'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="person_update.php?id='.$row['personID'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="person_delete.php?id='.$row['personID'].'">Delete</a>';
							   	echo '</td>';
								}
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>