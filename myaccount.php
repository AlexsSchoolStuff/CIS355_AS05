<?php 
session_start();
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