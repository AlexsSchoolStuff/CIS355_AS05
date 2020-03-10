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
    			<h3>Fish File</h3>
    		</div>
			<div class="row">
				<p>
					<a href="fish_create.php" class="btn btn-success">Add</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Species</th>
		                  <th>Weight</th>
		                  <th>Length</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   require '../../database.php';
					   
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM AS05_fish ORDER BY fishID DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['fishSpecies'] . '</td>';
							   	echo '<td>'. $row['fishWeight'] . '</td>';
							   	echo '<td>'. $row['fishLength'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn" href="fish_read.php?id='.$row['fishID'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="fish_update.php?id='.$row['fishID'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="fish_delete.php?id='.$row['fishID'].'">Delete</a>';
							   	echo '</td>';
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