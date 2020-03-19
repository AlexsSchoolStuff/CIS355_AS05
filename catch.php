<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<a class = "btn btn-default" href = "myaccount.php">My Account</a>
<body>
    <div class="container">
	
    		<div class="row">
    			<h3>Catch File</h3>
    		</div>
			<div class="row">
				<p>
					<a href="catch_create.php" class="btn btn-success">Create New Catch</a>
					
					
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Person</th>
		                  <th>Fish</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   require '../../database.php';
					   $pdo = Database::connect();
					   
					   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "SELECT * FROM AS05_fish";
						$q = $pdo->prepare($sql);
						$q->execute();
						$results = $q->fetchAll();
						
						$sql2 = "SELECT * FROM AS05_person";
						$q2 = $pdo->prepare($sql2);
						$q2->execute();
						$results2 = $q2->fetchAll();
						//var_dump($results2);
					   
					   
					   
					   
					   
					   
					   $sql = 'SELECT * FROM AS05_catch ORDER BY id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
								
								foreach ($results2 as $item){
									if ($row['catchPersonID'] == $item["personID"]){
									echo '<td>'. $item["personName"] . '</td>';
									}	
								}
								foreach ($results as $item){
										if ($row['catchFishID'] == $item["fishID"]){
												echo '<td>'. $item["fishSpecies"] . " (" . $item["fishWeight"] . " lbs)" . " (" . $item["fishLength"] . " in)" . '</td>';
										}
								}	
								
								
								
								if ($_SESSION['personTitle']==1 || $row['catchPersonID']== $_SESSION['personID']){
							   	echo '<td width=250>';
							   	echo '<a class="btn" href="catch_read.php?id='.$row['id'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="catch_update.php?id='.$row['id'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="catch_delete.php?id='.$row['id'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
								}
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>