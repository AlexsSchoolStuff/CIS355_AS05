<?php 
session_start();
if( !isset($_SESSION["personID"]) ){
    header("location:login.php");
	exit();
}
	require '../../database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM AS05_person where personID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($_SESSION['personID']));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
		
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
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>User Info:</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['personName'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Title</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php if($data['personTitle'] == 1){
								echo "Admin";}
								else{
									echo "User";
								}
									?>
						    </label>
					    </div>
					  </div>
					  
					  <div>
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
					  
					   
					   
					   
					   
					   
					   
					   
					   $sql = 'SELECT * FROM AS05_catch WHERE catchPersonID='.$_SESSION['personID'];
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
					  
					  
					  
					  
					  
					    <div class="form-actions">
						  <button type="button" class = "btn" onclick="history.back();">Back</button>
						  <a class = "btn btn-success" href = "login.php">Login Screen</a>
						  <a class = "btn btn-info" href = "catch.php">Catch Screen</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>