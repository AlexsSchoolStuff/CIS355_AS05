	<?php 
	
	require '../../database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$numError = null;
		
		
		// keep track post values
		$name = $_POST['personName'];
		$num = $_POST['personCatchNum'];
		
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}

		if (!is_numeric($num)) {
			$numError = 'Please enter number of fish caught';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO AS05_person (personName, personCatchNum) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$num));
			Database::disconnect();
			header("Location: person.php");
		}
	}
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
		    			<h3>Add User</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="person_create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="personName" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($numError)?'error':'';?>">
					    <label class="control-label">Caught Fish</label>
					    <div class="controls">
					      	<input name="personCatchNum" type="text" placeholder="Caught Fish" value="<?php echo !empty($num)?$num:'';?>">
					      	<?php if (!empty($numError)): ?>
					      		<span class="help-inline"><?php echo $numError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					 
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Add</button>
						  <a class="btn" href="person.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>